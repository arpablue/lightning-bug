<?php

 $msg = new Ablb\TreePath\TreePath();

 $msg->set('code',400);
 $msg->set('type','error');
 $msg->set('message','you need login to the system with user credentials.');

 echo $msg->toJSONnicelly();