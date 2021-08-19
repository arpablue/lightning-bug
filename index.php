<?php
require_once('vendor/autoload.php');
require_once('lib/php/libraries.php');


//////////////////////////////////////////////////////////////

$user = new Ablb\User\User();
//////////////////////////////////////////////////////////////
$urlFile =  $router->call();
//echo "\n==>".$urlFile."<===\n";// It is the current file respond according to the uri
include_once( $urlFile  );

