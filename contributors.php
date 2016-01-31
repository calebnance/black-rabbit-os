<?php
/*********
 * Black Rabbit Component Creator
 * by Caleb Nance
 */
 
	include('master.php');
	$pageTitle = 'Contributors of Black Rabbit Joomla Component Creator | Free | Joomla 2.5 & Joomla 3.0';
	$pageActive = 'contributors';
	$pageActiveBreadcrumb = '<li class="active">Contributors</li>';
	include('template/header.php');
?>

			<div id="section-container">
				<div class="container">
					<div class="row">
						<div class="span12">
							<h1>Contributors</h1>
							<?php if(!$_SESSION['loggedin'] || !$_SESSION['paid']){ ?>
							<span class="hidden-phone">
								<div class="page-ad well pull-right">
									<img src="http://placehold.it/250">
									<br>
									Place Ad Here
								</div>
							</span>
							<?php } ?>
							<p class="lead"><a href="http://github.com/soyuka" target="_blank">Antoine</a> provided the translation for the home page in French and soon to be German as well. Thanks so much!</p>
						</div><!-- /.span12 -->
					</div><!-- /.row -->
				</div><!-- /.container -->
			</div><!-- /#section-container -->

<?php
	include('template/footer.php');
?>
