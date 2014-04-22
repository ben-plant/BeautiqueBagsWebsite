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
<link rel="stylesheet" type="text/css" href="ftl-reprice.css" />
<link rel="icon" href="favicon.ico">
<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	
	$bagtoedit = $_GET['bagid'];
	$mysqli = mysqli_connect('localhost','baglookup','[REDACTED]','handbags');
	
	$stmt = mysqli_prepare($mysqli, "SELECT bag_title, bag_price FROM bags WHERE bag_id=(?)");
	mysqli_stmt_bind_param($stmt, 's', $bagtoedit);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $bagtitle, $bagprice);
	mysqli_stmt_fetch($stmt);
?>
</head>
<body>
<?php
	echo '<form action="initiatereprice.php" method="post" enctype="multipart/form-data">';
	echo '<fieldset>';
	echo '<legend>Putting '.$bagtitle.' on sale</legend>';
	echo 'Currently priced at &pound'.$bagprice.'<br>';
	echo 	'<input type="hidden" name="bag_id" value='.$bagtoedit.'>';
	echo 	'Bag sale price: &pound<input type="text" name="bag_new_price"><br>';
	echo 	'Put this bag in \'PROMOTED\': <input type="checkbox" name="promote_bag"><br>';
	echo 	'<input type="submit" value="Submit for validation">';
	echo '</fieldset>';
	echo '</form>';
	
?>
</body>
</html>