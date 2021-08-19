<?php

$msg = new Ablb\TreePath\TreePath();

$msg->set('code',400);
$msg->set('type','error');
$msg->set('message','The password is not specified.');

echo $msg->toJSONnicelly();