<?php


namespace Ablb\base;


class AttrManager_DAO extends AttrManager_Status
{
    /**
     * @var array It is the group of attributes of the object.
     */
    protected $mAttrs;
    /**
     * @var DbConnector It is the connector to the database.
     */
    protected $mConn = null;
    /**
     *
     * @var string It is the table related with the current object.
     */
    protected $mTable;
    ////////////////////////////////////////////constructors destructor /////////////////////////////////////
    /**
     * MapRouter destructor.
     */
    public function __destruct(){
        parent::__destruct();
    }
    /**
     * MapRouter constructor.
     */
    public function __construct(){
        parent::__construct();
        $this->mTable = null;
        $this->initConnector();
    }
    ///////////////////////////////////// Methods //////////////////////////////////////

    public function clean()
    {
        unset( $this->mAttrs );
        $this->mAttrs = array();
    }

    /**
     * It return the current table associate to the object.
     * @return string|null
     */
    public function getTable()
    {
        return $this->mTable;
    }
    /**
     * It start init connection with a global connection.
    */
    protected function initConnector()
    {
        $this->log('Start the DB connection.');
        if( $this->mConn != null )
        {
            $this->log('The connection to the database has been stablish.');
            return false;
        }
        if( !isset( $GLOBALS['DB_CONN'] ) )
        {
            $this->log('The global connector is not specified.');
            return false;
        }
        $this->log('...The global connection has been stablish.');
        $this->mConn = $GLOBALS['DB_CONN'];
        $this->mConn->setLog( $this->mLog );
        return true;
    }
    /**
     * It stablish the connection with the data base.
     * @param $conn DbConnector It is the connector to the current database.
     */
    public function setDbConnector( $conn )
    {
            $this->mConn = $conn;
    }
    /**
     * It return the current connection to the database.
     * @return mixed It is the connector to the database.
     */
    protected function getDbConnector(){
        return $this->mConn;
    }
    /**
     * It execute a query in the database using the current table.
     * @param $sql string It is the sql to get a result from the database.
     * @return array It is the result of the query.
     */
    protected function executeQuery( $sql )
    {
        return $this->getDbConnector()->executeQuery( $sql );
    }
    /**
     * It execute a sentence sql to modify the database.
     * @param $sql string It is the sql to modify the database.
     * @return boolean It is true the sql has been executed without problem.
     */
    protected function executeNonquery( $sql )
    {
        return $this->getDbConnector()->executeNonQuery( $sql );
    }
    /**
     * It return the current status of the connection with the database.
     * @return bool It is true the connection with the database is open, in any other cases is false.
     */
    public function isOpen()
    {
        if( $this->mConn == null )
        {
            return false;
        }
        return $this->mConn->isOpen();
    }
    /**
     * It insert a new object in the database with the fields specified, if the a field is ID them
     * this field is ignorated and is add a new element.
     * @return bool It is the element has been add without problem.
     */
    public function insert()
    {
        if( !$this->isOpen() )
        {
            $this->error('It is not possible add a new element, because the connection with the database is closed.');
            return false;
        }
        $attrs = '';
        $vals = '';
        $flag = false;
        foreach( $this->mAttrs as $k => $v)
        {
            if( strcasecmp('id', $k ) == 0 )
            {
                continue;
            }
            if( $flag ){
                $attrs = $attrs.',';
                $vals = $vals.',';
            }
            $flag = true;
            $attrs = $attrs.$k;
            $vals = $vals."'".$v."'";
        }
        $sql = 'INSERT INTO '.$this->mTable.' ('.$attrs.') VALUES ('.$vals.')';
        $this->executeNonQuery( $sql );
        return true;
    }
    /**
     * It load the data from the assigned table.
     * @param $id string|int It is the id of the object to load the data of the database.
     * @return bool It is the true if the object with the id exists.
     */
    public function load( $id = null )
    {
        if( $id == null )
        {
            $id = $this->getId();
        }
        if( $id == null )
        {
            $this->warning('It is not possible load data from NULL ID.');
            return false;
        }
        $this->log('Loading data from the database.');

        if( !$this->isOpen() )
        {
            $this->error('load: The connection to the database is not opened.');
            return false;
        }
        if( $id == null ){
            $this->error('load: It is not possible search data with a null value in the id.');
            return false;
        }
        $sql = 'SELECT * FROM '.$this->getTable().' WHERE id='.$id;
        return $this->applyQuery( $sql );
    }
    /**
     * It apply a query and the result apply the attributes of the current object, if more of one result is returnted
     * then only the first is applied to the object.
     * @param $sql string It is the query executed.
     * @return bool It i strue the query has been executed without problem.
     */
    protected function applyQuery( $sql )
    {

        $results = $this->executeQuery( $sql );
        if( $results == null )
        {
            return false;
        }
        $size = count( $results );
        if( $size < 0 )
        {
            return false;
        }
        $this->log('Number of users found: '.count($results));
        $this->setAttributes( $results[0] );


        return true;
    }
    /**
     * It search a user with a condition, if the where condition is not specified then the condition wil be create from the
     * current not empty attributes.
     * @param $where string It is the where condition used to search a user with particular conditions.
     * @param $complement string It is a complement used for the query, ex; ORDER BY, LIMI, etc.
     * @return bool It is true then query has been executed without problem.
     */
    public function search( $where = null , $complement = null)
    {
        if( $where == null )
        {
            $where = $this->createWhere();

        }

        $sql = 'SELECT * FROM '.$this->getTable().' WHERE '.$where;
        if($complement != null )
        {
            $sql = $sql . ' ' . $complement;
        }
        return $this->applyQuery( $sql );
    }

    /**
     * It return  where condition using the current not empty values.
     * @return string It is the where condition.
     */
    protected function createWhere()
    {
        $res = '';
        $flag = false;

        foreach( $this->mAttrs as $key => $value )
        {
            if( $flag )
            {
                $res = $res . 'AND';
            }
            $flag = true;
            if( $value == null )
            {
                continue;
            }
            if( strlen( $value ) < 1)
            {
                continue;
            }
            $res = $res . '('.$key ."='".$value."')";
        }

        return $res;
    }
}