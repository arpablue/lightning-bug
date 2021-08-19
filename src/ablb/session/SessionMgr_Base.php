<?php


namespace Ablb\session;


use Ablb\Base\BaseLog;
use ArpaBlue\AbTools\Logger;

class SessionMgr_Base extends BaseLog
{
    /**
     * @var String It is the name of the current session.
     */
    protected $mName;
    /**
     * It enable or disable the error with session in php.
     * @var bool
     */
    protected $mSetError = true;

    /**
     * SessionMgr constructor.
     * @param $name string It is the name of the current session.
     * @param string $path It is the path of the log file.
     * @param int $level It is the level of the message to be raised.
     */
    public function __construct()
    {
        parent::__construct();
        $this->mSetError = true;
    }
    public function __destruct()
    {
    }

}