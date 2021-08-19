<?php

/**
 * It specify the log object used by the application.
 */
$log = new \ArpaBlue\abtools\Logger();
$log->setLevel(\ArpaBlue\abtools\Logger::$LOG_ALL);
$log->deleteFile();
/**
 * This file initialise the global variables for the execution of the system
 */
$router = new ArpaBlue\MapRouter\MapRouter();
$router->setLog( $log );

$router->setDefaultPage('public/main.php');
$router->addANY('/api/*','api/index.php');



