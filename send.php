<?php

	include('master.php');

	/*
	 *	Variables
	 */
	$post = $_POST;

	if($post['send']):
		$to  = '';
		$subject = $post['subject'];

		// message
		$message = '
		<html>
			<head>
				<title>'.$post["subject"].' - '.$post["name"].'</title>
			</head>
			<body>
				<p><strong>Name</strong> : '.$post["name"].'</p>
				<p><strong>E-Mail</strong> : '.$post["email"].'</p>
				<p><strong>Subject</strong> : '.$post["subject"].'</p>
				<p><strong>Message</strong> : '.$post["message"].'</p>
			</body>
		</html>
		';
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		//$headers .= 'To: Caleb <'.$to.'>' . "\r\n";
		$headers .= 'From: '.$post["name"].' <'.$post["email"].'>' . "\r\n";

		// Send mail
		mail($to, $subject, $message, $headers);

		// Call header
		$pageTitle = 'Contact Sent To Caleb Nance | Black Rabbit Component Creator | Free | Joomla 2.5 & Joomla 3.0';
		$pageActive = 'contact';
		$pageActiveBreadcrumb = '<li class="active">Contact</li>';
		include('template/header.php');
		?>
			<div id="section-container">
				<div class="container">
					<div class="row">
						<div class="span12">
							<div class="jumbotron">
								<h1>Message Sent</h1>
								<p class="lead">Thank you for your message, I will get back with you as soon as possible.</p>
							</div><!-- /.jumbotron -->
						</div><!-- /.span12 -->
					</div><!-- /.row -->
				</div><!-- /.container -->
			</div><!-- /#section-container -->
		<?php
		// Call footer
		include('template/footer.php');
	else:

		$pageTitle = 'Contact Caleb Nance | Black Rabbit Component Creator | Free | Joomla 2.5 & Joomla 3.0';
		$pageActive = 'contact';
		$pageActiveBreadcrumb = '<li class="active">Contact</li>';
		include('template/header.php');
	?>

			<div id="section-container">
				<div class="container">
					<div class="row-fluid">
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
						</div><!-- /.span12 -->
					</div><!-- /.row -->
				</div><!-- /.container -->
			</div><!-- /#section-container -->

<?php
		include('template/footer.php');

	endif;
?>
