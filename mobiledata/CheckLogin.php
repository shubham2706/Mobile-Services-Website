<?php
require_once("admin/datafunctions.php");
$username=$_POST["T1"];
$password=$_POST["T2"];
$query="select * from logindata where username='$username' and password='$password'";
//$role=CheckLogin($username,$password);
//echo $role; die();
$result=mysql_query($query);
$n=mysql_num_rows($result);
if($n<1)
{
	header("Location:LoginError.php");
	die();
}
else
{
	$rw=mysql_fetch_array($result);
	$role=$rw["role"];
	session_start();
	$_SESSION["role"]=$role;
	$_SESSION["username"]=$username;
	if($role=="admin")
	{
		header("Location:admin/adminhome.php");
		die();
	}
	else
	{
		$acode=$rw["acode"];
		if($acode>1)
		{
			$_SESSION["acode"]=$acode;
			header("Location:user/check_activation.php");
			die();
		}
		else
		{
			header("Location:user/userhome.php");
			die();
		}
	}
	
}
?>