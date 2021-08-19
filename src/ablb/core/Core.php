<?php


namespace Ablb\Core;


use ArpaBlue\DbConnector\DbConnector;
use ArpaBlue\dbconnector\MySqlCon;

class Core
{
    /**
     * It is the connection to the database.
     * @var DbConnector It is the connector to the database.
     */
    protected static $mDbConnector;

    /**
     * It return the connector to the database.
     */
    public static function getDbConnector()
    {
        if( Core::$mDbConnector == null ){
            Core::$mDbConnector = new MySqlCon();


            Core::$mDbConnector->setHost( 'localhost' );
            Core::$mDbConnector->setHost( 'ablb' );
            Core::$mDbConnector->setHost( 'noroot' );
            Core::$mDbConnector->setHost( 'noroot' );
            Core::$mDbConnector->open();

        }
        return Core::$mDbConnector;
    }

}