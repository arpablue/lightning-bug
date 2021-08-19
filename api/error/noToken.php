<?php

 $msg = new Ablb\TreePath\TreePath();

 $msg->set('code',400);
 $msg->set('type','error');
 $msg->set('message','To request tot he system is necessary login toi the system.');

 echo $msg->toJSONnicelly();