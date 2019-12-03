<?php
	// Include database and config
	include('../master.php');

	// First time? Set the admin up.
	$database = new Database(HOST, DBNAME, DBUSER, DBPASS);
	$adminCheck = $database->select('br_admins', '*', '1=1', 'object');

	if ($adminCheck):
		header('location:login.php');
		exit();
	endif;

	$msg = $msgType = '';
	$post = $_POST;

	if ($post):
		if ($post['password'] != $post['cpassword']):
			$msg = 'Passwords do not match!';
			$msgType = 'error';
		elseif ($post['username'] && $post['password'] && $post['cpassword']):
			$posted_date = date("Y-m-d H:i:s");
			$admin_record = [
				'username' => $post['username'],
				'password' => md5($post['password']),
				'last_login' => $posted_date
			];
			$record_response = $database->insert('br_admins', $admin_record);

			if ($record_response) {
				// success
				header('location:login.php?msg=3');
			} else {
				// fail
				header('location:login.php?msg=2');
			}
			exit();
		else:
			$msg = 'Fill in all fields!';
			$msgType = 'warning';
		endif;
	endif;

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Admin Sign In</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="Caleb Nance - www.calebnance.com">
		<!-- Le styles -->
		<link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
		<style type="text/css">
			body { padding-bottom: 40px; padding-top: 40px!important; background-color: #f5f5f5;}
			.form-signin { max-width: 300px; padding: 19px 29px 29px; margin: 0 auto 20px; background-color: #fff; border: 1px solid #e5e5e5; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05); -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05); box-shadow: 0 1px 2px rgba(0,0,0,.05); }
			.form-signin .form-signin-heading, .form-signin .checkbox { margin-bottom: 10px; }
			.form-signin input[type="text"],.form-signin input[type="password"] { font-size: 16px; height: auto; margin-bottom: 15px; padding: 7px 9px; }
		</style>
		<link href="../bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container">
			<form class="form-signin" method="post" action="welcome.php">
				<h2 class="form-signin-heading">Admin Set Up</h2>
				<?php
				Msg::alert($msg, $msgType);
				?>
				<input type="text" name="username" class="input-block-level" placeholder="Username">
				<input type="password" name="password" class="input-block-level" placeholder="Password">
				<input type="password" name="cpassword" class="input-block-level" placeholder="Confirm Password">
				<button class="btn btn-large btn-success" type="submit">Create Admin</button>
			</form>
		</div> <!-- /container -->
		<!-- Le javascript
		================================================== -->
		<script src="../js/jquery-1.8.3.min.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
