<?php
/*********
 * Black Rabbit Component Creator
 * by Caleb Nance
 */

	// Display errors on localhost
	$whitelist = array('locathost');
	if(!in_array($_SERVER['SERVER_NAME'], $whitelist)){
		// this is localhost!
		ini_set('display_errors', 1);
		error_reporting(E_ALL);
		// error_reporting(E_ALL ^ E_NOTICE);
	}

	include('master.php');

	// session check
	// session_start();
	// store session data
	if(isset($_SESSION['loggedin'])):
		FileHelper::checksession();
	endif;

	// Call header
	$pageTitle = 'Black Rabbit Joomla Component Creator | Free | Joomla 2.5 & Joomla 3.0';
	$pageActive = 'home';

	include('template/header.php');

	$database = new Database(HOST, DBNAME, DBUSER, DBPASS);
	$rows = $database->select('br_packages', '*', '1=1');

	// default parent id
	$pid = 0;

	// default vars for edit
	$uCName = $uCFileName = $uCVersion = $uCJVersion25 = $uCJVersion30 = $uCDescription = $uCAuthor = $uCEmail = $uCURL = $uCCateory = $uCTags = $uCDatabaseNo = $uCDatabaseYes = $uCUserCreated = $uCDateCreated = $uCMainVSing = $uCFields = '';
	$uCCopyright	= 'Copyright (C) '.date('Y').'. All Rights Reserved';
	$uCLicense		= 'GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html';
	$uCJVersion		= '2.5.0';
	$uCJVersion25	= 'btn-warning active label-j25';

	$uCImageH = '500';
	$uCImageW = '600';
	$uCImageThumbHW = '100';

	$uCDatabase		= 1;
	$uCDatabaseYes	= 'btn-warning active';

	// lets check for a post and if they are still logged in
	if($_POST && $_SESSION['loggedin'] && $_SESSION['paid']):
		$cid	= $_POST['cid'];
		$pid	= $_POST['pid'];
		$uid	= $_SESSION['uid'];
		$userComponent		= $database->select('br_components', '*', 'uid="'.$uid.'" AND id="'.$cid.'"', 'object');
		$userComponentViews	= $database->select('br_components_views', '*', 'cid="'.$cid.'"', 'object');
		$uCFields			= unserialize($userComponentViews[0]->fields);
		//print_r($uCFields);
		$uCName			= $userComponent[0]->c_name;
		$uCFileName		= $userComponentViews[0]->plural;
		$uCMainVSing	= $userComponentViews[0]->singular;
		$uCVersion		= $userComponent[0]->version;
		$uCJVersion		= $userComponent[0]->jversion;
		$uCDescription	= $userComponent[0]->description;
		$uCCopyright	= $userComponent[0]->copyright;
		$uCLicense		= $userComponent[0]->license;
		$uCAuthor		= $userComponent[0]->author;
		$uCEmail		= $userComponent[0]->a_email;
		$uCURL			= $userComponent[0]->a_url;

		$uCCateory		= $userComponent[0]->category_view ? 'checked' : '';
		$uCTags			= $userComponent[0]->tags_view ? 'checked' : '';

		$uCDatabase		= $userComponent[0]->use_database;

		$uCImageH		= $userComponent[0]->imageheight == 0 ? 500 : $userComponent[0]->imageheight;
		$uCImageW		= $userComponent[0]->imagewidth == 0 ? 600 : $userComponent[0]->imagewidth;
		$uCImageThumbHW	= $userComponent[0]->imagethumbhw == 0 ? 100 : $userComponent[0]->imagethumbhw;

		$uCUserCreated	= $userComponent[0]->use_usercreated ? 'checked' : '';
		$uCDateCreated	= $userComponent[0]->use_datecreated ? 'checked' : '';

		switch($uCDatabase){
			case 0:
				$uCDatabaseNo	= 'btn-warning active';
				$uCDatabaseYes	= '';
				break;
			case 1:
			default:
				$uCDatabaseYes	= 'btn-warning active';
				$uCDatabaseNo	= '';
				break;
		}

		switch($uCJVersion){
			case '2.5.0':
				$uCJVersion32 = '';
				$uCJVersion30 = '';
				$uCJVersion25 = 'btn-warning active label-j25';
				break;
			case '3.0':
				$uCJVersion32 = '';
				$uCJVersion30 = 'btn-warning active label-j30';
				$uCJVersion25 = '';
				break;
			case '3.2':
				$uCJVersion32 = 'btn-warning active label-j32';
				$uCJVersion30 = '';
				$uCJVersion25 = '';
				break;
			default:
				$uCJVersion25 = 'btn-warning active label-j25';
				break;
		}
	endif;

	$packages = array();
	$packageslinescount = 0;
	$packagesfilescount = 0;
	foreach($rows as $row):
		$packages[] = $row;
		$packageslinescount = $packageslinescount + $row['lines_created'];
		$packagesfilescount = $packagesfilescount + $row['files_created'];
	endforeach;

	// Total time saved
	//$totaltimesaved = round(($packageslinescount / 4) / 60);

	$t 			= $packageslinescount * 15;
	$f			= ":";
	$hours		= floor($t/3600);
	$minutes	= ($t/60) % 60;
	$seconds	= $t % 60;
	$hours				= number_format($hours);
	$packagescount		= number_format(count($packages));
	$packageslinescount	= number_format($packageslinescount);
	$packagesfilescount	= number_format($packagesfilescount);
	$totaltimesaved		= sprintf("%04d%s%02d%s%02d", $hours, $f, $minutes, $f, $seconds);
	$totaltimesaved		= $hours . ':' . $minutes . ':' . $seconds;

	$msg = '';
	$error_type = 'error';
	if($_REQUEST['msg'] == 1):
		$msg = 'Please fill in all required fields, and make sure javascript is enabled on your browser!';
	elseif($_REQUEST['msg'] == 2):
		$error_type = 'success';
		$msg = 'Success! Check your e-mail for the validation code.';
	elseif($_REQUEST['msg'] == 3):
		$msg = 'Can not validate e-mail code.';
	elseif($_REQUEST['msg'] == 4):
		$error_type = 'warning';
		$msg = 'E-mail has already been validated. You can now sign-in!';
	elseif($_REQUEST['msg'] == 5):
		$error_type = 'success';
		$msg = 'You can now sign-in!';
	elseif($_REQUEST['msg'] == 6):
		$error_type = 'success';
		$msg = 'You are now logged out.';
	elseif($_REQUEST['msg'] == 7):
		$error_type = 'warning';
		$msg = 'Please <a href="login.php">login</a> to view that page.';
	elseif($_REQUEST['msg'] == 8):
		$error_type = 'warning';
		$msg = 'Session ended due to inactivity.';
	endif;

