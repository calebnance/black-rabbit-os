<?php
/**
 *	Start it off with everything
 *
 */
 	define('MAINDIR', dirname(__FILE__));
 	define('INCLUDESDIR', MAINDIR . '/includes/');
    session_start();
    // Display errors on localhost
	$whitelist = array('locathost');
	if(!in_array($_SERVER['SERVER_NAME'], $whitelist)){
		// this is localhost!
		// ini_set('display_errors', 1);
		error_reporting(E_ALL);
		// error_reporting(E_ALL ^ E_NOTICE);
	}

 	// Config file
 	require_once(INCLUDESDIR . 'configuration.php');

 	// Constants file
 	require_once(INCLUDESDIR . 'constants.php');

 	// Translator
 	require_once(INCLUDESDIR . 'translator.php');

 	// Database file
 	require_once(INCLUDESDIR . 'database.php');

 	// Helpers
 	require_once(INCLUDESDIR . 'helpers.php');

 	// File helper
 	require_once(INCLUDESDIR . 'filehelper.php');

 	// Files
 	require_once(INCLUDESDIR . 'files.php');

 	// Site files
 	require_once(INCLUDESDIR . 'sitefiles.php');

 	// Admin files
 	require_once(INCLUDESDIR . 'adminfiles.php');

 	// Field types
 	require_once(INCLUDESDIR . 'fieldtypes.php');

 	// Module helper
 	require_once(INCLUDESDIR . 'modulehelper.php');

 	// Debug mode
 	if(CREATE_PACKAGE == false){
		require_once(INCLUDESDIR . 'debug.php');
 	}
?>
