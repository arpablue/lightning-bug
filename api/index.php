<?php
include_once('api/lib/php/init.php');



$uname = $API_MAP->getParameter('username');
$pwd = $API_MAP->getParameter('password');
$token = $API_MAP->getParameter('token');
if( $token == null )
{
    if( $uname == null )
    {
        include_once($ERROR_NO_TOKEN);
    }else{
        if( $pwd == null)
        {
            include_once( $ERROR_NO_TOKEN );
        }else{
            include_once ('api/login/index.php');
        }
    }
}else{
        $file = $API_MAP->call();
}


include_once('api/lib/php/end.php');