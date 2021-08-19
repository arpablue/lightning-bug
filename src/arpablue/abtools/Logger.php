<?php


namespace ArpaBlue\AbTools;


use ArpaBlue\interfaces\ILog;

class Logger implements ILog
{
    /**
     * It specify the Log level only to show error messages
     * @var int It is the value of the log level for ERROR messages.
     */
    public static $LOG_ERROR=0;
    /**
     * It specify the Log level only to show error and warning messages
     * @var int It is the value of the log level for WARNING messages.
     */
    public static $LOG_WARNING=1;
    /**
     * It specify the Log level only to show error, warning adn info  messages
     * @var int It is the value of the log level for INFO messages.
     */
    public static $LOG_INFO=2;
    /**
     * It specify the Log level only to show all messages including the general messages.
     * @var int It is the value of the log level for ALL messages.
     */
    public static $LOG_ALL=3;
    /**
     * It specify the log level message for the current log
     * @var int It is the value of the log level for ERROR messages.
     */
    protected $mLevel=3;
    /**
     * It containt he path of the log file.
     * @var string It is the path of the log.
     */
    protected $mLogPath ='./logs/app.log';

    /**
     * Logger constructor.
     * @param string $path It is the path of the log file.
     * @param int $level It is the level of the log.
     */
    public function __construct( $path = './logs/app.log', $level = 3 )
    {
        $this->setLogPath( $path );
        $this->setLevel( $level );
    }

    /**
     * It specify the path of the log where the messages will be raised.
     * @param $path string It is the path of the log file.
     */
    public function setLogPath( $path )
    {
        $this->mLogPath = $path;
    }

    /**
     * It is to specify the level of the message, according of the level, the quantity of message
     * and the king of these will be write in the log file.
     * @param $level
     */
    public function setLevel( $level)
    {
        $this->mLevel;
    }
    /**
     * It return the log file where the files are writer.
     * @return string It is the path of the log file.
     */
    public function getLogPath()
    {
        return $this->mLogPath;
    }
    /**
     * It write a message in the log message
     * @param string $msg It is the message to write in the log file.
     */
    protected function write( $msg = '' )
    {
        if( $msg == null )
        {
            $msg = '';
        }
        if( $this->mLogPath == null )
        {
            return;
        }
        $fp = fopen( $this->mLogPath, 'a');//opens file in append mode
        $time = Logger::getNow();
        fwrite($fp, $time.': '.$msg."\n" );
        fclose($fp);
    }
    protected static function getNow()
    {
        $date = date('Y-d-m h:i:s');
        return $date;
    }
    /**
     * It raise a message in the log file with an ERROR tag at the beginning of the message.
     * @param $msg string It is the message to be written as ERROR.
     */
    public function error( $msg )
    {
        $this->write('ERROR: '.$msg );
    }
    /**
     * It raise a message in the log file with an ERROR tag at the beginning of the message.
     * @param $msg string It is the message to be written as ERROR.
     */
    public function warning( $msg )
    {
        if( $this->mLevel >= Logger::$LOG_WARNING )
        {
            $this->write('WARNING: '.$msg );
        }
    }
    /**
     * It raise a message in the log file with an ERROR tag at the beginning of the message.
     * @param $msg string It is the message to be written as ERROR.
     */
    public function info( $msg )
    {
        if( $this->mLevel >= Logger::$LOG_WARNING )
        {
            $this->write('INFO: ' . $msg);
        }
    }
    /**
     * It raise a message in the log file without a tag.
     * @param $msg string It is the message to be written.
     */
    public function log( $msg )
    {
        if( $this->mLevel >= Logger::$LOG_WARNING ) {
            $this->write($msg);
        }
    }

    /**
     * It remove the specified log file
     * @return bool It is true the file has been delete successfully.
     */
    public function deleteFile()
    {
        if( !file_exists($this->mLogPath) )
        {
            return true;
        }
        if (!unlink($this->mLogPath))
        {
            $this->error('It is not possible remove the ['.$this->mLogPath.'] file.');
            return false;
        }
        return true;
    }
}