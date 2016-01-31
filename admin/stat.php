<?php
	// Include database and config
	include('../master.php');
	
	session_start();
	// store session data
	if(!isset($_SESSION['logged'])):
		header('location:login.php');
		exit();
	endif;
	
	// Database connect
	$database = new Database( HOST, DBNAME, DBUSER, DBPASS);
	
	// Get user
	//$adminCheck = mysql_fetch_row(mysql_query("SELECT * FROM br_admins"));
	
	// Set menu
	$activeCpanel = $activeStats = $activeHelloworld = $activeUsers = '';
	$activeStats = 'class="active"';
	
	// Get page ID
	if($_REQUEST['id']):
		$pageID = $_REQUEST['id'];
	else:
		header('location:stats.php');
	endif;
	
	// Set query for this page
	$package = $database->select('br_packages', '*', 'id="'.$pageID.'"', 'object');
	$package = $package[0];
	
    // Include header and menu
	include('template/header.php');
	include('template/menu.php');
	
	$datecreated = strtotime($package->date_created);
	$datefolder = date('Y-m-d', $datecreated);
	$datecreated_formatted = date('m-d-Y h:i:sa', $datecreated);
	$downloadpath = "..".DS."components".DS.$datefolder.DS.$package->package;
?>
			<div class="row-fluid">
				<div class="span12">
					<h3><?php echo $package->title; ?> (v.<?php echo $package->version; ?>)</h3>
					<p><span class="label label-success">Package</span> <?php echo $package->package; ?> <a class="btn btn-mini" href="<?php echo $downloadpath; ?>">Download</a></p>
					<p>By <?php echo $package->author; ?> - <a href="mailto:<?php echo $package->email; ?>"><?php echo $package->email; ?></a> - Website: <a href="http://<?php echo $package->website; ?>" target="_blank"><?php echo $package->website; ?></a></p>
					<p><span class="label label-info">Date Created:</span> <?php echo $datecreated_formatted; ?></p>
					<p><span class="label label-info">Description:</span> <?php echo $package->description; ?></p>
					<p><span class="label label-inverse">Filesize:</span> <?php echo $package->filesize; ?></p>
					<p><span class="label label-inverse">Joomla Version - <?php echo $package->jversion; ?></span> <span class="label label-inverse">Black Rabbit Version - <?php echo $package->brversion; ?></span> <span class="label label-warning">Lines Created: <?php echo $package->lines_created; ?></span> <span class="label label-warning">Files Created: <?php echo $package->files_created; ?></span></p>
				</div><!-- /.span12 -->
			</div><!-- /.row-fluid -->
<?php
	// Include footer
	include('template/footer.php');
?>