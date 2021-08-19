<?php

namespace ArpaBlue\MapRouter;
require_once('AList.php');
require_once("maprouter_parameters.php");

/**
 * Class MapRouter_to
 * @package ArpaBlue\MapRouter
 * It contains manager the conversion to string and JSON objects
 */
class MapRouter_Url extends MapRouter_Parameters
{
    /**
     * @var string It is the key used to reference the files to apply to any method, if the same references exists in other request
    then the reference is ignored.
     */
    protected static $ANY_HTTP_METHOD = '*';
    /**
     * @var string It is the reference to call by GET request.
     */
    protected static $GET_HTTP_METHOD = 'GET';
    /**
     * @var string It is the reference to call by PUT request.
     */
    protected static $PUT_HTTP_METHOD = 'PUT';
    /**
     * @var string It is the reference to call by POST request.
     */
    protected static $POST_HTTP_METHOD = 'POST';
    /**
     * @var string It is the reference to call by PATCH request.
     */
    protected static $PATCH_HTTP_METHOD = 'PATCH';
    /**
     * @var string It it the reference to call by DELETE request.
     */
    protected static $DELETE_HTTP_METHOD = 'DELETE';
    /**
     * @var null string it is the default file if the URI is not found in the map, by default is NULL.
     */
    protected $mDefaultPage;
    // ** it the reference to call by GET request.
    /**
     * It is the list of the method for the key and the file references.
     * @var array
     */
    protected $mMap;
    ////////////////////////////////////////////constructors destructor /////////////////////////////////////
    /**
     * MapRouter constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->mDefaultPage = null;
        $this->mMap = array();
        //$host = $_SERVER['HTTP_HOST'];

        $this->mMap['*'] = new AList();
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
     * It specify the default page displayed when not url assigned exists.
     * @param $file string It is the the default page to be displayed.
     */
    public function setDefaultPage($file)
    {
        $this->mDefaultPage = $file;
    }

    /**
     * It return the default page to be displayed, by default is null.
     * @return string|null It is the default page.
     */
    public function getDefaultPage()
    {
        return $this->mDefaultPage;
    }

    /**
     * It add a url reference for any request, this file are the first to be reviewed.
     * @param $method string It is the method used for the reference, for all method is necessary use *.
     * @param $url string It is the url reference.
     * @param $file string it is the file assigned to the url.
     * @return bool It is true the reference has been added.
     */
    public function add($method, $url, $file)
    {
        if ($method == null) {
            $this->error("It is not possible add a element to the map for NULL method.");
            return false;
        }
        if ($url == null) {
            $this->error("It is not possible add a element to the map for URL method.");
            return false;
        }
        if ($file == null) {
            $this->error("It is not possible add a element to the map for FILE method.");
            return false;
        }
        $method = trim($method);
        $method = strtoupper($method);

        $url = $this->formatPath( $url );
        $file = $this->formatPath( $file );

        if (!isset($this->mMap[$method])) {
            $this->mMap[$method] = new AList();
        }

        $this->mMap[$method]->put($url, $file);

        return true;
    }

    /**
     * It add a url reference to all http method. any request for any method and the url is it specified in this section,
     * then its reference will be called.
     * @param $url string It is the url of the reference
     * @param $file string  It is the file to the corresponding url.
     * @return bool It is true if the reference has been added without problems.
     */
    public function addAny($url, $file)
    {
        return $this->add(MapRouter_Url::$ANY_HTTP_METHOD, $url, $file);
    }

    /**
     * It add a url reference to alll http method. any request for any method and the url is it specified in this section,
     * then its reference will be called.
     * @param $url string It is the url of the reference
     * @param $file string  It is the file to the corresponding url.
     * @return bool It is true if the reference has been added without problems.
     */
    public function addGET($url, $file)
    {
        return $this->add(MapRouter_Url::$GET_HTTP_METHOD, $url, $file);
    }

    /**
     * It add a url reference to all http method. any request for any method and the url is it specified in this section,
     * then its reference will be called.
     * @param $url string It is the url of the reference
     * @param $file string  It is the file to the corresponding url.
     * @return bool It is true if the reference has been added without problems.
     */
    public function addPUT($url, $file)
    {
        return $this->add(MapRouter_Url::$PUT_HTTP_METHOD, $url, $file);
    }

    /**
     * It add a url reference to POST http method. any request for any method and the url is it specified in this section,
     * then its reference will be called.
     * @param $url string It is the url of the reference
     * @param $file string  It is the file to the corresponding url.
     * @return bool It is true if the reference has been added without problems.
     */
    public function addPOST($url, $file)
    {
        return $this->add(MapRouter_Url::$POST_HTTP_METHOD, $url, $file);
    }

