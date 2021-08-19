<?php


namespace ArpaBlue\dbconnector;


use ArpaBlue\interfaces\IOpenClose;

/**
 * Class DbConnector_OpenClose
 * It class
 * @package ArpaBlue\dbconnector
 */
abstract class DbConnector_OpenClose extends DbConnector_Base implements IOpenClose
{
    /**
     * It contains the status of the connection of the database.
     * @var bool It is true the connection to the database is open.
     */
    private $mIsOpen = false;
    //////////////////////////////////////////
    /**
     * Default constructor.
     */
    public function __construct()
    {
        parent::__construct();
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
     * It return the status of the connection of the database.
     * @return bool It is true the connection is open.
     */
    public function isOpen()
    {
        return $this->mIsOpen;
    }

    /**
     * It specify the current connection of the database.
     * @param $status bool It is the status of the database connection.
     */
    protected function setConnectionStatus( $status )
    {
        $kind = gettype( $status);
        if( strcmp( $kind, 'boolean' ) === 0 )
        {

            $this->mIsOpen = $status;
            return;
        }
        $this->mIsOpen = false;
    }
    /**
     * It return the current status of the connection of the database, by default is false.
     * If the method return true then the connection is open in other cases is false.
     * @return bool It is the current status pof the connection
     */
    protected function getConnectionStatus()
    {
        return $this->mIsOpen;
    }
    /**
     * It open the connection to the database.
     * @return bool It return true if the connection has been opened without problems.
     */
    public abstract function open();
    /**
     * It close the connection with the database.
     * @return bool It the connection has been closed without problems.
     */
    public abstract function close();
}