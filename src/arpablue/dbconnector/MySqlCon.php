<?php


namespace ArpaBlue\dbconnector;


class MySqlCon extends DbConnector
{
    /**
     * @var null It contains the connection to the database.
     */
    protected $mCon;
    //////////////////////////////////////////
    /**
     * Default constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setPort(3306);
        $this->mCon = null;
        $this->setConnectionStatus(false );
    }

    /**
     * Default destructor.
     */
    public function __destruct()
    {
        parent::__destruct();
    }
    //////////////////////////////////////////
    /**
     * It open the connection to the database.
     * @return bool It is true the connection to the database is opened without problem.
     */
    public function open()
    {
        $this->setConnectionStatus(false );
        $this->info("MySqLCon - Open the connection to the database.");
        if( $this->isOpen() )
        {
            $this->error( 'MySqLCon - The connection to the database is open, it is not possible open a new connection until close the current connection.');
            return false;
        }
        if( !$this->verifyCredentials()  )
        {
            return false;
        }
        $this->setConnectionStatus(false );
        try {

            mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL);


            $con = new \mysqli(
                $this->getHost(),
                $this->getUser(),
                $this->getPassword(),
                $this->getDatabase()
            );

            if ($con->connect_error) {
                $this->error("MySqL - Connection to the database failed.");
                return false;
            }
            $this->log("MySqLCon - The connection to the database is success.");
            $this->setConnectionStatus(true );
            $this->mCon = $con;
            return true;
        }catch( Exception $e ) {
            $this->error("MySqLCon - " . $e->getMessage());
        }
        return false;
    }

    /**
     * It close the connection with the database.
     * @return bool It is true the database
     */
    public function close()
    {
        if( $this->isOpen() )
        {
            $this->mCon->close();
            $this->mCon = null;
            $this->setConnectionStatus(false );
            return true;
        }
        return false;
    }
    /**
     * It return current state of the connection with the database.
     * @return bool It is true the connection is opened.
     */
    /**
     * It verify if the connection and the query are valid to be executed.
     * @param $sql string It is the query to validate is a valid param.
     * @return bool It is true the environment is valid to execute the query.
     */
    protected function validate( $sql )
    {
        $this->mResult = null;
        if( $sql == null )
        {
            $this->error("MySqlCon - It is not possible execute a null query.");
            return false;
        }
        if( !$this->isOpen() ){
            $this->error("MySqlCon - The connection with the database is not opened.");
            return false;
        }
        return true;
    }
    /**
     * It execute a sql sentence, this sentence return the result, ex: select, show, describe, etc.
     * @param String $sql it is the sql to executed
     * @return array It is the result of the query, if the query has not been executed successfully then the result
     * is null.
     */
    public function executeQuery( $sql )
    {
        if( !$this->validate( $sql ) )
        {
            return null;
        }
        $this->log('MySqlCon - Executing the SQL ['.$sql.']');
        $res = array();
        mysqli_report (MYSQLI_REPORT_OFF);
        $result = $this->mCon->query($sql);
        if ($result->num_rows > 0)
        {
            // output data of each row
            //$i = 0;
            while($row = $result->fetch_assoc())
            {
                //$i = 0;
                $line = array();
                foreach( $row as $k => $v )
                {
                    $line[$k] = $v;
                    //$line[$i] = $v ;
                    //$i++;
                }
                $res[] = $line;

            }
        }
        $this->mResult = $res;
        return $res;
    }
    /**
     * It execute a sql sentence that modify the data adn not return a result, ex: update,insert, delete, etc.
     * @param String $sql It is the sql sentence to be executed.
     * @return bool It is true if the sql has been executed without problem.
     */
    public function executeNonQuery( $sql ){
        if( !$this->validate( $sql ) )
        {
            return false;
        }
        $this->log('MySqlCon - Executing the SQL ['.$sql.']');
        $this->mResult = null;
        if( $this->mCon->query($sql) )
        {
            $this->log("The QUERY has been executed successfully.");
            return true;
        }
        $this->error('executeNonQuery: '.$this->mCon->error);
        return false;
    }

}