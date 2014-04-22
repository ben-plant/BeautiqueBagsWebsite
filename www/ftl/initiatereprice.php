<?
	session_start();
	
	if (!session_is_registered(myusername))
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

	$bagtoreprice = $_POST['bag_id'];
	$bagnewprice  = $_POST['bag_new_price'];
	if (isset($_POST['promote_bag']))
	{
		$promote_bag = "1";
	}
	else
	{
		$promote_bag = "0";
	}
	
	$mysqli = mysqli_connect('localhost','bagreprice','[REDACTED]','handbags');
	
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	
	$reprice_stmt = mysqli_prepare($mysqli, "UPDATE bags SET bag_sale_price=(?), bag_promoted=(?) WHERE bag_id=(?)");
	mysqli_stmt_bind_param($reprice_stmt, 'sss', $bagnewprice, $promote_bag, $bagtoreprice);
	$reprice_stmt->execute();

	printf("Repriced bag %s!", $bagtoreprice);
	$reprice_stmt->close();
	
	header("location:bagmanager.php");
?>
</head>
<body>
</body>
</html>