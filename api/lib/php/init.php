<?php
use \Ablb\Core\Core;
use ArpaBlue\dbconnector\MySqlCon;
$ERROR_NO_USERNAME ='api/error/noUsername.php';
$ERROR_NO_TOKEN ='api/error/noPassword.php';
$ERROR_FAIL_LOGIN ='api/error/noPassword.php';

/**
 * It specify the log object used by the application.
 */
$API_LOG = new \ArpaBlue\abtools\Logger();
$API_LOG->setLogPath('logs/api.log');
$API_LOG->setLevel(\ArpaBlue\abtools\Logger::$LOG_ALL);
$API_LOG->deleteFile();
/**
 * It star the connection with the database.
 */
global $DB_CONN;
$DB_CONN = new MySqlCon();
$DB_CONN->setLog( $API_LOG );
$DB_CONN->setHost( 'localhost' );
$DB_CONN->setDatabase( 'ablb' );
$DB_CONN->setUser( 'noroot' );
$DB_CONN->setPassword( 'noroot' );

if( $DB_CONN->open() )
{
    $API_LOG->log( "Database connection stablish.");
}
else
{
    $API_LOG->error("Fail the connection to the database.");
}

/**
 * It is the map used for the api.
 */
 $API_MAP = new \ArpaBlue\MapRouter\MapRouter();
 $API_MAP->setLog( $API_LOG );
 $API_MAP->setDefaultPage('api/error/default.html');
 $API_MAP->headerJSON();

 $API_MAP->addGET('/api/user/*','/api/user/info.php');
 $API_MAP->addGET('/api/users','/api/user/list.php');
 $API_MAP->addPUT('/api/login','/api/login/index.php');
 $API_MAP->addPUT('/api/logout','/api/logout/index.php');
 $API_MAP->addPUT('/api/user/add','/api/user/add.php');
 $API_MAP->addPUT('/api/user/modif/*','/api/user/update.php');
 $API_MAP->addPUT('/api/user/del/*','/api/user/remove.php');


 $DB_CONN->setLog( $API_LOG );

 $username = $API_MAP->getParameter('username');
/**
 * Start the session.
 */
$API_SESSION = new \Ablb\session\SessionMgr( $username );
$API_SESSION->setLog( $API_LOG );
$API_SESSION->exists();


/*************************To delete *************************/

$API_LOG->log('MAP used for the API:');
$API_LOG->log($API_MAP->toJSONnicelly());

