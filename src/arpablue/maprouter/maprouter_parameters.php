<?php

namespace ArpaBlue\MapRouter;
require_once("AList.php");
require_once("maprouter_http.php");

/**
 * Class MapRouter_Parameters
 * @package ArpaBlue\MapRouter_Parameters
 * It class contain all method related to manage the parameters of the environment.
 */
class MapRouter_Parameters extends MapRouter_HTTP
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
    ///////////////////// Methods //////////////////////////////
    ///




    /**
     * It return the arrayy associated to any JSON that has been sent in a request.
     * @return array|null It is the array of the JSON.
     */
    public function getJSON(){
        if ( isset($this->mParams['JSON']) )
        {
            return $this->mParams['JSON'];
        }
        return null;
    }
    /**
     * It verify if a file has been uploaded with the name of a field.
     * @param $param string It is the name of the field.
     * @return bool It is true if the field exists in the files uploaded.
     */
    public function parameterFileExist( $param ){
        if( !isset($_FILES) ){
            return false;
        }
        if( !isset( $_FILES[$param] ) ){
            return false;
        }
        return true;
    }

    /**
     * It verify if a parameter with the name specified exists as parameter in the request.
     * @param $param string It is the name of the parameter.
     * @return bool It is true if the parameter exists.
     */
    public function paramExists( $param ){
        if( $param == null ){
            return false;
        }
        foreach( $this->mParams as $l ){
            if( isset($l[$param] ) ){
                return true;
            }
        }
        return $this->parameterFileExist( $param );

    }
    /**
     * It get the data of the parameters and it set the values in a string with JSON format.
     * the parameters are values of GET, POST, PUT, DELETE, etc. arrays.
     * @return string It is the data  of the parameters.
     */
    protected function putParametersToString($margin = "    "){
        $res = '';
        if($this->mParams == null ) {
            $res = $res . $margin . '"parameters:{}';
            return $res;
        }
        $res = $res . $margin . '"parameters":{'."\n";
        $flag = false;
        foreach ( $this->mParams as $key => $value ){
            if( $flag ){
                $res = $res . ",\n";
            }
            $res = $res . $margin . $margin . "\"".$key."\":".MapRouter_Base::ArrayToString_Nicelly($value);
            $flag = true;
        }
        $res = $res . "\n" . $margin . "}";
        return $res;
    }

}