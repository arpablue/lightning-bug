<?php

namespace Ablb\Base;

/**
 * It is a class for test.
 */
class BaseUser extends AttrManager
{
    ////////////////////////////////////////////constructors destructor /////////////////////////////////////
    /**
     * MapRouter destructor.
     */
    public function __destruct()
    {
    }
    /**
     * MapRouter constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->initAttrs();
    }
    ///////////////////////////////////////////////////////////////////
    protected function initAttrs()
    {
        $this->mTable = 'user';

        $this->setAttribute('id',null);
        $this->setAttribute('name',null);
        $this->setAttribute('lastname',null);
        $this->setAttribute('email',null);
        $this->setAttribute('username',null);
        $this->setAttribute('pwd',null);
        $this->setAttribute('photo',null);
        $this->setAttribute('active',null);
        $this->setAttribute('removed',null);
        $this->setAttribute('createdAt',null);
        $this->setAttribute('token',null);
    }
    /**
     * It specify the id value.
     */
    public function getId()
    {
        return $this->getAttribute('id');

    }
    /**
     * It return the id value.
     */
    public function setId( $value )
    {
        $this->setAttribute('id', $value);
    }
    /**
     * It specify the name value.
     */
    public function getName()
    {
        return $this->getAttribute('name');

    }
    /**
     * It return the name value.
     */
    public function setName( $value )
    {
        $this->setAttribute('name', $value);
    }
    /**
     * It specify the lastname value.
     */
    public function getLastname()
    {
        return $this->getAttribute('lastname');

    }
    /**
     * It return the lastname value.
     */
    public function setLastname( $value )
    {
        $this->setAttribute('lastname', $value);
    }
    /**
     * It specify the email value.
     */
    public function getEmail()
    {
        return $this->getAttribute('email');

    }
    /**
     * It return the email value.
     */
    public function setEmail( $value )
    {
        $this->setAttribute('email', $value);
    }
    /**
     * It specify the username value.
     */
    public function getUsername()
    {
        return $this->getAttribute('username');

    }
    /**
     * It return the username value.
     */
    public function setUsername( $value )
    {
        $this->setAttribute('username', $value);
    }
    /**
     * It specify the pwd value.
     */
    public function getPwd()
    {
        return $this->getAttribute('pwd');

    }
    /**
     * It return the pwd value.
     */
    public function setPwd( $value )
    {
        $this->setAttribute('pwd', $value);
    }
    /**
     * It specify the photo value.
     */
    public function getPhoto()
    {
        return $this->getAttribute('photo');

    }
    /**
     * It return the photo value.
     */
    public function setPhoto( $value )
    {
        $this->setAttribute('photo', $value);
    }
    /**
     * It specify the active value.
     */
    public function getActive()
    {
        return $this->getAttribute('active');

    }
    /**
     * It return the active value.
     */
    public function setActive( $value )
    {
        $this->setAttribute('active', $value);
    }
    /**
     * It specify the removed value.
     */
    public function getRemoved()
    {
        return $this->getAttribute('removed');

    }
    /**
     * It return the removed value.
     */
    public function setRemoved( $value )
    {
        $this->setAttribute('removed', $value);
    }
    /**
     * It specify the createdAt value.
     */
    public function getCreatedAt()
    {
        return $this->getAttribute('createdAt');

    }
    /**
     * It return the createdAt value.
     */
    public function setCreatedAt( $value )
    {
        $this->setAttribute('createdAt', $value);
    }
    /**
     * It specify the token value.
     */
    public function getToken()
    {
        return $this->getAttribute('token');

    }
    /**
     * It return the token value.
     */
    public function setToken( $value )
    {
        $this->setAttribute('token', $value);
    }

    /**
     * @param $target string It is the text to put on format,
     * if the text is null or empty then the method return null.
     * @return string|null It is the text formated.
     */
    protected static function formating( $target ){
        if( $target == null  )
        {
            return null;
        }
        $target = trim( $target );
        if( strlen( $target ) <= 1)
        {
            return null;
        }
        $target = strtolower( $target );
        return $target;
    }
}
