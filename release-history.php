<?php
	include('master.php');
	$pageTitle = 'Release History of Black Rabbit Joomla Component Creator | Free | Joomla 2.5 & Joomla 3.0';
	$pageActive = 'history';
	$pageActiveBreadcrumb = '<li class="active">Release History</li>';
	include('template/header.php');
?>
			<div id="section-container">
				<div class="container">
					<div class="row">
						<div class="span12">
							<h1>Release History</h1>

							<p class="well">
								Index:
								<span class="label label-j25">Joomla 2.5</span>
								<span class="label label-j30">Joomla 3.0</span>
								<span class="label label-j31">Joomla 3.1</span>
								<span class="label label-j32">Joomla 3.2</span>
								<span class="label label-success">New With Version</span>
								<span class="label label-important">Bug Fix</span>
								<span class="label label-info">Helpful</span>
								<span class="label label-warning">New Website Tool Features</span>
								<span class="label label-extend">Code Extended</span>
							</p>

							<div class="tabbable tabs-left">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#115" data-toggle="tab">v<span class="hidden-phone">ersion</span> 1.1.5</a></li>
									<li><a href="#114" data-toggle="tab">v<span class="hidden-phone">ersion</span> 1.1.4</a></li>
									<li><a href="#113" data-toggle="tab">v<span class="hidden-phone">ersion</span> 1.1.3</a></li>
									<li><a href="#111" data-toggle="tab">v<span class="hidden-phone">ersion</span> 1.1.1</a></li>
									<li><a href="#110" data-toggle="tab">v<span class="hidden-phone">ersion</span> 1.1.0</a></li>
									<li><a href="#105" data-toggle="tab">v<span class="hidden-phone">ersion</span> 1.0.5</a></li>
									<li><a href="#101" data-toggle="tab">v<span class="hidden-phone">ersion</span> 1.0.1</a></li>
									<li><a href="#100" data-toggle="tab">v<span class="hidden-phone">ersion</span> 1.0.0</a></li>
									<li><a href="#060" data-toggle="tab">v<span class="hidden-phone">ersion</span> 0.6.0</a></li>
									<li><a href="#053" data-toggle="tab">v<span class="hidden-phone">ersion</span> 0.5.3</a></li>
									<li><a href="#052" data-toggle="tab">v<span class="hidden-phone">ersion</span> 0.5.2</a></li>
									<li><a href="#050" data-toggle="tab">v<span class="hidden-phone">ersion</span> 0.5.0</a></li>
									<li><a href="#045" data-toggle="tab">v<span class="hidden-phone">ersion</span> 0.4.5</a></li>
									<li><a href="#044" data-toggle="tab">v<span class="hidden-phone">ersion</span> 0.4.4</a></li>
									<li><a href="#043" data-toggle="tab">v<span class="hidden-phone">ersion</span> 0.4.3</a></li>
									<li><a href="#042" data-toggle="tab">v<span class="hidden-phone">ersion</span> 0.4.2</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="115">
										<p><span class="label label-success">NEW <i class="icon icon-star icon-white"></i></span> <span class="label label-j30">J3.0</span> <span class="label label-j32">J3.2</span> Category menu item options for frontend views with links to each item inside that category.</p>
										<p><span class="label label-extend">Code Extended</span> Component Creator form validation and editing is now a lot better and more reliable!</p>
										<p><span class="label label-extend">Code Extended</span> Table fields now sortable :))</p>
										<p><span class="label label-important">Bug Fix</span> On the component creator form, bugs were found, then removed :) Some values and such were not saving properly.</p>
										<p><span class="label label-important">Bug Fix</span> In the script, I was using <code><a href="http://php.net/in_array" target="_blank">in_array()</a></code> and it always returns 0 or 1, not the key value if it is present, so changed it to <code><a href="http://php.net/array_search" target="_blank">search_array()</a></code> -_- *face palm*</p>
										<p class="pull-right"><i class="icon icon-calendar"></i> <small>posted on 01-10-2014</small></p>
									</div><!-- /#115 -->
									<div class="tab-pane" id="114">
										<p><span class="label label-important">Bug Fix</span> When multiple image uploads are present, only the last image was being uploaded, that has been fixed now!</p>
										<p><span class="label label-important">Bug Fix</span> Image resize now working better, proportions were a little off.</p>
										<p><span class="label label-important">Bug Fix</span> Error whenever deleting a field from a table view, does not save correctly in the database.. has now been fixed!!!</p>
										<p><span class="label label-important">Bug Fix</span> <span class="label label-j31">Joomla 3.1</span> & <span class="label label-j32">Joomla 3.2</span> versions of module creator bug fixed.</p>
										<p><span class="label label-info">Helpful</span> More checkers in place for view names, field names and form submission.</p>
										<p><span class="label label-warning">New</span> Ads now on the site for non-members.</p>
										<p><span class="label label-warning">New</span> Javascript for form submission added to the tool, made it faster.</p>
										<p class="pull-right"><i class="icon icon-calendar"></i> <small>posted on 11-18-2013</small></p>
									</div><!-- /#114 -->
									<div class="tab-pane" id="113">
										<p><span class="label label-extend">NEW <i class="icon icon-star icon-white"></i></span> New Module Creator (Structure) for Members!!</p>
										<p><span class="label label-important">Bug Fix</span> Joomla 3.0 component not working well whenever K2 component is also installed.. <strong>Thanks Rainer!</strong></p>
										<p class="pull-right"><i class="icon icon-calendar"></i> <small>posted on 8-29-2013</small></p>
									</div><!-- /#113 -->
									<div class="tab-pane" id="111">
										<p><span class="label label-extend">NEW <i class="icon icon-star icon-white"></i></span> Image Upload functionality added!</p>
										<ul>
											<li>Set a pixel limit on images, it resizes to those specs!</li>
											<li>Editable limits from component config modal, so you can set what the pixel dimensions are even after the component is created and installed.</li>
											<li>Also an option to delete the image uploaded</li>
											<li><strong>BEFORE</strong> the image is removed from the site, it makes sure it is not being used anywhere else in the component, if it is, it doens't delete it, it just removes it from the current item.</li>
										</ul>
										<p><span class="label label-important">Bug Fix</span> Error saving fields in other views! This is now fixed <strong>(Membership Users)</strong></p>
										<p class="pull-right"><i class="icon icon-calendar"></i> <small>posted on 8-17-2013</small></p>
									</div><!-- /#111 -->
									<div class="tab-pane" id="110">
										<p><span class="label label-warning">NEW <i class="icon icon-star icon-white"></i></span> Website design!</p>
										<p><span class="label label-success">Added</span> Some preset fields (user created/modified, date created/modified.. etc.) to select for field types!</p>
										<p><span class="label label-success">Added</span> Check out for each item to the table.</p>
										<p><span class="label label-success">Added</span> Checkin text to admin language file.</p>
										<p><span class="label label-success">Added</span> When category is set to display in manager listing view, shows the category title and a link to edit the category for each item.</p>
										<p class="pull-right"><i class="icon icon-calendar"></i> <small>posted on 8-4-2013</small></p>
									</div><!-- /#110 -->
									<div class="tab-pane" id="105">
										<p><span class="label label-important">Bug Fix</span> When saving from a singular view, and the return listing view (in administrator) is not exact plural, then return to correct parent view! This has been a big one that I have yet to fix... until now! <strong>Whaahoo!</strong></p>
										<p><span class="label label-important">Bug Fix</span> Site/Models JModelList error fixed, spacing removed. <strong>Thanks Erich!</strong></p>
										<p><span class="label label-important">Bug Fix</span> Errors on tool when hitting edit, if no fields are required/show on manager, has been fixed! <strong>Thanks Erich!</strong></p>
										<p><span class="label label-important">Bug Fix</span> Custom fields file has numbers in filename, causing problems on some installations. Fix to no longer have numbers in filename.</p>
										<p><span class="label label-important">Bug Fix</span> Removed number limitations from field names.</p>
										<p><span class="label label-info">Helpful</span> Changed foreach/if statements to be brackets instead of colons. Taking code editors that look for brackets into consideration. <strong>Thanks Viktor</strong> for your insight on this.
