<?php
/*********
 * Black Rabbit Component Creator
 * by Caleb Nance
 */
 
	include('master.php');
	$pageTitle = 'Contact Caleb Nance | Black Rabbit Joomla Component Creator | Free | Joomla 2.5 & Joomla 3.0';
	$pageActive = 'contact';
	$pageActiveBreadcrumb = '<li class="active">Contact</li>';
	include('template/header.php');
?>
			<div id="section-container">
				<div class="container">
					<div class="row">
						<div class="span12">
							<h1>Contact</h1>
							<form action="send.php" method="post" id="contact-form" class="form-horizontal">
								<div class="control-group">
									<label class="control-label" for="name">Name *</label>
									<div class="controls">
										<input type="text" id="name" name="name" class="required">
										<div class="status"></div>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="email">E-mail *</label>
									<div class="controls">
										<input type="text" id="email" name="email" class="required">
										<div class="status"></div>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="subject">Subject *</label>
									<div class="controls">
										<select id="subject" name="subject" class="required">
											<option value="Make This Aspect Better">Make This Aspect Better</option>
											<option value="Bug Report">Bug Report</option>
											<option value="Add A Feature">Add A Feature</option>
											<option value="Suggestion">Suggestion</option>
										</select>
										<div class="status"></div>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="message">Message *</label>
									<div class="controls">
										<textarea rows="3" id="message" name="message" class="required"></textarea>
										<div class="status"></div>
									</div>
								</div>
								<div class="form-actions">
									<input type="hidden" name="send" value="1" />
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</form>
							<?php if(!$_SESSION['loggedin'] || !$_SESSION['paid']){ ?>
							<span class="hidden-phone">
								<div class="well page-ad pull-right">
									<img src="http://placehold.it/250">
									<br>
									Place Ad Here
								</div><!-- /.page-ad -->
							</span>
							<?php } ?>
							<hr>
							<?php
							/*
							<p>If you use Black Rabbit Component Creator, please <a href="http://extensions.joomla.org/extensions/tools/webbased-tools/23259" target="_blank">post a rating and a review</a> at the Joomla! Extensions Directory.</p>
							<hr>
							*/
							?>
							<h3>Like this tool? Show your appreciation</h3>
							<p>
							Thank you for all of your support!!
							<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
								<input type="hidden" name="cmd" value="_s-xclick">
								<input type="hidden" name="hosted_button_id" value="TXCX4DUEAHC6U">
								<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
								<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
							</form>
							</p>
						</div><!-- /.span12 -->
					</div><!-- /.row -->
				</div><!-- /.container -->
			</div><!-- /#section-container -->
<?php
	include('template/footer.php');
?>
