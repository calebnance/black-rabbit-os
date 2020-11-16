<?php
// debug and testing mode
$live = false;
$debug = false;
$create_package = true;

define('LIVE', $live);

// Both
if (LIVE) {
	$host = 'localhost';
	$db_user = '';
	$db_pass = '';
	$db_name = '';
	$email_to	= '';
	$email_from	= '';
	$base_url	= 'http://[editthisinconfiguration.php].com/';

	// paypal
	$paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
	$paypal_btn_id = '';
	$paypal_pdt_token	= '';
} else {
	$host = 'localhost';
	$db_user = '';
	$db_pass = '';
	$db_name = '';
	$email_to = '';
	$email_from = '';

	$db_user = 'root';
	$db_pass = 'e3_#dRtLc23!2bn-8';
	$db_name = 'blackrabbit_os_2018';
	$email_to = 'calebnance@gmail.com';
	$email_from = 'admin@calebnance.com';
	$base_url	= 'http://black-rabbit-os/';

	// paypal
	$paypal_url	= 'https://www.sandbox.paypal.com/cgi-bin/webscr';
	$paypal_btn_id = '';
	$paypal_pdt_token	= '';
}

// download on home page
$latesthello25 = 'com_helloworlds-v.1.1.5-joomla_2.5.0.zip';
$latesthello30 = 'com_helloworlds-v.1.1.5-joomla_3.0.zip';
$latesthello32 = 'com_helloworlds-v.1.1.5-joomla_3.2.zip';
$latestallfields25 = 'com_allfields-v.1.1.5-joomla_2.5.0.zip';
$latestallfields30 = 'com_allfields-v.1.1.5-joomla_3.0.zip';
$latestallfields32 = 'com_allfields-v.1.1.5-joomla_3.2.zip';
