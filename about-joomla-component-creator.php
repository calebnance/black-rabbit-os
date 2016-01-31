<?php
/*********
 * Black Rabbit Component Creator
 * by Caleb Nance
 */
 
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
							<?php if(!$_SESSION['loggedin'] || !$_SESSION['paid']){ ?>
							<span class="hidden-phone">
								<div class="page-ad well pull-right">
									<img src="http://placehold.it/250">
									<br>
									Place Ad Here
								</div>
							</span>
							<?php } ?>
							<p class="lead">and what makes it so amazing!</p>
							<p>Add your own content here.</p>
							<p>- <strong>Caleb Nance</strong>, creator</p>
							<hr>
							<?php
							/*
							<p>If you use Black Rabbit Component Creator, please <a href="http://extensions.joomla.org/extensions/tools/webbased-tools/23259" target="_blank">post a rating and a review</a> at the Joomla! Extensions Directory.</p>
							<hr>
							*/
							?>
							<div class="clearfix"></div>
						</div><!-- /span12 -->
					</div><!-- /.row -->
				</div><!-- /.container -->
			</div><!-- /#section-container -->

<?php
	include('template/footer.php');
?>
