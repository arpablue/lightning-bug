<?php


namespace ArpaBlue\MapRouter;

/**
 * Class MapRouter_Log
 * It class contains the method to manage the log object.
 * @package ArpaBlue\MapRouter
 */
class MapRouter_Log{
    /**
     * @var null It is the log object used to raise the events and error messages.
     */
    protected $mLog;
    //////////////////////////////////////////// constructors destructor /////////////////////////////////////
    /**
     * MapRouter constructor.
     */
    public function __construct(){
        $this->mLog = null;
    }
    /**
     * MapRouter destructor.
     */
    public function __destruct(){}
    ///////////////////// Methods //////////////////////////////
    /**
     * It specify the object to write the log messages.
     * @param $log ILog It is the object to write log messages.
     */
    public function setLog( $log )
    {
        $this->mLog = $log;
    }
    /**
     * It write a message in the log, without a tag or title.
     * @param $msg string It is the message to write in the log.
     */
    protected function log( $msg )
    {
        if( $this->mLog == null )
        {
            return;
        }
        $this->mLog->log( $msg );
    }
    /**
     * It is the error message to be displayed in the error,the tag or tile ERROR will be displayed at the beginning of
     * the message.
     * @param $msg string it is the message to be raise as error.
     */
    protected function error( $msg )
    {
        if( $this->mLog == null )
        {
            return;
        }
        $this->mLog->error( 'ERROR: ' . $msg );
    }
    /**
     * It is the error message to be displayed in the error,the tag or tile ERROR will be displayed at the beginning of
     * the message.
     * @param $msg string it is the message to be raise as error.
     */
    protected function warning( $msg )
    {
        if( $this->mLog == null )
        {
            return;
        }
        $this->mLog->warning( $msg );
    }
    /**
     * It is the error message to be displayed in the error,the tag or tile ERROR will be displayed at the beginning of
     * the message.
     * @param $msg String it is the message to be raise as error.
     */
    protected function info( $msg )
    {
        if( $this->mLog == null )
        {
            return;
        }
        $this->mLog->info( $msg );
    }
}