    /**
     * It add a url reference to PATCH http method. any request for any method and the url is it specified in this section,
     * then its reference will be called.
     * @param $url string It is the url of the reference
     * @param $file string  It is the file to the corresponding url.
     * @return bool It is true if the reference has been added without problems.
     */
    public function addPATCH($url, $file)
    {
        return $this->add(MapRouter_Url::$PATCH_HTTP_METHOD, $url, $file);
    }

    /**
     * It add a url reference to DELETE http method. any request for any method and
     * the url is it specified in this section,
     * then its reference will be called.
     * @param $url string It is the url of the reference
     * @param $file string  It is the file to the corresponding url.
     * @return bool It is true if the reference has been added without problems.
     */
    public function addDELETE($url, $file)
    {
        return $this->add(MapRouter_Url::$DELETE_HTTP_METHOD, $url, $file);
    }

    /**
     * According to an url and the request method return the corresponding file,
     * if the url not exists then return null.
     * @param $uri string It is the rule of the reference.
     * @param $method string It is the method to be called, if it is not specified then
     * the method is the same of the request of the system.
     * @return string|null It is the file corresponding tot he url.
     */
    public function get($uri, $method = null)
    {
        if ($method == null) {
            $this->log('Method load from HTTP Request.');
            $met = $this->getMethod();

        }else{
            $met = $method;
        }
        $vec = null;
        $this->mCurrentUri = $this->formatPath( $uri );
        $this->log('The end point is ['.$this->mCurrentUri.']');
        $this->log('The HTTP method is ['.$met.']');

        if (isset($this->mMap[MapRouter_Url::$ANY_HTTP_METHOD]))
        {
            $this->log('...Searching in general methods');
            $vec = $this->mMap[MapRouter_Url::$ANY_HTTP_METHOD];
            $res = $this->getFindUrl($vec, $this->mCurrentUri);

            if ($res != null) {
                return $res;
            }
            $this->warning("The [" . $this->mCurrentUri . "] is not presents for general methods.");
        }
        $this->log('...Searching in the '.$met.' method');
        if (!isset($this->mMap[$met])) {
            $this->error("The " . $met . " the method is not specified.");
            return $this->getDefaultPage();
        }
        $vec = $this->mMap[$met];
        $res = $this->getFindUrl($vec, $this->mCurrentUri);

        if ($res == null) {
            $this->error("It is not possible found a value for: " . $this->mCurrentUri);
            $res = $this->getDefaultPage();
        }
        return $res;
    }

    /**
     * It return the file assigned in a AList assigned to a EndPoint.
     * @param $target AList It is the list of references
     * @param $endPoint String it is the eEndPoint to file the assignation.
     * @return String|null It is the file assigned to the EndPoint specified.
     */
    protected function getFindUrl($target, $endPoint)
    {
        if ($target == null) {
            $this->warning('The list of references is NULL.');
            return null;
        }
        if($endPoint == null ){
            $this->warning('The endpoint is NULL.');
            return null;
        }
        $keys = $target->getKeys();
        foreach ($keys as $key) {
            if ( strpos($key, '*') === false ) {
                if (strcasecmp( $endPoint, $key) == 0) {
                    return $target->get($key);
                }
            } else {

                $key2 = str_replace('/*', '', $key);
                $key2 = str_replace('*/', '', $key2);
                $key2 = str_replace('*', '', $key2);
                if (strpos($endPoint, $key2) > -1) {
                    return $target->get($key);
                }else if (strpos($key2, $endPoint ) > -1){
                    return $target->get($key);
                }
            }
        }
        return null;
    }
    /**
     * It return the file according to the current path, if no file has been assigned then the default page is returned
     * @return string|null It is the returned the file assigned.
     */
    public function call()
    {
        if( isset($_SERVER['REQUEST_URI'] ) ) {
            $this->mCurrentUri = $_SERVER['REQUEST_URI'];
        }else{
            $this->mCurrentUri = '/none';
        }
        $file = $this->get( $this->mCurrentUri );
        $this->log('File to be loaded['.$file.']');
        return $file;

    }
    /**
     * It get the data of the parameters and it set the values in a string with JSON format.
     * the parameters are values of GET, POST, PUT, DELETE, etc. arrays.
     * @return string It is the data  of the parameters.
     */
    protected function putUrlToString($margin = "")
    {
        $res = '';
        if ($this->mMap == null) {
            $res = $res . $margin . '"references:{}';
            return $res;
        }
        $res = $res . $margin . '"references":{' . "\n";
        $flag = false;
        foreach ($this->mMap as $key => $value) {
            if ($flag) {
                $res = $res . ",\n";
            }
            $res = $res . $margin . "    \"" . $key . "\":" . $value->toJSONnicelly($margin);
            $flag = true;
        }
        $res = $res . "\n" . $margin . "}";
        return $res;
    }
}