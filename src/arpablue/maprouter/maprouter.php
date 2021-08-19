<?php
namespace ArpaBlue\MapRouter;
require_once("maprouter_to.php");
/**
 * Class MapRouter
 * this class manage the direction of the files to be loaded according to the request.
 */
class MapRouter extends MapRouter_to {
    /**
     * @var array It contains the url references and the name of the links
     */
    protected $mUrls;
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
}