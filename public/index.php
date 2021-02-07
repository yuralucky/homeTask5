<?php

use Hillel\User;

require_once '../vendor/autoload.php';


//$user = User::find(1);
//var_dump($user);
$user1=new User();
var_dump($user1->save());
