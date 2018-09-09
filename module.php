<?php
	include('master.php');

	// Session check
	session_start();
	// store session data
	if(!isset($_SESSION['loggedin'])):
		header('Location: index.php?msg=7');
		exit();
	else:
		FileHelper::checksession();
	endif;

	// DB Connect
	$database = new Database(HOST, DBNAME, DBUSER, DBPASS);

	// Set user ID
	$uid = $_SESSION['uid'];

	// If the module is being downloaded
	if(isset($_POST['task']) && $_POST['task'] == 'mdownload'):
		$downloadModule = $database->select('br_modules', '*', 'uid="'.$uid.'" AND id="'.$_POST['mid'].'"', 'object');
		if($downloadModule):
			$downloadModule = $downloadModule[0];
			$packagename = 'mod_' . $downloadModule->m_file_name . '-v.' . $downloadModule->version . '-joomla_' . $downloadModule->jversion . '.zip';
			$filecreatedpath	= 'users' . DS . $uid . DS . 'modules' . DS . $downloadModule->id . DS . $packagename;
			if(file_exists($filecreatedpath)):
				header('Location: ' . $filecreatedpath);
				exit();
			else:
				header('Location: modules.php?msg=2');
				exit();
			endif;
		else:
			header('Location: modules.php?msg=2');
			exit();
		endif;
		exit();
	endif;

	// Call header
	$pageTitle = 'My Modules for Black Rabbit Joomla Component Creator | Free | Joomla 2.5 & Joomla 3.0';
	$pageActive = 'modules';
	$pageActiveBreadcrumb = '<li class="active">Create Module</li>';

	// Modules and such
	$userModules = $database->select('br_modules', '*', 'uid="'.$uid.'" AND midparent="0"', 'object'); // grab parents first
	$userModulesCount = count($userModules);
	$textModules = $userModulesCount > 1 || $userModulesCount == 0 ? 'modules' : 'module';

	include('template/header.php');

	// MSG handling
	$msg = '';
	$error_type = 'error';

	// Default vals
	$uMJVersion 	= '2.5.0';
	$uMJVersion25	= $uMJVersion30 = '';
	$pid			= 0;
	$uMName 		= $uMFileName = $uMAuthorURL = $uMVersion = $uMDesc = '';
	$uMAuthorEmail	= $_SESSION['email'];
	$uMAuthor 		= $_SESSION['fname'] . ' ' . $_SESSION['lname'];
	$uMCopyright	= 'Copyright (C) ' . date('Y') . '. All Rights Reserved';
	$uMLicense		= 'GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html';

	// If the module is being updated.
	if(isset($_POST['mid'])):
		$editModule 	= $database->select('br_modules', '*', 'uid="'.$uid.'" AND id="'.$_POST['mid'].'"', 'object'); // get module to update!
		$editModule 	= $editModule[0];
		// Set values
		$pid			= $_POST['pid'];
		$uMJVersion		= $editModule->jversion;
		$uMName			= $editModule->m_name;
		$uMFileName		= $editModule->m_file_name;
		$uMAuthorURL	= $editModule->author_url;
		$uMVersion		= $editModule->version;
		$uMDesc			= $editModule->description;
		$uMAuthorEmail	= $editModule->author_email;
		$uMAuthor		= $editModule->author;
		$uMCopyright	= $editModule->copyright;
		$uMLicense		= $editModule->license;
	endif;

	// Make sure Joomla version is right
	switch($uMJVersion){
		case '2.5.0':
			$uMJVersion25 = 'btn-warning active label-j25';
			break;
		case '3.0':
			$uMJVersion30 = 'btn-warning active label-j30';
			$uMJVersion25 = '';
			break;
		default:
			$uMJVersion25 = 'btn-warning active label-j25';
			break;
	}
