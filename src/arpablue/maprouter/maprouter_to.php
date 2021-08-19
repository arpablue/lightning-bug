<?php
namespace ArpaBlue\MapRouter;
require_once("maprouter_url.php");
/**
 * Class MapRouter_to
 * @package ArpaBlue\MapRouter
 * It contains manager the conversion to string and JSON objects
 */
class MapRouter_to extends MapRouter_Url {
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
    public function __destruct()
    {
        parent::__destruct();

    }
    ///////////////////// Methods //////////////////////////////
    /**
     * It return the data of the current object in jason object, but to be view in a tree view.
     * @return string It is the data of the object in JSON format.
     */
    public function toJSONnicelly()
    {
        $margin = "    ";
        $res = "{\n";
        $res = $res . '    "class": "MapRouter",'."\n";
        $res = $res . '    "com": "ARPAblue",'."\n";
        $res = $res . '    "uri": "'.$this->mCurrentUri.'",'."\n";
        if( $this->getMethod() == null )
        {
            $res = $res . '    "method": null,'."\n";
        }else{
            $res = $res . '    "method": "'.$this->getMethod()."\",\n";
        }
        if($this->mDefaultPage == null)
        {
            $res = $res . '    "default": null,'."\n";
        }else{
            $res = $res . '    "default": "'.$this->mDefaultPage."\",\n";

        }
        $res = $res . $this->putParametersToString($margin).",\n";
        $res = $res . $this->putUrlToString($margin)."\n";
        $res = $res . '}';
        return $res;
    }
    /**
     * It return the data of the current object with a JSON format.
     * @return string it is the string data of the current format.
     */
    public function __toString(){
        return $this->toJSONnicelly();
    }

}