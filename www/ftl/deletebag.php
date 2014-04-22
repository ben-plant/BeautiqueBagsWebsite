<?
	session_start();
	
	if (empty($_SESSION['username']))
	{
		header("location:ftl-login.php");
	}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FTL Stock Management - Alpha</title>
<link rel="stylesheet" type="text/css" href="ftl-dashboard.css" />
<link rel="icon" href="favicon.ico">
<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	$bagtodelete = $_GET['bagid'];
	
	$mysqli = mysqli_connect('localhost','bagdelete','[REDACTED]','handbags');
	
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	
	$del_stmt = mysqli_prepare($mysqli, "DELETE FROM bags WHERE bag_id=(?)");
	mysqli_stmt_bind_param($del_stmt, 's', $bagtodelete);
	//$del_stmt->bind_param('i', $bagtodelete);
	$del_stmt->execute();

	printf("Deleted bag %s!", $bagtodelete);
	
	$del_stmt->close();
	
	header("location:bagmanager.php");
?>
</head>
<body>
