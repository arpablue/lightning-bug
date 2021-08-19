<?php


namespace Ablb\TreePath;


use ArpaBlue\interfaces\IJson;

class TreePath_To extends TreePat_DTO implements IJson
{
    /**
     * Default constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Default destructor.
     */
    public function __destruct()
    {
        parent::__destruct();
    }
    ///////////////////////////////////////////////////////////////////

    /**
     * It return an string with the data of the TreePath in a JSON format
     * @return string It is the data in a JSON format.
     */
    public function toJSON()
    {
        $res = $this->toJSONnicelly();
        $res = str_replace("\r\n    \"",'"', $res);
        $res = str_replace("\r\n",'', $res);

        return $res;
    }

    /**
     * It return an string of the data of the TreePath in a JSON data and comfortable to the view.
     * @return string It is the data in a JSON data.
     */
    public function toJSONnicelly()
    {
//        if( $this->size() < 1)
//        {
//            return '{}';
//        }
//        $res = "{";
//        $flag = false;
//        foreach( $this->mNodes as $k => $v)
//        {
//            if( $flag )
//            {
//                $res = $res.',';
//            }
//            $flag = true;
//            $res = $res ."\r\n    \"".$k."\":";
//            if( $v == null )
//            {
//                $res = $res . 'null';
//            }else{
//                $res = $res . '"'.$v.'"';
//            }
//
//        }
//        $res = $res."\r\n}";
        $res = json_encode( $this->mNodes );
        return $res;
    }
    ////////////////////////////////////////////////////////////////////
    public function __toString()
    {
        return $this->toJSON();
    }
}