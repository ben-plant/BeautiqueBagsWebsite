<?php require_once("http://localhost:8087/JavaBridge/java/Java.inc");
	$lia = new java("Lia");
	
	$sentenceIn = "Hello there Lia, how are you?";
	$input = explode(" ", $sentenceIn);
	echo $lia->chat($input);

?>
