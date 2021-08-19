<?php

use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase implements \ArpaBlue\interfaces\ILog
{
    protected static $HOST = 'http://www.lightningbug.com';
    /**
     * It contains the name of the test case.
     * @var String It is the name of the current test case
     */
    protected $mTcName = 'test';

    /**
     * It is the Log object used to write the messages of the execution.
     * @var null it is the log object.
     */
    protected $mLog = null;
    /**
     * It compare 2 string, it both string are equals.
     * @param $cur string It is the current string to compare.
     * @param $exp string It is the expected string to compare.
     * @return bool It is true if both string are equals.
     */
    protected function compare($cur, $exp)
    {
        $this->write();
        $this->write('   CUR: ['.$cur.']');
        $this->write('   EXP: ['.$exp.']');
        if( strcasecmp( $cur, $exp ) == 0)
        {
            $this->log("PASS: The expected and the current result are equals.");
            return true;
        }
        $this->log("FAIL: The expected and the current result are different.");
        return false;
    }

    /**
     * It specify the log object to write the message of the test cases.
     * @param $log mixed It is the log object used to write the message of the test cases.
     */
    public function setLog( $log )
    {
        $this->mLog = $log;

    }
    /**
     * it is the log object used to write the execution folder.
     * @return ILog|null
     */
    public function getLog()
    {
        if( $this->mLog == null )
        {
            $this->mLog = new \ArpaBlue\abtools\Logger();
        }
        return $this->mLog;
    }
    /**
     * It return the test result folder to write the logs
     * @return string It is the test result folder.
     */
    protected function getTestFolder()
    {
        $dir = dirname(__FILE__);
        $pos = strpos( $dir,'tests');
        $res = null;
        if( $pos > -1 )
        {
            $res = substr( $dir, 0, $pos );
        }
        $res = $res . 'tests\test_results\\';
        return $res;
    }
    protected function getLogFile()
    {
        return $this->getTestFolder().$this->mTcName.'.log';
    }
    /**
     * @param $msg string It specify the name of the test cases and the title of file.
     */
    protected function title( $msg )
    {
        if( $msg == null )
        {
            return;
        }
        $title = trim( $msg );
        $title = str_replace(" ","_", $title);
        $this->mTcName = $title;
        $this->getLog()->setLogPath($this->getLogFile() );
        $this->getLog()->deleteFile();
        $this->write( '-------------------'.$title."-------------------" );
    }
    /**
     * It write a message in the log, if the log
     * @param $msg String It is the message to be write in the log.
     */
    public function write( $msg = '' )
    {
        $this->getLog()->log( $msg );
    }
    /**
     * @param $msg String It write a message in the log.
     */
    public function log($msg)
    {
        $this->getLog()->log($msg);
    }
    /**
     * @param $msg String It write a message in the log.
     */
    public function info($msg)
    {
        $this->getLog()->info($msg);
    }
    /**
     * @param $msg String It write a message in the log.
     */
    public function warning($msg)
    {
        $this->getLog()->warning($msg);
    }
    /**
     * It write an error message is written in the log.
     * @param $msg String It write a error message in the de log.
     */
    public function error($msg)
    {
        $this->getLog()->error('ERROR: '.$msg);
    }
    /**
     * It test is to formal pass
     */
    public function test_BaseTest_default_test()
    {
        $this->assertEquals(true, true );
    }


}