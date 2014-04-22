<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href='http://fonts.googleapis.com/css?family=Roboto:100,300,900italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Beau-tique Handbags: Beautiful Handbags to Suit Your Look</title>
<link rel="stylesheet" type="text/css" href="results.css" />
<link rel="icon" href="favicon.ico">
</head>
<!-- PHP-ified working results page -->
<body>

<?php
	require_once __DIR__ . "/../key/db_connector.php";
			
	$conn = new DB_CONNECT();
	$colours = mysql_query("SELECT * FROM colour") or die(mysql_error());
	$types = mysql_query("SELECT * FROM type") or die(mysql_error());
	$sizes = mysql_query("SELECT * FROM size") or die(mysql_error());
	
	/* Powers the offers on the front page */
	if (isset($_GET['sale']))
	{
		//Refine this
		$masterresultfetch = mysql_query("SELECT * FROM bags WHERE bag_sale_price IS NOT NULL");
	}
	else if (isset($_GET['tote']))
	{
		$masterresultfetch = mysql_query("SELECT * FROM bags WHERE bag_type='TOTE'");
	}
	else if (isset($_GET['purse']))
	{
		$masterresultfetch = mysql_query("SELECT * FROM bags WHERE bag_type='PURSE'");
	}
	else if (isset($_GET['satchel']))
	{
		$masterresultfetch = mysql_query("SELECT * FROM bags WHERE bag_type='SATCHEL'");
	}
	else if (isset($_GET['shoulder']))
	{
		$masterresultfetch = mysql_query("SELECT * FROM bags WHERE bag_type='SHOULDER'");
	}
	else if (isset($_GET['rucksack']))
	{
		$masterresultfetch = mysql_query("SELECT * FROM bags WHERE bag_type='RUCKSACK'");
	}
	else if (isset($_GET['clutch']))
	{
		$masterresultfetch = mysql_query("SELECT * FROM bags WHERE bag_type='CLUTCH'");
	}
	else if (isset($_GET['promo']))
	{
		//A bit clunky, but functional
		$masterresultfetch = mysql_query("SELECT * FROM bags WHERE bag_promoted > 0");
	}
	else
	{
		if (isset($_POST['colour']) && ($_POST['colour'] != 1))
		{
			$bagcolour = $_POST['colour'];
			$colourquery = mysql_query("SELECT colour FROM colour WHERE colour_id='".$bagcolour."'") or die(mysql_error()); //PROTOTYPE
			$colourrow   = mysql_fetch_array($colourquery);
		}
		else
		{
			$colourrow = "%";
		}
		
		if (isset($_POST['type']) && ($_POST['type'] != 1))
		{
			$bagtype = $_POST['type'];
			$typequery = mysql_query("SELECT type FROM type WHERE type_id='".$bagtype."'") or die(mysql_error()); //PROTOTYPE
			$typerow   = mysql_fetch_array($typequery);
		}
		else
		{
			$typerow = "%";
		}
		
		if (isset($_POST['size']) && ($_POST['size'] != 1))
		{
			$bagsize = $_POST['size'];
			$sizequery = mysql_query("SELECT size FROM size WHERE size_id='".$bagsize."'") or die(mysql_error()); //PROTOTYPE
			$sizerow   = mysql_fetch_array($sizequery);
		}
		else
		{
			$sizerow = "%";
		}
		
		$masterresultfetch = mysql_query("SELECT * FROM bags WHERE bag_type LIKE '".$typerow['type']."' AND bag_size LIKE '".$sizerow['size']."' AND bag_colour LIKE '".$colourrow['colour']."'");
	}

?>

   <!-- Begin Wrapper -->
   <div id="wrapper">
   
		<div id="header_wrapper">
			<!-- Begin Header -->
			<div id="header">
				<!-- Header body - DOES NOT TRAVEL AROUND -->
			<a href="http://www.beautiquebags.co.uk/index.html"><img src="images/header.png" /></a>
			</div>
			<!-- End Header -->
			<!-- Begin Naviagtion -->
			<div id="navigation" align="center"> 
			</div>
			<!-- End Naviagtion -->
			<div id="backbar">
				<a class="link" onClick="history.go(-1);return true;"><h1> &laquo; BACK</h1></a>
			</div>
		</div>

		<?php
		$numberofrowsreturned = mysql_num_rows($masterresultfetch);
		if ($numberofrowsreturned > 0)
		{
			while ($masterresultrow = mysql_fetch_array($masterresultfetch))
			{
				if ($masterresultrow['bag_quantity'] > 0)
				{
					echo '<div id="searchresult">';
					echo '<div id="SearchResultContainer">';
					echo '<div id="searchresultimage" align="center">';
					echo '<a href="http://www.beautiquebags.co.uk/bagpage.php?bagid='.$masterresultrow['bag_id'].'"><img height="250" src="'.$masterresultrow['bag_img_link'].'">';
					echo '</div>';
					echo '</div>';
					
					echo '<div id="searchresultcontent" align="justify">';
					echo '<h1>'.$masterresultrow['bag_title'].'</h1>';
						if (($masterresultrow['bag_sale_price'] != null) && ($masterresultrow['bag_sale_price'] < $masterresultrow['bag_price']) && ($masterresultrow['bag_sale_price'] != 0))
					{
						echo '<div id="font_fjalla_sale">';
						echo 'SALE PRICE: <h1>&pound;'.$masterresultrow['bag_sale_price'].'</h1>';
						echo '</div>';
					}
					else
					{
						echo '<h1>&pound;'.$masterresultrow['bag_price'].'</h1>';
					}
					
					echo '</div>';
					echo '</div>';
					echo '<div id="splitbar">';
					echo '</div>';
				}
			}
		}
		else
		{
			echo '<div id="searchresult">';
			echo '<div id="SearchResultContainer">';
			echo '</div>';
			
			echo '<div id="searchresultcontent" align="justify">';
			echo '<h1>SORRY, BUT NONE OF OUR BAGS FIT YOUR DESCRIPTION.</h1>';
			
			echo '</div>';
			echo '</div>';
			echo '<div id="splitbar">';
			echo '</div>';
		}
		?>
		
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
