<?php
	// Include database and config
	include('../master.php');

	// First time? Set the admin up.
	$database = new Database(HOST, DBNAME, DBUSER, DBPASS);
	$adminCheck = $database->select('br_admins', '*', '1=1', 'object');
	if(!$adminCheck):
		header('location:welcome.php');
		exit();
	endif;

	// Default messages
	$msg = '';
	$msgclass = 'error';

	$post = $_POST;

	if($post):
		if($post['username'] && $post['password']):
			$result = $database->select('br_admins', '*', 'username="'.$post['username'].'" AND password="'.md5($post['password']).'"', 'object');
			if($result):
				$loggedin_date = date("Y-m-d H:i:s");
				$user_update = array(
					'last_login' => $loggedin_date
				);
				$database->update('br_admins', $user_update, 'username="'.$post['username'].'"');
				session_start();
				$_SESSION['logged'] = 1;
				header('location:index.php');
				exit();
			else:
				$msg = 'Wrong username or password!';
			endif;
			// Close connection
			mysql_close($connect);
		else:
			$msg = 'Fill in all fields!';
			$msgclass = 'warning';
		endif;
	endif;

	// Check for messages
	if($_REQUEST['msg']):
		switch($_REQUEST['msg']) {
			case '3':
				$msg = 'You can now login!';
				$msgclass = 'success';
				break;
			case '2':
			default:
				$msg = 'Something went wrong...';
				$msgclass = 'error';
				break;
		}
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
			body { padding-top: 40px; padding-bottom: 40px; background-color: #f5f5f5;}
			.row { margin: 30px 0 0 0; }
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
			<div class="row">
				<form class="form-signin" method="post" action="login.php">
					<h2 class="form-signin-heading">Admin Sign In</h2>
					<?php if($msg): ?>
					<div class="alert alert-<?php echo $msgclass; ?>"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $msg; ?></div>
					<?php endif; ?>
					<input type="text" name="username" class="input-block-level" placeholder="Username">
					<input type="password" name="password" class="input-block-level" placeholder="Password">
					<button class="btn btn-large btn-success" type="submit">Sign in</button>
				</form>
			</div>
		</div> <!-- /container -->
		<!-- Le javascript
		================================================== -->
		<script src="../js/jquery-1.8.3.min.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
