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
	require_once __DIR__ . "/../../key/db_connector.php";
	
	$conn = new DB_CONNECT();
	$allbags = mysql_query("SELECT * FROM bags") or die(mysql_error()) ;
?>
</head>
<body>
<table border="1">
<div id="table-headers">
	<tr>
	<td>Bag ID</td>
	<td>Bag Name</td>
	<td>Bag Type</td>
	<td>Bag Colour</td>
	<td>Bag Size</td>
	<td>Bag Img</td>
	<td>Bag Price</td>
	<td>Bag Sale price</td>
	<td>Bag P&P</td>
	<td>Bag Promoted?</td>
	<td>Bag Stock</td>
	</tr>
</div>
	<?php
		while ($row = mysql_fetch_array($allbags)) {
			echo '<tr>';
			echo '<td>'.$row[0].'</td>';
			echo '<td>'.$row[1].'</td>';
			echo '<td>'.$row[3].'</td>';
			echo '<td>'.$row[4].'</td>';
			echo '<td>'.$row[5].'</td>';
			echo '<td><a href="../'.$row[6].'">Image</a></td>';
			echo '<td>&pound'.$row[7].'</td>';
			if ($row[8] != null)
			{
				echo '<td>&pound'.$row[8].'</td>'; 
			}
			else
			{
				echo '<td>'.$row[8].'</td>'; 
			}
			echo '<td>&pound'.$row[9].'</td>';
			if ($row[10] == 1)
			{
				echo '<td>YES</td>';
			}
			else
			{
				echo '<td></td>';
			}
			echo '<td>'.$row[12].'</td>';
			echo '<td><a href="repricebag.php?bagid='.$row[0].'">Initiate bag sale</a></td>'; //post changes
			//echo '<td><a href="modifybag.php?bagid='.$row[0].'">Edit bag</a></td>'; //post changes
			echo '<td><a href="deletebag.php?bagid='.$row[0].'">Permanently delete bag</a></td>'; 
			echo '</tr>';
		}
	?>
</table>

</body>
</html>

