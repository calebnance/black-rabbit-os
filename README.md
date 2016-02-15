Black Rabbit Open Source
=============
<h3>Black Rabbit (Open Source) Joomla Component Creator</h3>
<p>Easily create a fully installable Joomla 2.5/3.0 component from scratch just by filling in the form!</p>

<h3>Final Stats</h3>
<p>After the 3 years run, this component creator helped the <a href="https://www.joomla.org" target="_blank">Joomla</a> community develop custom components/modules.</p>
<p>Here are some stats before I took it off-line and placed it here for the community to use.</p>
<p><strong>Total Lines of Code Created:</strong> 51,843,240</p>
<p><strong>Total Components Created:</strong> 25,194</p>
<p><strong>Total Number of Files Created:</strong> 3,589,922</p>
<p><strong>Total Time Saved In All:</strong> 216,013:30:0 **</p>
<p><small>** 15 seconds allocated per line of code</small></p>

<h3>Terms of Use</h3>
<p>This code set was written <a href="https://twitter.com/calebnance/status/335807921076178944">3 years ago</a>. I haven't updated it in more than a year, and the hosted site for this was hacked a couple months back. I didn't have time to fix everything, so I have decided to give the code to the Joomla community and let you all do with it as you'd like.</p>
<p>Literally anything goes, take this code apart, add to it, fork it, clone it, rebrand it, make money from it.. <strong>I don't care what you do with this code</strong>. It's for whoever wants it.</p>
<p>I only ask that you leave my name somewhere in the code, it can be in the comments, where only a developer could see it, that's fine.</p>
<p>Please note I will keep this repo up, and if people want to improve on it, by all means do so. <strong>Just hit up the pull requests</strong> and have at it. I'll try and pull in the code that works.</p>
<p>Also this is OLD CODE, it could be cleaned up A LOT, I understand that, so with that being said, please test this on a local environment, before you put it out there on any production server. Putting this out on a production server will be <strong>done at your own risk</strong>. Like I said, this code set was hacked. But honestly I just didn't sanitize the uploads well enough I think.</p>
<p>Please take a look below and I will show you step by step, how to get this thing going on your dev environment!</p>
<p>Enjoy, and share the love.</p>
<p>:heart: Caleb Nance</p>

<h3>Installation</h3>
<ol>
	<li>Open file /includes/configuration.php</li>
	<li>Set $host, $db_user, $db_pass, $db_name for connection.</li>
	<li>Set up database.. import sql into database (file: /install/database.sql)</li>
	<li>Now that the database is installed and hooked up, go to url: /admin/index.php</li>
	<li>This will allow you to set up the admin user.</li>
	<li>Then you will want to create an account. Via Sign-Up</li>
	<li>Make sure to change the $email_to, $email_from in the file: /includes/configuration.php</li>
	<li>To get past the "Pay", set the user field `paypal_payment_status` to 1.</li>
	<li>Logout from the user frontend and log back in, and you should be good to go!</li>
	<li>Component and Module mangers now should be running fine on your local envrionment!</li>
</ol>
