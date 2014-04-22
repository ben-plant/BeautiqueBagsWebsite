<?php

	if (isset($_GET["discountcode"]))
	{
		$code_submitted = $_POST["discountcode"];
		$discount_fetch = mysql_query("SELECT * FROM discount_code.valid_codes WHERE code='$code_submitted'") or die(mysql_error());
		$discount_valid = mysql_num_rows($discount_fetch);
		if ($discount_valid == 1)
		{
			echo "true";
			//POSITIVE RESPONSE REQUIRED BY PAGE
		}
		else
		{
			echo "false";
			//NEGATIVE RESPONSE REQUIRED BY PAGE
		}
	}
?>