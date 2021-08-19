<?php


namespace Ablb\session;


use ArpaBlue\AbTools\Logger;

/**
 * Class SessionMgr
 * It manage the session of the user, load and save the variables
 * @package Ablb\Session
 */
class SessionMgr extends SessionMgr_To
{
    /**
     * SessionMgr constructor.
     * @param $name string It is the name of the current session.
     * @param string $path It is the path of the log file.
     * @param int $level It is the level of the message to be raised.
     */
    public function __construct( $name = null )
    {
        parent::__construct( $name );
    }
    public function __destruct()
    {
    }

}