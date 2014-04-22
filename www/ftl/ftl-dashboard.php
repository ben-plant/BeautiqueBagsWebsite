<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?
	session_start();
	
	if (empty($_SESSION['username']))
	{
		header("location:ftl-login.php");
	}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FTL Stock Management - Alpha</title>
<link rel="stylesheet" type="text/css" href=" ftl-dashboard.css" />
<link rel="icon" href="favicon.ico">

<script language="JavaScript">
function testInput(form) {
	var xhr = new XMLHttpRequest();
	xhr.open("GET", "lia/lia.php?input=" + form.inputbox.value, true);
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
	xhr.send();
}

function showBag(input)	{
	if (input.length==0)
	{
		document.getElementById("bags").innerHTML="NO BAGS!";
		return;
	}
	if (window.XMLHttpRequest)
	{
		xmlhttp = new XMLHttpRequest();
	}
	xmlhttp.onreadystatechange = function()
	{
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
		{
			alert(xmlhttp.responseText);
		}
	}
	xmlhttp.open("GET","lia/getbags.php?input="+input,true);
	xmlhttp.send();
	
}
</script>

</head>
<body>
<div id="main_title">
FTL V0.3A - Landing Page V1.1<br>
</div>
<div id="ftl_planned">
[REDACTED]
</div>
<br>
<form name="lia_form" action="" method="GET">
<input type="text" id="inputbox" value="" onkeyup="showBag(this.value)"><P>
<input type="button" name="go" value="Submit!" onClick="testInput(this.form)">
</form>
<p>Found: <span id="bags"></span></p>
<br>
<div id="ftl_working">
	<div id="working_title">This stuff works as expected, and has been tested to work. It can be used day to day, though there still may be the odd bug or problem<br><br></div>
	-- <a href="upload.php">Upload form</a> -- Version 0.1 (Works. Needs cleanup and function change. Needs to not pick up character case of file extension.)<br>
	-- You can now delete and add sale prices to bags through bagmanager! <br>
	-- <a href="bagmanager.php">Bag management</a>
</div>
<br>
<div id="ftl_beta">
	<div id="beta_title">This stuff should work, but possibly won't. It's where stuff I'm working on will go, as it's gonna be updated frequently until it moves into the working category. Watch what you click.<br><br></div>
	Currently nothing classed as 'beta'
</div>
<br>
<div id="ftl_broken">
	<div id="broken_title">This stuff is broken. Big time. Seriously. Here be demons.<br>
	Stuff here may actually crash the server, or destroy the website. Hence you can't click on them.<br><br></div>
	Currently nothing classed as 'broken'
</div>
<br>
<div id="ftl_planned">
	<div id="planned_title">This is stuff I'm thinking about working on soon.<br><br></div>
	-- Intelligent Java framework running to manage site in admin/Jones' absence. Detect poorly selling bags and promote them accordingly, and automatically apply preapproved discounts to poor moving stock. Send weekly reports on sales and inform admin/Jones when stock needs ordering. Send receipts to customers.<br>
</div>
<br>
<div id="ftl_todo">
	<div id="todo_title">A list of odd jobs that need doing.<br><br></div>
	-- Fix the discount box<br>
	-- Put 'share to Facebook' back on bagpage.php<br>
	-- Set up cron backups once disk arrives. Nightly backups of full SQL and website<br>
	-- Thanks landing page after transaction<br>
	-- Buttons on the front page<br>
	-- Pinterest integration<br>
	-- Generalise asset type and storage<br>
</div>

</body>
</html>
