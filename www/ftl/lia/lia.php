<?php
	include_once "sql.php";
	include_once "language.php";

	$mySQL = new mySQLConnector();
	$mySQLu = new mySQLConnectorUsers();

	$colours[] = null;
	$materials[] = null;
	$sizes[] = null;

	$users[] = null;

	while ($row = $mySQL->getResult(1)->fetch_row()) 
	{
		array_push($colours, strtolower($row[1]));
	}

	while ($row = $mySQL->getResult(2)->fetch_row())
	{
		array_push($materials, strtolower($row[1]));
	}

	while ($row = $mySQL->getResult(3)->fetch_row())
	{
		array_push($sizes, strtolower($row[1]));
	}

	$mySQL->closeResults();
	$this->users = $mySQLu->usersLiaKnows;
	
	$sentAnalysis = new sentenceAnalysis($colours, $materials, $sizes);
	
	$input = $_GET["input"];

	if (strlen($input) > 0)
	{	
		$sentence = explode(" ", $input);
		$sentAnalysis->analyseSentence($sentence);
	}
	else
	{
		echo "Try typing something next time!"; //less aggressive
	}
?>