?>
			<!-- HERO -->
			<div id="hero">
				<div class="container">
					<?php if($msg): ?>
					<br />
					<div class="alert alert-<?php echo $error_type; ?>">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<?php echo $msg; ?>
					</div>
					<?php endif; ?>
					<!-- Hero title -->
					<div class="hero-title">
						<div class="logo-wrapper">
							<a href="index.php"><div class="logo"></div></a>
						</div>
						<h1><?php echo $brtext->__('BRCC'); ?></h1>
						<p class="lead"><?php echo $brtext->__('TIRED'); ?></p>
						<h2 style="text-align: center;">
							<div class="free-tool">100% Free Tool<br /><small style="color: #EFEFEF;">The paid membership is for managing the components that were created.</small></div>
						</h2>
					</div>

					<!-- Hero boxes -->
					<div class="row boxes">
						<div class="span4">
							<div class="box">
								<div class="box-icon">
									<i class="icon-file-alt"></i>
								</div>
								<div class="box-title">
									<h2><a href="#start">Create</a></h2>
								</div>
								<div class="box-text">
									<p>Creating a Joomla Extension has never been easier or faster! Fill in the form below..</p>
									<a class="btn-black" href="#start"><?php echo $brtext->__('GETSTARTED'); ?></a>
								</div>
							</div>
						</div>
						<div class="span4">
							<div class="box">
								<div class="box-icon">
									<i class="icon-download-alt"></i>
								</div>
								<div class="box-title">
									<h2><a href="dashboard.php">Download</a></h2>
								</div>
								<div class="box-text">
									<p>...once it has been created, download your fresh Joomla Component...</p>
									<a class="btn-black" href="dashboard.php">Manager</a>
								</div>
							</div>
						</div>
						<div class="span4">
							<div class="box">
								<div class="box-icon">
									<i class="icon-thumbs-up"></i>
								</div>
								<div class="box-title">
									<h2><a href="faqs.php">Install</a></h2>
								</div>
								<div class="box-text">
									<p>..and log into your Joomla 2.5/3.0 site, then quickly and easily install the .zip package.</p>
									<a class="btn-black" href="faqs.php">How To</a>
								</div>
							</div>
						</div>
					</div><!-- /.row -->
				</div><!-- /.container -->
			</div><!-- /#hero -->

			<!-- COMPONENT CREATOR SECTION -->
			<div id="section-container">
				<div class="container">
					<a href="#" id="start"></a><!-- Start Anchor -->
					<form id="mainform" action="create.php" method="post" class="form-horizontal" enctype="multipart/form-data">
						<fieldset>
							<h2><?php echo $brtext->__('COMPCREATEFORM'); ?></h2>
							<h3><?php echo $brtext->__('VERSION'); ?></h3>
							<div class="btn-group" id="jversionselect" data-toggle="buttons-radio">
								<button type="button" value="2.5.0" class="btn <?php echo $uCJVersion25; ?>">Joomla 2.5</button>
								<button type="button" value="3.0" class="btn <?php echo $uCJVersion30; ?>">Joomla 3.0</button>
								<button type="button" value="3.2" class="btn <?php echo $uCJVersion32; ?>">Joomla 3.2</button>
							</div><!-- /joomla select -->
							<br />
							<h3><?php echo $brtext->__('PROGRESS'); ?></h3>
							<div id="scroller-anchor"></div>
							<div id="scroller" style="margin-top: 10px;" class="progress progress-striped active ">
								<div class="bar" style="width: 0%;"></div>
							</div><!-- /progress bar -->
							<ul class="nav nav-tabs" id="myTab">
								<li class="active"><a href="#install"><?php echo $brtext->__('INSTALLDETAILS'); ?> <span><span class="badge badge-important">6</span></span></a></li>
								<li><a href="#authorinfo"><?php echo $brtext->__('AUTHOR'); ?> <span><span class="badge badge-important">3</span></span></a></li>
								<li><a href="#views"><?php echo $brtext->__('VIEWS'); ?> <span><span class="badge badge-important">2</span></span></a></li>
								<li><a href="#tables"><?php echo $brtext->__('TABLES'); ?> <span><span class="badge badge-important">1</span></span></a></li>
								<li><a href="#imagesTab"><?php echo $brtext->__('IMAGES'); ?></a></li>
							</ul><!-- /tab nav -->
							<div class="tab-content">
								<div class="tab-pane active" id="install">
									<h3><?php echo $brtext->__('INSTALLDETAILS'); ?></h3>
									<div class="control-group">
										<label class="control-label" for="componentname"><?php echo $brtext->__('COMPNAME'); ?></label>
										<div class="controls">
											<input type="text" name="componentname" id="componentname" placeholder="Hello World" class="required inline" value="<?php echo $uCName; ?>">
											<div class="status inline"></div>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="filename"><?php echo $brtext->__('COMPFILE'); ?> <span class="pophelp" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Try to keep this to one plural word. (this will be the main view)" title="Tip"><i class="icon icon-info-sign"></i></span></label>
										<div class="controls">
											<div class="input-prepend">
												<span class="add-on">com_</span>
												<input name="filename" id="filename" type="text" placeholder="helloworlds" class="required" value="<?php echo $uCFileName; ?>">
												<div class="status"></div>
											</div>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="version"><?php echo $brtext->__('VERSION'); ?> <span class="pophelp" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Only accepts numbers and decimals. (ex. 0.0.1)" title="Tip"><i class="icon icon-info-sign"></i></span></label>
										<div class="controls">
											<input type="text" name="version" id="version" placeholder="0.0.1" class="required integer" value="<?php echo $uCVersion; ?>">
											<div class="status"></div>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="description"><?php echo $brtext->__('DESC'); ?></label>
										<div class="controls">
											<textarea name="description" id="description" rows="3" placeholder="Component description here.." class="required"><?php echo $uCDescription; ?></textarea>
											<div class="status"></div>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="copyright"><?php echo $brtext->__('COPYRIGHT'); ?></label>
										<div class="controls">
											<textarea name="copyright" id="copyright" rows="3" class="required"><?php echo $uCCopyright; ?></textarea>
											<div class="status"></div>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="license"><?php echo $brtext->__('LICENSE'); ?></label>
										<div class="controls">
											<textarea name="license" id="license" rows="3" class="required"><?php echo $uCLicense; ?></textarea>
											<div class="status"></div>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="authorinfo">
									<h3><?php echo $brtext->__('AUTHORINFO'); ?></h3>
									<div class="control-group">
										<label class="control-label" for="author"><?php echo $brtext->__('AUTHOR'); ?></label>
										<div class="controls">
											<input type="text" name="author" id="author" placeholder="Your Name" class="required" value="<?php echo $uCAuthor; ?>">
											<div class="status"></div>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="authoremail"><?php echo $brtext->__('AUTHOREMAIL'); ?> <span class="pophelp" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Only valid e-mail addresses are accepted. (ex. test@gmail.com)" title="Tip"><i class="icon icon-info-sign"></i></span></label>
										<div class="controls">
											<input type="text" name="authoremail" id="authoremail" placeholder="Your E-Mail" class="required" value="<?php echo $uCEmail; ?>">
											<div class="status"></div>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="authorurl"><?php echo $brtext->__('AUTHORURL'); ?> <span class="pophelp" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Only valid BASE urls accepted. Nothing after the .com/.org/.net etc.. (ex. www.codelydia.com or http://www.codelydia.com" title="Tip"><i class="icon icon-info-sign"></i></span></label>
										<div class="controls">
											<div class="input-prepend">
												<span class="add-on">http://</span>
												<input name="authorurl" id="authorurl" type="text" placeholder="www.codelydia.com" class="required" value="<?php echo $uCURL; ?>">
												<div class="status"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="views">
									<h3><?php echo $brtext->__('VIEWS'); ?></h3>
									<div class="control-group">
										<label class="control-label" for="includeCat"><?php echo $brtext->__('ADDCATVIEW'); ?> <span class="pophelp" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="By checking this box, you can add categories to the views (in the tables tab)." title="Tip"><i class="icon icon-info-sign"></i></span></label>
										<div class="controls">
											<input type="checkbox" id="includeCat" name="includeCat" value="1" <?php echo $uCCateory; ?>>
										</div><!-- /.controls -->
									</div><!-- /control-group -->

									<div id="viewsMsg"></div><!-- /#viewsMsg -->

									<div id="componentviews" class="control-group">
										<label class="control-label" for="mainview"><?php echo $brtext->__('MAINVIEW'); ?></label>
										<div class="controls">
											<input type="text" name="view[]" id="mainview" value="" class="uneditable-input view required" readonly="readonly">
											<div class="status"></div>
											<label><?php echo $brtext->__('SINGLEVIEWVERB'); ?></label>
											<input type="text" name="view-single[]" id="mainview-single" value="<?php echo $uCMainVSing; ?>" class="input required">
											<div class="status"></div>
										</div><!-- /.controls -->
									</div><!-- /#componentviews -->
									<?php
									if($_POST && $_SESSION['loggedin'] && $_SESSION['paid'] && $userComponentViews):
										for($i=1; $i < count($userComponentViews); $i++):
											$userComponentView = $userComponentViews[$i];
										?>
										<div class="control-group" id="viewwrap-<?php echo $i; ?>">
											<label class="control-label">View</label>
											<div class="controls">
												<input type="text" class="view input required" name="view[]" value="<?php echo $userComponentView->plural; ?>" />
												<div class="status"></div>

												<label><?php echo $brtext->__('SINGLEVIEWVERB'); ?></label>
												<input type="text" class="input required" name="view-single[]" value="<?php echo $userComponentView->singular; ?>" />
												<div class="status"></div>

												<div id="removeview-<?php echo $i; ?>" class="btn btn-small btn-danger removeView"><i class="icon icon-remove icon-white"></i></div>
											</div><!-- /.controls -->
										</div><!-- /.control-group -->
										<?php
										endfor;
									endif;
									?>
									<div id="addviewparent" class="control-group">
										<div class="controls">
											<a id="addView" class="btn btn-warning"><i class="icon-plus-sign icon-white"></i> <?php echo $brtext->__('ADDVIEW'); ?></a>
										</div><!-- /.controls -->
									</div><!-- /#addviewparent -->
								</div><!-- /#views -->
								<div class="tab-pane" id="tables">
									<h3><?php echo $brtext->__('TABLES'); ?></h3>
									<div class="row-fluid">
										<div class="span4">
											<?php echo $brtext->__('USEDATABASE'); ?>
											<div class="btn-group" id="usedatabasegroup" data-toggle="buttons-radio">
												<button type="button" value="1" class="btn <?php echo $uCDatabaseYes; ?>"><?php echo $brtext->__('YES'); ?></button>
												<button type="button" value="0" class="btn <?php echo $uCDatabaseNo; ?>"><?php echo $brtext->__('NO'); ?></button>
											</div><!-- /joomla select -->
										</div><!-- /span4 -->
										<div class="span8">
											<?php echo $brtext->__('NEEDHELP'); ?>
											<div class="btn btn-mini" id="needhelp"><?php echo $brtext->__('SURE'); ?></div>
											<div class="hide" id="needhelptext"><?php echo $brtext->__('SURE'); ?></div>
											<div class="hide" id="needhelptext-return"><?php echo $brtext->__('GOTITTHANKS'); ?></div>
										</div><!-- /span8 -->
									</div>
									<div class="row-fluid" id="showhelpfortables" class="hide">
										<div class="span12">
											<hr>
											<div class="alert alert-success">
												<h4><?php echo $brtext->__('ALITTLEMORE'); ?>...</h4>
												<br />
												<ul>
													<li><?php echo $brtext->__('ALITTLEMOREONE'); ?></li>
													<li><?php echo $brtext->__('ALITTLEMORETWO'); ?></li>
													<li><?php echo $brtext->__('ALITTLEMORETHREE'); ?></li>
													<li><?php echo $brtext->__('ALITTLEMOREFOUR'); ?></li>
												</ul>
												<p><?php echo $brtext->__('ALITTLEMOREFIVE'); ?> <a href="faqs.php" target="_blank"><?php echo $brtext->__('FAQS'); ?></a> <?php echo $brtext->__('PAGE'); ?>.</p>
												<p><?php echo $brtext->__('ALITTLEMORESIX'); ?></p>
											</div><!-- /alert -->
										</div><!-- /span12 -->
									</div><!-- /row-fluid -->
									<hr />

									<p><strong>ID field</strong> created automatically for each table!</p>
									<p><span class="label label-success">New</span> Joomla! item "checked out" now supported!</p>

									<div class="well well-preset">
										<h4>Add Some Standard Fields <small id="show-standard"><i class="icon-chevron-down"></i> Show</small></h4>
										<div class="add-some-standard hide">
											<label class="checkbox inline">
												<input type="checkbox" name="use-usermodified" id="use-usermodified" value="1" <?php echo $uCUserCreated; ?>> <?php echo $brtext->__('USERCREATEDMODIFIED'); ?>
											</label>
											<label class="checkbox inline">
												<input type="checkbox" name="use-datemodified" id="use-datemodified" value="1" <?php echo $uCDateCreated; ?>> <?php echo $brtext->__('DATECREATEDMODIFIED'); ?>
											</label>
											<h4>Image Upload Preferences</h4>
											<div class="control-group">
												<label class="control-label"><?php echo $brtext->__('IMAGEHEIGHT'); ?></label>
												<div class="controls">
													<div class="input-append">
														<input type="text" class="span1" name="image-height" id="image-height" value="<?php echo $uCImageH; ?>">
														<span class="add-on">px</span>
													</div><!-- /.input-append -->
												</div><!-- /.controls -->
											</div><!-- /.control-group -->
											<div class="control-group">
												<label class="control-label"><?php echo $brtext->__('IMAGEWIDTH'); ?></label>
												<div class="controls">
													<div class="input-append">
														<input type="text" class="span1" name="image-width" id="image-width" value="<?php echo $uCImageW; ?>">
														<span class="add-on">px</span>
													</div><!-- /.input-append -->
												</div><!-- /.controls -->
											</div><!-- /.control-group -->
											<div class="control-group">
												<label class="control-label"><?php echo $brtext->__('IMAGETHUMBHEIGHTWIDTH'); ?></label>
												<div class="controls">
													<div class="input-append">
														<input type="text" class="span1" name="image-thumb-height-width" id="image-thumb-height-width" value="<?php echo $uCImageThumbHW; ?>">
														<span class="add-on">px</span>
													</div><!-- /.input-append -->
												</div><!-- /.controls -->
											</div><!-- /.control-group -->
										</div><!-- /.add-some-standard -->
									</div><!-- /.well-preset -->
									<hr />
									<div class="accordion" id="accordion">
										<div class="accordion-group">
											<div class="accordion-heading">
												<a id="mainview-header" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#mainview-accord"><?php echo $brtext->__('MAINVIEW'); ?></a>
												<input type="hidden" name="mainviewtable" id="mainviewtable" value="<?php echo $uCFileName; ?>" >
											</div>
											<div id="mainview-accord" class="accordion-body collapse in">
												<div class="accordion-inner">
													<table id="main-view-table" class="table table-bordered table-hover sortable">
														<tbody>
															<tr>
																<td>#</td>
																<td><?php echo $brtext->__('FIELDNAME'); ?></td>
																<td><?php echo $brtext->__('DEFAULTVALUES'); ?></td>
																<td></td>
																<td></td>
															</tr>
															<?php
															if($uCFields):
																for($f=0; $f < count($uCFields['name']); $f++):
																	$findex = $f + 1;
																	$fshow = $frequired = '';
																	if(is_array($uCFields['show'])):
																		if(array_key_exists($f, $uCFields['show'])):
																			$fshow = 'checked';
																		endif;
																	endif;
																	if(is_array($uCFields['required'])):
																		if(array_key_exists($f, $uCFields['required'])):
																			$frequired = 'checked';
																		endif;
																	endif;
																	?>
																	<tr>
																		<td><?php echo $findex; ?></td>
																		<td>
																			<div style="margin: 0 0 5px 0;">
																				<input type="text" name="main-view-table-field[]" id="main-view-table-field" class="input required input-block-level" placeholder="Title" value="<?php echo $uCFields['name'][$f]; ?>">
																			</div>
																			<select name="main-view-table-fieldtype[]" id="main-view-table-fieldtype" class="input input-block-level">
																				<optgroup label="Standard Fields">
																					<option value="calendar" <?php if($uCFields['type'][$f] == 'calendar'){ echo 'selected'; }; ?>><?php echo $brtext->__('CALENDAR'); ?></option>
																					<option value="category" <?php if($uCFields['type'][$f] == 'category'){ echo 'selected'; }; ?>><?php echo $brtext->__('CATEGORY'); ?></option>
																					<option value="checkbox" <?php if($uCFields['type'][$f] == 'checkbox'){ echo 'selected'; }; ?>><?php echo $brtext->__('CHECKBOX'); ?></option>
																					<option value="editor" <?php if($uCFields['type'][$f] == 'editor'){ echo 'selected'; }; ?>><?php echo $brtext->__('CONTENTEDITOR'); ?></option>
																					<option value="file" <?php if($uCFields['type'][$f] == 'file'){ echo 'selected'; }; ?>><?php echo $brtext->__('FILEIMAGEUPLOAD'); ?></option>
																					<option value="hidden" <?php if($uCFields['type'][$f] == 'hidden'){ echo 'selected'; }; ?>><?php echo $brtext->__('HIDDEN'); ?></option>
																					<option value="numbers" <?php if($uCFields['type'][$f] == 'numbers'){ echo 'selected'; }; ?>><?php echo $brtext->__('NUMBERS'); ?></option>
																					<option value="integer" <?php if($uCFields['type'][$f] == 'integer'){ echo 'selected'; }; ?>><?php echo $brtext->__('INTEGER'); ?></option>
																					<option value="list" <?php if($uCFields['type'][$f] == 'list'){ echo 'selected'; }; ?>><?php echo $brtext->__('LIST'); ?></option>
																					<option value="radio" <?php if($uCFields['type'][$f] == 'radio'){ echo 'selected'; }; ?>><?php echo $brtext->__('RADIO'); ?></option>
																					<option value="text" <?php if($uCFields['type'][$f] == 'text'){ echo 'selected'; }; ?>><?php echo $brtext->__('TEXTBOX'); ?></option>
																					<option value="textarea" <?php if($uCFields['type'][$f] == 'textarea'){ echo 'selected'; }; ?>><?php echo $brtext->__('TEXTAREA'); ?></option>
																				</optgroup>
																			</select>
																		</td>
																		<td><textarea rows="2" name="main-view-table-default[]" id="main-view-table-default" class="input-block-level"><?php echo $uCFields['default'][$f]; ?></textarea></td>
																		<td>
																			<label class="checkbox">
																				<input type="checkbox" name="main-view-table-show[<?php echo $f; ?>]" id="main-view-table-show" value="1" <?php echo $fshow; ?>> <?php echo $brtext->__('SHOWONMANAGER'); ?>
																			</label>
																			<label class="checkbox">
																				<input type="checkbox" name="main-view-table-required[<?php echo $f; ?>]" id="main-view-table-required" value="1" <?php echo $frequired; ?>> <?php echo $brtext->__('REQUIRED'); ?>
																			</label>
																		</td>
																		<td>
																			<div class="btn btn-small moveField">
																				<i class="icon icon-move"></i>
																			</div>
																			<div id="remove-<?php echo $findex; ?>" class="btn btn-small btn-danger removeField">
																				<i class="icon icon-remove icon-white"></i>
																			</div>
																		</td>
																	</tr>
																	<?php
																endfor;
															else:
															?>
															<tr>
																<td>1</td>
																<td>
																	<div style="margin: 0 0 5px 0;">
																		<input type="text" name="main-view-table-field[]" id="main-view-table-field" class="input required input-block-level" placeholder="Title">
																	</div>
																	<select name="main-view-table-fieldtype[]" id="main-view-table-fieldtype" class="input input-block-level">
																		<optgroup label="Standard Fields">
																			<option value="calendar"><?php echo $brtext->__('CALENDAR'); ?></option>
																			<option value="category"><?php echo $brtext->__('CATEGORY'); ?></option>
																			<option value="checkbox"><?php echo $brtext->__('CHECKBOX'); ?></option>
																			<option value="editor"><?php echo $brtext->__('CONTENTEDITOR'); ?></option>
																			<option value="file"><?php echo $brtext->__('FILEIMAGEUPLOAD'); ?></option>
																			<option value="hidden"><?php echo $brtext->__('HIDDEN'); ?></option>
																			<option value="numbers"><?php echo $brtext->__('NUMBERS'); ?></option>
																			<option value="integer"><?php echo $brtext->__('INTEGER'); ?></option>
																			<option value="list"><?php echo $brtext->__('LIST'); ?></option>
																			<option value="radio"><?php echo $brtext->__('RADIO'); ?></option>
																			<option value="text" selected><?php echo $brtext->__('TEXTBOX'); ?></option>
																			<option value="textarea"><?php echo $brtext->__('TEXTAREA'); ?></option>
																		</optgroup>
																	</select>
																</td>
																<td><textarea rows="2" name="main-view-table-default[]" id="main-view-table-default" class="input-block-level"></textarea></td>
																<td>
																	<label class="checkbox">
																		<input type="checkbox" name="main-view-table-show[]" id="main-view-table-show" value="1"> <?php echo $fshow; ?> <?php echo $brtext->__('SHOWONMANAGER'); ?>
																	</label>
																	<label class="checkbox">
																		<input type="checkbox" name="main-view-table-required[]" id="main-view-table-required" value="1"> <?php echo $brtext->__('REQUIRED'); ?>
																	</label>
																</td>
																<td>
																	<div class="btn btn-small moveField">
																		<i class="icon icon-move"></i>
																	</div>
																	<div id="remove-1" class="btn btn-small btn-danger removeField">
																		<i class="icon icon-remove icon-white"></i>
																	</div>
																</td>
															</tr>
															<?php
															endif;
															?>
														</tbody>
													</table><!-- /#main-view-table -->
													<div rel="main-view-table" class="control-group">
														<div class="pull-right">
															<div class="btn btn-warning addField"><i class="icon-plus-sign icon-white"></i> <?php echo $brtext->__('ADDFIELD'); ?></div>
														</div>
														<div class="clearfix"></div>
													</div><!-- /control-group -->
												</div><!-- /accordion-inner -->
											</div><!-- /mainview -->
										</div><!-- /accordion-group -->
										<?php
										if($_POST && $_SESSION['loggedin'] && $_SESSION['paid'] && $userComponentViews):
											for($v=1; $v < count($userComponentViews); $v++):
												$userComponentView	= $userComponentViews[$v];
												$uCFields			= unserialize($userComponentView->fields);
										?>
											<div class="accordion-group">
												<div class="accordion-heading">
													<a id="view-<?php echo $v; ?>-header" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#view<?php echo $v; ?>"><?php echo $userComponentView->plural; ?></a>
													<input type="hidden" name="view-<?php echo $v; ?>-table" id="view-<?php echo $v; ?>-table" value="<?php echo $userComponentView->plural; ?>" >
												</div>
												<div id="view<?php echo $v; ?>" class="accordion-body collapse">
													<div class="accordion-inner">
														<table id="view-<?php echo $v; ?>" class="table table-bordered table-hover sortable">
															<tr>
																<td>#</td>
																<td><?php echo $brtext->__('FIELDNAME'); ?></td>
																<td><?php echo $brtext->__('DEFAULTVALUES'); ?></td>
																<td></td>
																<td></td>
															</tr>
															<?php
															if($uCFields):
																for($f=0; $f < count($uCFields['name']); $f++):
																	$findex = $f + 1;
																	$fshow = $frequired = '';
																	if(is_array($uCFields['show'])):
																		if(array_key_exists($f, $uCFields['show'])):
																			$fshow = 'checked';
																		endif;
																	endif;
																	if(is_array($uCFields['required'])):
																		if(array_key_exists($f, $uCFields['required'])):
																			$frequired = 'checked';
																		endif;
																	endif;
																	?>
																	<tr>
																		<td><?php echo $findex; ?></td>
																		<td>
																			<div style="margin: 0 0 5px 0;">
																				<input type="text" name="view-<?php echo $v; ?>-field[]" id="view-<?php echo $v; ?>-field" class="input required input-block-level" placeholder="Title" value="<?php echo $uCFields['name'][$f]; ?>">
																			</div>
																			<select name="view-<?php echo $v; ?>-fieldtype[]" id="view-<?php echo $v; ?>-fieldtype" class="input input-block-level">
																				<optgroup label="Standard Fields">
																					<option value="calendar" <?php if($uCFields['type'][$f] == 'calendar'){ echo 'selected'; }; ?>><?php echo $brtext->__('CALENDAR'); ?></option>
																					<option value="category" <?php if($uCFields['type'][$f] == 'category'){ echo 'selected'; }; ?>><?php echo $brtext->__('CATEGORY'); ?></option>
																					<option value="checkbox" <?php if($uCFields['type'][$f] == 'checkbox'){ echo 'selected'; }; ?>><?php echo $brtext->__('CHECKBOX'); ?></option>
																					<option value="editor" <?php if($uCFields['type'][$f] == 'editor'){ echo 'selected'; }; ?>><?php echo $brtext->__('CONTENTEDITOR'); ?></option>
																					<option value="file" <?php if($uCFields['type'][$f] == 'file'){ echo 'selected'; }; ?>><?php echo $brtext->__('FILEIMAGEUPLOAD'); ?></option>
																					<option value="hidden" <?php if($uCFields['type'][$f] == 'hidden'){ echo 'selected'; }; ?>><?php echo $brtext->__('HIDDEN'); ?></option>
																					<option value="numbers" <?php if($uCFields['type'][$f] == 'numbers'){ echo 'selected'; }; ?>><?php echo $brtext->__('NUMBERS'); ?></option>
																					<option value="integer" <?php if($uCFields['type'][$f] == 'integer'){ echo 'selected'; }; ?>><?php echo $brtext->__('INTEGER'); ?></option>
																					<option value="list" <?php if($uCFields['type'][$f] == 'list'){ echo 'selected'; }; ?>><?php echo $brtext->__('LIST'); ?></option>
																					<option value="radio" <?php if($uCFields['type'][$f] == 'radio'){ echo 'selected'; }; ?>><?php echo $brtext->__('RADIO'); ?></option>
																					<option value="text" <?php if($uCFields['type'][$f] == 'text'){ echo 'selected'; }; ?>><?php echo $brtext->__('TEXTBOX'); ?></option>
																					<option value="textarea" <?php if($uCFields['type'][$f] == 'textarea'){ echo 'selected'; }; ?>><?php echo $brtext->__('TEXTAREA'); ?></option>
																				</optgroup>
																			</select>
																		</td>
																		<td><textarea rows="2" name="view-<?php echo $v; ?>-default[]" id="view-<?php echo $v; ?>-default" class="input-block-level"><?php echo $uCFields['default'][$f]; ?></textarea></td>
																		<td>
																			<label class="checkbox">
																				<input type="checkbox" name="view-<?php echo $v; ?>-show[<?php echo $f; ?>]" id="view-<?php echo $v; ?>-show" value="1" <?php echo $fshow; ?>> <?php echo $brtext->__('SHOWONMANAGER'); ?>
																			</label>
																			<label class="checkbox">
																				<input type="checkbox" name="view-<?php echo $v; ?>-required[<?php echo $f; ?>]" id="view-<?php echo $v; ?>-required" value="1" <?php echo $frequired; ?>> Required
																			</label>
																		</td>
																		<td><div id="remove-<?php echo $findex; ?>" class="btn btn-small btn-danger removeField"><i class="icon icon-remove icon-white"></i></div></td>
																	</tr>
																	<?php
																endfor;
															endif;
															?>
														</table><!-- /#main-view-table -->
														<div rel="view-<?php echo $v; ?>" class="control-group">
															<div class="pull-right">
																<div class="btn btn-warning addField"><i class="icon-plus-sign icon-white"></i> <?php echo $brtext->__('ADDFIELD'); ?></div>
															</div>
															<div class="clearfix"></div>
														</div><!-- /control-group -->
													</div><!-- /accordion-inner -->
												</div><!-- /mainview -->
											</div><!-- /accordion-group -->
										<?php
											endfor;
										endif;
										?>
										<div id="accordionAdd"></div>
									</div><!-- /accordion -->
								</div><!-- /tables pane -->
						<input type="hidden" name="task" value="create">
						<input type="hidden" name="jversion" id="jversion" value="<?php echo $uCJVersion; ?>">
						<input type="hidden" name="brversion" id="brversion" value="<?php echo $br_version; ?>">
						<input type="hidden" name="usedatabase" id="usedatabase" value="<?php echo $uCDatabase; ?>">
						<input type="hidden" name="cidparent" id="cidparent" value="<?php echo $pid; ?>">
						<div id="addHiddenImages"></div>
					</form><!-- /mainform -->

								<div class="tab-pane" id="imagesTab">
									<form id="imagesForm" method="post" action="images.php" enctype="multipart/form-data">
										<h3><?php echo $brtext->__('IMAGES'); ?></h3>
										<p><?php echo $brtext->__('BRANDYOURCOMPONENT'); ?></p>
										<div class="imageProgress">
											<div class="imageBar"></div>
											<div class="imagePercent">0%</div>
										</div><!-- /imageProgress -->
										<div id="imageViews">
											<div class="control-group">
												<label class="control-label" id="mainview-image-label" for="mainview-image">Mainview Image</label>
												<div class="controls">
													<input class="imageTab" type="file" name="images[]" />
													<input type="hidden" id="imagesName0" name="imagesname[]" value="mainview" />
												</div><!-- /.controls -->
											</div><!-- /.control-group -->

											<?php
											if($_POST && $_SESSION['loggedin'] && $_SESSION['paid'] && $userComponentViews):
												for($v=1; $v < count($userComponentViews); $v++):
												$viewCount = $v + 1;
											?>
												<div class="control-group">
													<label class="control-label" id="view-<?php echo $viewCount; ?>-image-label">Image</label>
													<div class="controls">
														<input class="imageTab" type="file" name="images[]" />
														<input type="hidden" id="imagesName<?php echo $viewCount; ?>" name="imagesname[]" value="" />
													</div><!-- /.controls -->
												</div><!-- /.control-group -->
											<?php
												endfor;
											endif;
											?>

											<div id="imageAdd"></div>
										</div><!-- /imageViews -->
										<input class="btn btn-error" type="submit" value="Upload Image(s) First!">
										<div id="imageReturn"></div>
									</form><!-- /imagesForm -->
								</div><!-- /imagesTab pane -->

								<div class="well">
									<input class="btn btn-primary" id="createcomponent" type="submit" name="submit" value="<?php echo $brtext->__('CREATECOMPONENT'); ?>">
								</div><!-- /well -->

							</div><!-- /tab content -->
						</fieldset>
				</div><!-- /.container -->
			</div><!-- /.section-container -->

			<!-- WHATS NEW SECTION -->
			<div id="section-container">
				<div class="container">
					<div class="row recent-title">
						<h2 class="span12"><i class="icon-star "></i> What's New <p class="lead">Check the full list on the <a href="release-history.php">Release History</a> page.</p></h2>
					</div><!-- /.row -->
					<div class="row recent-posts">
						<div class="span12">
							<article>
								<div class="entry-content">
									<ul>
										<li>Image upload within a view now works better, and the <strong>image resizing</strong> when uploaded works a lot better, added with v.1.1.4</li>
										<li>Members now have access to the structure <strong>Module Creator</strong> along with the module manager, added with v.1.1.3</li>
										<li>Image upload functionality is now built in, added with v.1.1.1</li>
										<li>User Created/Modified and Date Created/Modified now added for each item in a view, added with v.1.1.0</li>
									</ul>
									<a href="release-history.php" class="btn pull-right"><i class="icon-time" style="color: #000;"></i> Release History</a>
									<div class="clearfix"></div>
								</div>
							</article>
						</div>
					</div><!-- /.row -->
					<?php if(!$_SESSION['loggedin'] || !$_SESSION['paid']){ ?>
					<span class="hidden-phone">
						<br /><br />
						<div class="row recent-posts">
							<div class="span4 ad">
								<img src="http://placehold.it/250">
								<br>
								Place Ad Here
							</div><!-- /.span4 -->
							<div class="span4 ad">
								<img src="http://placehold.it/250">
								<br>
								Place Ad Here
							</div><!-- /.span4 -->
							<div class="span4 ad">
								<img src="http://placehold.it/250">
								<br>
								Place Ad Here
							</div><!-- /.span4 -->
						</div><!-- /.row -->
						<div class="row recent-posts">
							<div class="span12">
								<br />
								<a href="sign-up.php" class="btn btn-primary pull-right"><i class="icon icon-white icon-remove"></i> No Ads?</a>
								<div class="clearfix"></div>
							</div><!-- /.span12 -->
						</div><!-- /.row -->
					</span><!-- /.hidden-phone -->
					<?php } ?>
				</div><!-- /.container -->
			</div><!-- /.section-container -->

			<!-- DOWNLOAD HELLOWORLD SECTION -->
			<div id="section-container" class="video-bg">
				<div class="container">
					<div class="row recent-title">
						<h2 class="span12"><?php echo $brtext->__('COMPONENTDEV'); ?> <p class="lead center"><?php echo $brtext->__('HELLOWORLDDESC'); ?></p></h2>
					</div><!-- /.row -->
					<div class="row">
						<div class="span6">
							<h2><i class="icon-beaker"></i> Hello World</h2>
							<div class="box-video-list">
								<h4><?php echo $brtext->__('DOWNLOADEX'); ?> com_helloworlds (v.<?php echo $br_version; ?>)</h4>
								<form action="create.php" method="post" class="form-horizontal pull-left" style="margin: 0 10px 10px 0;">
									<button type="submit" class="btn btn-primary label-j25"><i class="icon icon-download icon-white"></i> Joomla 2.5</button>
									<input type="hidden" name="version" value="<?php echo $br_version; ?>" />
									<input type="hidden" name="jversion" value="2.5" />
									<input type="hidden" name="task" value="download" />
								</form>
								<form action="create.php" method="post" class="form-horizontal pull-left" style="margin: 0 10px 10px 0;">
									<button type="submit" class="btn btn-primary label-j30"><i class="icon icon-download icon-white"></i> Joomla 3.0</button>
									<input type="hidden" name="version" value="<?php echo $br_version; ?>" />
									<input type="hidden" name="jversion" value="3.0" />
									<input type="hidden" name="task" value="download" />
								</form>
								<form action="create.php" method="post" class="form-horizontal pull-left" style="margin: 0 10px 10px 0;">
									<button type="submit" class="btn btn-primary label-j32"><i class="icon icon-download icon-white"></i> Joomla 3.2</button>
									<input type="hidden" name="version" value="<?php echo $br_version; ?>" />
									<input type="hidden" name="jversion" value="3.2" />
									<input type="hidden" name="task" value="download" />
								</form>
								<div class="clearfix"></div>
							</div><!-- /.box-video-list -->
						</div><!-- /.span6 -->
						<div class="span6">
							<h2><i class="icon-puzzle-piece"></i> All Field Types</h2>
							<div class="box-video-list">
								<h4><?php echo $brtext->__('DOWNLOADEX'); ?> com_allfields (v.<?php echo $br_version; ?>)</h4>
								<form action="create.php" method="post" class="form-horizontal pull-left" style="margin: 0 10px 10px 0;">
									<button type="submit" class="btn btn-primary label-j25"><i class="icon icon-download icon-white"></i> Joomla 2.5</button>
									<input type="hidden" name="version" value="<?php echo $br_version; ?>" />
									<input type="hidden" name="jversion" value="2.5" />
									<input type="hidden" name="task" value="download_allfields" />
								</form>
								<form action="create.php" method="post" class="form-horizontal pull-left" style="margin: 0 10px 10px 0;">
									<button type="submit" class="btn btn-primary label-j30"><i class="icon icon-download icon-white"></i> Joomla 3.0</button>
									<input type="hidden" name="version" value="<?php echo $br_version; ?>" />
									<input type="hidden" name="jversion" value="3.0" />
									<input type="hidden" name="task" value="download_allfields" />
								</form>
								<form action="create.php" method="post" class="form-horizontal pull-left" style="margin: 0 10px 10px 0;">
									<button type="submit" class="btn btn-primary label-j32"><i class="icon icon-download icon-white"></i> Joomla 3.2</button>
									<input type="hidden" name="version" value="<?php echo $br_version; ?>" />
									<input type="hidden" name="jversion" value="3.2" />
									<input type="hidden" name="task" value="download_allfields" />
								</form>
								<div class="clearfix"></div>
							</div><!-- /.box-video-list -->
						</div><!-- /.span6 -->
					</div><!-- /.row -->
					<div class="row">
						<div class="span12">
							<h2>Why Membership?</h2>
							<ul class="well why-membership">
								<li><i class="icon icon-ok"></i> Save all components and modules created!</li>
								<li><i class="icon icon-remove"></i> No Ads</li>
								<li><i class="icon icon-thumbs-up"></i> It's a one time fee... that's it, seriously.</li>
								<li><i class="icon icon-pencil"></i> So <a href="sign-up.php">sign up</a></li>
								<li>
									<span class="btn" id="showVideo"><i class="icon-film"></i> Show Video</span>
									<div id="membershipVideo" class="hide">
										<iframe width="100%" height="400" src="http://www.youtube.com/embed/MtuBpjKm06c" frameborder="0" allowfullscreen></iframe>
									</div><!-- /#membershipVideo -->
								</li>
							</ul>
						</div><!-- /.span12 -->
					</div><!-- /.row -->
				</div><!-- /.container -->
			</div><!-- /.video-bg -->

			<!-- FUN STATS SECTION -->
			<div id="section-container">
				<div class="container">
					<div class="row recent-title">
						<h2 class="span12"><?php echo $brtext->__('FUNSTATS'); ?>* <p class="lead center"><?php echo $brtext->__('FUNSTATSHISTORY'); ?>...</p></h2>
					</div><!-- /.row -->
					<div class="row recent-posts">
						<div class="span3">
							<article>
								<div class="entry-content">
									<h5><i class="icon-code black"></i> <?php echo $brtext->__('TOTALLINESCREATED'); ?></h5>
									<div class="numbers center"><?php echo $packageslinescount; ?></div>
								</div>
							</article>
						</div>

						<div class="span3">
							<article>
								<div class="entry-content">
									<h5><i class="icon-list-ol black"></i> <?php echo $brtext->__('TOTALCOMPSCREATED'); ?></h5>
									<div class="numbers center"><?php echo $packagescount; ?></div>
								</div>
							</article>
						</div>

						<div class="span3">
							<article>
								<div class="entry-content">
									<h5><i class="icon-file-alt black"></i> <?php echo $brtext->__('TOTALFILESCREATED'); ?></h5>
									<div class="numbers center"><?php echo $packagesfilescount; ?></div>
								</div>
							</article>
						</div>

						<div class="span3">
							<article>
								<div class="entry-content">
									<h5><i class="icon-time black"></i> <?php echo $brtext->__('TOTALTIMESCREATED'); ?> **</h5>
									<div class="numbers center"><?php echo $totaltimesaved; ?></div>
								</div>
							</article>
						</div>
					</div><!-- /.row -->
					<div class="row">
						<div class="span12">
							<br />
							<p><small>* <?php echo $brtext->__('STATSSINCE'); ?> Feb. 21, 2013</small> | <small>** 15 <?php echo $brtext->__('SECONDSALLOC'); ?></small></p>
						</div><!-- /span12 -->
					</div><!-- /.row -->
				</div><!-- /.container -->
			</div><!-- /.section-container -->
<?php
	// Call footer
	include('template/footer.php');
?>
