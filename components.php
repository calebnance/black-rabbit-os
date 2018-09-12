<?php
include('master.php');

if(Access::notLoggedIn()) {
	header('Location: index.php?msg=7');
	exit();
} else {
	FileHelper::checksession();
}

$pageTitle = 'My Components for Black Rabbit Joomla Component Creator | Free | Joomla 2.5 & Joomla 3.0';
$pageActive = 'components';
$pageActiveBreadcrumb = '<li class="active">My Components</li>';

$uid = $_SESSION['uid'];
$database = new Database(HOST, DBNAME, DBUSER, DBPASS);
$userComponents = $database->select('br_components', '*', 'uid="'.$uid.'" AND cidparent="0"', 'object'); // grab parents first
$userComponentsCount = count($userComponents);
$textComponents = $userComponentsCount > 1 || $userComponentsCount == 0 ? 'components' : 'component';

$msg = $msgType = '';

if(isset($_REQUEST['msg'])) {
	switch($_REQUEST['msg']) {
		case "1":
		default:
			$msg = 'Something went wrong... no idea what happened really, please let me know if this keeps happening.';
			$msgType = 'error';
			break;
		case "2":
			$msg = 'You do not have access to this component, or it could be found? If this keeps happening, please let me know!';
			$msgType = 'error';
			break;
		case "3":
			$msg = 'Your component has been deleted!';
			break;
		case "4":
			$msg = 'CONGRATS! You are now a member and all components will be saved as long as you are logged in.';
			break;
		case "5":
			$msg = 'Looks like something went wrong, transaction didn\'t go through, please try again...';
			$msgType = 'error';
			break;
	}
}

