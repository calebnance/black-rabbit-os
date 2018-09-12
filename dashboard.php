<?php
include('master.php');

if(Access::notLoggedIn()) {
	header('Location: index.php?msg=7');
	exit();
} else {
	FileHelper::checksession();
}

$greetings = array("Hello", "Welcome", "Happy " . date("l"));
$greeting  = $greetings[rand(0,2)];
$greeting .= " " . $_SESSION['fname'];

$pageTitle = 'My Dashboard for Black Rabbit Joomla Component Creator | Free | Joomla 2.5 & Joomla 3.0';
$pageActive = 'dashboard';
$pageActiveBreadcrumb = '<li class="active">My Dashboard</li>';

$database = new Database(HOST, DBNAME, DBUSER, DBPASS);

// Components and Modules and such from DB
$uid				= $_SESSION['uid'];
$userInfo			= $database->select('br_users', '*', 'id="'.$uid.'"', 'object'); // grab user info

$userComponents		= $database->select('br_components', '*', 'uid="'.$uid.'" AND cidparent="0"', 'object'); // grab parents first
$userAllComponents	= $database->select('br_components', '*', 'uid="'.$uid.'"', 'object');

$userModules		= $database->select('br_modules', '*', 'uid="'.$uid.'" AND midparent="0"', 'object'); // grab parents first
$userAllModules		= $database->select('br_modules', '*', 'uid="'.$uid.'"', 'object');

// Components
$filesizetotal = 0;
$componentversionstotal = 0;
if(is_array($userAllComponents)):
	foreach($userAllComponents as $userAllComponent):
		$filesizetotal += $userAllComponent->filesize;
		$componentversionstotal += 1;
	endforeach;
	$filesizetotal = FileHelper::formatBytes($filesizetotal);
endif;
$userComponentsCount= count($userComponents);
$textComponents 	= $userComponentsCount > 1 || $userComponentsCount == 0 ? 'components' : 'component';

// Modules
$filesizetotalmod = 0;
$moduleversionstotal = 0;
if(is_array($userAllModules)):
	foreach($userAllModules as $userAllModule):
		$filesizetotalmod 		+= (int) $userAllModule->filesize;
		$moduleversionstotal 	+= 1;
	endforeach;
	$filesizetotalmod = FileHelper::formatBytes($filesizetotalmod);
endif;
$userModulesCount	= count($userModules);
$textModules		= $userModulesCount > 1 || $userModulesCount == 0 ? 'modules' : 'module';

include('template/header.php');
?>
<div id="section-container">
	<div class="container">
		<div class="row">
			<div class="span12">
				<h1><?php echo $greeting; ?>!</h1>
				<?php if(Access::paid()): ?>
					<p class="lead">You have <?php echo $userComponentsCount . ' ' . $textComponents; ?>
					<?php if($userModulesCount): ?>
						<?php echo ' and ' . $userModulesCount . ' ' . $textModules; ?>
					<?php endif; ?>
					in your work area!</p>
				<?php endif; ?>
			</div><!-- /.span12 -->
		</div><!-- /.row -->

		<div class="row">
			<?php
			if(Access::paid()):
			?>
			<div class="span6">
				<div class="well">
					<h3>Components</h3>
					<p>Total space used: <span class="label label-info"><?php echo $filesizetotal; ?></span></p>
					<p>Total components created: <span class="label label-info"><?php echo $componentversionstotal; ?></span></p>
					<p>&nbsp;</p>
					<h3>Modules</h3>
					<p>Total space used: <span class="label label-info"><?php echo $filesizetotalmod; ?></span></p>
					<p>Total modules created: <span class="label label-info"><?php echo $moduleversionstotal; ?></span></p>
					<p>&nbsp;</p>
					<a href="components.php" class="btn btn-large pull-left" style="margin: 0 10px 10px 0;"><i class="icon-cogs"></i> Go to Components Manager</a>
					<a href="modules.php" class="btn btn-large pull-left"><i class="icon-paper-clip"></i> Go to Modules Manager</a>
					<div class="clearfix"></div>
				</div><!-- /.well -->
			</div><!-- /.span6 -->
			<div class="span6">
				<div class="well">
					<h3>User Information</h3>
					<?php
					$date_validated = strtotime($userInfo[0]->date_validated);
					$date_paid = strtotime($userInfo[0]->date_paid);
					$date_validated = date('m-d-Y h:i:sa', $date_validated);
					$date_paid = date('m-d-Y h:i:sa', $date_paid);
					?>
					<div class="alert alert-success"><i class="icon icon-envelope"></i> E-mail validated: <?php echo $date_validated; ?></div>
					<div class="alert alert-success"><i class="icon icon-credit-card"></i> Payment made: <?php echo $date_paid; ?></div>
					<div class="alert alert-success"><i class="icon icon-thumbs-up"></i> Full membership! No renewal needed...Ever</div>
					<div class="alert alert-success"><i class="icon icon-bolt"></i> The ads on this site are removed as well!</div>
				</div><!-- /.well -->
			</div><!-- /.span6 -->
			<?php
			else:
				if($_SESSION['emailv']):
				?>
				<div class="span12">
					<div class="well center">
						<h3>Complete Membership...</h3>
						<form action="<?php echo PAYPAL_URL; ?>" method="post" target="_top">
							<input type="hidden" name="cmd" value="_s-xclick">
							<input type="hidden" name="hosted_button_id" value="<?php echo PAYPAL_BTN_ID; ?>">
							<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
							<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
						</form>
						<p class="lead">You can still create components, they just won't be saved.</p>
						<p class="alert alert-error">NOTICE: Once you have completed the Paypal process, please let the redirect back to this site happen!</p>
					</div><!-- /.well -->
				</div><!-- /.span12 -->
				<?php
				else:
				?>
				<div class="span12">
					<div class="alert alert-error">
						<p><strong>Oh Snap!</strong> Looks like you have yet to validate your e-mail... check your spam folder if you have yet to see your validate notification e-mail. Then just click the link and be on your way to creating components!</p>
					</div><!-- /.alert -->
				</div><!-- /.span12 -->
				<?php
				endif;
			endif;
			?>
		</div><!-- /.row -->
	</div><!-- /.container -->
</div><!-- /#section-container -->
<?php
include('template/footer.php');
