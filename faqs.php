<?php
/*********
 * Black Rabbit Component Creator
 * by Caleb Nance
 */
 
	include('master.php');
	$pageTitle = 'FAQs for Black Rabbit Joomla Component Creator | Free | Joomla 2.5 & Joomla 3.0';
	$pageActive = 'faqs';
	$pageActiveBreadcrumb = '<li class="active">FAQs</li>';
	include('template/header.php');
?>

			<div id="section-container">
				<div class="container">
					<div class="row">
						<div class="span12">
							<h1 class="hidden-phone">Frequently Asked Questions</h1>
							<h1 class="visible-phone">FAQs</h1>

							<div class="accordion" id="accord">
								<div class="accordion-group">
									<div class="accordion-heading">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accord" href="#faq1">How much does this amazing tool cost?</a>
									</div><!-- /.accordion-heading -->
									<div id="faq1" class="accordion-body collapse">
										<div class="accordion-inner">
											It is free! But <a href="contact.php">donations</a> are greatly appreciated...
										</div><!-- /.accordion-inner -->
									</div><!-- /.accordion-body -->
								</div><!-- /.accordion-group -->

								<div class="accordion-group">
									<div class="accordion-heading">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accord" href="#faq2">Why should I use Black Rabbit?</a>
									</div><!-- /.accordion-heading -->
									<div id="faq2" class="accordion-body collapse">
										<div class="accordion-inner">
										This tool is to help developers/joomla admins cut down on creating a component. All of of the many files and folders of an extension are generated for you, with the information you've entered into the tool, then zipped up for instant install into a Joomla 2.5 or Joomla 3.0 website.
										</div><!-- /.accordion-inner -->
									</div><!-- /.accordion-body -->
								</div><!-- /.accordion-group -->

								<div class="accordion-group">
									<div class="accordion-heading">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accord" href="#faq3">What are some of the features of this tool?</a>
									</div><!-- /.accordion-heading -->
									<div id="faq3" class="accordion-body collapse">
										<div class="accordion-inner">
										<ul>
											<li>Multi-Database creation</li>
											<li>Multi-Views</li>
											<li>Brand your component with images!</li>
											<li>5 hours of saved time on average.</li>
											<li>No coding knowledge needed to create a component.</li>
										</ul>
										</div><!-- /.accordion-inner -->
									</div><!-- /.accordion-body -->
								</div><!-- /.accordion-group -->

								<div class="accordion-group">
									<div class="accordion-heading">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accord" href="#faq4">What does the table tab mean and how do I use it?</a>
									</div><!-- /.accordion-heading -->
									<div id="faq4" class="accordion-body collapse">
										<div class="accordion-inner">
										<p>The table tab can be a little confusing if you are not familiar with how a database is set up. Maybe it shouldn't be called a table, <strong>think of it as a field creator</strong>.</p>
										<p>With the tables manager, add the fields name that you want in the form on the administrator side of the component and then select the type of field that it is.</p>
										<h4>Cheat sheet for fields and what they do</h4>
										<dl class="dl-horizontal">
											<dt>Calendar</dt>
											<dd>This field will be a calendar date selector, with the calendar icon to the right of the input, upon clicking on it, a calendar will appear for you to select a specific date.</dd>

											<dt>Category</dt>
											<dd>This field will be a dropdown list so that you can (upon checking the use category box) select a category for the item.</dd>

											<dt>Checkbox</dt>
											<dd>This field will be a checkbox, usually used for a yes or no question, checked for yes or turned on and so on..</dd>

											<dt>Content Editor</dt>
											<dd>This field will be a "what you see is what you get" (WYSIWYG) contnet editor, to allow for the addition of paragraphs and images, with the options to bold text and so on..</dd>

											<dt>File/Image Upload</dt>
											<dd>This field will be an upload option, to select a file or image from your computer and upload it to the site.</dd>

											<dt>Hidden</dt>
											<dd>This field will not show up in the form editor, it will show up "behind the scenes" and will require more attention after component is built.</dd>

											<dt>Integer</dt>
											<dd>This field will create a dropdown list of a <strong>number</strong> range, setting this range by placing in the default field the start number then double hash and then the end number. Like the following: 2##5. This would produce a dropdown that starts at 2 and ends at 5.</dd>

											<dt>List</dt>
											<dd>This field is another dropdown, but for <strong>text</strong> not numbers, with that in mind, to create the dropdown list you will put the text options in the default box, separated by a comma. Here is an example (setting the default value to be unpublished, by putting brackets around it): published, [unpublished], archived</dd>

											<dt>Radio</dt>
											<dd>This field is a list option for radio buttons, works the same way as the list field, comma separated options and bracket around the default selected option.</dd>

											<dt>Textbox</dt>
											<dd>This field is just a regular old textbox, nothing special here. :)</dd>

											<dt>Text Area</dt>
											<dd>This field is much like the content editor above, but with no WYSIWIG, just a field to put a lot of text.</dd>
										</dl>

										</div><!-- /.accordion-inner -->
									</div><!-- /.accordion-body -->
								</div><!-- /.accordion-group -->

								<div class="accordion-group">
									<div class="accordion-heading">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accord" href="#faq5">How do I brand my component with images?</a>
									</div><!-- /.accordion-heading -->
									<div id="faq5" class="accordion-body collapse">
										<div class="accordion-inner">
										This is a new feature and I am really excited about it! The images tab will update for each view that you add, so by default the main view will be present. Click the browse button to select the image that you want to upload. I recommend a transparent png that is a square. The image upload limit is 2MB. Once you have selected your image, you can then upload them and see a preview of them sized down for how they will look in the component itself. <strong>Please remember to upload the images first (by hitting the upload image(s) button!), before hitting create component!</strong>
										</div><!-- /.accordion-inner -->
									</div><!-- /.accordion-body -->
								</div><!-- /.accordion-group -->

							</div><!-- /.accordion -->

						</div><!-- /.span12 -->
					</div><!-- /.row -->
				</div><!-- /.container -->
			</div><!-- /#section-container -->

<?php
	include('template/footer.php');
?>
