<?php


namespace Ablb\TreePath;


class TreePat_DTO extends TreePath_Base
{
    /**
     * @var array It is the list of elements, each element could be a element or another TreePath.
     */
    protected $mNodes;

    /**
     * TreePath constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->mNodes = array();
    }

    /**
     * TreePath destructor.
     */
    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * It specify the value for a Key , the key cannot be null or empty. If the key not exists then it is added.
     * @param $key string It is the value reference in the TreePath.
     * @param $value mixed It is a basic value.
     * @return boolean It is true if the value and the key has been ser without problems.
     */
    public function set($key, $value)
    {
        $key = $this->format( $key );
        if( $key == null )
        {
            return false;
        }
        $this->mNodes[ $key ] = $value;
        return true;
    }

    /**
     * It return the value of a Key, if the value not exists then return false.
     * @param $key string It is the key to get its value.
     * @return mixed|null it i sthe value of the key.
     */
    public function get($key)
    {
        $key = $this->format( $key );
        if( $key == null )
        {
            return null;
        }
        return $this->mNodes[ $key ];
    }
    /**
     * It return the quantity oif nodes in the first level of the TreePath.
     * @return int it is the number of elements in the first level.
     */
    public function size()
    {
        return count($this->mNodes);
    }
}