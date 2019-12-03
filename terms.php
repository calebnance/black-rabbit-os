<?php
include('master.php');

$pageTitle = 'Terms for Black Rabbit Joomla Component Creator | Free | Joomla 2.5 & Joomla 3.0';
$pageActive = 'terms';
$pageActiveBreadcrumb = '<li class="active">Terms for Black Rabbit Joomla Component Creator</li>';

include('template/header.php');
?>
<div id="section-container">
	<div class="container">
		<div class="row">
			<div class="span12">
				<h1>Terms</h1>
				<?php
				if (Access::notLoggedInOrPaid()) {
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
				<p>By using the tool, Black Rabbit Joomla Component Creator (BRJCC), and/or signing up to this site, you agree to having your information saved in our database. Only the information that you place into the forms on this site and the browser information will be saved, it will never be sold, <strong>just used to make this site better and easier to use in your future visits</strong>.</p>
				<p>By signing up, you will be able to save and edit all components created for as long as the site is up. It is a <strong>one time fee</strong> to become a member.</p>
				<p>You also agree to never share your login with others, one user per account.</p>
				<p>The misuse of this tool will be subject for deletion, you will then have to sign-up again and all of your past data will be lost. Misuse includes but is not limited to: spamming to make the server crash, creating unnecessarily big files, trying to hack the site, and <strong>sharing your login with others</strong>. If the misuse persists, you will be blocked from the site all together.</p>
			</div><!-- /.span12 -->
		</div><!-- /.row -->
	</div><!-- /.container -->
</div><!-- /#section-container -->
<?php
include('template/footer.php');
