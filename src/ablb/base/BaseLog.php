<?php


namespace Ablb\Base;


use Ablb\TreePath\TreePath;
use ArpaBlue\interfaces\ILog;

/**
 * Class BaseLog
 * It contain the methods and attributes to manage the log.
 * @package ArpaBlue\MapRouter
 */
class BaseLog implements ILog
{
    protected $mLevel = 0;
    /**
     * @var ILogger It is the logger used to write the messages.
     */
    protected $mLog;
    ////////////////////////////////////////////constructors destructor /////////////////////////////////////
    /**
     * MapRouter destructor.
     */
    public function __destruct(){}
    /**
     * MapRouter constructor.
     */
    public function __construct(){}
    ///////////////////////////////////// Methods //////////////////////////////////////
    protected function initLog()
    {
        if( $this->mLog != null )
        {
            return true;
        }
        if( !isset($GLOBALS['API_LOG']) )
        {
            return false;
        }
        $this->mLog = $GLOBALS['API_LOG'];
        return true;
    }
    /**
     * @return String It return the current time and date in Mysql timestamp format.
     */
    protected static function getCurrentInstant()
    {
        $res =  date('Y-m-d H:i:s');
        if( $res === false )
        {
            return null;
        }
        return $res;
    }
    /**
     * It specify the log output to be used it is a implementation of the ILogger interface.
     * @param $log ILogger it is a ILogger object.
     */
    public function setLog( $log )
    {
        $this->mLog = $log;
    }
    /**
     * Ity write a message in the log output.
     * @param $msg string is the message to be raised.
     */
    public function log( $msg )
    {
        $this->initLog();
        if( $this->mLog == null ){
            return;
        }
        $this->mLog->log( $msg );
    }

    /**
     * This is message to write test message, in production this function not display messages.
     * @param $msg
     */
    public function deep( $msg )
    {
        $this->initLog();
        if( $this->mLog == null ){
            return;
        }
        $this->mLog->log( $msg );
    }
    /**
     * It write an error message in the log ouput.
     * @param $msg string is the message to be raised in the log.
     */
    public function error( $msg ,$code = 400)
    {
        $this->setEvent( 'fail',$code, $msg);
        $this->initLog();
        if( $this->mLog == null ){
            return;
        }
        $this->mLog->error( '['.get_class( $this ) . ']: ' . $msg );
    }
    /**
     * It write a warning message in the log ouput.
     * @param $msg string is the message to be raised in the log.
     */
    public function warning( $msg, $code = '500' )
    {
        $this->setEvent( 'fail',$code, $msg);
        $this->initLog();
        if( $this->mLog == null ){
            return;
        }
        $this->mLog->warning(  '['.get_class( $this ) . ']: ' . $msg );
    }
    /**
     * It write an info message in the log ouput.
     * @param $msg string is the message to be raised in the log.
     */
    public function info( $msg, $code = 202 )
    {
        $this->setEvent( 'info',$code, $msg);
        $this->initLog();
        if( $this->mLog == null ){
            return;
        }
        $this->mLog->info( $msg );
    }
    /**
     * It write an info message in the log ouput.
     * @param $msg string is the message to be raised in the log.
     */
    public function success( $msg , $code = 200 )
    {
        $this->setEvent( 'success',$code, $msg);
        $this->initLog();
        if( $this->mLog == null ){
            return;
        }
        $this->mLog->log( 'SUCCESS: '.$msg );
    }
    /**
     * It set the default values to the default to the response message.
     * @param $type string It is the type of the response.
     * @param $code string It is the code assigned to the response.
     * @param $msg string It is the message displayed for the response.
     */
    protected function setEvent($type, $code, $msg)
    {
        if( !isset( $this->mStatus ))
        {
            $this->mStatus = new TreePath();
        }
        if( $this->mStatus == null )
        {
            $this->mStatus = new TreePath();
        }
        $this->mStatus->set('type',$type);
        $this->mStatus->set('code',$code);
        $this->mStatus->set('msg', $msg);

    }

    /**
     * It add a field tot he response.
     * @param $field string It is the name of the field.
     * @param $value string It is the value of the field.
     */
    protected function addFieldToResponse( $field, $value )
    {
        if( $this->mStatus == null )
        {
            $this->mStatus = new TreePath();
        }
        $this->mStatus->set( $field, $value);

    }
}