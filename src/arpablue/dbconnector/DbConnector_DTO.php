<?php


namespace ArpaBlue\DbConnector;


abstract class DbConnector_DTO extends DbConnector_OpenClose
{
    /**
     * @var String It contains the host for the connection of tdatabase.
     */
    protected $mHost;
    /**
     * @var String It is the name of the database to be connected.
     */
    protected $mDatabase;
    /**
     * @var String It contains the user used for the connection.
     */
    protected $mUser;
    /**
     * @var String It contains the user the password used for the connection.
     *
     */
    protected $mPwd;
    /**
     * @var String It contain the port connection of the database.
     */
    protected $mPort;
    /**
     * @var array It contains the result of the execution of a query, each element ia another array with the values of the row,
     * the query is a no no sql then the contain is null.
     */
    protected $mResult;
    //////////////////////////////////////////
    /**
     * Default constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setHost( null );
        $this->setDatabase( null );
        $this->setUser( null );
        $this->setPassword( null );
        $this->setPort( null );

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
     * It contains the response of the execution of a sql query execution. It the query is a no sql sentences
     * then this method return null. It result is an array of arrays, each element of the firs array
     * is a row of the response.
     * @return array It is the result of the execution of a query execution.
     */
    public function getResult()
    {
        return $this->mResult;
    }
    /**
     * It verify that all credential for the connection with the database are set.
     * @return bool It is true all credential are set.
     */
    protected function verifyCredentials()
    {
        $flag = true;
        if( $this->getHost() == null )
        {
            $this->error('MySqLCon - The host of the database is not specified.');
            $flag = false;
        }
        if( $this->getDatabase() == null )
        {
            $this->error('MySqLCon - The database for the the connection is not specified.');
            $flag = false;

        }
        if( $this->getPort() == null )
        {
            $this->error('MySqLCon - The port of the database is not specified.');
            $flag = false;

        }
        if( $this->getUser() == null )
        {
            $this->error('MySqLCon - The user of the database is not specified.');
            $flag = false;
        }
        if( $this->getPassword() == null )
        {
            $this->error('MySqLCon - The password of the database is not specified.');
            $flag = false;
        }
        return $flag;
    }
    /**
     * It specify the host use for the connection.
     * @param $value String It is the host that contain the database.
     */
    public function setHost( $value )
    {
        $this->mHost = $value;
    }

    /**
     * It return the current host.
     * @return String It is the host for the database connection.
     */
    public function getHost()
    {
        return $this->mHost;
    }
    /**
     * It specify the host use for the connection.
     * @param $value String It is the host that contain the database.
     */
    public function setDatabase( $value )
    {
        $this->mDatabase = $value;
    }

    /**
     * It return the current host.
     * @return String It is the host for the database connection.
     */
    public function getDatabase()
    {
        return $this->mDatabase;
    }
    /**
     * It specify the host use for the connection.
     * @param $value String It is the host that contain the database.
     */
    public function setUser( $value )
    {
        $this->mUser = $value;
    }
    /**
     * It return the current host.
     * @return String It is the host for the database connection.
     */
    public function getUser()
    {
        return $this->mUser;
    }
    /**
     * It specify the host use for the connection.
     * @param $value String It is the host that contain the database.
     */
    public function setPassword( $value )
    {
        $this->mPwd = $value;
    }

    /**
     * It return the current host.
     * @return String It is the host for the database connection.
     */
    public function getPassword()
    {
        return $this->mPwd;
    }
    /**
     * It specify the host use for the connection.
     * @param $value String It is the host that contain the database.
     */
    public function setPort( $value )
    {
        $this->mPort = $value;
    }
    /**
     * It return the current host.
     * @return String It is the host for the database connection.
     */
    public function getPort()
    {
        return $this->mPort;
    }

}