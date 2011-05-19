<?php

require_once('init.php');
require_once(ROOT . 'lib/database/MySQL.class.php');
require_once(ROOT . 'lib/user/user.class.php');

	echo <<<HEADER
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
			<html lang="en"> 
		<head> 
		<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
		<title>LOGIN</title> 
		</head>
		<body>
HEADER;

	echo "<h1>&lt;enhanCSE/&gt; Login module</h1>";

	$user= new user();
	$user->displayForm();
	$username=$_POST['username'];
	$password=$_POST['password'];
	switch($_POST['action']){
		case 'register!':
		$user->addUser($username.$password);
		break;
		case 'login!':
		$res=$user->verify($username,$password);
		
		break;
	}
		
		

	

?>