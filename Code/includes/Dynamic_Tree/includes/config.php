<?php
	session_start();
	
	if(!defined("IN_PHP"))
		die();
	// if you want to run in demo mode, enable the macro below,  if it runs in demo mode, it doesn't care what TARGET_PLATFORM is
	//define("DEMO_MODE", true);

	/** target platform types
	 *  this script runs for both database(mysql) and file system. 
	 *  database is supposed to be mysql
	 */
	define ("DATABASE_PLATFORM", 0); // Don't edit
	define ("FILE_SYSTEM_PLATFORM", 1); // Don't edit

	// choose target platform according to your needs, it may be DATABASE_PLATFORM or FILE_SYSTEM_PLATFORM
	define ("TARGET_PLATFORM", DATABASE_PLATFORM);
	if(TARGET_PLATFORM == FILE_SYSTEM_PLATFORM)
	{
		// if FILE_SYSTEM_PLATFORM is selected as TARGET_PLATFORM, then assign root folder adress to FILE_ROOT macro
		define("FILE_ROOT", "/home/mekya/public_html/test"); 
	}
	else if (TARGET_PLATFORM == DATABASE_PLATFORM)
	{
		/**
		 * if DATABASE_PLATFORM is selected as TARGET_PLATFORM,
		 * set the variables to connect database and 
		 * set the TREE_TABLE_PREFIX if you want to
		 * change the prefix of table name
		 */
		
		$dbHost = $_SESSION[$_SESSION['Prefix'].'ServerHost'];
		$dbUsername = $_SESSION[$_SESSION['Prefix'].'ServerUser']; 
		$dbPassword = $_SESSION[$_SESSION['Prefix'].'ServerPassword'];
		$dbName = $_SESSION[$_SESSION['Prefix'].'ServerDB'];
		
		define ("TREE_TABLE_PREFIX", "");
	}
	else
		die("No known target platform specified, in includes/config.php");

	define("SUCCESS", 1); // Don't edit
	define("FAILED", -1); // Don't edit
	define("FAILED_FILE_WITH_SAME_NAME_EXIST", -2); // Don't edit, it is only used in FILE_SYSTEM_PLATFORM
	error_reporting(0); 
?>