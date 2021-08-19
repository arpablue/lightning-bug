<?php

 $user = new \Ablb\User\User();

 $user->setLog( $API_LOG );

 $uname = $API_MAP->getParameter('username');
 $pwd = $API_MAP->getParameter('password');

 $token = $user->login( $uname, $pwd);

echo $user->getStatus();

echo $API_SESSION->toJSON();

?>
