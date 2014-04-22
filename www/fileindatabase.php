<?
	session_start();
	
	if (!session_is_registered(myusername))
	{
		header("location:ftl-login.php");
	}
?>

<?php
	
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	
	require_once __DIR__ . "/../../key/db_upload_connector.php";
	
	$conn = new DB_UPLOAD_CONNECT();
	$valid_extensions = array("jpg", "bmp", "png", "jpeg");
	$upload_exts = end(explode(".", $_FILES["file"]["name"]));
	
	$upload_path = "bags/";
	$thisfilename = NULL;
	
	if  (( ($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/png")
		|| ($_FILES["file"]["type"] == "image/pjpeg"))
		&& ($_FILES["file"]["size"] < 2000000)
		&& in_array($upload_exts, $valid_extensions))
	{
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
			
			if (file_exists("/home/jones/www/bags/" . $_FILES["file"]["name"]))
			{
				echo "ERROR: Filename already exists! Please rename file or clean directory.";
			}
			else
			{
				move_uploaded_file($_FILES["file"]["tmp_name"], "/home/jones/www/bags/" . $_FILES["file"]["name"]);
				$thisfilename = $_FILES["file"]["name"];
				$sql="INSERT INTO bags (bag_title, bag_material, bag_type, bag_colour, bag_size, bag_price, bag_pandp, bag_desc, bag_img_link) VALUES ('$_POST[bag_title]','$_POST[material]','$_POST[type]','$_POST[colour]','$_POST[size]','$_POST[bag_price]','$_POST[bag_pandp]','$_POST[bag_desc]','" . $upload_path . $thisfilename . "')";

				if (!mysqli_query($conn,$sql))
				{
					die('Error: ' . mysqli_error($conn));
				}
				
				$sql="SELECT bag_id FROM bags WHERE bag_title='$_POST[bag_title]'";
				
				$result = $conn->query($sql);
				$row = ($result->fetch_row());

				echo "Bag ID ".$row[0]." added!";
				echo "1 record added<br>";
				echo "SUCCESS: File ".$thisfilename." stored successfully!";
			}
		}
	}
	else
	{
		echo "ERROR: Invalid file specified!";
	}
	
	if (mysqli_connect_errno())
	{
		echo "Connection failure: " . mysqli_connect_error();
	}
	?>
	<form action="upload.php">
		<input type="submit" value="Back to form">
	</form>
	<?php
	mysqli_close($conn);

?>