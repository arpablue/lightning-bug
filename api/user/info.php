<?php
/**
 * This file is in charge to return the data from an user, the id of the user should be specified.
 * @author Augusto Flores
 */
$id = 1;
$user = new Ablb\User\User();
$user->setLog( $API_LOG );
if( $user->addIdFromRequest( $API_MAP->getURI() ) )
{
    $user->load();
}
 echo $user->getStatus();


