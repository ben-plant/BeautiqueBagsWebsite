<?php require_once("http://localhost:8087/JavaBridge/java/Java.inc");
	$word = $_GET["word"];

	$lia = new java("Lia");
	$lia->start();	
	echo $lia->transmit($word);
	$lia->exitCleanly();
	exit("Success!");
?>
