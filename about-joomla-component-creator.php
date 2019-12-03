<?php
include('master.php');

$pageTitle = 'About Black Rabbit Joomla Component Creator | Free | Joomla 2.5 & Joomla 3.0';
$pageActive = 'about';
$pageActiveBreadcrumb = '<li class="active">About Black Rabbit Component Creator</li>';

include('template/header.php');
?>
<div id="section-container">
	<div class="container">
		<div class="row">
			<div class="span12">
				<h1>About Black Rabbit Component Creator</h1>
				<?php
				if (Access::notLoggedInOrPaid()){
				?>
					<span class="hidden-phone">
						<div class="page-ad well pull-right">
							<img src="https://via.placeholder.com/250" />
							<br />
							Place Ad Here
						</div>
					</span>
				<?php
				}
				?>
				<p class="lead">and what makes it so amazing!</p>
				<p>Add your own content here.</p>
				<p>- <strong>Caleb Nance</strong>, creator</p>
				<div class="clearfix"></div>
			</div><!-- /span12 -->
		</div><!-- /.row -->
	</div><!-- /.container -->
</div><!-- /#section-container -->
<?php
include('template/footer.php');
