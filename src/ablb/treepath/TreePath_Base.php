<?php


namespace Ablb\TreePath;


class TreePath_Base
{
    /**
     * Default constructor.
     */
    public function __construct()
    {
    }

    /**
     * Default destructor.
     */
    public function __destruct()
    {
    }

    /**
     * It put in format a value, it is without white spaces at the beginning and at the end of the string, no null
     * and not empty.
     * @param $target string it i sthe string to put on format.
     * @return string|null It is null the string to be format is empty or null.
     */
    public static function format( $target )
    {
        if( $target == null )
        {
            return null;
        }
        $target = trim( $target);
        if( strlen($target) < 1)
        {
            return null;
        }
        $target = str_replace('\\','/',$target);
        return $target;
    }

}