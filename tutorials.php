<?php
include('master.php');

$pageTitle = 'Tutorials for Black Rabbit Joomla Component Creator | Free | Joomla 2.5 & Joomla 3.0';
$pageActive = 'tutorial';
$pageActiveBreadcrumb = '<li class="active">Tutorials</li>';

include('template/header.php');
?>
<div id="section-container">
	<div class="container">
		<div class="row">
			<div class="span12">
				<h1>Tutorials</h1>
				<div class="well">
					<h3 style="margin-top: 0;">Black Rabbit Tutorial 1 - How To Use This Tool - HD</h3>
					<iframe width="100%" height="400" src="http://www.youtube.com/embed/AY40ibGhMs4" frameborder="0" allowfullscreen></iframe>
				</div><!-- /.well -->
				<?php
				if (Access::notLoggedInOrPaid()) {
				?>
					<span class="hidden-phone">
						<div class="row-fluid">
							<div class="span4">
								<div class="well">
									<img src="https://via.placeholder.com/250" />
									<br />
									Place Ad Here
								</div><!-- /.page-ad -->
							</div><!-- /.span4 -->
							<div class="span4">
								<div class="well">
									<img src="https://via.placeholder.com/250" />
									<br />
									Place Ad Here
								</div><!-- /.page-ad -->
							</div><!-- /.span4 -->
							<div class="span4">
								<div class="well">
									<img src="https://via.placeholder.com/250" />
									<br />
									Place Ad Here
								</div><!-- /.page-ad -->
							</div><!-- /.span4 -->
						</div><!-- /.row-fluid -->
					</span>
				<?php
				}
				?>
				<div class="well">
					<h3 style="margin-top: 0px;">Black Rabbit Membership - Quick Manager Look - HD</h3>
					<iframe width="100%" height="400" src="http://www.youtube.com/embed/MtuBpjKm06c" frameborder="0" allowfullscreen></iframe>
				</div><!-- /.well -->
			</div><!-- /.span12 -->
		</div><!-- /.row -->
	</div><!-- /.container -->
</div><!-- /#section-container -->

<?php
include('template/footer.php');
