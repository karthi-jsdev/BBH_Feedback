<?php
	class MySQL
	{	
		private $dbLink, $dbHost, $dbUsername, $dbPassword, $dbName;
		public  $queryCount;
		
		function MySQL($dbHost,$dbUsername,$dbPassword,$dbName)
		{
			$this->dbHost = $dbHost;
			$this->dbUsername = $dbUsername;
			$this->dbPassword = $dbPassword;
			$this->dbName = $dbName;	
			$this->queryCount = 0;
		}
		function __destruct()
		{
			$this->close();
		}
		//connect to database
		private function connect()
		{	
			$this->dbLink = mysqli_connect($this->dbHost, $this->dbUsername, $this->dbPassword);		
			if(!$this->dbLink)
			{			
				$this->ShowError();
				return false;
			}
			else if (!mysqli_select_db($this->dbName,$this->dbLink))
			{
				$this->ShowError();
				return false;
			}
			else
			{
				mysqli_query("set names utf8",$this->dbLink);
				return true;
			}
			unset ($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);		
		}	
		/*****************************
		 * Method to close connection *
		 *****************************/
		function close()
		{
			mysqli_close($this->dbLink);
		}
		// Checks for MySQL Errors
		function ShowError()
		{
			$error = mysqli_error();
			//echo $error;		
		}	
		// Method to run SQL queries
		function  query($sql)
		{	
			if(!$this->dbLink)	
				$this->connect();
				
			if(! $result = mysqli_query($sql,$this->dbLink))
			{
				$this->ShowError();			
				return false;
			}
			$this->queryCount++;	
			return $result;
		}
		// Method to fetch values
		function fetchObject($result)
		{
			if(!$Object=mysqli_fetch_object($result))
			{
				$this->ShowError();
				return false;
			}
			else
				return $Object;
		}
		// Method to number of rows
		function numRows($result)
		{
			if(false === ($num = mysqli_num_rows($result)))
			{
				$this->ShowError();
				return -1;
			}
			return $num;		
		}
		// Method to safely escape strings
		function escapeString($string)
		{
			if(get_magic_quotes_gpc())
				return $string;
			else 
			{
				$string = mysqli_escape_string($string);
				return $string;
			}
		}
		
		function free($result)
		{
			if (mysqli_free_result($result))
			{
				$this->ShowError();
				return false;
			}
			return true;
		}
		
		function lastInsertId()
		{
			return mysqli_insert_id($this->dbLink);
		}
		
		function getUniqueField($sql)
		{
			$row = mysqli_fetch_row($this->query($sql));
			return $row[0];
		}
	}