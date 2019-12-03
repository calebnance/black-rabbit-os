<?php
include('master.php');

if (Access::loggedIn()) {
	FileHelper::checksession();
}

// check to see if there is even data to GET
if (isset($_GET)):
	// make sure its coming from paypal
	if (array_key_exists('tx', $_GET)):
		$output = FileHelper::curl_request(PAYPAL_URL, "tx=".$_GET['tx']."&cmd=_notify-synch&at=".PAYPAL_PDT);

		$lines = explode("\n", $output);
		$keyarray = array();

		if (strcmp($lines[0], 'SUCCESS') == 0):
			for($i = 1; $i < count($lines); $i++):
				list($key,$val)				= explode('=', $lines[$i]);
				$keyarray[urldecode($key)]	= urldecode($val);
			endfor;

			$date_paid = strtotime($keyarray['payment_date']);
			$date_paid = date('Y-m-d H:i:s', $date_paid);

			$update = array();
			$update['paypal_payment_status']		= 1;
			$update['paypal_payment_status_text']	= $keyarray['payment_status'];
			$update['paypal_payer_id']				= $keyarray['payer_id'];
			$update['paypal_payment_type']			= $keyarray['payment_type'];
			$update['paypal_payer_status']			= $keyarray['payer_status'];
			$update['paypal_payer_email']			= $keyarray['payer_email'];
			$update['paypal_payer_fname']			= $keyarray['first_name'];
			$update['paypal_payer_lname']			= $keyarray['last_name'];
			$update['paypal_payer_tx_id']			= $keyarray['txn_id'];
			$update['paypal_payer_tx_type']			= $keyarray['txn_type'];
			$update['paypal_payment_amount']		= $keyarray['mc_gross'];
			$update['paypal_payment_gross']			= $keyarray['payment_gross'];
			$update['paypal_payment_currency']		= $keyarray['mc_currency'];
			$update['payment_payer_country']		= $keyarray['residence_country'];
			$update['date_paid']					= $date_paid;

			$database = new Database(HOST, DBNAME, DBUSER, DBPASS);
			$database->update('br_users', $update, 'id='.$_SESSION['uid']);

			// set paid in session as well
			$_SESSION['paid'] = '1';

			// redirect to components, should be able to save them now!
			header('location: components.php?msg=4');
		elseif (strcmp($lines[0], 'FAIL') == 0):
			header('location: components.php?msg=5');
		endif;

	else:
		header('location: components.php');
		exit();
	endif;
else:
	header('location: components.php');
	exit();
endif;
?>
