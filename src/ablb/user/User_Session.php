<?php
namespace Ablb\User;


use Ablb\base\AttrManager;

class User_Session extends User_Logic
{
    ////////////////////////////////////////////constructors destructor /////////////////////////////////////
    /**
     * MapRouter destructor.
     */
    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * MapRouter constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }
    ///////////////////////////////////// Methods //////////////////////////////////////
    /**
     * It execute the login process for a user. It method verify f the user is logged, in this case return false.
     * It generate a unique token for the session.
     * @param $username string It is the username.
     * @param $pwd string It is the password.
     * @return string it is the token assigned.
     */
    public function login( $username = null, $pwd = null )
    {
        if( $username == null )
        {
            return null;
        }
        if( $pwd == null )
        {
            return null;
        }
        $username = $this->formating( $username, $pwd );
        if( $username == null )
        {
            return null;
        }
        $this->clean();

        $this->setUsername( $username );
        $this->setPwd( $pwd );
        if( !$this->search() ){
            $this->error("Fail to login, please another.");
            return null;
        }
        $this->success('Login success.');
        $token = $this->generateToken();
        $this->setToken( $token );
        $this->addFieldToResponse('token', $this->getToken() );
        $this->sessionStart();
        $this->addFieldToResponse('token',$token);
        return $token;
    }

    /**
     * It finish the session of the current user.
     */
    public function logout()
    {
        if( $this->getUsername() == null )
        {
            $this->error("It is not possible finish a session with a NULL username.");
            return false;
        }
        if( strlen( $this->getUsername() ) < 1 )
        {
            $this->error("It is not possible finish a session with an empty username.");
            return false;

        }
        $this->sessionFinish();

    }
    /**
     * It initialize the session with the current username, for this it is necessary the user have the
     *
     */
    protected function sessionStart()
    {
        $session = $GLOBALS['API_SESSION'];
        if( $session == null)
        {
            return false;
        }
        if( !$session->exists() )
        {
            $this->deep('The ['.$this->getUsername().'] session not exists.');
            $session->start();
        }else{
            $this->deep('The ['.$this->getUsername().'] session exists.');
        }
        if( $this->getToken() != null )
        {
            $session->set( 'token', $this->getToken() );
        }
        return true;
    }

    /**
     * It finish the session of the current user.
     * @return bool
     */
    protected function sessionFinish()
    {
        $session = $GLOBALS['API_SESSION'];
        if( $session == null)
        {
            return false;
        }
        if( $session->exists() )
        {
            return $session->finish();
        }
        return false;
    }

}
