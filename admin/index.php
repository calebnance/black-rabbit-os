<?php
include('../master.php');

if (!isset($_SESSION['logged'])) {
	header('location:login.php');
	exit();
}

$database = new Database(HOST, DBNAME, DBUSER, DBPASS);

// Set menu
$activeCpanel = $activeStats = $activeHelloworld = $activeUsers = '';
$activeCpanel = 'class="active"';

// Grab helloworlds stats
$helloworlds = $database->select('br_helloworlds', '*', '1=1', 'object');
$helloworldsAll = array();
$downloadcountAll = 0;
foreach($helloworlds as $row) {
	$helloworldsAll[] = $row;
	$downloadcountAll = $downloadcountAll + $row->downloadcount;
}

// just for joomla 2.5
$helloworlds25Result = $database->select('br_helloworlds', '*', 'jversion ="2.5"', 'object');
$helloworlds25 = array();
$downloadcount25 = 0;

foreach($helloworlds25Result as $row) {
	$helloworlds25[] = $row;
	$downloadcount25 = $downloadcount25 + $row->downloadcount;
}

// just for joomla 3.0
$helloworlds30Result = $database->select('br_helloworlds', '*', 'jversion ="3.0"', 'object');
$helloworlds30 = array();
$downloadcount30 = 0;

foreach($helloworlds30Result as $row) {
	$helloworlds30[] = $row;
	$downloadcount30 = $downloadcount30 + $row->downloadcount;
}

// Grab creation stats
$packagesResult = $database->select('br_packages', '*', '1=1', 'object');
$packages = array();
$packageslinescount = 0;
$packagesfilescount = 0;

foreach($packagesResult as $row) {
	$packages[] = $row;
	$packageslinescount = $packageslinescount + $row->lines_created;
	$packagesfilescount = $packagesfilescount + $row->files_created;
}

// Grab all users
$usersResult = $database->select('br_users', '*', '1=1', 'object');
$users = array();
$users_paid	= 0;
$users_money = 0;
$users_validated = 0;

foreach($usersResult as $row) {
	if ($row->paypal_payment_status) {
		$users_paid = $users_paid + 1;
		$users_money = $users_money + (int) $row->paypal_payment_amount;
	}
	if ($row->email_validated) {
		$users_validated = $users_validated + 1;
	}
}

// account for mine
$users_paid = $users_paid - 1;

$packageslinescount = number_format($packageslinescount);
$packagesfilescount = number_format($packagesfilescount);

include('template/header.php');
include('template/menu.php');
?>
<div class="row-fluid">
	<div class="span6 well">
		<h2>All Components Created</h2>
		<p><span class="label label-info">Total:</span> <span class="label label-info"><?php echo count($packages); ?></span></p>
		<p><span class="label label-success">Total Lines:</span> <span class="label label-success"><?php echo $packageslinescount; ?></span></p>
		<p><span class="label label-success">Total Files:</span> <span class="label label-success"><?php echo $packagesfilescount; ?></span></p>
		<p><a class="btn" href="stats.php">View Stats &raquo;</a></p>
	</div><!-- /span6 -->
	<div class="span6 well">
		<h2>All Helloworlds Downloaded</h2>
		<p><span class="label label-info">Total:</span> <span class="label label-info"><?php echo $downloadcountAll; ?></span></p>
		<p><span class="label label-inverse">Joomla 2.5:</span> <span class="label label-inverse"><?php echo $downloadcount25; ?></span></p>
		<p><span class="label label-inverse">Joomla 3.0:</span> <span class="label label-inverse"><?php echo $downloadcount30; ?></span></p>
		<p><a class="btn" href="helloworld.php">View helloworlds &raquo;</a></p>
	</div><!-- /span6 -->
</div><!-- /row-fluid -->
<div class="row-fluid">
	<div class="span6 well">
		<h2>All Users</h2>
		<p><span class="label label-info">Total:</span> <span class="label label-info"><?php echo count($usersResult); ?></span></p>
		<p><span class="label label-success">Total Paid:</span> <span class="label label-success"><?php echo $users_paid; ?></span></p>
		<p><span class="label label-success">Total Money:</span> <span class="label label-success"><?php echo '$' . number_format($users_money,2); ?></span></p>
		<p><span class="label label-inverse">Total E-mail Validated:</span> <span class="label label-inverse"><?php echo $users_validated; ?></span></p>
		<p><a class="btn" href="users.php">View users &raquo;</a></p>
	</div><!-- /span6 -->
</div><!-- /row-fluid -->
<?php
include('template/footer.php');
