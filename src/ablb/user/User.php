<?php

namespace Ablb\User;

class User extends User_To
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
     * It return an User object with the default attributes initialized.
     */
   public static function create()
   {
       $user = new User();
       $user->setActive( 1 );
       $user->setRemoved( 1 );
       $user->setCreatedAt( $user::getCurrentInstant() );
       return $user;
   }

}