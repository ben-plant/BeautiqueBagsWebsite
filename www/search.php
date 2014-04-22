<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href='http://fonts.googleapis.com/css?family=Roboto:100,300,900italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Beau-tique Handbags: Beautiful Handbags to Suit Your Look</title>
<link rel="stylesheet" type="text/css" href="search.css" />
<link rel="icon" href="favicon.ico">
</head>

<?php
	require_once __DIR__ . "/../key/db_connector.php";
			
	$conn = new DB_CONNECT();
	$colours = mysql_query("SELECT * FROM colour") or die(mysql_error());
	$types = mysql_query("SELECT * FROM type") or die(mysql_error());
	$sizes = mysql_query("SELECT * FROM size") or die(mysql_error());
?>

<body>

   <!-- Begin Wrapper -->
   <div id="wrapper">
   
         <!-- Begin Header -->
         <div id="header">
			<a href="http://www.beautiquebags.co.uk/index.html"><img src="images/header.png" /></a>
		 </div>
		 <!-- End Header -->
		 
		 <!-- Begin Naviagtion -->
         <div id="navigation" align="center">

		</div>
		<!-- End Navigation -->
		
		 <div id="backbar">
		 <div id="font_fjalla_dark" align="left">
		 <a class="link" href="index.html"><h1> &laquo; BACK TO HOMEPAGE</h1></a></div>
		 </div>
		
		<!-- Begin Content -->
		<div id="fillerimage">
			<div id="font_fjalla">
			<h6>FIND YOUR NEW BAG</h6>
			</div>
		</div>
		<div id="searchbox">
		<form class="searchform" method="post" action="searchresults.php">
			<!--<select name="colour">-->
			<!-- VALUE 1 MEANS THAT THE USER HAS SELECTED THAT THEY DON'T CARE ABOUT THIS PROPERTY-->
			<?php
			//	while ($row = mysql_fetch_array($colours)) {
			//				unset($id, $name);
			//				$id = $row['colour_id'];
			//				$name = $row['colour']; 
			//				echo '<option value="' . $id . '">' . ucfirst(strtolower($name)) . '</option>';
			//	}
			?> 
			</select>
			<br><br>
			<select name="type">
			<?php
				while ($row = mysql_fetch_array($types)) {
							unset($id, $name);
							$id = $row['type_id'];
							$name = $row['type'];
							echo '<option value="' . $id . '">' . ucfirst(strtolower($name)) . '</option>';
				}
			?>
			 </select>
			<br><br>
			<select name="size">
			<?php
				while ($row = mysql_fetch_array($sizes)) {
							unset($id, $name);
							$id = $row['size_id'];
							$name = $row['size'];
							$name_formatted = $row['size_formatted'];
							echo '<option value="' . $id . '">' . ucfirst(strtolower($name_formatted)) . '</option>';
				}
			?> 
			</select>
			<br><br>
			<input type="submit" value="GO">
		</form>
		 </div>
		 <!-- End Content -->
		 <!-- Begin Footer -->
		 <div id="footer" align="center">
		       
			   &copy; 2013 Beau-tique Bags - Contact email: <a href="mailto:beau-tiquebags@live.co.uk">beau-tiquebags@live.co.uk</a> - <b>Shipped from the UK!</b>
			    
	     </div>
		 <!-- End Footer -->
		 
   </div>
   <!-- End Wrapper -->
   
   <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-37736551-4']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
   
</body>
</html>
