<?php
class sentenceAnalysis
{
	var $colours;
	var $materials;
	var $sizes;
	
	function __construct($col, $mat, $siz)
	{
		$this->colours   = $col;
		$this->materials = $mat;
		$this->sizes     = $siz;
	}
	
	function analyseSentence($sentence)
	{
		for ($i = 0; $i < count($sentence); $i++)
		{
			if (in_array($sentence[$i], $this->colours) || in_array($sentence[$i], $this->materials) 
				|| in_array($sentence[$i], $this->sizes)) 
			{
				echo "I understand that!";
			}
			else
			{
				echo "I don't understand \"{$sentence[$i]}\" yet! Sorry :(";
			}
		}
	}
}
?>