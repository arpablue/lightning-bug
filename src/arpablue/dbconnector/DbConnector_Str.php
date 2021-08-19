<?php


namespace ArpaBlue\DbConnector;

use ArpaBlue\AbTools\ArrayTool;

/**
 * Class DbConnector_Str
 * It class contains the method to show the data of the class in string format.
 * @package ArpaBlue\DbConnector
 */
abstract class DbConnector_Str extends DbConnector_Query
{
    //////////////////////////////////////////
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

    /**
     * It return the data of the current connection in a JSON format.
     * @return string It is the data in JSON format.
     */
    public function toJSON()
    {
        $res = '{';

        $res = $res . "\"host\":";
        if( $this->mHost == null )
        {
            $res = $res.'null';
        }else{
            $res = $res."\"".$this->mHost."\",";
        }
        $res = $res . "\"database\":";
        if( $this->mDatabase == null )
        {
            $res = $res.'null';
        }else{
            $res = $res."\"".$this->mDatabase."\",";
        }
        $res = $res . "\"port\":";
        if( $this->mPort == null )
        {
            $res = $res.'null';
        }else{
            $res = $res.$this->mPort.",";
        }
        $res = $res . "\"user\":";
        if( $this->mUser == null )
        {
            $res = $res.'null';
        }else{
            $res = $res."\"".$this->mUser."\",";
        }
        $res = $res . "\"password\":";
        if( $this->mPwd == null )
        {
            $res = $res.'null';
        }else{
            $res = $res."\"".$this->mPwd."\"";
        }
        $res = $res . '}';
        return $res;
    }
    /**
     * It return the data of the current connection in a JSON format.
     * @return string It is the data in JSON format.
     */
    public function toJSONnicelly()
    {
        $res = '{';
        $res = $res . "\n";
        $res = $res . "    \"host\":";
        if( $this->mHost == null )
        {
            $res = $res.'null';
        }else{
            $res = $res."\"".$this->mHost."\",";
        }
        $res = $res . "\n";
        $res = $res . "    \"database\":";
        if( $this->mDatabase == null )
        {
            $res = $res.'null';
        }else{
            $res = $res."\"".$this->mDatabase."\",";
        }
        $res = $res . "\n";
        $res = $res . "    \"port\":";
        if( $this->mPort == null )
        {
            $res = $res.'null';
        }else{
            $res = $res.$this->mPort.",";
        }
        $res = $res . "\n";
        $res = $res . "    \"user\":";
        if( $this->mUser == null )
        {
            $res = $res.'null';
        }else{
            $res = $res."\"".$this->mUser."\",";
        }
        $res = $res . "\n";
        $res = $res . "    \"password\":";
        if( $this->mPwd == null )
        {
            $res = $res.'null';
        }else{
            $res = $res."\"".$this->mPwd."\"";
        }
        $res = $res . "\n";
        $res = $res . '}';
        return $res;
    }

    /**
     * It return the result of the query in a treepath format, this result is the result of the execution of
     * the last sql sentences.
     * @return string It is the result of the query in JSON format.
     */
    public function toJSONnicellyReuslt()
    {
        if( $this->mResult == null )
        {
            return 'null';
        }
        if( count($this->mResult ) < 1)
        {
            return '{}';
        }
        $res = "{";
        $f1 = false;
        $margin = '    ';
        foreach( $this->mResult as $row )
        {
            if( $f1 )
            {
                $res = $res . ',';
            }
            $f1 = true;
            $line = ArrayTool::toJSONnicelly( $row ,$margin );
            $res = $res."\r\n".$margin.$line;
        }
        $res = $res ."\r\n}";
        return $res;
    }
    //////////////////////////////////////////
    public function __toString()
    {
        return $this->toJSON();
    }

}