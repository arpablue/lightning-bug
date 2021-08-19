<?php


namespace Ablb\User;


use Ablb\base\AttrManager;

class User_Logic extends User_DAO
{
    ////////////////////////////////////////////constructors destructor /////////////////////////////////////
    /**
     * MapRouter destructor.
     */
    public function __destruct(){
        parent::__destruct();
    }
    /**
     * MapRouter constructor.
     */
    public function __construct(){
        parent::__construct();
    }
    ///////////////////////////////////// Methods //////////////////////////////////////


    /**
     * It add more detail to the password to get more security in the password. It the method return null
     * then at less one of the data necessary to generate the new password is null or empty.
     * @param $value string It is the password.
     * @return string|null It is the new password generated.
     */
    protected function getPwdControl( $value )
    {
        $uname = $this->getUsername();
        if( $uname == null )
        {
            $this->warning('The username cannot be NULL.');
            return null;
        }
        if( strlen( $uname ) <  1 )
        {
            $this->warning('The username cannot be empty.');
            return null;
        }
        if( $value == null )
        {
            $this->warning('The password cannot be NULL.');
            return null;
        }
        if( strlen( $uname ) <  1 )
        {
            $this->warning('The password cannot be empty.');
            return null;
        }
        $pwd = $uname.'_'.$value;
        $pwd = md5($pwd);
        return $pwd;
    }

    /**
     * It generate a token for the current user
     * @return string It is a token generated.
     */
    protected function generateToken()
    {
        $res = rand();
        $res = uniqid( $res, true );
        $res = sha1( $res );
        return $res;
    }

}