<?php

$pageTitle = 'Registered for Black Rabbit Joomla Component Creator | Free | Joomla 2.5 & Joomla 3.0';
$pageActive = 'signup';
$pageActiveBreadcrumb = '<li class="active">Registered</li>';

// include files
include('master.php');

// get post
$post = $_POST;

if(!empty($post)):
	// Connect to database and open it
	$database = new Database(HOST, DBNAME, DBUSER, DBPASS);

	// validate all information
	$good = true;
	if($post['fname'] == ''):
		$good = false;
	endif;
	if($post['lname'] == ''):
		$good = false;
	endif;
	if($post['email'] == ''):
		$good = false;
	endif;
	if($post['password'] == ''):
		$good = false;
	endif;
	if($post['password2'] == ''):
		$good = false;
	endif;
	if($post['country'] == ''):
		$good = false;
	endif;
	if($post['agree'] != 1):
		$good = false;
	endif;
	if($post['password'] != $post['password2']):
		$good = false;
	endif;

	// if good, send e-mail and add to database
	if($good):

		// check if e-mail is already in use
		$noemail = 0;
		$noemail = $database->select('br_users', 'COUNT(DISTINCT email) as count', 'email="'.strtolower($post['email']).'"', 'object');
		$noemail = $noemail[0]->count;
		if($noemail == 0):
			$user = array();
			$user['fname']					= ucwords(FileHelper::safeString($post['fname']));
			$user['lname']					= ucwords(FileHelper::safeString($post['lname']));
			$user['email']					= strtolower($post['email']);
			$user['email_code']				= md5(uniqid(rand(), true));
			$user['email_validated']		= 0;
			$user['password']				= md5($post['password']);
			$user['country']				= $post['country'];
			$user['paypal_payment_status']	= 0;
			$user['date_created']			= date('Y-m-d H:i:s');

			$database->insert('br_users', $user);

			$link_validate = $base_url.'validate.php?'.$user['email_code'];

			// send validation e-mail
			$msg = '
			<html>
				<head>
					<title>Welcome to Black Rabbit, '.$user['fname'].'</title>
				</head>
				<body>
					<p>Hey '.$user['fname'].',</p>
					<p>Thank you for signing up for membership of the Black Rabbit Joomla component creator!</p>
					<p>The next step is to validate this e-mail address by clicking the link below, if the link does not work, copy the full link underneath into your favorite internet browser.</p>
					<p><a href="'.$link_validate.'">Validate E-mail/Sign-In</a></p>
					<p>'.$link_validate.'</p>
					<p><br />Thanks,</p>
					<p>Caleb Nance</p>
				</body>
			</html>
			';
			$msg_notify = '
			<html>
				<head>
					<title>New User - '.$user['fname'].' '.$user['lname'].'</title>
				</head>
				<body>
					<p><strong>'.$user['fname'].' '.$user['lname'].'</strong></p>
					<p><strong>E-mail:</strong> '.$user['email'].'</p>
					<p><strong>Country:</strong> '.$user['country'].'</p>
				</body>
			</html>
			';
			FileHelper::sendEmail($user['email'], $email_from, 'Welcome to Black Rabbit!', $msg, $email_to, 'New User - '. $user['fname'] . ' ' . $user['lname'], $msg_notify);
			header('location: index.php?msg=2');
			exit();
		else:
			header('location: sign-up.php?msg=2');
			exit();
		endif;

	else:
		header('location: sign-up.php?msg=1');
		exit();
	endif;
else:
	header('location: sign-up.php?msg=1');
	exit();
endif;

?>
