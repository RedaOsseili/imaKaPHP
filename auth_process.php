<?php

$auth = 'Basic ' . base64_encode($GLOBALS['username'].':'.$GLOBALS['password']);
$url = $GLOBALS['instance_url'] . $GLOBALS['namespace'] .  '/table/' . $tableName;

if(isset($sys_id)){
	$url = $url . '/' . $sys_id;
}

$headers = array('Authorization' => $auth, 'Accept' => 'application/json', 'Content-Type' => 'application/json');


?>