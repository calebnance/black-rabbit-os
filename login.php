<?php
include('master.php');

$pageTitle = 'Login for Black Rabbit Joomla Component Creator | Free | Joomla 2.5 & Joomla 3.0';
$pageActive = 'login';
$pageActiveBreadcrumb = '<li class="active">Login</li>';

$msg = '';

// lets do some checking
if (empty($_POST['email']) || empty($_POST['password'])):
	if (isset($_POST['email']) || isset($_POST['password'])):
		$msg = 'Make sure you fill in your e-mail and password.';
	endif;
else:
	$post = $_POST;
	$email = $post['email'];
	$pass = $post['password'];

	// database
	$database = new Database(HOST, DBNAME, DBUSER, DBPASS);
	$user_info = $database->select('br_users', '*', 'email="'.$email.'"');

	if ($user_info):
		$user_pass = $user_info[0]['password'];
		if ($user_pass === md5($pass)):
			FileHelper::startsession($user_info);
			header('location: dashboard.php');
			exit();
		else:
			$msg = 'Password did not match.';
		endif;
	else:
		$msg = 'E-mail was not found..';
	endif;
endif;

include('template/header.php');
?>
<div id="section-container">
	<div class="container">
		<div class="row">
			<div class="span12">
				<?php
				Msg::alert($msg, 'error');
				?>
				<h1><?php echo $brtext->__('LOGIN'); ?></h1>
				<p class="lead">and be able to manage/edit/download all your components created!</p>
			</div><!-- /.span12 -->
		</div><!-- /.row -->
		<div class="row">
			<div class="span6">
				<div class="well">
					<?php
					if (Access::loggedIn()) {
					?>
						<h3><?php echo $_SESSION['fname'] . ' ' . $_SESSION['lname']; ?></h3>
						<a href="logout.php" class="btn btn-info login"><i class="icon icon-off icon-white"></i> <?php echo $brtext->__('LOGOUT'); ?></a>
					<?php
					} else {
					?>
						<h3>Already A Member</h3>
						<form class="form-horizontal"  action="login.php" method="post">
							<div class="control-group">
								<input type="text" name="email" placeholder="Email">
							</div>
							<div class="control-group">
								<input type="password" name="password" placeholder="Password">
							</div>
							<div class="control-group">
								<button type="submit" class="btn btn-info"><?php echo $brtext->__('LOGIN'); ?></button>
							</div>
						</form>
					<?php
					}
					?>
					<br /><br />
				</div><!-- /.well -->
			</div><!-- /.span6 -->
			<?php
			if (Access::notLoggedIn()) {
			?>
				<div class="span6">
					<div class="well">
						<h3>Sign Up</h3>
						<p class="lead">Don't have an account yet? Sign up to become a member.</p>
						<ul>
							<li>Components created are saved</li>
							<li>Edit a saved component option</li>
							<li>Download past components (versions) that you have created</li>
						</ul>
						<p><a href="sign-up.php" class="btn btn-success">Sign-up</a></p>
					</div><!-- /.well -->
				</div><!-- /.span6 -->
			<?php
			}
			?>
		</div><!-- /.row -->
	</div><!-- /.container -->
</div><!-- /#section-container -->
<?php
include('template/footer.php');
