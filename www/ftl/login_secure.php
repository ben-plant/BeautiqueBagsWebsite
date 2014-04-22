<?php
	function start_a_secure_session()
	{
		$session_name = 'bag_maintenance_session';
		$secure = false;
		$httponly = true;
		
		ini_set('session.use_only_cookies', 1);
		$cookieParams = session_get_cookie_params();
		session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
		session_name($session_name);
		session_start();
		session_regenerate_id(true);
	}
	
	function login($username, $password, $mysqli)
	{
		if ($stmt = mysqli->prepare("SELECT username, password, salt FROM users WHERE username = ? LIMIT 1"))
		{
			$stmt->bind_params('s', $username);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($username, $password, $salt);
			$stmt->fetch();
			$password = hash('sha512', $password.salt);
			
			if($stmt->num_rows == 1)
			{
				if ($password == $password)
				{
					$user_browser = $_SERVER['HTTP_USER_AGENT'];
					
					$username = preg_replace("/[^0-9]+/", "", $username);
					$_SESSION['username'] = $username;
					$_SESSION['login_string'] = hash('sha512', $password.$user_browser);
					$sql_success = "INSERT INTO $tbl_attempts (user_id, timestamp, success) VALUES ('$myusername','$attempt_date','$success')";
					return true;
				}
				else
				{
					
					return false;
				}
			}
		}
	}
?>