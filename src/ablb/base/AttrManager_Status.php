<?php


namespace Ablb\base;


use Ablb\TreePath\TreePath;

class AttrManager_Status extends BaseLog
{
    /**
     * It is a
     * @var TreePath tha contain the current status of the object as a response for a request.
     */
    protected $mStatus;
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
        $this->mStatus = new TreePath();
        $this->initStatus();
    }
    ///////////////////////////////////// Methods //////////////////////////////////////
    /**
     * It initialize the status with a default values.
     */
    private function initStatus()
    {
        $this->mStatus->set("type","error");
        $this->mStatus->set("msg","No interaction with the object.");
    }
    /**
     * It return the current status of the object in a JSON format.
     * @return string It is the status of the object.
     */
    public function getStatus()
    {
        return $this->mStatus->toJSONnicelly();
    }
}