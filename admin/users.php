<?php
include('../master.php');

if(!isset($_SESSION['logged'])) {
	header('location:login.php');
	exit();
}

$database = new Database(HOST, DBNAME, DBUSER, DBPASS);
$users = $database->select('br_users', '*', '1=1', 'object');

// set menu
$activeCpanel = $activeStats = $activeHelloworld = $activeUsers = '';
$activeUsers = 'class="active"';

include('template/header.php');
include('template/menu.php');
?>
<div class="row-fluid">
	<div class="span12">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>User</th>
					<th>Country</th>
					<th>Language</th>
					<th>Paid</th>
					<th>Last Logged In</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach($users as $user) {
				?>
					<tr>
						<td><?php echo $user->id; ?></td>
						<td><?php echo $user->fname . ' ' . $user->lname; ?></td>
						<td><?php echo $user->country; ?></td>
						<td><?php echo $user->language; ?></td>
						<td>
						<?php
						if($user->paypal_payment_status) {
							echo '$ ' . $user->paypal_payment_amount;
						}
						?>
						</td>
						<td><?php echo $user->date_last_logged_in; ?></td>
					</tr>
				<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>
<?php
include('template/footer.php');
