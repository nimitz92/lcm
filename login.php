<?php

require_once('init.php');
require_once(ROOT . 'lib/database/MySQL.class.php');
require_once(ROOT . 'lib/session/SessionManager.class.php');
require_once(ROOT . 'lib/user/UserManager.class.php');
require_once(ROOT . 'lib/util/Time.class.php');

if(isset($_POST["action"])){
	$um=new UserManager();
	$mysql= new MySQL();
	$sm=new SessionManager();
	$username=$_POST["username"];
	$password=$_POST["password"];
	$res=$um->authenticate($mysql,$username,$password);
	if($res>0){
		$random=$sm->addSession($mysql,$res);
		setcookie("lcmsession",$random,Time::getTime()+30*24*60*60);
		header("Location:index.php");
	}
	else
	{
		echo "Username/Password Incorrect.";
	}
	
	}

echo <<<HEADER
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html lang="en"> 
	<head> 
	  <meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
	  <title>LOGIN</title> 
	</head>
	<body>
HEADER;

echo "<h1>&lt;enhanCSE/&gt; Login Module</h1>";

echo <<<FORM
	<div id="user">
			<form action="" method="POST">
				
				<table>
					<tbody>
						<tr>
							<td>Username</td>
							<td><input type="text" name="username" /></td>
						</tr>
						<tr>
							<td>Password</td>
							<td><input type="Password" name="password" /></td>
						</tr>
							<td><input type="reset" value="Reset"/></td>
							<td><input type="submit"  name="action" value="login!"/></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
FORM;


?>