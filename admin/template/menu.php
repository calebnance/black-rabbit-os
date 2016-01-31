			<div class="masthead">
				<h3 class="muted pull-left">Black Rabbit Manager</h3>
				<a href="logout.php" style="margin: 10px 0;" class="btn btn-warning pull-right"><i class="icon icon-off"></i> Logout</a>
				<div class="clearfix"></div>
				<div class="container visible-phone">
					<ul class="nav nav-tabs nav-stacked">
						<li <?php echo $activeCpanel; ?>><a href="index.php">Black Rabbit Overview</a></li>
						<li <?php echo $activeStats; ?>><a href="stats.php">Component Creator Stats</a></li>
						<li <?php echo $activeUsers; ?>><a href="users.php">Black Rabbit Users</a></li>
						<li <?php echo $activeHelloworld; ?>><a href="helloworld.php">Hello World Stats</a></li>
					</ul>
				</div>
				<div class="navbar hidden-phone">
					<div class="navbar-inner">
						<div class="container">
							<ul class="nav">
								<li <?php echo $activeCpanel; ?>><a href="index.php">Black Rabbit Overview</a></li>
								<li <?php echo $activeStats; ?>><a href="stats.php">Component Creator Stats</a></li>
								<li <?php echo $activeUsers; ?>><a href="users.php">Black Rabbit Users</a></li>
								<li <?php echo $activeHelloworld; ?>><a href="helloworld.php">Hello World Stats</a></li>
							</ul>
						</div>
					</div>
				</div><!-- /.navbar -->
			</div>
			
			<hr>