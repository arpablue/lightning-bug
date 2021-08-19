<?php


namespace Ablb\session;


class SessionMgr_Logic extends SessionMgr_DTO
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
    /**
     * It start the session of the user.
     */
    public function start()
    {

        $this->deep('...Start session');

        session_start();
        if( !$this->mSetError ){
            error_reporting( 0 );
        }
        $_SESSION[ $this->mName ] = array();
    }
    /**
     * Finalize the current session.
     */
    public function finish()
    {

        $this->info('...Finish ['.$this->getName().'] session');
        session_destroy();
    }
    /**
     * Clear the current session variables.
     */
    public function clear()
    {
        $this->deep('Cleaning the ['.$this->getName().'] session.');
        unset( $this->mName );
    }

    /**
     * It verify if the current session is active.
     * @return bool It is true the current session is active.
     */
    public function exists()
    {
        $flag = isset( $_SESSION[ $this->mName] );
        if( $flag )
        {
            $this->deep('The ['.$this->getName().'] session exists.');
        }else{
            $this->deep('The ['.$this->getName().'] session not exists.');
        }
        return $flag;
    }

}