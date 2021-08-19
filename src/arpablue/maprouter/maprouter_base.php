<?php
namespace ArpaBlue\MapRouter;
use ArpaBlue\AbTools\ArrayTool;

require_once("maprouter_log.php");
/**
 * Class maprouter_base
 * @package ArpaBlue\MapRouter
 * It contains the the base objects members and setters and getters of the class.
 */
class MapRouter_Base extends MapRouter_Log{
    ////////////////////////////////////////////constructors destructor /////////////////////////////////////
    /**
     * MapRouter constructor.
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * MapRouter destructor.
     */
    public function __destruct(){

    }
    ///////////////////// Methods //////////////////////////////
    /**
     * It set on format an url.
     * @param $url string It is the url to be process.
     * @return string It is the url in the correct format.
     */
    public static function formatURL( $url ){
        if($url == null){
            return '';
        }
        $url = str_replace('/',' ',$url);
        $url = trim($url);
        $url = str_replace(' ','/',$url);
        $url = '/'.$url;
        return $url;
    }

    /**
     * It put on foramt an array with its elements and its key, all data is set in a JSON format.
     * @param $target array it i sthe array to set in string.
     * @return string It is the data of the array is JSON fomat.
     */
    protected static function ArrayToString_Nicelly( $target,$space = "    " ){
        if( $target == null ){
            return '{}';
        }
        $res = "{\n";
        $flag = false;

        foreach( $target as $key => $value ){
            if( $flag ){
                $res = $res . ",\n";
            }
            if( !is_array( $value ) )
            {
                $res = $res . $space . $space . $space . "\"" . $key . "\": \"" . $value . "\"";
            }else{
                $res = $res . $space . $space . $space . "\"" . $key . ":" . MapRouter_Base::ArrayToString_Nicelly($value,$space.$space) ;
            }
            $flag = true;
        }
        $res = $res . "\n";
        $res = $res . $space . $space . "}";
        return $res;
    }

    /**
     * It put on format a path, remiving the "/" form the end of the path and removing the white spaces from path.
     * @param $path string It is the path to be set on format.
     * @return string it is the path on format.
     */
    public static function formatPath( $path ){
        if( $path == null ){
            return '';
        }
        if( strlen( $path ) < 1){
            return '';
        }
        $path = str_replace('/',' ', $path);
        $path = str_replace("\\",' ',$path);
        $path = trim( $path );
        $path = str_replace(' ','/', $path);
        return $path;
    }
    /**
     * It return a value corresponding a value nad the position of the value.
     * @param $vector
     * @param $params
     * @param $pos
     * @return mixed|null
     */
    protected static function getVectorParam( $vector, $params, $pos){
        if( $pos === null )
        {
            return null;
        }
        if( $vector === null )
        {
            return null;
        }
        if( $params === null )
        {
            return null;
        }
        if( $pos < 0 )
        {
            return null;
        }
        if( count( $params ) < 0 )
        {
            return null;
        }
        if( count($params) <= $pos )
        {
            return null;
        }

        $key = $params[ $pos ];
        if( !isset( $vector[ $key ] ) )
        {
            return null;
        }
        $value = $vector[ $key ];
        if( $pos == count( $params) -1 ){
            return $value;
        }
        if( !is_array( $value ) ) {
            return null;
        }
        return MapRouter_Base::getVectorParam($value, $params, $pos+1 );

    }

}