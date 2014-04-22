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
	require_once __DIR__ . "/../key/db_connector.php";
			
	$conn = new DB_CONNECT();
	$query_fetch = mysql_query("SELECT * FROM bags WHERE bag_id=$thisbagid") or die(mysql_error());
	$thisbag = mysql_fetch_array($query_fetch);
?>

<body>
<script language="JavaScript">
	function testInput(form) {
		var xhr = new XMLHttpRequest();
		
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //apparently essential: research
	
		xhr.onreadystatechange = function() {
			if (xhr.readyState === 4) {
				if (xhr.status === 200) {
					alert(xhr.responseText);
				}
				else
				{
					alert('Error! Lia is not available right now. She is probably dead.');
				}
			}
		}
		xhr.open("GET", "ftl/checkdiscountcode.php?discountcode=" + form.discountcode.value, true);
		xhr.send();
	}
</script>
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
			<a href="#" 
			  onclick="
				window.open(
				  'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 
				  'facebook-share-dialog', 
				  'width=626,height=436'); 
				return false;">
			  Share me on Facebook &raquo
			</a>
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
		 <div id="titleblock" align="left">
		 <?php
			echo $thisbag[bag_title];
		 ?>
		 </div>
		 </div>
		<div id="discountbar">
			<div id="discount_code">
				<form action="" method="post">
				Discount Code : <input type="text" id="discountcode">
				<input type="submit" value="Submit" onClick="testInput(this.form)">
				</form>
			</div>
		</div>
		</div>
		 </div>

		 <!-- End Content -->
   </div>
   <!-- End Wrapper -->   
</body>
</html>
