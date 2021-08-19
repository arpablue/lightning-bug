<?php


namespace Ablb\session;


use ArpaBlue\AbTools\ArrayTool;
use ArpaBlue\interfaces\IJson;

class SessionMgr_To extends SessionMgr_Logic implements IJson
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
    public function __toString()
    {
        $tab = '    ';
        $res =  "{\r\n\"SESSION\": ".$this->mName."\n\r";

        if( !$this->exist() )
        {
            $msg = 'The '.$this->mName.' session is not active.';
            $this->error($msg );
            return $msg;
        }
        $flag = false;
        foreach( $_SESSION[$this->mName] as $key => $value )
        {
            $res = $res . $tab ."\"". $key . "\":\"" . $value  ;
            if( $flag )
            {
                $res = $res  . ',';
            }
            $res = $res . "\r\n";
        }
        $res = $res . "}\r\n";
        return $res;
    }

    function toJSON()
    {
        return $this->toJSONnicelly();
    }

    function toJSONnicelly()
    {
        if( isset($_SESSION))
        {
            return ArrayTool::toJSONnicelly($_SESSION);
        }
        return "{}";
    }
}