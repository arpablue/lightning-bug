<?php


namespace ArpaBlue\DbConnector;

use ArpaBlue\interfaces\ILog;

/**
 * Class DbConnector_Log
 * @package ArpaBlue\DbConnector
 * It class contains the method to manage the messages for the log.
 */
class DbConnector_Log implements ILog
{
    /**
     * It is the log object used to
     */
    protected $mLog;
    //////////////////////////////////////////
    /**
     * Default constructor.
     */
    public function __construct()
    {
    }
    /**
     * Default destructor.
     */
    public function __destruct()
    {
    }
    //////////////////////////////////////////
    /**
     * @param $log ILog object It specify the log object to be used.
     */
    public function setLog( $log ){
        $this->mLog = $log;
    }

    /**
     * @return mixed It return the current log object used.
     */
    public function getLog(){
        return $this->mLog;
    }
    /**
     * It write a message in the log object.
     * @param string $msg It is the message to be written in the log.
     * @return null
     */
    public function log( $msg = "" )
    {
        if( $this->mLog == null )
        {
            return null;
        }
        $this->mLog->log( $msg );
    }
    /**
     * It write a message ERROR in the log object.
     * @param string $msg It is the message to be written in the log.
     * @return null
     */
    public function error( $msg = "" )
    {
        if( $this->mLog == null )
        {
            return null;
        }
        $this->mLog->error( $msg );
    }
    /**
     * It write a message WARNING in the log object.
     * @param string $msg It is the message to be written in the log.
     * @return null
     */
    public function warning($msg)
    {
        if( $this->mLog == null )
        {
            return null;
        }
        $this->mLog->warning( $msg );
    }
    /**
     * It write a message INFO in the log object.
     * @param string $msg It is the message to be written in the log.
     * @return null
     */
    public function info($msg)
    {
        if( $this->mLog == null )
        {
            return null;
        }
        $this->mLog->info( $msg );
    }
}