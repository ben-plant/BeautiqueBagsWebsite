<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href='http://fonts.googleapis.com/css?family=Roboto:100,300,900italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Beau-tique Handbags: Beautiful Handbags to Suit Your Look</title>
<link rel="stylesheet" type="text/css" href="bagpage.css" />
<link rel="icon" href="favicon.ico">
</head>
<?php
	$thisbagid = $_GET["bagid"];
?>

<?php
	require_once __DIR__ . "/../key/db_connector.php";
			
	$conn = new DB_CONNECT();
	$query_fetch = mysql_query("SELECT * FROM bags WHERE bag_id=$thisbagid") or die(mysql_error());
	$thisbag = mysql_fetch_array($query_fetch);
	
	if (isset($_POST["discountcode"]))
	{
		$code_submitted = $_POST["discountcode"];
		$discount_fetch = mysql_query("SELECT * FROM discount_code.valid_codes WHERE code='$code_submitted'") or die(mysql_error());
		$discount_valid = mysql_num_rows($discount_fetch);
		if ($discount_valid == 1)
		{
			$valid_code_submitted = true;
			$discount_submitted = mysql_fetch_array($discount_fetch);
			//POSITIVE RESPONSE REQUIRED BY PAGE
		}
		else
		{
			$valid_code_submitted = false;
			//NEGATIVE RESPONSE REQUIRED BY PAGE
		}
	}
?>

<body>

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

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
		 <!-- End Naviagtion -->

		 <div id="backbar">
		 <div id="font_fjalla_dark" align="left">
		 <a class="link" onClick="history.go(-1);return true;"><h1>RETURN TO SEARCH</h1></a></div>
		 </div>
		 <div id="splitbar">
		 </div>
		 
		 
		 <!-- Begin Content -->
		 <div id="searchresult"> <!-- Master width defined here -->
		 <div id="SearchResultContainer">
		 <div id="searchresultimage" align="center">
		 <?php
		 echo '<img height="450" src="'.$thisbag['bag_img_link'].'">';
		 ?>
		 </div>
		 <?php
		 if ($thisbag[bag_promoted] > 0)
		 {
			echo '<div id="hotbuyticket" align="left">';
			echo 'HOT BUY!';
			echo '</div>';
		 }
		 
		 if ($thisbag[bag_sale_price] != null)
		 {
			echo '<div id="saleticket" align="left">';
			echo 'ON SALE!';
			echo '</div>';
		 }
		 ?>
		 <div id="priceticket" align="left">
		 <?php
		 if ($thisbag[bag_sale_price] != null)
		 {
			echo '&pound'.$thisbag[bag_sale_price];
		 }
		 else
		 {
			echo '&pound'.$thisbag[bag_price];
		 }
		 ?>
		 </div>
		 </div>
		 <div id="splitbar">
		 </div>
		 <div id="socialbar" align="right">
			<?php
				echo '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">';
				echo '<input type="hidden" name="cmd" value="_xclick">';
				echo '<input type="hidden" name="business" value="beau-tiquebags@live.co.uk">';
				echo '<input type="hidden" name="lc" value="GB">';
				echo '<input type="hidden" name="item_name" value="'.$thisbag['bag_title'].'">';
				echo '<input type="hidden" name="item_number" value="'.$thisbag['bag_id'].'">';
				if (($thisbag['bag_sale_price'] != null) && ($thisbag['bag_sale_price'] < $thisbag['bag_price']) && ($thisbag['bag_sale_price'] != 0))
				{
					echo '<input type="hidden" name="amount" value="'.$thisbag['bag_sale_price'].'">';
				}
				else
				{
					echo '<input type="hidden" name="amount" value="'.$thisbag['bag_price'].'">';
				}
				echo '<input type="hidden" name="currency_code" value="GBP">';
				if ($valid_code_submitted != false && $thisbag['bag_pandp'] != 0 && $discount_submitted['pandp_free'] != 0)
				{
					echo '<input type="hidden" name="shipping" value="0">';
				}
				else
				{
					echo '<input type="hidden" name="shipping" value="'.$thisbag['bag_pandp'].'">';
				}
				echo '<input type="hidden" name="button_subtype" value="services">';
				if ($valid_code_submitted != false && $thisbag['bag_sale_price'] == null)
				{
					echo '<input type="hidden" name="discount_rate" value="'.$discount_submitted['discount_percentage'].'">';
				}
				echo '<input type="hidden" name="no_note" value="0">';
				echo '<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest">';
				echo '<input type="image" height=25px src="https://www.paypalobjects.com/en_GB/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">';
				echo '</form>';
			?>
	     </div>
		 
		 <div id="SearchResultContainer">
			 <div id="infoblockleft">
				 <div id="font_fjalla_table">
					 <div id="datatable">
						<table border="3">
						<tr>
						<td>Bag Number</td>
						<?php
							echo '<td>'.strtoupper($thisbag[bag_id]).'</td>';
						?>
						</tr>
						<tr>
						<td>Type</td>
						<?php
							echo '<td>'.strtoupper($thisbag[bag_type]).'</td>';
						?>
						</tr>
						<tr>
						<td>Colour</td>
						<?php
							echo '<td>'.strtoupper($thisbag[bag_colour]).'</td>';
						?>
						</tr>
						<tr>
						<td>Postage & Packaging</td>
						<?php
							if ($thisbag[bag_pandp] != 0)
							{
								echo '<td>'."&pound".strtoupper($thisbag[bag_pandp]).'</td>';
							}
							else
							{
								echo "<td>FREE</td>";
							}
						?>
						</tr>
						<td>Total Price</td>
						<?php
						if ($thisbag[bag_sale_price] != null)
						{
							$totalprice = ($thisbag[bag_pandp] + $thisbag[bag_sale_price]);
							echo '<td>'."&pound".strtoupper($totalprice).'</td>';
						}
						else
						{
							$totalprice = ($thisbag[bag_pandp] + $thisbag[bag_price]);
							echo '<td>'."&pound".strtoupper($totalprice).'</td>';
						}
						?>
						</table>
					</div>
			 </div>
		 </div>
		 <div id="infoblockright">
		 <div id="titleblock" align="center">
		 <?php
			echo $thisbag[bag_title];
		 ?>
		 </div>
		 <div id="infoblock">
			 <div id="discount_code">
				<?php
					if ($valid_code_submitted == null)
					{
						echo '<form action="bagpage.php?bagid='.$thisbag['bag_id'].'" method="post">';
						echo 'Discount Code : <input type="text" name="discountcode" class="discountTextBox">';
						echo '<input type="submit" value="" class="changingButton">';
						echo '</form>';
					}
					if ($valid_code_submitted != null && $valid_code_submitted == true)
					{
						echo '<form action="bagpage.php?bagid='.$thisbag['bag_id'].'" method="post">';
						echo 'Discount Code : <input type="text" name="discountcode">';
						echo '<input type="submit" value="" class="yesButton">';
						echo '</form>';
					}
					else if ($valid_code_submitted != null && $valid_code_submitted == false)
					{
						echo '<form action="bagpage.php?bagid='.$thisbag['bag_id'].'" method="post">';
						echo 'Discount Code : <input type="text" name="discountcode">';
						echo '<input type="submit" value="" class="noButton">';
						echo '</form>';
					}
				?>
			</div>
		 </div>
		 </div>
		 </div>
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
