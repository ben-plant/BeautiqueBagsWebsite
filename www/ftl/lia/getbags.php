<?php
	include_once "sql.php";
	include_once "language.php";

	$mySQL = new mySQLConnector();
	$input = $_GET["input"];
	
	$temp[] = array();

	$results = $mySQL->runQuery("SELECT colour FROM colour WHERE colour != 'Select colour'");
		
	while ($row = $results->fetch_row())
	{
		array_push($temp, $row[0]);
	}

	if (in_array($input, $temp)) //$i after results
	{
		$output = $mySQL->runQuery("SELECT bag_img_link FROM bags WHERE bag_colour = '{$input}'");
		while ($row = $output->fetch_row())
		{
			printf($row[0], " ");
		}
	}
?>