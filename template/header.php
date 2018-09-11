<?php
	$br_version = '1.1.5';

	$home = $about = $history = $contact = $tutorial = $signup = $login = $faqs = $terms = $contributors = $testimonials = $help = $manager = $dashboard = $development = $components = $modules = '';

	switch($pageActive){
		case 'home':
			$home = 'class="active"';
			break;
		case 'about':
			$about = 'class="active"';
			break;
		case 'history':
			$history = 'class="active"';
			break;
		case 'contact':
			$contact = 'class="active"';
			break;
		case 'tutorial':
			$tutorial = 'class="active"';
			$help = ' active';
			break;
		case 'login':
			$login = 'class="active"';
			break;
		case 'faqs':
			$faqs = 'class="active"';
			$help = ' active';
			break;
		case 'terms':
			$terms = 'class="active"';
			$help = ' active';
			break;
		case 'contributors':
			$contributors = 'class="active"';
			$help = ' active';
			break;
		case 'testimonials':
			$testimonials = 'class="active"';
			$help = ' active';
			break;
		case 'signup':
			$signup = 'class="active"';
			break;
		case 'development':
			$development = 'class="active"';
			$help = ' active';
			break;
		case 'dashboard':
			$dashboard = 'class="active"';
			$manager = ' active';
			break;
		case 'components':
			$components = 'class="active"';
			$manager = ' active';
			break;
		case 'modules':
			$modules = 'class="active"';
			$manager = ' active';
			break;
		default:
			$home = '';
			break;
	}

	// Session check
	// session_start();
	$loggedin = 0;
	// store session data
	if(isset($_SESSION['loggedin'])):
		$loggedin = 1;
	endif;


	// handle language
	$usa = $germany = $spain = $france = '';
	if(isset($_SESSION['language'])):
		// handle language start
		$brtext = new Translator($_SESSION['language']);
		switch($_SESSION['language']){
			case 'DE':
				$germany = 'active';
				break;
			case 'ES':
				$spain = 'active';
				break;
			case 'FR':
				$france = 'active';
				break;
			case 'EN':
			default:
				$usa = 'active';
				break;
		}
	else:
		// handle language start
		$brtext = new Translator('EN');
		$usa = 'active';
	endif;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo $pageTitle; ?></title>
		<meta name="robots" content="index,follow">
		<meta name="description" content="Black Rabbit Free Joomla Component Creator for Joomla 2.5 or 3.0">
		<meta name="keywords" content="joomla, free, component, creator, joomla 2.5, joomla 3.0, extension, configuration, developement, generator, builder">
		<meta name="author" content="Caleb Nance">

		<!-- Facebook Meta Tags -->
		<meta property="og:title" content="Black Rabbit">
		<meta property="og:image" content="">
		<meta property="og:site_name" content="Black Rabbit Joomla Component Creator">

		<!-- Le styles -->
		<link href="template/assets/css/bootstrap.min.css<?php echo '?v=' . $br_version; ?>" rel="stylesheet">
		<link href="template/assets/css/bootstrap-responsive.min.css<?php echo '?v=' . $br_version; ?>" rel="stylesheet">
		<link href="template/assets/css/font-awesome.min.css<?php echo '?v=' . $br_version; ?>" rel="stylesheet">
		<link href="template/assets/css/style.min.css<?php echo '?v=' . $br_version; ?>" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800' rel='stylesheet' type='text/css'>

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script src="template/assets/js/html5shiv.js"></script>
		<![endif]-->
	</head>
	<body>
		<?php
		// print at top of page
	 	if(DEBUG):
	 		echo '<div class="debug">IN DEBUG MODE</div>';
	 	endif;
	 	?>
	 	<div id="top-anchor"></div>
	 	<!-- NAVBAR
		================================================== -->
		<div class="banner navbar navbar-static-top navbar-inverse">
			<div class="navbar-inner">
				<div class="container">
					<nav id="slide-menu" class="visible-phone">
						<div class="menu-trigger"><i class="icon-reorder white icon-2x"></i></div>
						<ul class="hide">
							<li <?php echo $home; ?>><a href="index.php"><?php echo $brtext->__('HOME'); ?></a></li>
							<li <?php echo $about; ?>><a href="about-joomla-component-creator.php"><?php echo $brtext->__('ABOUT'); ?></a></li>
							<?php
							if($loggedin) {
							?>
							<li><a href="logout.php"><?php echo $brtext->__('LOGOUT'); ?></a></li>
							<?php
							} else {
							?>
							<li <?php echo $login; ?>><a href="login.php"><?php echo $brtext->__('LOGIN'); ?></a></li>
							<?php
							}
							?>
							<li <?php echo $signup; ?>><a href="sign-up.php"><?php echo $brtext->__('SIGNUP'); ?></a></li>
							<li <?php echo $history; ?>><a href="release-history.php"><?php echo $brtext->__('RELEASEHISTORY'); ?></a></li>
							<li <?php echo $tutorial; ?>><a href="tutorials.php"><?php echo $brtext->__('TUTORIALS'); ?></a></li>
							<li <?php echo $faqs; ?>><a href="faqs.php"><?php echo $brtext->__('FAQS'); ?></a></li>
							<li <?php echo $development; ?>><a href="development.php">Development</a></li>
							<li <?php echo $contributors; ?>><a href="contributors.php">Contributors</a></li>
							<li <?php echo $testimonials; ?>><a href="testimonials.php">Testimonials</a></li>
							<li <?php echo $terms; ?>><a href="terms.php">Terms</a></li>
							<?php
							if($loggedin):
							?>
							<li <?php echo $dashboard; ?>><a href="dashboard.php"><?php echo $brtext->__('DASHBOARD'); ?></a></li>
							<li <?php echo $components; ?>><a href="components.php"><?php echo $brtext->__('COMPONENTS'); ?></a></li>
							<li <?php echo $modules; ?>><a href="modules.php"><?php echo $brtext->__('MODULES'); ?></a></li>
							<?php
							endif;
							?>
							<li <?php echo $contact; ?>><a href="contact.php"><?php echo $brtext->__('CONTACT'); ?></a></li>
						</ul>
					</nav>
					<a class="brand" href="index.php">Black Rabbit v.<?php echo $br_version; ?></a>
					<!-- Responsive Navbar -->
					<div id="nav-main" class="hidden-phone">
						<ul id="menu" class="nav">
							<li <?php echo $home; ?>><a href="index.php"><?php echo $brtext->__('HOME'); ?></a></li>
							<li <?php echo $about; ?>><a href="about-joomla-component-creator.php"><?php echo $brtext->__('ABOUT'); ?></a></li>
							<?php
							if($loggedin) {
							?>
							<li><a href="logout.php"><?php echo $brtext->__('LOGOUT'); ?></a></li>
							<?php
							} else {
							?>
							<li <?php echo $login; ?>><a href="login.php"><?php echo $brtext->__('LOGIN'); ?></a></li>
							<?php
							}
							?>
							<li <?php echo $signup; ?>><a href="sign-up.php"><?php echo $brtext->__('SIGNUP'); ?></a></li>
							<li <?php echo $history; ?>><a href="release-history.php"><?php echo $brtext->__('RELEASEHISTORY'); ?></a></li>

							<li class="dropdown<?php echo $help; ?>">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $brtext->__('HELP'); ?> <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li <?php echo $tutorial; ?>><a href="tutorials.php"><?php echo $brtext->__('TUTORIALS'); ?></a></li>
									<li <?php echo $faqs; ?>><a href="faqs.php"><?php echo $brtext->__('FAQS'); ?></a></li>
									<li <?php echo $contributors; ?>><a href="contributors.php">Contributors</a></li>
									<li <?php echo $testimonials; ?>><a href="testimonials.php">Testimonials</a></li>
									<li <?php echo $development; ?>><a href="development.php">Development</a></li>
									<li <?php echo $terms; ?>><a href="terms.php">Terms</a></li>
								</ul>
							</li>
							<?php
							if($loggedin):
							?>
							<li class="dropdown<?php echo $manager; ?>">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $brtext->__('MANAGER'); ?><b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li <?php echo $dashboard; ?>><a href="dashboard.php"><?php echo $brtext->__('DASHBOARD'); ?></a></li>
									<li <?php echo $components; ?>><a href="components.php"><?php echo $brtext->__('COMPONENTS'); ?></a></li>
									<li <?php echo $modules; ?>><a href="modules.php"><?php echo $brtext->__('MODULES'); ?></a></li>
								</ul>
							</li>
							<?php
							endif;
							?>
							<li <?php echo $contact; ?>><a href="contact.php"><?php echo $brtext->__('CONTACT'); ?></a></li>
						</ul>
					</div><!--/.nav-collapse -->
				</div> <!-- /.container -->
			</div><!-- /.navbar-inner -->
		</div><!-- /.navbar -->
		<div id="login-area">
			<div id="login-area-btn"><i class="icon icon-chevron-right"></i></div>
			<div id="login-area-form" class="hide">
			 	<form id="language-select" action="create.php" method="post">
					<div id="language-choice" class="btn-group pull-right">
						<button type="submit" value="EN" name="submit" class="btn <?php echo $usa; ?>"><img src="images/languages/usa.jpg" /></button>
						<button type="submit" value="ES" name="submit" class="btn <?php echo $spain; ?>"><img src="images/languages/es.jpg" /></button>
						<button type="submit" value="DE" name="submit" class="btn <?php echo $germany; ?>"><img src="images/languages/de.jpg" /></button>
						<button type="submit" value="FR" name="submit" class="btn <?php echo $france; ?>"><img src="images/languages/fr.jpg" /></button>
						<input type="hidden" name="task" value="setlanguage" />
						<?php
						$returnUrl = urlencode(array_pop(explode('/', $_SERVER['SCRIPT_NAME'])));
						?>
						<input type="hidden" name="return" value="<?php echo $returnUrl; ?>" />
						<div class="clearfix"></div>
					</div>
				</form>
				<div class="clearfix"></div>
				<?php
				if(!$loggedin):
				?>
				<a href="#login" role="button" class="btn btn-info login" data-toggle="modal"><i class="icon icon-lock icon-white"></i> <?php echo $brtext->__('LOGIN'); ?></a>
				<?php
				else:
				?>
				<a href="logout.php" class="btn btn-info login"><i class="icon icon-off icon-white"></i> <?php echo $brtext->__('LOGOUT'); ?></a>
				<?php
				endif;
				if(!$loggedin):
				?>
				<div id="login" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h3 id="loginLabel"><?php echo $brtext->__('LOGIN'); ?></h3>
					</div><!-- /modal-header -->
					<div class="modal-body">
						<form class="form-inline" action="login.php" method="post">
							<input type="text" id="modal-email" name="email" class="input-medium" placeholder="Email">
							<input type="password" id="modal-password" name="password" class="input-medium" placeholder="Password">
							<button type="submit" class="btn btn-info"><?php echo $brtext->__('LOGIN'); ?></button>
						</form>
					</div><!-- /modal-body -->
					<div class="modal-footer">
						<?php echo $brtext->__('NOTAMEMBER'); ?>
						<a href="sign-up.php" class="btn btn-success"><?php echo $brtext->__('CREATEANACCOUNT'); ?></a>
					</div><!-- /modal-footer -->
				</div><!-- /login -->
				<?php
				endif;
				?>
			</div><!-- /#login-area-form -->
		</div><!-- /#login-area -->
