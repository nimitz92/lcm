<?php
	require_once('init.php');
	require_once(ROOT . 'lib/database/MySQL.class.php');
	require_once(ROOT . 'lib/session/SessionManager.class.php');
	
	if(isset($_COOKIE["lcmsession"]))
	$sessionid=$_COOKIE["lcmsession"];
	$mysql=new MySQL();
	$sm=new SessionManager();
	$sm->deleteSession($mysql,$sessionid);
?>