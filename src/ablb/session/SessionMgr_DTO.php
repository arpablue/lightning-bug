<?php


namespace Ablb\session;


class SessionMgr_DTO extends SessionMgr_Base
{
    /**
     * SessionMgr constructor.
     * @param $name string It is the name of the current session.
     * @param string $path It is the path of the log file.
     * @param int $level It is the level of the message to be raised.
     */
    public function __construct( $name = null )
    {
        parent::__construct();
        $this->setName( $name );
    }
    /**
     * default destructor.
     */
    public function __destruct()
    {
    }
    /**
     * It enable the error of the session.
     * @param $flag boolean It is true the error are showing.
     */
    public function setEnableError( $flag )
    {
        $this->mSetError = $flag;
    }
    /**
     * It specify the name of the current session.
     * @param $name string It is the name of the current session.
     */
    public function setName( $name )
    {
        $this->mName = $name;
    }
    /**
     * It return the name of the current session.
     *
     * @return String It is the name of the current session.
     */
    public function getName()
    {
        return $this->mName;
    }
    /**
     * It save a value in the current session.
     * @param $key string It is the name of the variable.
     * @param $value mixed It is the value of the session.
     */
    public function set($key, $value)
    {
        $_SESSION[$this->getName()][ $key ] = $value;
    }

    /**
     * It return the values of the current session.
     * @param $key string It is the name of the variable of the current session.
     * @return mixed It is the value of the session of the variable.
     */
    public function get( $key )
    {
        if( isset( $_SESSION[ $this->mName ][ $key ] ) )
        {
            return $_SESSION[ $this->mName ][ $key ];
        }
        return$_SESSION[ $this->mName ][ $key ];
    }
}