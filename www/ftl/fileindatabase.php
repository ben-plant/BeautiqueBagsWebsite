<?
	session_start();
	
	if (empty($_SESSION['username']))
	{
		header("location:ftl-login.php");
	}
?>

<?php
	require_once __DIR__ . "/../../key/db_upload_connector.php";
	
	$conn = new DB_UPLOAD_CONNECT();
	//$valid_extensions = array("jpg", "bmp", "png", "jpeg", "JPG");
	$upload_exts = end(explode(".", $_FILES["file"]["name"]));
	
	$upload_path = "bag/";
	$thisfilename = NULL;
	
	//if  (( ($_FILES["file"]["type"] == "image/gif")
	//	|| ($_FILES["file"]["type"] == "image/jpeg")
	//	|| ($_FILES["file"]["type"] == "image/png")
	//	|| ($_FILES["file"]["type"] == "image/pjpeg"))
	//	&& ($_FILES["file"]["size"] < 2000000)
	//	&& in_array($upload_exts, $valid_extensions))
	//{
		if ($_FILES["file"]["error"] > 0)
		{
			echo "Error code: " . $_FILES["file"]["error"] . "<br>";
		}
		else
		{
			echo "Upload: " . $_FILES["file"]["name"] . "<br>";
			echo "Type: " . $_FILES["file"]["type"] . "<br>";
			echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
			
			if (file_exists("/home/jones/www/bag/" . $_FILES["file"]["name"]))
			{
				echo "ERROR: Filename already exists! Please rename file or clean directory.";
			}
			else
			{
				move_uploaded_file($_FILES["file"]["tmp_name"], "/home/jones/www/bag/" . $_FILES["file"]["name"]);
				$thisfilename = $_FILES["file"]["name"];
				$sql="INSERT INTO bags (bag_title, bag_material, bag_type, bag_colour, bag_size, bag_price, bag_pandp, bag_desc, bag_img_link) VALUES ('$_POST[bag_title]','$_POST[material]','$_POST[type]','$_POST[colour]','$_POST[size]','$_POST[bag_price]','$_POST[bag_pandp]','$_POST[bag_desc]','" . "bag/" . $thisfilename . "')";
	
				if (!mysql_query($sql))
				{
					die('Error: ' . mysqli_error($conn));
				}
				
				$sql="SELECT * FROM bags WHERE bag_title='$_POST[bag_title]'";
				
				$result = mysql_query($sql);
				
				while ($row = mysql_fetch_array($result))
				{
					echo "Bag ID ".$row[0]." added!";
					echo "1 record added<br>";
					echo "SUCCESS: File ".$thisfilename." stored successfully!";
					echo "SUCCESS: Image stored under ".$row[6]."!";
				}
			}
		}
	//}
	//else
	//{
	//	echo "ERROR FOR SOME REASON: Error code: " . $_FILES["file"]["error"] . "<br>";
	//}
	
	if (mysqli_connect_errno())
	{
		echo "Connection failure: " . mysqli_connect_error();
	}
	?>
	<form action="upload.php">
		<input type="submit" value="Back to form">
	</form>
	<?php
?>