<pre>
foreach($items as $item):
  // stuff
endforeach;
</pre>
<p>to:</p>
<pre>
foreach($items as $item){
  // stuff
}
</pre>
										</p>
										<p><span class="label label-info">Helpful</span> Added notes about ID field already being created in each table.</p>
										<p class="pull-right"><i class="icon icon-calendar"></i> <small>posted on 7-3-2013</small></p>
									</div><!-- /#105 -->
									<div class="tab-pane" id="101">
										<p><span class="label label-info">Added <i class="icon icon-star icon-white"></i></span> Language support added for BRCC site home page! (English, Spanish and French) - German coming soon.</p>
										<p><span class="label label-info">Added <i class="icon icon-star icon-white"></i></span> Option to delete a view when using the tool! This has been long overdue but I have now added this to the many things you can do with Black Rabbit.</p>
										<p><span class="label label-important">Bug Fix</span> Javascript errors with tool has been fixed.</p>
										<p><span class="label label-important">Bug Fix</span> Membership edit button causing all fields to be checked required or show on manager fixed.</p>
										<p><span class="label label-important">Bug Fix</span> Server errors fixed for updating.</p>
										<p><span class="label label-important">Bug Fix</span> Version tag updated when editing.</p>
										<p class="pull-right"><i class="icon icon-calendar"></i> <small>posted on 6-15-2013</small></p>
									</div><!-- /#101 -->
									<div class="tab-pane" id="100">
										<p><span class="label label-warning">Added <i class="icon icon-star icon-white"></i></span> Membership Manager Added! Now you can sign up and manager/edit/download all your components you create.</p>
										<ul>
											<li>You are now able to sign-up, and save all of your components that you have created.</li>
											<li>Keeps track of each version you have created for a single component, and you can download each version at anytime!</li>
											<li>View history of your components!</li>
											<li>Saves all form data, so that editing is a breeze.</li>
										</ul>
										<p><span class="label label-important">Bug Fix</span> Rule class error for server side validation. (administrator)</p>
										<p class="pull-right"><i class="icon icon-calendar"></i> <small>posted on 6-1-2013</small></p>
									</div><!-- /#100 -->
									<div class="tab-pane" id="060">
										<p><span class="label label-success">Added <i class="icon icon-star icon-white"></i></span> SEF support is now here with the addition of router.php file!</p>
										<p><span class="label label-success">Updated</span> Language words updated, including language system file.</p>
										<p><span class="label label-warning">Added <i class="icon icon-picture icon-white"></i></span> <span class="label label-j25">Joomla 2.5</span> You can now brand your component administrator views and dropdown submenu with the addition of View Images!</p>
										<p><span class="label label-warning">Added</span> Validate and check to make sure only good characters are accepted.</p>
										<p><span class="label label-warning">Added</span> Added requirement field types! (this field only accepts numbers, letters and so on)</p>
										<p><span class="label label-warning">Added</span> Option to turn off the use of the database at all. Just plain installable component.</p>
										<p><span class="label label-extend">Added <i class="icon icon-star icon-white"></i></span> More field types for database table, <strong>file/image upload, numbers and hidden</strong>.</p>
										<p><span class="label label-extend">Added</span> JRoute added to links, from lists views to singular view pages on the frontend.</p>
										<p><span class="label label-extend">Added</span> More language words supported. (configuration modal/file)</p>
										<p><span class="label label-important">Bug Fix <i class="icon icon-star icon-white"></i></span> Server errors when not using a database option, thanks for your insight Jan!</p>
										<p><span class="label label-important">Bug Fix</span> Single view on frontend, added the where clause to the query.</p>
										<p><span class="label label-important">Bug Fix</span> Validation error on URL check. Thanks Christopher!</p>
										<p><span class="label label-important">Bug Fix</span> Validation numbered error on wrong tabs when fields were not filled in.</p>
										<p class="pull-right"><i class="icon icon-calendar"></i> <small>posted on 3-20-2013</small></p>
									</div><!-- /#060 -->
									<div class="tab-pane" id="053">
										<p><span class="label label-success">Added</span> Submenu addition for all views in the component.</p>
										<p><span class="label label-extend">Added</span> When using categories in a view, it prints the category name instead of category ID on frontend.</p>
										<p><span class="label label-important">Bug Fix</span> <span class="label label-j30">Joomla 3.0</span> single view error on frontend fixed.</p>
										<p><span class="label label-important">Bug Fix</span> JS file include fixed on the administrator side (pointing to the wrong filename), thank you for reporting this Romeo!</p>
										<p><span class="label label-success">Helpful</span> Added validation to the form and tool tips for fields that could be confusing when using the tool.</p>
										<p><span class="label label-info">Tutorial</span> <a href="http://www.youtube.com/watch?v=AY40ibGhMs4" target="_blank">First tutorial video</a> made on how to use the tool, a very top level explanation of the configuration tool.</p>
										<p class="pull-right"><i class="icon icon-calendar"></i> <small>posted on 3-9-2013</small></p>
									</div><!-- /#053 -->
									<div class="tab-pane" id="052">
										<p><span class="label label-warning">New Name!</span> I have finally picked a name, <strong>Black Rabbit</strong> is the project.</p>
										<p><span class="label label-extend">Added</span> Plural view for each view set, along with the menu item and language supported!</p>
										<p><span class="label label-success">Features</span> Added CDATA support in installation description.</p>
										<p><span class="label label-warning">New Downloads</span> Now both Joomla HelloWorlds component examples available for download. Built by this tool!</p>
										<p><span class="label label-inverse">It is really starting to come together!</span></p>
										<p class="pull-right"><i class="icon icon-calendar"></i> <small>posted on 2-18-2013</small></p>
									</div><!-- /#052 -->
									<div class="tab-pane" id="050">
										<p><span class="label label-success">Features</span> Addition of site part and all views.
											<ul>
												<li><span class="label label-extend">Added</span> Singular view menu item selection, with drop down selector of first field in view. Requirement checked, can not be blank.</li>
												<li><span class="label label-extend">Added</span> Singular view has all item's fields displayed.</li>
												<li><span class="label label-extend">Added</span> Model files.</li>
												<li><span class="label label-extend">Added</span> Language support added to file for Menu Item selector.</li>
											</ul>
										</p>
										<p><span class="label label-extend">Joomla Changes</span> Language for menu view selection added.</p>
										<p><span class="label label-warning">Added Stats</span> Total lines created</p>
										<p><span class="label label-warning">Added Stats</span> Total files created</p>
										<p><span class="label label-warning">Added Stats</span> Total time saved :)</p>
										<p class="pull-right"><i class="icon icon-calendar"></i> <small>posted on 1-21-2013</small></p>
									</div><!-- /#050 -->
									<div class="tab-pane" id="045">
										<p><span class="label label-success">Joomla Changes</span> Categories supported! By adding a view and calling it <strong>categories</strong>, then in another view, adding a field and selecting the <strong>category</strong> option in the field type, it will link them together!</p>
										<p><span class="label label-j30">Changes</span> select box formatted on administrator side for bootstrap.</p>
										<p><span class="label label-j30">Changes</span> manager view formatted for bootstrap.</p>
										<p><span class="label label-j30">Changes</span> singular view formatted for bootstrap.</p>
										<p><span class="label label-j30">Changes</span> left side menu does not show on singular view. Use of <strong>JHtmlSidebar</strong>.</p>
										<p><span class="label label-j30">Changes</span> added support for deleted item message for the language file.</p>
										<p class="pull-right"><i class="icon icon-calendar"></i> <small>posted on 1-17-2013</small></p>
									</div><!-- /#045 -->
									<div class="tab-pane" id="044">
										<p><span class="label label-important">Bug Fix</span> <strong>More</strong> errors when packaging and downloading the zip file on server fixed.</p>
										<p><span class="label label-important">Bug Fix</span> Functions fixed on Joomla 3.0 package, no errors and installs fine now:
											<ul>
												<li><span class="label label-j30">Changed</span> <strong>, $urlparams = false</strong> added to the display() function of main controller.</li>
												<li><span class="label label-j30">Changed</span> <strong>$table = null, $id = null</strong> added to the _getAssetParentId() function of the table files for each view.</li>
											</ul>
										</p>
										<p><span class="label label-important">File Changed: install.xml</span>