include('template/header.php');
?>
<div id="section-container">
	<div class="container">
		<div class="row">
			<div class="span12">
				<?php
				Msg::alert($msg, $msgType);
				?>
				<h1><i class="icon-cogs"></i> My Components</h1>
				<?php
				if(Access::paid()) {
				?>
					<p class="lead">You have <?php echo $userComponentsCount . ' ' . $textComponents; ?> in your work area!</p>
				<?php
				}
				?>
			</div><!-- /.span12 -->
		</div><!-- /.row -->
		<div class="row">
			<?php
			if(Access::paid()):
			?>
			<div id="components-list" class="span12">
				<p>
					<a href="dashboard.php" class="btn pull-left"><i class="icon icon-chevron-left"></i> Back to Dashboard</a>
					<a href="index.php#start" class="btn btn-success pull-right"><i class="icon icon-white icon-plus"></i> Create Component</a>
				</p>
				<p class="clearfix"></p>
				<?php if($userComponents): ?>
					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th width="25">#</th>
								<th>Name</th>
								<th width="75">Version</th>
								<th width="50"><center><img src="images/joomla-logo-small.png" /></center></th>
								<th width="75"><center><img src="images/black-rabbit.png" height="23" width="23" /></center></th>
								<th width="250"></th>
							</tr>
						</thead>
						<tbody>
						<?php
						$c = 1;
						foreach($userComponents as $userComponent):
							$userComponentFirst = $userComponent;
							// grab all components under parent
							$userComponentHistory = $database->select('br_components', '*', 'uid="'.$uid.'" AND cidparent="'.$userComponent->id.'"', 'object');
							$date_created	= $userComponent->date_created;
							$date_modified	= '';
							if($userComponentHistory):
								$compCount 		= count($userComponentHistory) - 1;
								$userComponent	= $userComponentHistory[$compCount];
								$date_modified	= $userComponent->date_created;
								$date_modified	= date('m-d-Y h:ia', strtotime($date_modified));
							endif;
							$date_created	= date('m-d-Y h:ia', strtotime($date_created));
							$file_size		= FileHelper::formatBytes($userComponent->filesize);
							$views			= $database->select('br_components_views', '*', 'cid="'.$userComponent->id.'"', 'object');
							$views_count	= count($views);
							if($userComponent->category_view):
								$views_count += 1;
							endif;
							if($userComponent->tags_view):
								$views_count += 1;
							endif;
							switch($userComponent->jversion){
								case '3.2':
									$j_version = 'label-j32';
									$j_version_print = '3.2';
									break;
								case '3.0':
									$j_version = 'label-j30';
									$j_version_print = '3.0';
									break;
								case '2.5.0':
								default:
									$j_version = 'label-j25';
									$j_version_print = '2.5';
									break;
							}
							$lines_created	= number_format($userComponent->lines_created);
							$files_created	= number_format($userComponent->files_created);
							$t				= $userComponent->minutes_saved * 60;
							$f				= ":";
							$hours			= floor($t/3600);
							$minutes		= ($t/60) % 60;
							$seconds		= $t % 60;
							$hours			= number_format($hours);
							$time_saved		= sprintf("%02d%s%02d%s%02d", $hours, $f, $minutes, $f, $seconds);

							// safe guard the parent id, always stay with the parent
							$cidparent		= $userComponent->cidparent == 0 ? $userComponent->id : $userComponent->cidparent;
						?>
							<tr>
								<td><?php echo $c; ?></td>
								<td><?php echo $userComponent->c_name; ?></td>
								<td>v.<?php echo $userComponent->version; ?></td>
								<td><center><span class="label <?php echo $j_version; ?>">J! <?php echo $j_version_print; ?></span></center></td>
								<td>v.<?php echo $userComponent->brversion; ?></td>
								<td>
									<div class="btn-group">
										<button action="edit" cid="<?php echo $userComponent->id; ?>" pid="<?php echo $cidparent; ?>" class="btn btn-small"><i class="icon icon-edit"></i> Edit</button>
										<button action="download" cid="<?php echo $userComponent->id; ?>" class="btn btn-small"><i class="icon icon-download-alt"></i> Download</button>
										<button class="btn btn-small show-more" id="show-<?php echo $userComponent->id; ?>"><i class="icon icon-info-sign"></i> More</button>
									</div><!-- /btn-group -->
									<button action="delete" cid="<?php echo $cidparent; ?>" class="btn btn-danger btn-small"><i class="icon icon-white icon-trash"></i></button>
									<form style="margin: 0; padding: 0;" id="component-manager-form"></form>
									<div id="show-<?php echo $userComponent->id; ?>-more" class="hide">
										<br />
										<p><a class="btn btn-small" href="#modal-<?php echo $userComponent->id; ?>" data-toggle="modal"><i class="icon icon-book"></i> Show Full History</a></p>
										<div id="modal-<?php echo $userComponent->id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modal<?php echo $userComponent->id; ?>label" aria-hidden="true">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
												<h3 id="modal<?php echo $userComponent->id; ?>label">History - <?php echo $userComponentFirst->c_name; ?></h3>
											</div><!-- /.modal-header -->
											<div class="modal-body">
												<table class="table">
													<thead>
														<tr>
															<th>#</th>
															<th>Name</th>
															<th>Version</th>
															<th><center><img src="images/joomla-logo-small.png" /></center></th>
															<th><center><img src="images/black-rabbit.png" height="23" width="23" /></center></th>
															<th><center><i class="icon icon-download-alt"></i></center></th>
															<th></th>
														</tr>
														<tr>
															<td>1</td>
															<td><?php echo $userComponentFirst->c_name; ?></td>
															<td><?php echo $userComponentFirst->version; ?></td>
															<td><?php echo $userComponentFirst->jversion; ?></td>
															<td><?php echo $userComponentFirst->brversion; ?></td>
															<td id="download-<?php echo $userComponentFirst->id; ?>-1"><?php echo $userComponentFirst->downloadcount; ?></td>
															<td><button action="download" cid="<?php echo $userComponentFirst->id; ?>" update="download-<?php echo $userComponentFirst->id; ?>-1" class="btn btn-small"><i class="icon icon-download-alt"></i> Download</button></td>
														</tr>
														<?php
														$hcount = 2;
														foreach($userComponentHistory as $userComponentH):
														?>
														<tr>
															<td><?php echo $hcount; ?></td>
															<td><?php echo $userComponentH->c_name; ?></td>
															<td><?php echo $userComponentH->version; ?></td>
															<td><?php echo $userComponentH->jversion; ?></td>
															<td><?php echo $userComponentH->brversion; ?></td>
															<td id="download-<?php echo $userComponentH->id; ?>-<?php echo $hcount; ?>"><?php echo $userComponentH->downloadcount; ?></td>
															<td><button action="download" cid="<?php echo $userComponentH->id; ?>" update="download-<?php echo $userComponentH->id; ?>-<?php echo $hcount; ?>" class="btn btn-small"><i class="icon icon-download-alt"></i> Download</button></td>
														</tr>
														<?php
														$hcount++;
														endforeach;
														?>
													</thead>
												</table>
											</div><!-- /.modal-body -->
											<div class="modal-footer">
												<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
											</div><!-- /.modal-footer -->
										</div><!-- /#modal-<?php echo $userComponent->id; ?> -->
										<p><strong>Date Created:</strong> <?php echo $date_created; ?></p>
										<?php
										if($date_modified):
										?>
										<p><strong>Date Modified:</strong> <?php echo $date_modified; ?></p>
										<?php
										endif;

										if($userComponent->description):
										?>
											<p><strong>Description:</strong></p>
											<p><?php echo $userComponent->description; ?></p>
										<?php
										endif;

										if($views):
										?>
										<p><strong>Views (<?php echo $views_count; ?>)</strong></p>
										<?php
											if($userComponent->category_view):
											?>
											<p>
												categories<br />
												&not; category
											</p>
											<?php
											endif;

											if($userComponent->tags_view):
											?>
											<p>
												tags<br />
												&not; tag
											</p>
											<?php
											endif;

											foreach($views as $view):
												$view->fields = unserialize($view->fields);
											?>
											<p>
												<?php echo $view->plural; ?>
												<br />
												&not; <?php echo $view->singular; ?>
												<?php
												if($view->fields):
												?>
													<br />
													&not; &not;<?php echo ' total fields: <strong>' . count($view->fields['name']) . '</strong>'; ?>
												<?php
												endif;
												?>
											</p>
											<?php
											endforeach;
											?>
										<?php
										endif;
										?>
										<p><strong>Downloads:</strong> <?php echo $userComponent->downloadcount; ?></p>
										<p><strong>Time Saved:</strong> <?php echo $time_saved; ?></p>
										<p><strong>Lines Created:</strong> <?php echo $lines_created; ?></p>
										<p><strong>Files Created:</strong> <?php echo $files_created; ?></p>
										<hr />
									</div><!-- /.hide -->
								</td>
							</tr>
						<?php
							$c++;
						endforeach;
						?>
						</tbody>
					</table>
				<?php else: ?>
					<p>No components saved yet, why don't you change that..</p>
					<br /><br /><br />
				<?php endif; ?>
			</div><!-- /.span12 -->
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
