<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FTL Stock Management</title>
<link rel="stylesheet" type="text/css" href=" login.css" />
<link rel="icon" href="favicon.ico">
</head>

<body>
	<form name="login" action="/../../ftl/login.php" method="post">
		<fieldset>
		<legend>FTL Stock Management - (c)2013 Ben Plant</legend>
		<p><label for="username">Username:</label> <input type="text" name="username" /></p>
		<p><label for="password">Password:</label>  <input type="password" name="password" /></p>
		<?php
			if (isset($_POST["problem"]) && !empty($_POST["problem"]))
			{
				echo 'Wrong username or password!';
			}
		?>
		<p class="submit"><input type="submit" value="Confirm" /></p>
		</fieldset>
	</form>
</body>