			<div id="section-container">
				<div class="container">
					<div class="row">
						<div class="span12">
							<ul class="breadcrumb well">
								<li><a href="index.php">Home</a> <span class="divider">/</span></li>
								<?php echo $pageActiveBreadcrumb; ?>
							</ul>
						</div><!-- /.span12 -->
					</div><!-- /.row -->
				</div><!-- /.container -->
			</div><!-- /#section-container -->
			<!-- FOOTER -->
			<footer>
				<div class="main-footer">
					<div class="container">
						<div class="row">
							<section id="footermenu" class="span8">
								<h4><i class="icon-sitemap"></i> Site Map</h4>
								<ul class="inline">
									<li <?php echo $home; ?>><a href="index.php"><i class="icon-home"></i> <?php echo $brtext->__('HOME'); ?></a></li>
									<li <?php echo $about; ?>><a href="about-joomla-component-creator.php"><i class="icon-book"></i> <?php echo $brtext->__('ABOUT'); ?></a></li>
									<li <?php echo $signup; ?>><a href="sign-up.php"><i class="icon-lightbulb"></i> <?php echo $brtext->__('SIGNUP'); ?></a></li>
									<li <?php echo $history; ?>><a href="release-history.php"><i class="icon-time"></i> <?php echo $brtext->__('RELEASEHISTORY'); ?></a></li>
									<li <?php echo $tutorial; ?>><a href="tutorials.php"><i class="icon-film"></i> <?php echo $brtext->__('TUTORIALS'); ?></a></li>
									<li <?php echo $faqs; ?>><a href="faqs.php"><i class="icon-question"></i> <?php echo $brtext->__('FAQS'); ?></a></li>
									<li <?php echo $development; ?>><a href="development.php"><i class="icon-code"></i> Development</a></li>
									<li <?php echo $contributors; ?>><a href="contributors.php"><i class="icon-pencil"></i> Contributors</a></li>
									<li <?php echo $testimonials; ?>><a href="testimonials.php"><i class="icon-comment"></i> Testimonials</a></li>
									<li <?php echo $terms; ?>><a href="terms.php"><i class="icon-briefcase"></i> Terms</a></li>
									<li <?php echo $contact; ?>><a href="contact.php"><i class="icon-smile"></i> <?php echo $brtext->__('CONTACT'); ?></a></li>
									<?php
									if($loggedin):
									?>
									<li <?php echo $dashboard; ?>><a href="dashboard.php"><i class="icon-dashboard"></i> <?php echo $brtext->__('DASHBOARD'); ?></a></li>
									<li <?php echo $components; ?>><a href="components.php"><i class="icon-cogs"></i> <?php echo $brtext->__('COMPONENTS'); ?></a></li>
									<li <?php echo $modules; ?>><a href="modules.php"><i class="icon-paper-clip"></i> <?php echo $brtext->__('MODULES'); ?></a></li>
									<?php
									endif;
									?>
								</ul>
							</section>
						</div><!-- /.row -->
					</div><!-- /.container -->
				</div><!-- /.main-footer -->

				<!-- Sub footer -->
				<div class="sub-footer">
					<div class="container">
						<div id="social-icons">
							<ul>
								<li class="social-icon twitter">
									<a class="fade-img" href="https://twitter.com/calebnance" target="_blank" rel="tooltip" title="Twitter"><img src="template/assets/img/social/icons_twitter.png" alt="Twitter" /></a>
								</li>
								<li class="social-icon youtube">
									<a class="fade-img" href="http://www.youtube.com/user/calebcanhelp22" target="_blank" rel="tooltip" title="YouTube"><img src="template/assets/img/social/icons_youtube.png" alt="YouTube" /></a>
								</li>
							</ul>
						</div><!-- /.social-icons -->
						<div class="copyright-text">Copyright &copy; 2008-<?php echo date('Y'); ?> Caleb Nance | All Rights Reserved</div>
					</div><!-- /.container -->
				</div><!-- /.sub-footer -->
			</footer>

		<div id="gototop" class="btn"><i class="icon-chevron-up"></i></div>
		<style>
			#show-standard { cursor: pointer; margin-left: 10px; }
			.sortable-placeholder { background-color: #E5E5E5; min-height: 60px; /*width: 100%;*/ }
		</style>

		<!-- Le javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="js/jquery-1.8.3.min.js<?php echo '?v=' . $br_version; ?>"></script>
		<script src="js/jquery-ui.min.js<?php echo '?v=' . $br_version; ?>"></script>
		<script src="bootstrap/js/bootstrap.min.js<?php echo '?v=' . $br_version; ?>"></script>
		<script src="js/jquery.form.min.js<?php echo '?v=' . $br_version; ?>"></script>
		<script type="text/javascript">
		function reSortable(){
			$('.sortable tbody').sortable({
				handle: '.moveField',
				placeholder: 'sortable-placeholder',
				forcePlaceholderSize: true,
				items: '> tr:not(:first)',
				stop: function(event, ui) {
					var $table	= $(this).closest('table');
					var $id		= $table.attr('id');
					$.each($table.find('tr'), function(i, item){
						if(i != 0){
							var f = i - 1;
							$(item).find('td:first').html(i);
							$(item).find('.removeField').attr('id', 'remove-' + i);
							$(this).find('#' + $id + '-show').attr('name', $id + '-show[' + f + ']');
							$(this).find('#' + $id + '-required').attr('name', $id + '-required[' + f + ']');
						}
					});

				}
			});//.disableSelection();
		}

		$(document).ready(function(){

			reSortable();

			$('#show-standard').on('click', function(e){
				if($('.add-some-standard').is(':visible')){
					$(this).html('<i class="icon-chevron-down"></i> Show</small>');
					$('.add-some-standard').slideUp(400);
				} else {
					$(this).html('<i class="icon-chevron-up"></i> Hide</small>');
					$('.add-some-standard').slideDown(400);
				}
			});

			$('#login-area-btn').click(function(){
				if($('#login-area-form').is(':visible')){
					$('#login-area-form').hide('slide', {direction: 'left'}, 1000);
					$(this).html('<i class="icon icon-chevron-right"></i>');
				} else {
					$('#login-area-form').show('slide', {direction: 'left'}, 1000);
					$(this).html('<i class="icon icon-chevron-left"></i>');
				}
			});
			$('.menu-trigger').click(function(){
				$(this).next().slideToggle('200');
			});
			$('#gototop').click(function(){
				$('html, body').stop().animate({
					scrollTop: 0
				}, 1000);
			});

			<?php if($pageActive == 'home'){ ?>
			// Take tour
			$('#take-tour').on('click', function(e){
				e.preventDefault();
				intro.setOptions({
					exitOnEsc: true,
					exitOnOverlayClick: true,
					scrollToElement: true,
					showStepNumbers: true, // default is true, but if we want to turn it off, we can.
					skipLabel: 'Exit',
					doneLabel: 'Got it, Thanks!',
					steps: [
						{
							element: '#mainform h2',
							intro: 'Welcome to the Black Rabbit Joomla Component Creator!',
							position: 'top'
						},
						{
							element: '#jversionselect',
							intro: 'Here you will want to select the Joomla Version you would like to create a component for!',
							position: 'top'
						},
						{
							element: '#myTab',
							intro: 'Then go through each tab and fill in the required fields, if it is your first time please take a look at some of the tutorial videos and helpful text along the way.',
							position: 'top'
						},
						{
							element: '.tab-content',
							intro: 'Content area for each tab is here..',
							position: 'top'
						},
						{
							element: '#createcomponent',
							intro: 'Once everything is filled out, this is the last thing you\'ll need to click to get the component generated.',
							position: 'top'
						}
					]
				});
				intro.start();
			});

			<?php } ?>

		});
		</script>

		<?php if($pageActive == 'contact'): ?>
		<script src="js/mail.js<?php echo '?v=' . $br_version; ?>"></script>
		<?php elseif($pageActive == 'signup'): ?>
		<script src="js/signup.js<?php echo '?v=' . $br_version; ?>"></script>
		<?php elseif($pageActive == 'components'): ?>
		<script src="js/components.js<?php echo '?v=' . $br_version; ?>"></script>
		<?php elseif($pageActive == 'modules'): ?>
		<script src="js/modules.js<?php echo '?v=' . $br_version; ?>"></script>
		<?php else: ?>
		<script src="js/javascript.min.js<?php echo '?v=' . $br_version; ?>.1"></script>
		<?php endif; ?>
	</body>
</html>
