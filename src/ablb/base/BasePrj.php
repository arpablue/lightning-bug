<?php

namespace Ablb\Base;

/**
 * It is a class for test.
 */
class BasePrj extends AttrManager
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
        $this->mTable = 'prj';

        $this->setAttribute('id',null);
        $this->setAttribute('name',null);
        $this->setAttribute('acron',null);
        $this->setAttribute('descr',null);
        $this->setAttribute('active',null);
        $this->setAttribute('remove',null);
        $this->setAttribute('icon',null);
        $this->setAttribute('createdAt',null);
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
     * It specify the acron value.
     */
    public function getAcron()
    {
        return $this->getAttribute('acron');

    }
    /**
     * It return the acron value.
     */
    public function setAcron( $value )
    {
        $this->setAttribute('acron', $value);
    }
    /**
     * It specify the descr value.
     */
    public function getDescr()
    {
        return $this->getAttribute('descr');

    }
    /**
     * It return the descr value.
     */
    public function setDescr( $value )
    {
        $this->setAttribute('descr', $value);
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
     * It specify the icon value.
     */
    public function getIcon()
    {
        return $this->getAttribute('icon');

    }
    /**
     * It return the icon value.
     */
    public function setIcon( $value )
    {
        $this->setAttribute('icon', $value);
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
