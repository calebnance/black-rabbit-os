<?php
include('master.php');

if (Access::notLoggedIn()) {
	header('Location: index.php?msg=7');
	exit();
} else {
	FileHelper::checksession();
}

$pageTitle = 'My Modules for Black Rabbit Joomla Component Creator | Free | Joomla 2.5 & Joomla 3.0';
$pageActive = 'modules';
$pageActiveBreadcrumb = '<li class="active">My Modules</li>';

$database = new Database(HOST, DBNAME, DBUSER, DBPASS);
$uid = $_SESSION['uid'];
$userModules = $database->select('br_modules', '*', 'uid="'.$uid.'" AND midparent="0"', 'object'); // grab parents first
$userModulesCount = count($userModules);
$textModules = $userModulesCount > 1 || $userModulesCount == 0 ? 'modules' : 'module';

include('template/header.php');

$msg = '';
if (isset($_REQUEST['msg'])){
	switch($_REQUEST['msg']) {
		case '1':
			$msg = 'Please complete membership before you can continue with the module creator!';
			break;
		case '2':
			$msg = 'File can not be found, or you do not have access to this file!';
			break;
		default:
			$msg = 'Something went wrong...';
			break;
	}
}
?>
<div id="section-container">
	<div class="container">
		<div class="row">
			<div class="span12">
				<?php
				Msg::alert($msg, 'error');
				?>
				<h1><i class="icon-paper-clip"></i> My Modules</h1>
				<?php if (Access::paid()): ?>
					<p class="lead">You have <?php echo $userModulesCount . ' ' . $textModules; ?> in your work area!</p>
				<?php endif; ?>
			</div><!-- /.span12 -->
		</div><!-- /.row -->
		<div class="row">
			<?php
			if (Access::paid()):
			?>
			<div id="modules-list" class="span12">
				<p>
					<a href="dashboard.php" class="btn pull-left"><i class="icon icon-chevron-left"></i> Back to Dashboard</a>
					<a href="module.php" class="btn btn-success pull-right"><i class="icon icon-white icon-plus"></i> Create Module</a>
				</p>
				<p class="clearfix"></p>
				<?php if ($userModules): ?>
					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th width="25">#</th>
								<th>Name</th>
								<th width="75">Version</th>
								<th width="50"><center><img src="images/joomla-logo-small.png" /></center></th>
								<th width="75"><center><img src="images/black-rabbit.png" height="23" width="23" /></center></th>
								<th width="75">Filesize</th>
								<th width="180"></th>
							</tr>
						</thead>
						<tbody>
						<?php
						$m = 1;
						foreach($userModules as $userModule):
							// grab all components under parent
							$userModuleHistory = $database->select('br_modules', '*', 'uid="'.$uid.'" AND midparent="'.$userModule->id.'"', 'object');
							if ($userModuleHistory):
								$modCount	= count($userModuleHistory) - 1;
								$userModule	= $userModuleHistory[$modCount];
							endif;
							$filesize			= FileHelper::formatBytes($userModule->filesize);
							// safe guard the parent id, always stay with the parent
							$midparent		= $userModule->midparent == 0 ? $userModule->id : $userModule->midparent;
							$jlabel			= $userModule->jversion == '2.5.0' ? 'label-j25' : 'label-j30';
							?>
							<tr>
								<td align="right"><?php echo $m; ?></td>
								<td><?php echo $userModule->m_name; ?></td>
								<td style="text-align: right;"><?php echo $userModule->version; ?></td>
								<td><center><div class="label <?php echo $jlabel; ?>">J! <?php echo $userModule->jversion; ?></div></center></td>
								<td><center><?php echo $userModule->brversion; ?></center></td>
								<td><?php echo $filesize; ?></td>
								<td>
									<div class="btn-group modules-manager">
										<button action="edit" mid="<?php echo $userModule->id; ?>" pid="<?php echo $midparent; ?>" class="btn btn-small"><i class="icon icon-edit"></i> Edit</button>
										<button action="download" mid="<?php echo $userModule->id; ?>" class="btn btn-small"><i class="icon icon-download-alt"></i> Download</button>
									</div><!-- /btn-group -->
									<form id="module-manager-form" style="margin: 0; padding: 0;"></form>
								</td>
							</tr>
							<?php
							$m++;
						endforeach;
						?>
						</tbody>
					</table>
				<?php endif; ?>
			</div><!-- /#modules-list -->
			<?php
			else:
				if ($_SESSION['emailv']):
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
