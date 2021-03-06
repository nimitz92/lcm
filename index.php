<?php

require_once('init.php');
require_once(ROOT . 'lib/database/MySQL.class.php');
require_once(ROOT . 'lib/contact/ContactManager.class.php');
require_once(ROOT . 'lib/session/SessionManager.class.php');


if(!isset($_COOKIE["lcmsession"]) or $_COOKIE["lcmsession"]<0){
	header("Location:login.php");
	exit;
}
$sessionid=$_COOKIE["lcmsession"];
$sm=new SessionManager();


$mysql = new MySQL();
$uid=$sm->getUid($sessionid,$mysql);
$title = "Local Contact Manager";
echo <<<HEADER
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html lang="en"> 
	<head> 
	  <meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
	  <title>$title</title> 
	</head>
	<body>
HEADER;

echo "<h1>&lt;enhanCSE/&gt; Local Contact Manager</h1>";
echo '<p align="right"><a href="logout.php">Logout!</a></p>';

$cm = new ContactManager();

if(isset($_POST['action'])){
	$action = $_POST['action'];
	switch($action) {
		case 'New Contact ...' :
		{
			$cm->displayForm($mysql);
			break;
		}
		case 'Edit' :
		{
			if(!isset($_POST['cid']))
				echo "<p>The contact was not selected. Please try again.</p>";
			else {
				$cid = $_POST['cid'];
				$cm->displayForm($mysql, $cid, $uid);
			}
			break;
		}
		case 'Delete' :
		{
			if(!isset($_POST['cid']))
				echo "<p>The contact was not selected. Please try again.</p>";
			else {
				$cid = $_POST['cid'];
				$cm->deleteContact($mysql, $cid, $uid);
			}
			break;
		}
		case 'Save' :
		{
			if(!isset($_POST['cname']))
				echo "<p>The contact cannot be empty.</p>";
			else {
				$name = $_POST['cname'];
				$email = $_POST['email'];
				$phone = $_POST['phone'];
				$cid = $_POST['cid'];
				if($cid == 0)
					$cm->addContact($mysql, $name, $email, $phone, $uid);
				else 
					$cm->updateContact($mysql, $cid, $name, $email, $phone, $uid);
			}
			break;
		}
		default :
	}
}

$cm->viewContacts($uid, $mysql);

echo <<<FOOTER
		<div id="footer"><p>Powered by enhanCSE 2011</p></div>
	</body>
</html>
FOOTER;

?>