<?
	session_start();
	
	if (!session_is_registered(myusername))
	{
		header("location:ftl-login.php");
	}
?>

<html>
<head>
Test upload page<br>
</head>

<?php
	require_once __DIR__ . "/../key/db_connector.php";
			
	$conn = new DB_CONNECT();
	$colours = mysql_query("SELECT * FROM colour") or die(mysql_error());
	$materials = mysql_query("SELECT * FROM material") or die(mysql_error());
	$sizes = mysql_query("SELECT * FROM size") or die(mysql_error());
	$types = mysql_query("SELECT * FROM type") or die(mysql_error());
?>

<body>
<form action="fileindatabase.php" method="post" enctype="multipart/form-data">
	Bag title: <input type="text" name="bag_title"><br>
	Bag price: &pound<input type="text" name="bag_price"><br>
	Bag P&P: &pound<input type="text" name="bag_pandp"><br>
	Bag description:<br> <textarea name="bag_desc" cols="50" rows="10">Enter bag description here (max 2000 chars)</textarea><br> 
	<select name="colour">
	<?php
		while ($row = mysql_fetch_array($colours)) {
			unset($name);
			$name = $row['colour']; 
			echo '<option value="' . $name . '">' . ucfirst(strtolower($name)) . '</option>';
		}
	?> 
	</select><br>
	<select name="material">
	<?php
		while ($row = mysql_fetch_array($materials)) {
			unset($name);
			$name = $row['material']; 
			echo '<option value="' . $name . '">' . ucfirst(strtolower($name)) . '</option>';
		}
	?>
	</select><br>
	<select name="size">
	<?php
		while ($row = mysql_fetch_array($sizes)) {
			unset($name);
			$name = $row['size']; 
			echo '<option value="' . $name . '">' . $name . '</option>';
		}
	?> 
	</select><br>
	<select name="type">
	<?php
		while ($row = mysql_fetch_array($types)) {
			unset($name);
			$name = $row['type']; 
			echo '<option value="' . $name . '">' . $name . '</option>';
		}
	?> 
	</select><br>
	Photo: <input type="file" name="file" id="file"><br>
	Check your info before clicking this button!!!!!!!<br>
	<input type="submit" value="Submit for validation">
</form>
</body>
</html>