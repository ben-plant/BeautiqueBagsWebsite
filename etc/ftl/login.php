<?php
	$host="localhost";
	$username="sec_user_check";
	$password="GS7q8PFHBLaHKZk";
	$db_name="bagusers";
	$tbl_name="users";
	
	mysql_connect("$host", "$username", "$password") or die(mysql_error);
	mysql_select_db("$db_name");
	
	$myusername=mysql_real_escape_string($_POST['username']);
	$mypassword=mysql_real_escape_string($_POST['password']);
	
	$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
	$result=mysql_query($sql);
	
	$count=mysql_num_rows($result);
	
	if ($count == 1)
	{
		unset($_POST['problem']);
		$SESSION['username'] = $myusername;
		$SESSION['password'] = $mypassword;
		header("location:upload.php");
	}
	else
	{
		$_POST['problem'] = "login";
		header("location:ftl-login.php");
	}
?>