<pre>
&lt;schemapath type="mysql"&gt;sql/updates/mysql&lt;/schemapath&gt;
</pre>
<p>to:</p>
<pre>
&lt;schemapath type="mysql"&gt;sql/updates/mysql/&lt;/schemapath&gt;
</pre>
										</p>
										<p class="pull-right"><i class="icon icon-calendar"></i> <small>posted on 1-15-2013</small></p>
									</div><!-- /#044 -->
									<div class="tab-pane" id="043">
										<p><span class="label label-important">Bug Fix</span> Errors when packaging and downloading the zip file on server fixed.</p>
										<p><span class="label label-j30">Joomla Changes</span> Installs to Joomla 3.0 but errors on views.</p>
										<p class="pull-right"><i class="icon icon-calendar"></i> <small>posted on 1-13-2013</small></p>
									</div><!-- /#043 -->
									<div class="tab-pane" id="042">
										<p><span class="label label-success">Info</span> Coded in <strong>MVC (Model View Controller)</strong></p>
										<p><span class="label label-success">Features</span> Language file supported.</p>
										<p><span class="label label-success">Features</span> Multiple view creation.</p>
										<p><span class="label label-j30">Install</span> Not checked for install on Joomla 3.0 yet.</p>
										<p><span class="label label-success">Features</span> Ability to set fields to required. (javascript validate)</p>
										<p><span class="label label-success">Features</span> Set field to show on manager view.</p>
										<p><span class="label label-success">Features</span> Created path to custom CSS and custom JS file on all views. (Administrator side)</p>
										<p><span class="label label-success">Administrator</span> Only creates the administrator side of the component.</p>
										<p><span class="label label-success">Administrator Pagination</span> Pagination support for administrator managers.</p>
										<p class="pull-right"><i class="icon icon-calendar"></i> <small>posted on 12-6-2012</small></p>
									</div><!-- /#042 -->
								</div><!-- /.tab-content -->
							</div><!-- /.tabbable -->

							<?php
							if(Access::notLoggedInOrPaid()) {
							?>
								<span class="hidden-phone">
									<div class="page-ad well pull-right" style="margin-top: 15px;">
										<img src="https://via.placeholder.com/250" />
										<br />
										Place Ad Here
									</div>
								</span>
							<?php
							}
							?>

							<h3><i class="icon-list-ul"></i> Wishlist and Things To Come</h3>
							<ul>
								<li>Tags Component (com_tags) support added. <strong>(Expected on v.1.2.0)</strong></li>
								<li><strong>Multiple</strong> image upload. <strong>(Expected on v.1.2.0)</strong></li>
								<li>Frontend form submission to database, with a check for user needing to be logged in or not (checkable option from the creator form). <strong>(Expected on v.1.2.0)</strong></li>
								<li>New branding options! If you are a member, you can select images that you have uploaded or free stock images that you can brand your component with! <strong>(Expected on v.1.2.0)</strong></li>
								<li>Filter/Sorting <strong>(Expected on v.1.2.0)</strong></li>
								<li>Image editable (cropping and more from administrator side). <strong>(Expected on v.1.3.0)</strong></li>
								<li>Field and View name limits.. Some words don't work, so limit those from being used. <strong>(Expected on v.1.3.0)</strong></li>
								<li>Removed Ending ?&gt; tag from php files, some servers do not like this, adding a line after.</li>
								<li>Table linking <strong>in le future :)</strong></li>
							</ul>
							<h3><i class="icon-bug"></i> Known Bugs</h3>
							<ul>
								<li>Got nothing.. :) Please <a href="contact.php">tell me</a> if there are!</li>
							</ul>
							<?php
							/*
							TODO: LIST on lists on lists
										<p><span class="label label-success">Added <i class="icon icon-star icon-white"></i></span> Categories view with links to each item inside that category, all with SEF urls.</p>
										<p><span class="label label-success">Added <i class="icon icon-star icon-white"></i></span> <span class="label label-j31">Joomla 3.1</span> Tags - http://docs.joomla.org/J3.1:Using_Tags_in_an_Extension.</p>
										<p><span class="label label-extend">Added <i class="icon icon-picture icon-white"></i></span> Selecting a field to be an image upload, now actually has the code for an image upload from the administrator side to work!</p>
										<p><span class="label label-extend">Added <i class="icon icon-picture icon-white"></i></span> New branding options! If you are a member, you can select images that you have uploaded or free stock images that you can brand your component with!</p>
							*/
							?>
						</div><!-- /.span12 -->
					</div><!-- /.row -->
				</div><!-- /.container -->
			</div><!-- /#section-container -->

<?php
	include('template/footer.php');
?>
