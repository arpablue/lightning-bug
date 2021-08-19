<?php
namespace ArpaBlue\MapRouter;
require_once("maprouter_base.php");
/**
 * This include the members , baseic seeters and getters of the class.
 * Class MapRouter_GetSet
 * @package ArpaBlue\MapRouter
 */
class MapRouter_GetSet extends MapRouter_Base {
    protected $mCurrentUri = null;
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
        parent::__destruct();

    }
    ///////////////////// Methods //////////////////////////////

    /**
     * It return the current URI.
     * @return string|null It is the current URI.
     */
    public function getURI()
    {
        return $this->mCurrentUri;
    }
    /**
     * It return the array of parameters specified.
     * @param $array string It is the name of the array to be returned.
     * @return mixed|null It is the array of parameters.
     */
    public function getParameterArray( $array ){
        if( isset( $this->mParams[ $array ])){
            return $this->mParams[ $array ];
        }
        return null;
    }
    /**
     * It return the value of a parameter, this parameter could be exist in a JSON request data, in am array request or
     * environment parameters.
     * @param $param string it is the name of the parameter.
     * @return mixed|null mixed It return the value of a parameter.
     */
    public function getParameter($param)
    {
        if ($param == null) {
            return null;
        }
        $param = trim( $param );
        if( strlen( $param ) < 1){
            return null;
        }
        $params = explode('/', $param );
        $res = null;
        foreach( $this->mParams as $vector )
        {
            $res = MapRouter_Base::getVectorParam($vector, $params, 0);
            if($res !== null )
            {
                return $res;
            }
        }
        return $res;

    }
}