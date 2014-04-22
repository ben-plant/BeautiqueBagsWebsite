<?php

class mySQLConnector
{
	var $result;  //globally available result bank
	var $result2;
	var $result3;

	var $mysqli; //mysql connector
	
	function __construct()
	{
		$this->mysqli = new mysqli("localhost", "baglookup", "selectorpass", "handbags");
		
		if (mysqli_connect_errno())
		{
			echo "Connection to the database failed! Lia cannot operate without the database! Panic!";
			exit();
		}
		$this->result  = $this->runQuery("SELECT * FROM colour WHERE colour != 'Select colour'");
		$this->result2 = $this->runQuery("SELECT * FROM material WHERE material != 'Select material'");
		$this->result3 = $this->runQuery("SELECT * FROM size WHERE size != 'Select size'");
	}
	
	function getArrayOfResults($query)
	{
		$temp[] = null;
		while ($row = $query->fetch_row())
		{
			array_push($temp, $row);
		}
		return $temp;
	}
	
	function runQuery($query) //string in, result out
	{
		$output = $this->mysqli->query($query);
		return $output;
	}
	
	function runQueryStoreInBank($query, $i) //string in, stored in bank
	{
		if (isset($i))
		{
			if ($i == 1)
			{
				$this->result  = $this->mysqli->query($query);
			}
			if ($i == 2)
			{
				$this->result2 = $this->mysqli->query($query);
			}
			if ($i == 3)
			{
				$this->result3 = $this->mysqli->query($query);
			}
		}
		else
		{
			echo "Error: result var not set for setting result bank. Abort.";
			exit();
		}
	}

	function getResult($i) //returns the defined preset result bank (only used for initial fetches)
	{
		if (isset($i))
		{
			if ($i == 1)
			{
				return $this->result;
			}
			if ($i == 2)
			{
				return $this->result2;
			}
			if ($i == 3)
			{
				return $this->result3;
			}
		}
		else
		{
			echo "Error: result var not set. Abort.";
			exit();
		}
	}
	
	function closeResults() //cleans result banks
	{
		$this->result->close();
		$this->result2->close();
		$this->result3->close();
	}
}

class mySQLConnectorUsers
{
	var $usersLiaKnows;

	var $mysqli;
	
	function __construct()
	{
		$this->mysqli = new mysqli("localhost", "lia_mod", "7g336[6K.U9f/<j", "lia");
		
		if (mysqli_connect_errno())
		{
			echo "Connection to the database failed! Lia cannot operate without the database! Panic!";
			exit();
		}
		$this->usersLiaKnows = $this->runQuery("SELECT * FROM known_users");
	
	}

	function runQuery($query) //string in, result out
	{
		$output = $this->mysqli->query($query);
		return $output;
	}
}
	
?>