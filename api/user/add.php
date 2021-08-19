<?php
/**
 * this file contain information to add a new user to the system.
 * @author Augusto Flores
 */
$user = new Ablb\User\User();
//$user->setLog( $API_LOG );

$user->setAttributes( $API_MAP->getJSON() );

$resJson = array();
if( $user->insert() )
{
    $resJson['code']=200;
    $resJson['msg']='New user has been added.';
}else{
    $resJson['code']=404;
    $resJson['msg']='It is not possible add a new user.';

}

// It is the response to the client
echo json_encode( $resJson );