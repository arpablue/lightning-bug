<?php


namespace ArpaBlue\DbConnector;

/**
 * Class DbConnector
 * @package ArpaBlue\DbConnector
 * It class contains the implementation of the method to return data of the database.
 */
abstract class DbConnector extends DbConnector_Str
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
    //////////////////////////////////////////

}