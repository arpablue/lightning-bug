<?php

namespace Ablb\Base;

/**
 * It is a class for test.
 */
class BaseUser_prj extends AttrManager
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
        $this->mTable = 'user_prj';

        $this->setAttribute('userId',null);
        $this->setAttribute('prjId',null);
        $this->setAttribute('active',null);
        $this->setAttribute('remove',null);
        $this->setAttribute('createdAt',null);
    }
    /**
     * It specify the userId value.
     */
    public function getUserId()
    {
        return $this->getAttribute('userId');

    }
    /**
     * It return the userId value.
     */
    public function setUserId( $value )
    {
        $this->setAttribute('userId', $value);
    }
    /**
     * It specify the prjId value.
     */
    public function getPrjId()
    {
        return $this->getAttribute('prjId');

    }
    /**
     * It return the prjId value.
     */
    public function setPrjId( $value )
    {
        $this->setAttribute('prjId', $value);
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
     * It specify the remove value.
     */
    public function getRemove()
    {
        return $this->getAttribute('remove');

    }
    /**
     * It return the remove value.
     */
    public function setRemove( $value )
    {
        $this->setAttribute('remove', $value);
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
}
