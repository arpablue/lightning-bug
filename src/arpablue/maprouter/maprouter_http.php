<?php
namespace ArpaBlue\MapRouter;
require_once("maprouter_files.php");
/**
 * Class MapRouter_HTTP
 * @package ArpaBlue\MapRouter
 * It manage the request of the HTTP, identify the resquest and load the array respective to the request.
 */
class MapRouter_HTTP extends MapRouter_Files {
    /**
     * @var string It is the reference to the POST method of a request.
     */
    protected static $REFERENCE_POST = 'POST';
    /**
     * @var string It is the reference to the PUT method of a request.
     */
    protected static $REFERENCE_PUT = 'PUT';
    /**
     * @var string It is the reference to the DELETE method of a request.
     */
    protected static $REFERENCE_DELETE = 'DELETE';
    /**
     * @var string It is the reference to the PATCH method of a request.
     */
    protected static $REFERENCE_PATCH = 'PATCH';
    /**
     * @var string It is the reference to the GET method of a request.
     */
    protected static $REFERENCE_GET = 'GET';
    /**
     * @var string It is the reference to the GET method of a request.
     */
    protected static $REFERENCE_JSON = 'JSON';
    /**
     * @var string It is the reference to the GET method of a request.
     */
    protected static $REFERENCE_SERVER = 'SERVER';

    /**
     * @var String It contains the current method of the request.
     */
    protected $mMethod;
    /**
     * @var array It is an associative array, this contains the parameters of all environments.
     */
    protected $mParams;

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
        $this->initHTTP();

    }
    ///////////////////// Methods //////////////////////////////
    /**
     * It initialize the method with the data of the request.
     */
    protected function initHTTP(){

        //load the current method.
        $this->loadMethod();
    }
    /**
     * It return the array of parameter related to a method, if the method not exists then a new array is created
     * and added.
     * @param $method String It is the name of the method.
     * @return array|null It is the array related to the method.
     */
    protected function getMethodArray($method){
        if( $this->mParams == null ){
            return null;
        }
        if( isset($this->mParams[ $method ] ) ){
            return $this->mParams[ $method ];
        }
        $this->mParams[ $method ] =  array();
        return $this->mParams[ $method ];
    }

    /**
     * It specify a value fora parameter in a method. If the method and/or the parameter not exists, then a new method
     * and/or parameter is created.
     *
     * @param $method String It is the method to search.
     * @param $param String It is the parameter name to search.
     * @param $value String It is the new parameter value.
     */
    protected function addParameter($method,$param, $value){
        $marray = $this->getMethodArray( $method );
        if( $marray == null){
            return;
        }

        $marray[ $param ] = $value;
    }
    /**
     * It set a array for a specific method, if the method not exists then the array added with the method specified.
     * @param $method String It is the method for the array
     * @param $array array It is the new array associated to the method.
     */
    protected function addParameterArray($method, $array){
        $this->mParams[ $method ] = $array;
    }
    /**
     * It detect the method used for the current request.
     */
    protected function loadMethod(){
        if( isset( $_SERVER['REQUEST_METHOD'] ) )
        {
            $this->mMethod = $_SERVER['REQUEST_METHOD'];
        }else {
            $this->mMethod = 'GET';
        }
        http_response_code(200); //--
        switch( $this->mMethod ){
            case MapRouter_HTTP::$REFERENCE_GET:
                $this->loadGET();
                break;
            case MapRouter_HTTP::$REFERENCE_PUT:
                $this->loadPUT();
                break;
            case MapRouter_HTTP::$REFERENCE_POST:
                $this->loadPOST();
                break;
            case MapRouter_HTTP::$REFERENCE_PATCH:
                $this->loadPATCH();
                break;
            case MapRouter_HTTP::$REFERENCE_DELETE:
                $this->loadDELETE();
                break;
            default:

        }
        $this->loadJSON();

    }

    /**
     * It set the current response as JSON response.
     */
    public function headerJSON(){
               header("Content-Type: application/json");// It is the specification of the treepath.
    }
    /**
     * It load the GET array to the object.
     */
    protected function loadGET(){
        if( isset( $_GET )) {
            $this->addParameterArray(MapRouter_HTTP::$REFERENCE_GET, $_GET);
        }
    }
    /**
     * It load the POST array to the object.
     */
    protected function loadPOST(){
        if( isset( $_POST ) ) {
            $this->addParameterArray(MapRouter_HTTP::$REFERENCE_POST, $_POST);
        }
    }
    /**
     * It load the PUT array to the object.
     */
    protected function loadPUT(){
        if( isset( $_GET )) {
            $this->addParameterArray(MapRouter_HTTP::$REFERENCE_GET, $_GET);
        }
        if( isset( $_PUT ) )  {
            $this->addParameterArray(MapRouter_HTTP::$REFERENCE_PUT, $_PUT);
        }
    }
    /**
     * It load the PATCH array to the object.
     */
    protected function loadPATCH(){
        if( isset( $_GET )) {
            $this->addParameterArray(MapRouter_HTTP::$REFERENCE_GET, $_GET);
        }
        if( isset( $_PATCH ) ) {
            $this->addParameterArray(MapRouter_HTTP::$REFERENCE_PATCH,$_PATCH);
        }
    }
    /**
     * It load the DELETE array to the object.
     */
    protected function loadDELETE(){
        if( isset( $_GET )) {
            $this->addParameterArray(MapRouter_HTTP::$REFERENCE_GET, $_GET);
        }
        if( isset($_DELETE )) {
            $this->addParameterArray(MapRouter_HTTP::$REFERENCE_DELETE,$_DELETE);
        }
    }
    /**
     * It load the data sent by a JSON format in the request
     */
    protected function loadJSON($method = "JSON"){
        $file = file_get_contents('php://input');
        $json = json_decode( $file,true);
        $this->addParameterArray($method, $json);
    }
    /**
     * It return the current method of the request.
     * @return String It is the method of the request.
     */
    protected function getMethod(){
        return $this->mMethod;
    }

    /**
     * It move a uploaded file to a folder in the ser4ver, if the folder not exists then it is created.
     * @param $field String It is the field where the file has been uploaded.
     * @param $targetFolder string It is the folder in the server where the file will be copied.
     * @return bool It is true if the file sent has been copied tpo the target folder without problems.
     */
    public function moveUploadedFile($field, $targetFolder = 'uploaded_files'){
        if( !isset( $_FILES[$field] )){
            return false;
        }
        $fileName = $_FILES[ $field ]['name'];
        $tmpFileName = $_FILES[ $field ]['tmp_name'];
        $targetFolder = parent::formatPath( $targetFolder );
        if( !file_exists($targetFolder)){
            mkdir($targetFolder, 0777, true);
        }
        if( file_exists($targetFolder) ){
            if( !move_uploaded_file($tmpFileName, $targetFolder.'/'.$fileName) ){
                return false;
            }
        }
        return true;
    }

}