?>
			<div id="section-container">
				<div class="container">
					<div class="row">
						<div class="span12">
							<?php if($msg): ?>
							<br />
							<div class="alert alert-<?php echo $error_type; ?>">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<?php echo $msg; ?>
							</div>
							<?php endif; ?>

							<h1><i class="icon-paper-clip"></i> Create Module</h1>
						</div><!-- /.span12 -->
						<?php
						if($_SESSION['paid'] == 1):
						?>
						<div id="modules-list">
							<div class="span12">
								<h4>Joomla <?php echo $brtext->__('VERSION'); ?></h4>
								<div class="btn-group" id="jversionselect" data-toggle="buttons-radio">
									<button type="button" value="2.5.0" class="btn <?php echo $uMJVersion25; ?>">Joomla 2.5</button>
									<button type="button" value="3.0" class="btn <?php echo $uMJVersion30; ?>">Joomla 3.0</button>
								</div><!-- /joomla select -->
								<br /><br />
							</div><!-- /.span12 -->
							<form id="module-mainform" action="module-create.php" method="post" class="form-horizontal" enctype="multipart/form-data">
								<input type="hidden" name="jversion" id="jversion" value="<?php echo $uMJVersion; ?>">
								<input type="hidden" name="brversion" id="brversion" value="<?php echo $br_version; ?>">
								<input type="hidden" name="midparent" id="midparent" value="<?php echo $pid; ?>">
								<div class="span6">
									<div class="control-group">
										<label class="control-label"><?php echo $brtext->__('MODNAME'); ?></label>
										<div class="controls">
											<input type="text" name="name" id="name" placeholder="Hello World" class="required inline" value="<?php echo $uMName; ?>">
											<div class="status inline"><i class="icon-asterisk"></i></div>
										</div><!-- /.controls -->
									</div><!-- /.control-group -->

									<div class="control-group">
										<label class="control-label"><?php echo $brtext->__('MODFILE'); ?> <span class="pophelp" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="This will be the package name and how it will be installed. All spaces will be replaced, should not have spaces." title="Tip"><i class="icon icon-info-sign"></i></span></label>
										<div class="controls">
											<div class="input-prepend">
												<span class="add-on">mod_</span>
												<input name="filename" id="filename" type="text" placeholder="helloworld" class="required" value="<?php echo $uMFileName; ?>">
											</div><!-- /.input-prepend -->
											<div class="status inline"><i class="icon-asterisk"></i></div>
										</div><!-- /.controls -->
									</div><!-- /.control-group -->

									<div class="control-group">
										<label class="control-label"><?php echo $brtext->__('MODAUTHOR'); ?></label>
										<div class="controls">
											<input type="text" name="author" id="author" placeholder="Hello World" class="required inline" value="<?php echo $uMAuthor; ?>">
											<div class="status inline"><i class="icon-asterisk"></i></div>
										</div><!-- /.controls -->
									</div><!-- /.control-group -->

									<div class="control-group">
										<label class="control-label"><?php echo $brtext->__('MODAUTHOREMAIL'); ?></label>
										<div class="controls">
											<input name="author_email" id="author_email" type="text" class="required inline" value="<?php echo $uMAuthorEmail; ?>">
											<div class="status inline"><i class="icon-asterisk"></i></div>
										</div><!-- /.controls -->
									</div><!-- /.control-group -->

									<div class="control-group">
										<label class="control-label"><?php echo $brtext->__('MODAUTHORURL'); ?></label>
										<div class="controls">
											<div class="input-prepend">
												<span class="add-on">http://</span>
												<input name="author_url" id="author_url" type="text" placeholder="www.codelydia.com" class="required inline" value="<?php echo $uMAuthorURL; ?>">
											</div><!-- /.input-prepend -->
											<div class="status inline"><i class="icon-asterisk"></i></div>
										</div><!-- /.controls -->
									</div><!-- /.control-group -->

									<div class="control-group">
										<label class="control-label"><?php echo $brtext->__('VERSION'); ?></label>
										<div class="controls">
											<input type="text" name="version" id="version" placeholder="0.0.1" class="required inline" value="<?php echo $uMVersion; ?>">
											<div class="status inline"><i class="icon-asterisk"></i></div>
										</div><!-- /.controls -->
									</div><!-- /.control-group -->
								</div><!-- /.span6 -->
								<div class="span6">
									<div class="control-group">
										<label class="control-label"><?php echo $brtext->__('MODDESCRIPTION'); ?></label>
										<div class="controls">
											<textarea name="description" id="description" rows="3" placeholder="Module description here.." class="required inline"><?php echo $uMDesc; ?></textarea>
											<div class="status inline"><i class="icon-asterisk"></i></div>
										</div><!-- /.controls -->
									</div><!-- /.control-group -->

									<div class="control-group">
										<label class="control-label"><?php echo $brtext->__('MODCOPYRIGHT'); ?></label>
										<div class="controls">
											<textarea name="copyright" id="copyright" rows="3" placeholder="Copyright.." class="inline"><?php echo $uMCopyright; ?></textarea>
											<div class="status inline"></div>
										</div><!-- /.controls -->
									</div><!-- /.control-group -->

									<div class="control-group">
										<label class="control-label"><?php echo $brtext->__('MODLICENSE'); ?></label>
										<div class="controls">
											<textarea name="license" id="license" rows="3" placeholder="License.." class="inline"><?php echo $uMLicense; ?></textarea>
											<div class="status inline"></div>
										</div><!-- /.controls -->
									</div><!-- /.control-group -->

								</div><!-- /.span6 -->

								<div class="span12">
									<div class="well well-small center">
										<button type="submit" class="btn btn-large btn-primary">Create Module</button>
									</div>
								</div><!-- /.span12 -->

							</form>
						</div><!-- /#modules-list -->
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
?>
