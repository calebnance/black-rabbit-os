<?php
	include('../master.php');

	if (!isset($_SESSION['logged'])):
		header('location:login.php');
		exit();
	endif;

	$database = new Database(HOST, DBNAME, DBUSER, DBPASS);

	// Set menu
	$activeCpanel = $activeStats = $activeHelloworld = $activeUsers = '';
	$activeStats = 'class="active"';

	// Grab creation stats
	$currentpage = 1;
	$start = 0;
	//$limit = 10;
	$limitSet = 10;

	if (isset($_REQUEST['p'])) {
		$currentpage = $_REQUEST['p'];
	}

	if (isset($_REQUEST['start'])) {
		$start = $_REQUEST['start'];
	}

	/*
	if ($_REQUEST['limit']):
		$limit = $_REQUEST['limit'];
	endif;
	*/

	// Get total packages!
	$totalCheck = $database->select('br_packages', '*', '1=1', 'object');
	$totalPackages = count($totalCheck);
	$packages = array();
	$packageslinescount = 0;
	$packagesfilescount = 0;
	foreach($totalCheck as $row):
		$packages[] = $row;
    	$packageslinescount = $packageslinescount + $row->lines_created;
    	$packagesfilescount = $packagesfilescount + $row->files_created;
	endforeach;

	// Set query for this page
	$totalP = $database->select('br_packages', '*', '1=1', 'object', '', '', 'date_created', $limitSet, true, $start);
	$packages = array();
	foreach($totalP as $row):
		$packages[] = $row;
	endforeach;

    // Calculate time saved (hours)
    //$totaltimesaved = round(($packageslinescount / 4) / 60);
    $t = $packageslinescount * 15;
	$f = ":";
	$hours = number_format(floor($t/3600));
	$minutes = ($t/60)%60;
	$seconds = $t%60;
	$totaltimesaved = $hours . $f . $minutes . $f . $seconds;

	$packageslinescount = number_format($packageslinescount);
	$packagesfilescount = number_format($packagesfilescount);

	include('template/header.php');
	include('template/menu.php');
?>
			<div class="row-fluid">
				<div class="span12">
					<h2>All Components Created</h2>
					<p>Total Packages: <span class="label label-success"><?php echo number_format($totalPackages); ?></span></p>
					<p>Total Lines: <span class="label label-success"><?php echo $packageslinescount; ?></span> | Total Files: <span class="label label-success"><?php echo $packagesfilescount; ?></span></p>
					<p>Total Time Saved: <span class="label label-success"><?php echo $totaltimesaved; ?></span></p>
					<table class="table table-striped">
						<thead>
							<tr>
								<th width="20">ID</th>
								<th>Title</th>
								<th class="hidden-phone">Package</th>
								<th>Filesize</th>
								<?php
								/*
								<th>Component Version</th>
								<th>J! Version</th>
								<th>Black Rabbit Version</th>
								*/
								?>
								<th class="hidden-phone">Author</th>
								<?php
								/*
								<th>E-Mail</th>
								<th>Website</th>
								*/
								?>
								<th class="hidden-phone">Date Created</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($packages as $row): ?>
							<?php
							$date_created = strtotime($row->date_created);
							$date_created = date('m-d-Y h:i:sa', $date_created);
							?>
							<tr>
								<td><?php echo $row->id; ?></td>
								<td><a href="stat.php?id=<?php echo $row->id; ?>"><i class="icon icon-edit"></i> <?php echo $row->title; ?></a></td>
								<td class="hidden-phone"><?php echo $row->package; ?></td>
								<td><?php echo $row->filesize; ?></td>
								<?php
								/*
								<td>v.<?php echo $row->version; ?></td>
								<td><?php echo $row->jversion; ?></td>
								<td><?php echo $row->brversion; ?></td>
								*/
								?>
								<td class="hidden-phone"><a href="mailto:<?php echo $row->email; ?>"><?php echo $row->author; ?></td>
								<?php
								/*
								<td><?php echo $row['email']; ?></td>
								<td><?php echo $row['website']; ?></td>
								*/
								?>
								<td class="hidden-phone"><?php echo $date_created; ?></td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>

					<?php
					if ($totalPackages > 10):
						$totalpages = 1;
						for ($i = 1; $i <= $totalPackages; $i++):
							$i = $i + 9;
							$totalpages++;
						endfor;
						$laststart = $i - 11;
						$totalpages = $totalpages - 1;

						if ($totalPackages > 10)
						{
							$firstActive = ($currentpage == 1) ? " class=\"active\"" : "";
							$lastActive = ($currentpage == $totalpages) ? " class=\"active\"" : "";
							$totalpages = intval($totalpages);
							$pagination = '<div class="well pagination hidden-phone" style="text-align: center;">';
							$pagination .= '<ul>';
							//$pagination .= '<li' . $firstActive . '><a href="stats.php?p=1&start=0">First</a></li>';
							//$currentpage = (false == isset($currentpage)) ? 1 : $currentpage;
							$i = 0;
							for($page = 1; $page < $totalpages + 1; $page++)
							{
								$lower = $currentpage - 3;
								$upper = $currentpage + 3;
								$class = ($page == $currentpage) ? " class=\"active\"" : "";
								if (($page > $lower && $page < $upper) || $page < 2 || $page > ($totalpages - 1))
								{
									if ($last_done_page + 1 != $page) $pagination .= '<li class="disabled"><span>...</span></li>';
									$pagination.='<li' . $class . '><a href="stats.php?p=' . $page . '&start=' . $i . '">' . $page . '</a></li>';
									$last_done_page = $page;
								}
								$i = $i + 10;
							}
							//$pagination .= '<li' . $lastActive . '><a href="stats.php?p=' . $totalpages . '&start=' . $laststart . '">Last</a></li>';
							$pagination .= '</ul>';
							$pagination .= '</div>';
							echo $pagination;
						}

						$last_done_page = 0;
						if ($totalPackages > 10)
						{
							$firstActive = ($currentpage == 1) ? " class=\"active\"" : "";
							$lastActive = ($currentpage == $totalpages) ? " class=\"active\"" : "";
							$totalpages = intval($totalpages);
							$pagination = '<div class="well pagination pagination-mini visible-phone" style="text-align: center;">';
							$pagination .= '<ul>';
							//$pagination .= '<li' . $firstActive . '><a href="stats.php?p=1&start=0">First</a></li>';
							//$currentpage = (false == isset($currentpage)) ? 1 : $currentpage;
							$i = 0;
							for($page = 1; $page < $totalpages + 1; $page++)
							{
								$lower = $currentpage - 3;
								$upper = $currentpage + 3;
								$class = ($page == $currentpage) ? " class=\"active\"" : "";
								if (($page > $lower && $page < $upper) || $page < 2 || $page > ($totalpages - 1))
								{
									if ($last_done_page + 1 != $page) $pagination .= '<li class="disabled"><span>...</span></li>';
									$pagination.='<li' . $class . '><a href="stats.php?p=' . $page . '&start=' . $i . '">' . $page . '</a></li>';
									$last_done_page = $page;
								}
								$i = $i + 10;
							}
							//$pagination .= '<li' . $lastActive . '><a href="stats.php?p=' . $totalpages . '&start=' . $laststart . '">Last</a></li>';
							$pagination .= '</ul>';
							$pagination .= '</div>';
							echo $pagination;
						}
					endif;
					?>

				</div><!-- /.span12 -->
			</div><!-- /.row-fluid -->
<?php
include('template/footer.php');
