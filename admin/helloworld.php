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
	
	// Set menu
	$activeCpanel = $activeStats = $activeHelloworld = $activeUsers = '';
	$activeHelloworld = 'class="active"';
	
	// Get total packages!
	$hellowords = $database->select('br_helloworlds', '*', '1=1', 'object');
	$allHelloworlds = count($hellowords);
	$totalDownloads = 0;
	$joomla25Downloads = 0;
	$joomla30Downloads = 0;
	
	foreach($hellowords as $row):
		$totalDownloads = $totalDownloads + $row->downloadcount;
		if($row->jversion == '2.5'):
			$joomla25Downloads = $joomla25Downloads + $row->downloadcount;
		endif;
		if($row->jversion == '3.0'):
			$joomla30Downloads = $joomla30Downloads + $row->downloadcount;
		endif;
	endforeach;
	
	$hellowords25 = $database->select('br_helloworlds', '*', 'jversion = "2.5"', 'object');
	$joomla25 = array();
	foreach($hellowords25 as $row):
		$joomla25['25'][] = $row->downloadcount;
		$joomla25['brv'][] = $row->version;
		$joomla25['last'][] = $row->lastdownloaded;
	endforeach;
	
	$hellowords30 = $database->select('br_helloworlds', '*', 'jversion = "3.0"', 'object');
	$joomla30 = array();
	foreach($hellowords30 as $row):
		$joomla30['30'][] = $row->downloadcount;
		$joomla30['brv'][] = $row->version;
		$joomla30['last'][] = $row->lastdownloaded;
	endforeach;
	
	$linesCount = count($joomla25['25']);
	
	// Include header and menu
	include('template/header.php');
	include('template/menu.php');
?>
			<div class="row-fluid">
				<div class="span12">
					<h2>Hello Worlds Downloads</h2>
					<p>Total Downloads: <span class="label label-success"><?php echo number_format($totalDownloads); ?></span></p>
					<p>Total Joomla 2.5: <span class="label label-success"><?php echo number_format($joomla25Downloads); ?></span></p>
					<p>Total Joomla 3.0: <span class="label label-success"><?php echo number_format($joomla30Downloads); ?></span></p>
					<table class="table table-striped">
						<thead>
							<tr>
								<th>BR Version</th>
								<th>Joomla 2.5</th>
								<th>Last Downloaded</th>
								<th>Joomla 3.0</th>
								<th>Last Downloaded</th>
							</tr>
						</thead>
						<tbody>
						<?php for($i=0; $i < $linesCount; $i++): ?>
							<?php
							$date_25 = strtotime($joomla25['last'][$i]);
							$date_25 = date('m-d-Y h:i:sa', $date_25);
							$date_30 = strtotime($joomla30['last'][$i]);
							$date_30 = date('m-d-Y h:i:sa', $date_30);
							?>
							<tr>
								<td><?php echo $joomla25['brv'][$i]; ?></td>
								<td><?php echo $joomla25['25'][$i]; ?></td>
								<td><?php echo $date_25; ?></td>
								<td><?php echo $joomla30['30'][$i]; ?></td>
								<td><?php echo $date_30; ?></td>
							</tr>
						<?php endfor; ?>
						</tbody>
					</table>
				</div><!-- /.span12 -->
			</div><!-- /.row-fluid -->
<?php
	// Include footer
	include('template/footer.php');
?>