<?php
/*********
 * Black Rabbit Component Creator
 * by Caleb Nance
 */
 
	session_start();

	// Display errors on localhost
	$whitelist = array('locathost');
	if(!in_array($_SERVER['SERVER_NAME'], $whitelist)){
		//this is localhost!
		ini_set('display_errors', 1);
		//error_reporting(E_ALL);
		error_reporting(E_ALL ^ E_NOTICE);
	}

	/*
	 *	Variables
	 */
	$post		= $_POST;
	$task		= $post['task'];

	// Posted data
	$posted_date = date('Y-m-d H:i:s');

	/*
	 *	Include Config and Database
	 */
	require_once('master.php');

	// Connect to database
	$database = new Database(HOST, DBNAME, DBUSER, DBPASS);

	/**
	 *	Lets set the language session!
	 *
	 */
	if($task == 'setlanguage'):
		Filehelper::languagesession($post['submit'], $post['return']);
		exit();
	endif;

	// Set Black Rabbit Version
	$br_version	= $post['brversion'];

	if(DEBUG):
		/*
		$database->truncate('br_components');
		$database->truncate('br_components_views');
		$database->truncate('br_components_images');
		$database->truncate('br_components_version_history');
		*/
		//echo '<div class="debug">Databases could have been truncated!!! Add this feature somewhere, Caleb?</div>';
	endif;

	/*
	 *	Download helloworld task
	 */
	if($task == 'download'):

		$helloworldscheck = $database->select('br_helloworlds', '*', 'version="'.$post['version'].'" AND jversion="'.$post['jversion'].'"', 'object');

		// is it in the database?
		if(count($helloworldscheck) > 0):
			$downloadcount = $helloworldscheck[0]->downloadcount + 1;
			$helloworlds_record = array (
				'downloadcount' => $downloadcount,
				'lastdownloaded' => $posted_date
			);
			$database->update('br_helloworlds', $helloworlds_record, 'version="'.$post['version'].'" AND jversion="'.$post['jversion'].'"');
		else:
			$helloworlds_record = array (
				'version' => $post['version'],
				'jversion' => $post['jversion'],
				'downloadcount' => 1,
				'lastdownloaded' => $posted_date
			);
			$database->insert('br_helloworlds', $helloworlds_record);
		endif;

		// Which package do they want to download?
		if($post['jversion'] == '2.5'):
			header('location: examples/'.LCOMP25);
		elseif($post['jversion'] == '3.0'):
			header('location: examples/'.LCOMP30);
		elseif($post['jversion'] == '3.2'):
			header('location: examples/'.LCOMP32);
		endif;

		exit();
	endif;

	/*
	 *	Download allfields task
	 */
	if($task == 'download_allfields'):

		$allfieldscheck = $database->select('br_allfields', '*', 'version="'.$post['version'].'" AND jversion="'.$post['jversion'].'"', 'object');

		// is it in the database?
		if(count($allfieldscheck) > 0):
			$downloadcount = $allfieldscheck[0]->downloadcount + 1;
			$allfields_record = array (
				'downloadcount' => $downloadcount,
				'lastdownloaded' => $posted_date
			);
			$database->update('br_allfields', $allfields_record, 'version="'.$post['version'].'" AND jversion="'.$post['jversion'].'"');
		else:
			$allfields_record = array (
				'version' => $post['version'],
				'jversion' => $post['jversion'],
				'downloadcount' => 1,
				'lastdownloaded' => $posted_date
			);
			$database->insert('br_allfields', $allfields_record);
		endif;

		// Which package do they want to download?
		if($post['jversion'] == '2.5'):
			header('location: examples/'.LAFCOMP25);
		elseif($post['jversion'] == '3.0'):
			header('location: examples/'.LAFCOMP30);
		elseif($post['jversion'] == '3.2'):
			header('location: examples/'.LAFCOMP32);
		endif;

		exit();
	endif;

	/*
	 *	Component download and record it in the database
	 */
	if($task == 'cdownload'):
		session_start();
		if($post['cid'] && $_SESSION['uid']):
			$getComponent = $database->select('br_components', '*', 'id="'.$post['cid'].'" AND uid="'.$_SESSION['uid'].'"', 'object');
			if($getComponent):
				// create the path to the file and save the download counter
				$getComponent			= $getComponent[0];
				$componentDownload		= 'users' . DS . $getComponent->uid . DS . $getComponent->id . DS . $getComponent->c_file_name;
				$downloadcount			= $getComponent->downloadcount + 1;
				$getComponentUpdate		= array ('downloadcount' => $downloadcount);

				$database->update('br_components', $getComponentUpdate, 'id="'.$post['cid'].'" AND uid="'.$_SESSION['uid'].'"');
				header('Location: ' . $componentDownload);
				exit();
			else:
				header('Location: components.php?msg=2');
				exit();
			endif;
		else:
			header('Location: components.php?msg=1');
			exit();
		endif;
	endif;

	/**
	 *	Lets delete managed components that the user does not want anymore
	 *	from the file system and the database.. delete all history of the component!
	 */
	if($task == 'cdelete'):
		session_start();
		if($post['cid'] && $_SESSION['uid']):
			// Get all references first of this component for the user
			$getComponent		= $database->select('br_components', '*', 'id="'.$post['cid'].'" AND uid="'.$_SESSION['uid'].'"', 'object');
			$getComponentViews	= $database->select('br_components_views', '*', 'cid="'.$post['cid'].'"', 'object');
			$dComponentFolder	= 'users' . DS . $_SESSION['uid'] . DS . $post['cid'] . DS;

			// if this is a component and is owned by user
			if($getComponent):

				$getComponents	= $database->select('br_components', '*', 'cidparent="'.$post['cid'].'" AND uid="'.$_SESSION['uid'].'"', 'object');

				// Check if the views are there, if so parse through and delete them
				if($getComponentViews):
					foreach($getComponentViews as $dComponentViews):
						$database->delete('br_components_views', $dComponentViews->id);
					endforeach;
				endif;

				// if more views, delete them
				if($getComponents):

					foreach($getComponents as $dComponent):
						$dComponentsFolder	= 'users' . DS . $_SESSION['uid'] . DS . $dComponent->id . DS;
						$dComponentsViews	= $database->select('br_components_views', '*', 'cid="'.$dComponent->id.'"', 'object');
						// Now delete the files first then folders
						//FileHelper::deleteDir($dComponentsFolder);
						// Now lets delete the entries in the database
						$database->delete('br_components', $dComponent->id);

						// Check if the views are there, if so parse through and delete them
						if($dComponentsViews):
							foreach($dComponentsViews as $dComponentView):
								$database->delete('br_components_views', $dComponentView->id);
							endforeach;
						endif;
					endforeach;

				endif;
				FileHelper::deleteDir($dComponentFolder);
				$database->delete('br_components', $post['cid']);

				header('Location: components.php?msg=3');
				exit();
			endif;
		else:
			header('Location: components.php?msg=1');
			exit();
		endif;
		exit();
	endif;

	/**
	 *	Formatting
	 */
	$return = "\n";
	$tab1 = '	';
	$tab2 = '		';
	$tab3 = '			';
	$tab4 = '				';
	$tab5 = '					';
	$tab6 = '						';
	$tab7 = '							';
	$tab8 = '								';
	$space2 = '  ';

	/*
	 *	Default Component variables
	 */
	$joomla_version 			= $post['jversion'];
	$component_name 			= $post['componentname'];
	$component_main_view 		= FileHelper::safeString($post['filename']);
	$component_main_view_cap	= ucwords($component_main_view);
	$com_main_view				= 'com_' . $component_main_view;
	$com_language				= strtoupper($com_main_view);
	$com_language_menu			= $com_language . '_MENU';
	$created_date				= date('F d, Y');
	$author						= $post['author'];
	$authoremail				= $post['authoremail'];
	$authorurl					= $post['authorurl'];
	$copyright					= $post['copyright'];
	$license					= $post['license'];
	$version					= $post['version'];
	$description				= $post['description'];
	$views						= $post['view'];
	$cidparent					= $post['cidparent'];
	$includeCat					= 0;
	$includeTags				= 0;

	// le Zip Array()
	$filestozip					= array();

	// Lines created Array()
	$totallinescreated			= array();

	// Categories check
	if(array_key_exists('includeCat', $post)):
		$includeCat = 1;
	endif;

	// Tags check - Joomla 3.1
	if(array_key_exists('includeTags', $post)):
		$includeTags = 1;
	endif;

	// start - added v.0.6.0
	$imagesUploaded = 0;
	// Check if images are uploaded, get them and set the array for them to be added.
	if(isset($post['imagesUploaded'])):
		$imagesUploaded			= $post['imagesUploaded'];
		$newImagesUploaded		= array();
		foreach($imagesUploaded as $viewKey=>$imageUpload):
			$imageUploadParts	= explode('.',$imageUpload);
			$imageUploadExt		= array_pop($imageUploadParts);
			$imageUploadExt		= strtolower($imageUploadExt);
			$imageUploadRestof	= implode('.', $imageUploadParts);
			$newImagesUploaded[$viewKey]		= (object) array();
			$newImagesUploaded[$viewKey]->orig	= $imageUpload;
			$newImagesUploaded[$viewKey]->mana	= $imageUploadRestof . '-48x48.' . $imageUploadExt;
			$newImagesUploaded[$viewKey]->menu	= $imageUploadRestof . '-16x16.' . $imageUploadExt;
		endforeach;
		$imagesUploaded = $newImagesUploaded;
	endif;
	// end - added v.0.6.0

	// Create object
	$varObject					= (object) array();
	$varObject->cidparent		= $cidparent;
	$varObject->j_version		= $joomla_version;
	$varObject->comp_name		= $component_name;
	$varObject->comp_m_view 	= $component_main_view;
	$varObject->comp_m_view_cap	= $component_main_view_cap;
	$varObject->com_main		= $com_main_view;
	$varObject->created			= $created_date;
	$varObject->author			= $author;
	$varObject->a_email			= $authoremail;
	$varObject->a_url			= str_replace('http://', '', $authorurl);
	$varObject->copyright		= $copyright;
	$varObject->license			= $license;
	$varObject->version			= $version;
	$varObject->description		= $description;
	$varObject->includeCat		= $includeCat;
	$varObject->includeTags		= $includeTags;
	$varObject->views			= $views;
	$varObject->allViews		= array();
	$varObject->formFields		= array();
	$varObject->imagesUploaded	= $imagesUploaded;


	/********** NEED TO PARSE THROUGH IMAGE TYPE FIELDS AND HAVE THEM AS A SEPERATE ARRAY? OR JUST A MARKER AND PARSE THROUGH ALL FIELDS SET>>> YES *************/

	/*
	 *	Check if
	 *		- Date Created/Modified
	 *		- User Created/Modified
	 */
	$varObject->usermodified	= 0;
	$varObject->datemodified	= 0;
	if($post['use-usermodified']):
		$varObject->usermodified	= 1;
	endif;
	if($post['use-datemodified']):
		$varObject->datemodified	= 1;
	endif;

	/*
	 * Format all view variations
	 */
	// start - added v.0.6.0
	if($views):
		// Parse through all views, and create each variation
		// of the view ALSO add each image to view and create css
		// lines for css file on administrator side
		$view_count = 0;
		foreach($views as $view):
			$singular = 0;
			$varObject->allViews[$view_count]['plural']['orig']		= $view;
			$varObject->allViews[$view_count]['plural']['cap']		= ucwords($view);
			$varObject->allViews[$view_count]['plural']['safe']		= FileHelper::safeString($view);
			$varObject->allViews[$view_count]['plural']['language']	= strtoupper($varObject->allViews[$view_count]['plural']['safe']);
			// Check plural and create
			if($post['view-single'][$view_count]):
				$singular = $post['view-single'][$view_count];
				// Main view can't equal the singular view
				if($singular != $view):
					$singular	= $singular;
				else:
					$singular	= substr($view, 0, -1);
				endif;
			else:
				$singular		= substr($view, 0, -1);
			endif;
			$varObject->allViews[$view_count]['singular']['orig']		= $singular;
			$varObject->allViews[$view_count]['singular']['cap']		= ucwords($singular);
			$varObject->allViews[$view_count]['singular']['safe']		= FileHelper::safeString($singular);
			$varObject->allViews[$view_count]['singular']['language']	= strtoupper($varObject->allViews[$view_count]['singular']['safe']);
			$view_count++;
		endforeach;
	endif;
	// end - added v.0.6.0

	// Language variables
	$varObject->com_language		= $com_language;
	$varObject->com_language_menu	= $com_language_menu;
	$extraLanguageLines				= array();
	$extraSysLanguageLines			= array();

	// Display variables
	$varObject->tab1			= $tab1;
	$varObject->tab2			= $tab2;
	$varObject->tab3			= $tab3;
	$varObject->tab4			= $tab4;
	$varObject->tab5			= $tab5;
	$varObject->tab6			= $tab6;
	$varObject->tab7			= $tab7;
	$varObject->tab8			= $tab8;
	$varObject->space2			= $space2;
	$varObject->return			= $return;

	// Handle Joomla Versions
	if($varObject->j_version == '2.5.0'):
		$varObject->j_controller 						= 'JController';
		$varObject->j_controller_display_function		= 'function display($cachable = false)';
		$varObject->j_controller_display_function		= 'function display($cachable = false, $urlparams = false)'; // new for Joomla 2.5.7
		$varObject->j_helper_sub_menu_type				= 'JSubMenuHelper';
		$varObject->j_model								= 'JModel';
		$varObject->j_model_form						= 'JModelForm';
		$varObject->j_model_item						= 'JModelItem';
		$varObject->j_table_getassetparentid_function	= 'protected function _getAssetParentId()';
		$varObject->j_view								= 'JView';
		$varObject->j_view_single_view_html_hide_menu	= 'JRequest::setVar(\'hidemainmenu\', true);';
		$varObject->j_clear_class						= 'clr';
	elseif($varObject->j_version == '3.0' || $varObject->j_version == '3.2'):
		$varObject->j_controller						= 'JControllerLegacy';
		$varObject->j_controller_display_function		= 'function display($cachable = false, $urlparams = false)';
		$varObject->j_helper_sub_menu_type				= 'JHtmlSidebar';
		$varObject->j_model								= 'JModelLegacy';
		$varObject->j_model_form						= 'JModelFormLegacy';
		$varObject->j_model_item						= 'JModelItem';
		$varObject->j_table_getassetparentid_function	= 'protected function _getAssetParentId($table = null, $id = null)';
		$varObject->j_view								= 'JViewLegacy';
		$varObject->j_view_single_view_html_hide_menu	= 'JFactory::getApplication()->input->set(\'hidemainmenu\', true);';
		$varObject->j_clear_class						= 'clearfix';
	endif;

	/*
	 *	Delete old folders and files (1 day old)
	 */
	$dir = dirname(__FILE__).'/output/';
	// Check to make sure it is a directory
	if (is_dir($dir)):
		// Can we open the directory?
	    if ($dh = opendir($dir)):
	    	// Filter through the directory
	        while (($file = readdir($dh)) !== false) {
	        	// Get type of file
	        	$typedir = filetype($dir . $file);
	        	// Check the type is a folder (directory)
	        	if($typedir == 'dir' && $file != '.' && $file != '..'):
	        		$foldertocheck = explode('-', $file);
	        		$daycreated = $foldertocheck[0];
	        		// Is the folder a day old or more? Then delete it off the server
	        		if(strtotime($daycreated)< strtotime('-1 days')):
	        			$dirpath = $dir . $file;
	        			FileHelper::deleteDir($dirpath);
	        		endif;
		        endif;
	        }
	        closedir($dh);
	    endif;
	endif;

	/*
	 *	Create Task
	 */
	if($task == 'create'):

		/*
		 *	Check to make sure there are fields filled out, if not redirect with message.
		 */

		if(empty($post['componentname'])):
			header('location:index.php?msg=1');
			exit();
		elseif(empty($post['author'])):
			header('location:index.php?msg=1');
			exit();
		elseif(empty($post['authoremail'])):
			header('location:index.php?msg=1');
			exit();
		elseif(empty($post['authorurl'])):
			header('location:index.php?msg=1');
			exit();
		elseif(empty($post['copyright'])):
			header('location:index.php?msg=1');
			exit();
		elseif(empty($post['license'])):
			header('location:index.php?msg=1');
			exit();
		elseif(empty($post['version'])):
			header('location:index.php?msg=1');
			exit();
		elseif(empty($post['description'])):
			header('location:index.php?msg=1');
			exit();
		endif;

		/*
		 *	Check to make sure the database needs to be used
		 *	- two things need to happen
		 *		- check if they have selected no
		 *		- or check if the database is not filled in
		 */
		// start - added v.0.6.0
		$useDatabase = 1;
		if($post['usedatabase'] == 1):
			if(array_key_exists('main-view-table-field', $post)):
				if(empty($post['main-view-table-field'][0])):
					$useDatabase = 0;
				endif;
			else:
				$useDatabase = 0; // if there is no main-view-table-field, don't use database
			endif;
		else:
			$useDatabase = 0;
		endif;
		$varObject->useDatabase = $useDatabase;
		// end - added v.0.6.0

		// Image upload form fields
		$varObject->imageUpload = 0;
		$varObject->imageFields = array();
		$varObject->imageHeight = $post['image-height'];
		$varObject->imageWidth	= $post['image-width'];
		$varObject->imageThumbHW= $post['image-thumb-height-width'];
		$view_count = 0;
		foreach($varObject->allViews as $view):
			// Check if view is not categories and not category
			if($view['plural']['safe'] != 'categories' && $view['plural']['safe'] != 'category'):
				// start - added v.0.6.0
				if($varObject->useDatabase):
					if($view_count == 0):
						$name = $post['main-view-table-field'];
						$type = $post['main-view-table-fieldtype'];
						foreach($type as $k=>$ty):
							if($ty == 'file'):
								$varObject->imageUpload = 1;
								$imageFieldName = preg_replace('/[^A-Za-z0-9]/', ' ', $post['main-view-table-field'][$k]);
								$imageFieldNameSafe = strtolower(str_replace(' ', '', $imageFieldName));
								$varObject->imageFields[$view_count][] = array(
									'fieldname' => $imageFieldName,
									'fieldnamesafe' => $imageFieldNameSafe
								);
							endif;
						endforeach;
					else:
						// Rest of the views fields
						if(array_key_exists('view-'.$view_count.'-field', $post)):
							$name = $post['view-'.$view_count.'-field'];
							$type = $post['view-'.$view_count.'-fieldtype'];
							foreach($type as $k=>$ty):
								if($ty == 'file'):
									$varObject->imageUpload = 1;
									$imageFieldName = preg_replace('/[^A-Za-z0-9]/', ' ', $post['view-'.$view_count.'-field'][$k]);
									$imageFieldNameSafe = strtolower(str_replace(' ', '', $imageFieldName));
									$varObject->imageFields[$view_count][] = array(
										'fieldname' => $imageFieldName,
										'fieldnamesafe' => $imageFieldNameSafe
									);
								endif;
							endforeach;
						endif;
					endif;
					$view_count++;
				endif;
			endif;
		endforeach;

		// start - added v.1.1.5
		// Category view form fields
		if($varObject->includeCat):
			$varObject->categoryView = 0;
			$varObject->categoryViewFields = array();
			$view_count = 0;
			foreach($varObject->allViews as $view):
				// Check if view is not categories and not category
				if($view['plural']['safe'] != 'categories' && $view['plural']['safe'] != 'category'):
					// start - added v.0.6.0
					if($varObject->useDatabase):
						if($view_count == 0):
							$name = $post['main-view-table-field'];
							$type = $post['main-view-table-fieldtype'];
							foreach($type as $k=>$ty):
								if($ty == 'category'):
									$varObject->categoryView = 1;
									$varObject->categoryViewFields[$view_count] = array(
										'plural' => array(
											'view_cap'	=> $view['plural']['cap'],
											'view_safe' => $view['plural']['safe'],
											'view_lang' => $view['plural']['language']
										),
										'singular' => array(
											'view_cap'	=> $view['singular']['cap'],
											'view_safe' => $view['singular']['safe'],
											'view_lang' => $view['singular']['language']
										),
									);
								endif;
							endforeach;
						else:
							// Rest of the views fields
							if(array_key_exists('view-'.$view_count.'-field', $post)):
								$name = $post['view-'.$view_count.'-field'];
								$type = $post['view-'.$view_count.'-fieldtype'];
								foreach($type as $k=>$ty):
									if($ty == 'category'):
										$varObject->categoryView = 1;
										$varObject->categoryViewFields[$view_count] = array(
											'plural' => array(
												'view_cap'	=> $view['plural']['cap'],
												'view_safe' => $view['plural']['safe'],
												'view_lang' => $view['plural']['language']
											),
											'singular' => array(
												'view_cap'	=> $view['plural']['cap'],
												'view_safe' => $view['plural']['safe'],
												'view_lang' => $view['plural']['language']
											),
										);
									endif;
								endforeach;
							endif;
						endif;
						$view_count++;
					endif;
				endif;
			endforeach;
		endif;
		// end - added v.1.1.5
		/*
		 *	Check folder exists
		 */

		$folder = OUTPUTDIR;
		FileHelper::foldercheck($folder);

		/*
		 *	Create the install files
		 */
		$installlines	= Files::installFile($varObject);
		$scriptlines	= Files::scriptFile($varObject, 'script.php');

		/*
		 * Create index file
		 */
		$indexlines[]		= Files::indexFile();

		/*
		 *	Create ALL the admin files!!!!1
		 */
		$access				= AdminFiles::accessFile($varObject);
		$config				= AdminFiles::configFile($varObject);
		$componentlines 	= AdminFiles::componentFile($varObject);
		$controllerlines	= AdminFiles::controllerFile($varObject, 'controller.php');
		$helperlines		= AdminFiles::helperFile($varObject);

		/*
		 *	Create ALL the site files!!!!1
		 */
		$sitecontrollerlines	= SiteFiles::controllerFile($varObject, 'controller.php');
		$sitecomponentlines		= SiteFiles::componentFile($varObject);
		$sitehelperlines		= SiteFiles::helperFile($varObject);
		$siterouterlines		= SiteFiles::routerFile($varObject, 'router.php');

		/*
		 *	Start of File Package Creation
		 */

		// Set folders top level
		$dated					= date('Ymd-His');
		$datedfolder			= $folder . $dated . DS;
		$adminfolder			= $datedfolder . 'admin' . DS;
		$sitefolder				= $datedfolder . 'site' . DS;

		// Set folders for admin folder
		$adminassets			= $adminfolder . 'assets' . DS;
		$adminassetscss			= $adminassets . 'css' . DS;
		$adminassetsimages		= $adminassets . 'images' . DS; // added v.0.6.0
		$adminassetsimagesicons	= $adminassetsimages . 'icons' . DS; // added v.0.6.0
		$adminassetsjs			= $adminassets . 'js' . DS;
		$admincontrollers		= $adminfolder . 'controllers' . DS;
		$adminhelpers			= $adminfolder . 'helpers' . DS;
		$adminlanguage			= $adminfolder . 'language' . DS;
		$adminlanguageengb		= $adminlanguage . 'en-GB' . DS;
		$adminmodels			= $adminfolder . 'models' . DS;

		// start - added v.0.6.0
		if($varObject->useDatabase):
			$adminmodelsfields		= $adminmodels . 'fields' . DS;
			$adminmodelsforms		= $adminmodels . 'forms' . DS;
			$adminmodelsrules		= $adminmodels . 'rules' . DS;
			$adminsql				= $adminfolder . 'sql' . DS;
			$adminsqlupdates		= $adminsql . 'updates' . DS;
			$adminsqlupdatesmysql	= $adminsqlupdates . 'mysql' . DS;
			$admintables			= $adminfolder . 'tables' . DS;
		endif;
		// end - added v.0.6.0

		$adminviews				= $adminfolder . 'views' . DS;

		// Set folders for site folder
		$siteassets				= $sitefolder . 'assets' . DS;
		$siteassetscss			= $siteassets . 'css' . DS;
		$siteassetsjs			= $siteassets . 'js' . DS;
		$sitehelpers			= $sitefolder . 'helpers' . DS;
		$sitemodels				= $sitefolder . 'models' . DS;
		$siteviews				= $sitefolder . 'views' . DS;

		// Check/Create folders
		FileHelper::foldercheck($datedfolder);
		// Admin folders
		FileHelper::foldercheck($adminfolder);
		FileHelper::foldercheck($adminassets);
		FileHelper::foldercheck($adminassetscss);
		FileHelper::foldercheck($adminassetsimages); // added v.0.6.0
		FileHelper::foldercheck($adminassetsimagesicons); // added v.0.6.0
		FileHelper::foldercheck($adminassetsjs);
		FileHelper::foldercheck($admincontrollers);
		FileHelper::foldercheck($adminhelpers);
		FileHelper::foldercheck($adminlanguage);
		FileHelper::foldercheck($adminlanguageengb);
		FileHelper::foldercheck($adminmodels);

		// start - added v.0.6.0
		if($varObject->useDatabase):
			FileHelper::foldercheck($adminmodelsfields);
			FileHelper::foldercheck($adminmodelsforms);
			FileHelper::foldercheck($adminmodelsrules);
			FileHelper::foldercheck($adminsql);
			FileHelper::foldercheck($adminsqlupdates);
			FileHelper::foldercheck($adminsqlupdatesmysql);
			FileHelper::foldercheck($admintables);
		endif;
		// end - added v.0.6.0

		FileHelper::foldercheck($adminviews);

		$filestozip[] = $adminfolder;
		$filestozip[] = $adminassets;
		$filestozip[] = $adminassetscss;
		$filestozip[] = $adminassetsimages; // added v.0.6.0
		$filestozip[] = $adminassetsimagesicons; // added v.0.6.0
		$filestozip[] = $adminassetsjs;
		$filestozip[] = $admincontrollers;
		$filestozip[] = $adminhelpers;
		$filestozip[] = $adminlanguage;
		$filestozip[] = $adminlanguageengb;
		$filestozip[] = $adminmodels;
		$filestozip[] = $adminmodelsfields;
		$filestozip[] = $adminmodelsforms;
		$filestozip[] = $adminmodelsrules;
		$filestozip[] = $adminsql;
		$filestozip[] = $adminsqlupdates;
		$filestozip[] = $adminsqlupdatesmysql;
		$filestozip[] = $admintables;
		$filestozip[] = $adminviews;

		// Site folders
		FileHelper::foldercheck($sitefolder);
		FileHelper::foldercheck($siteassets);
		FileHelper::foldercheck($siteassetscss);
		FileHelper::foldercheck($siteassetsjs);
		FileHelper::foldercheck($sitehelpers);
		FileHelper::foldercheck($sitemodels);
		FileHelper::foldercheck($siteviews);

		$filestozip[] = $sitefolder;
		$filestozip[] = $siteassets;
		$filestozip[] = $siteassetscss;
		$filestozip[] = $siteassetsjs;
		$filestozip[] = $sitehelpers;
		$filestozip[] = $sitemodels;
		$filestozip[] = $siteviews;

		// Set filenames
		$indexfile		= 'index.html';

		// Install filenames
		$installfile	= $datedfolder . $varObject->comp_m_view . '.xml';
		$scriptfile		= $datedfolder . 'script.php';

		// Admin filenames
		$accessfile				= $adminfolder . 'access.xml';
		$configfile				= $adminfolder . 'config.xml';
		$componentfile			= $adminfolder . $varObject->comp_m_view . '.php';
		$controllerfile			= $adminfolder . 'controller.php';
		$cssfile				= $adminassetscss . $varObject->comp_m_view . '.css';
		$jsfile					= $adminassetsjs . $varObject->comp_m_view . '.js';
		$helperfile				= $adminhelpers . $varObject->comp_m_view . '.php';
		$languagefile			= $adminlanguageengb . 'en-GB.' . $varObject->com_main . '.ini';
		$languagesysfile		= $adminlanguageengb . 'en-GB.' . $varObject->com_main . '.sys.ini';

		// start - added v.0.6.0
		if($varObject->useDatabase):
			$sqlinstallfile			= $adminsql . 'install.mysql.utf8.sql';
			$sqluninstallfile		= $adminsql . 'uninstall.mysql.utf8.sql';
			$sqlupdatesmysqlfile	= $adminsqlupdatesmysql . $varObject->version . '.sql';
		endif;
		// end - added v.0.6.0

		// Site filenames
		$sitecomponentfile	= $sitefolder . $varObject->comp_m_view . '.php';
		$sitecontrollerfile	= $sitefolder . 'controller.php';
		$siterouterfile		= $sitefolder . 'router.php';
		$sitecssfile		= $siteassetscss . $varObject->comp_m_view . '.css';
		$sitejsfile			= $siteassetsjs . $varObject->comp_m_view . '.js';
		$sitehelperfile		= $sitehelpers . $varObject->comp_m_view . '.php';

		// Set index file paths
		// Admin folder
		$indexpaths[] = $adminfolder . $indexfile;
		$indexpaths[] = $adminassets . $indexfile;
		$indexpaths[] = $adminassetscss . $indexfile;
		$indexpaths[] = $adminassetsimages . $indexfile; // added v.0.6.0
		$indexpaths[] = $adminassetsimagesicons . $indexfile; // added v.0.6.0
		$indexpaths[] = $adminassetsjs . $indexfile;
		$indexpaths[] = $admincontrollers . $indexfile;
		$indexpaths[] = $adminhelpers . $indexfile;
		$indexpaths[] = $adminlanguage . $indexfile;
		$indexpaths[] = $adminlanguageengb . $indexfile;
		$indexpaths[] = $adminmodels . $indexfile;

		// start - added v.0.6.0
		if($varObject->useDatabase):
			$indexpaths[] = $adminsql . $indexfile;
			$indexpaths[] = $adminsqlupdates . $indexfile;
			$indexpaths[] = $adminsqlupdatesmysql . $indexfile;
			$indexpaths[] = $admintables . $indexfile;
		endif;
		// end - added v.0.6.0

		$indexpaths[] = $adminviews . $indexfile;
		// Site folder
		$indexpaths[] = $sitefolder . $indexfile;
		$indexpaths[] = $siteassets . $indexfile;
		$indexpaths[] = $siteassetscss . $indexfile;
		$indexpaths[] = $siteassetsjs . $indexfile;
		$indexpaths[] = $sitehelpers . $indexfile;
		$indexpaths[] = $sitemodels . $indexfile;
		$indexpaths[] = $siteviews . $indexfile;

		// Admin Views
		$view_count = 0;
		foreach($varObject->allViews as $view):

			// Check if view is not categories and not category
			if($view['plural']['safe'] != 'categories' && $view['plural']['safe'] != 'category'):

				// Handle the form fields
				$formfields = (object) array();

				// start - added v.0.6.0
				if($varObject->useDatabase):
					if($view_count == 0):
						// Main view fields
						$formfields->name		= $post['main-view-table-field'];
						// start - added v.1.0.0
						foreach($post['main-view-table-field'] as $field):
							$field = preg_replace('/[^A-Za-z0-9]/', ' ', $field);
							$formfields->name_safe[] = strtolower(str_replace(' ', '', $field));
						endforeach;
						// end - added v.1.0.0
						$formfields->count		= count($formfields->name);
						$formfields->type		= $post['main-view-table-fieldtype'];
						$formfields->default	= $post['main-view-table-default'];
						$formfields->show		= $post['main-view-table-show'];
						$formfields->required	= $post['main-view-table-required'];
					else:
						// Rest of the views fields
						if(array_key_exists('view-'.$view_count.'-field', $post)):
							// View fields
							$formfields->name		= $post['view-'.$view_count.'-field'];
							// start - added v.1.0.0
							foreach($post['view-'.$view_count.'-field'] as $field):
								$field = preg_replace('/[^A-Za-z]/', ' ', $field);
								$formfields->name_safe[] = strtolower(str_replace(' ', '', $field));
							endforeach;
							// end - added v.1.0.0
							$formfields->count		= count($formfields->name);
							$formfields->type		= $post['view-'.$view_count.'-fieldtype'];
							$formfields->default	= $post['view-'.$view_count.'-default'];
							$formfields->show		= $post['view-'.$view_count.'-show'];
							$formfields->required	= $post['view-'.$view_count.'-required'];
						endif;
					endif;
					$varObject->formFields[] = $formfields;
				endif;
				// end - v.0.6.0


				//$formfields->name			= FileHelper::safeString($formfields->name); this doesn't work because it is an object!	// added v.0.6.0

				// Add paths to index paths array()

				// start - added v.0.6.0
				if($varObject->useDatabase):
					$indexpaths[]				= $adminmodelsfields . $indexfile;
					$indexpaths[]				= $adminmodelsforms . $indexfile;
					$indexpaths[]				= $adminmodelsrules . $indexfile;
					// Create forms
					$adminmodelformsform		= $adminmodelsforms . $view['singular']['safe'] . ".xml";
					$adminmodelformsformlines	= AdminFiles::adminModelFormsForm($formfields, $varObject);

					// Create forms file
					$totallinescreated[]		= FileHelper::createFile($adminmodelformsform, $adminmodelformsformlines);
					$filestozip[]				= $adminmodelformsform;

					// Create forms .js
					$adminmodelformsformjs		= $adminmodelsforms . $view['singular']['safe'] . ".js";
					$adminmodelformsformjslines	= AdminFiles::adminModelFormsFormJS($formfields, $view, $varObject);

					// Create forms .js file
					$totallinescreated[]		= FileHelper::createFile($adminmodelformsformjs, $adminmodelformsformjslines);
					$filestozip[] 				= $adminmodelformsformjs;

					// Create form fields
					// added v.1.5.0 - fixed numeric numbers in filename
					$view_count_string			= Helpers::numtonumtext($view_count);
					$adminmodelfieldfile		= $adminmodelsfields.$varObject->comp_m_view.$view_count_string.'.php';
					$adminmodelfieldfilename	= $varObject->comp_m_view.$view_count_string;
					$adminmodelfieldlines		= AdminFiles::adminModuleFieldsField($formfields, $adminmodelfieldfilename, $view, $varObject, $view_count_string);

					// Create form fields file
					$totallinescreated[]		= FileHelper::createFile($adminmodelfieldfile, $adminmodelfieldlines);
					$filestozip[]				= $adminmodelfieldfile;

					// Create form rules
					$adminmodelrules			= AdminFiles::adminModelRulesRule($formfields, $varObject);

					// Parse through all rules for this view
					if(is_array($adminmodelrules)):
						foreach($adminmodelrules as $adminmodelrule):
							$adminmodelrulesrulelines		= array();
							$rulefilename 					= $adminmodelrule['filename'];
							$rulecount = count($adminmodelrule) - 1;

							// Create new array for model rules rule file (takes the filename line out, since we had to pass it back from the function)
							for($i = 0; $i < $rulecount; $i++):
								$adminmodelrulesrulelines[]	= $adminmodelrule[$i];
							endfor;

							// Create file, file path and add to zip array
							$adminmodelrulesrule	= $adminmodelsrules . $rulefilename;
							$totallinescreated[]	= FileHelper::createFile($adminmodelrulesrule, $adminmodelrulesrulelines);
							$filestozip[]			= $adminmodelrulesrule;
						endforeach;
					endif;

				endif;
				// end - added v.0.6.0

				// Create lines
				// Controllers
				$admincontrollerplural			= $admincontrollers . $view['plural']['safe'] . ".php";
				$admincontrollerplurallines		= AdminFiles::adminControllerPlural($view, $varObject);
				// Models
				$adminmodelplural				= $adminmodels . $view['plural']['safe'] . ".php";
				$adminmodelplurallines			= AdminFiles::adminModelPlural($view, $varObject);
				// Views
				$adminviewsview					= $adminviews . $view['plural']['safe'] . "/";
				$adminviewsviewhtml				= $adminviewsview . "view.html.php";
				$adminviewsviewtmpl				= $adminviewsview . "tmpl/";
				$adminviewsviewtmpldefault		= $adminviewsviewtmpl . "default.php";
				$adminviewsviewtmpldefaulthead	= $adminviewsviewtmpl . "default_head.php";
				$adminviewsviewtmpldefaultbody	= $adminviewsviewtmpl . "default_body.php";
				$adminviewsviewtmpldefaultfoot	= $adminviewsviewtmpl . "default_foot.php";

				// Which manager view view.html.php layout needed?
				if($varObject->j_version == '2.5.0'):
					$adminviewsviewhtmllines = AdminFiles::viewsViewHtml25($view, $varObject, 'view.html.php');
				elseif($varObject->j_version == '3.0' || $varObject->j_version == '3.2'):
					$adminviewsviewhtmllines = AdminFiles::viewsViewHtml30($view, $varObject, 'view.html.php');
				endif;

				// Which manager view default.php layout needed?
				if($varObject->j_version == '2.5.0'):
					$adminviewsviewtmpldefaultlines = AdminFiles::viewsViewDefault25($view, $varObject, 'default.php');
				elseif($varObject->j_version == '3.0' || $varObject->j_version == '3.2'):
					$adminviewsviewtmpldefaultlines = AdminFiles::viewsViewDefault30($view, $varObject, 'default.php');
				endif;

				$indexpaths[] = $adminviewsview . $indexfile;
				$indexpaths[] = $adminviewsviewtmpl . $indexfile;

				FileHelper::foldercheck($adminviewsview);
				FileHelper::foldercheck($adminviewsviewtmpl);

				$filestozip[] = $adminviewsview;
				$filestozip[] = $adminviewsviewtmpl;

				// start - added v.0.6.0
				if($varObject->useDatabase):
					// Create SQL install and uninstall files
					$sqlinstallfilelinesarray[]		= AdminFiles::adminSQLInstallFile($formfields, $view, $varObject);
					$sqluninstallfilelinesarray[]	= AdminFiles::adminSQLUninstallFile($formfields, $view, $varObject);
				endif;
				// end - added v.0.6.0

				if(!is_numeric($view['singular']['safe']) && $varObject->useDatabase): // added - v.0.6.0 - database check
					/**
					 *	Admin side
					 */
					$adminviewsviewtmpldefaultheadlines = AdminFiles::viewsViewDefaultHead($varObject, $formfields, 'default_head.php');
					$adminviewsviewtmpldefaultbodylines = AdminFiles::viewsViewDefaultBody($view, $varObject, $formfields, 'default_body.php');
					$adminviewsviewtmpldefaultfootlines = AdminFiles::viewsViewDefaultFoot($varObject, $formfields, 'default_foot.php');
					// Create singular view
					$singularview				= $adminviews . $view['singular']['safe'] . "/";
					$singularviewviewhtml		= $singularview . "view.html.php";
					$singularviewviewsubmit		= $singularview . "submitbutton.js";
					$singularviewviewtmpl		= $singularview . "tmpl/";
					$singularviewviewtmpledit	= $singularviewviewtmpl . "edit.php";
					// Add index.html paths
					$indexpaths[]				= $singularview . $indexfile;
					$indexpaths[]				= $singularviewviewtmpl . $indexfile;
					// Check folders and create
					FileHelper::foldercheck($singularview);
					FileHelper::foldercheck($singularviewviewtmpl);
					// Add to zip list
					$filestozip[]				= $singularview;
					$filestozip[]				= $singularviewviewtmpl;
					// Create lines for the files
					// Controllers
					$admincontrollersingular		= $admincontrollers . $view['singular']['safe'] . ".php";
					$admincontrollersingularlines	= AdminFiles::adminControllerSingular($view, $varObject, $view_count);
					// Models
					$adminmodelsingular				= $adminmodels . $view['singular']['safe'] . ".php";
					$adminmodelsingularlines		= AdminFiles::adminModelSingular($view, $varObject);
					// Tables
					$admintable						= $admintables . $view['singular']['safe'] . ".php";
					$admintablelines				= AdminFiles::adminTable($view, $varObject);
					// Views
					$singularviewviewhtmllines		= AdminFiles::viewsViewSingularViewHtml($view, $varObject, 'view.html.php');
					$singularviewviewsubmitlines	= AdminFiles::viewsViewSingularViewSubmitButton($view, $varObject, 'submitbutton.js');
					// Which edit.php layout needed?
					if($varObject->j_version == '2.5.0'):
						$singularviewviewtmpleditlines = AdminFiles::viewsViewSingularViewEdit25($view, $varObject, 'edit.php', $view_count);
					elseif($varObject->j_version == '3.0' || $varObject->j_version == '3.2'):
						$singularviewviewtmpleditlines = AdminFiles::viewsViewSingularViewEdit30($view, $varObject, 'edit.php', $view_count);
					endif;
					// Create files
					// Controllers
					$totallinescreated[]	= FileHelper::createFile($admincontrollersingular, $admincontrollersingularlines);
					$filestozip[]			= $admincontrollersingular;
					// Models
					$totallinescreated[]	= FileHelper::createFile($adminmodelsingular, $adminmodelsingularlines);
					$filestozip[]			= $adminmodelsingular;
					// Tables
					$totallinescreated[]	= FileHelper::createFile($admintable, $admintablelines);
					$filestozip[]			= $admintable;
					//Views
					$totallinescreated[] = FileHelper::createFile($singularviewviewhtml, $singularviewviewhtmllines);
					$totallinescreated[] = FileHelper::createFile($singularviewviewsubmit, $singularviewviewsubmitlines);
					$totallinescreated[] = FileHelper::createFile($singularviewviewtmpledit, $singularviewviewtmpleditlines);
					$filestozip[] = $singularviewviewhtml;
					$filestozip[] = $singularviewviewsubmit;
					$filestozip[] = $singularviewviewtmpledit;

					/**
					 *	SITE SIDE - START
					 */
					// Create plural view
					$sitepluralview						= $siteviews . $view['plural']['safe'] . "/";
					$sitepluralviewviewhtml				= $sitepluralview . "view.html.php";
					$sitepluralviewviewtmpl				= $sitepluralview . "tmpl/";
					$sitepluralviewviewtmpldefaultphp 	= $sitepluralviewviewtmpl . "default.php";
					$sitepluralviewviewtmpldefaultxml	= $sitepluralviewviewtmpl . "default.xml";
					// Add index.html paths
					$indexpaths[] = $sitepluralview . $indexfile;
					$indexpaths[] = $sitepluralviewviewtmpl . $indexfile;
					// Check folders and create
					FileHelper::foldercheck($sitepluralview);
					FileHelper::foldercheck($sitepluralviewviewtmpl);
					// Add to zip list
					$filestozip[] = $sitepluralview;
					$filestozip[] = $sitepluralviewviewtmpl;
					/*
					 * Create lines for the files
					 */
					// Models
					$sitepluralmodelsmodelfile	= $sitemodels . $view['plural']['safe'] . ".php";
					$sitepluralmodelsmodellines	= SiteFiles::modelsModelPlural($view, $varObject);
					// Views
					$sitepluralviewviewhtmllines			= SiteFiles::viewsViewPluralViewHtml($view, $varObject, 'view.html.php');
					$sitepluralviewviewtmpldefaultphplines	= SiteFiles::viewsViewPluralTmplDefaulPHP($formfields, $view, $varObject, 'default.php', $view_count);
					$sitepluralviewviewtmpldefaultxmllines	= SiteFiles::viewsViewPluralTmplDefaulXML($view, $varObject);
					/*
					 * Create files
					 */
					// Views
					$totallinescreated[] = FileHelper::createFile($sitepluralmodelsmodelfile, $sitepluralmodelsmodellines);
					$totallinescreated[] = FileHelper::createFile($sitepluralviewviewhtml, $sitepluralviewviewhtmllines);
					$totallinescreated[] = FileHelper::createFile($sitepluralviewviewtmpldefaultphp, $sitepluralviewviewtmpldefaultphplines);
					$totallinescreated[] = FileHelper::createFile($sitepluralviewviewtmpldefaultxml, $sitepluralviewviewtmpldefaultxmllines);
					$filestozip[] = $sitepluralmodelsmodelfile;
					$filestozip[] = $sitepluralviewviewhtml;
					$filestozip[] = $sitepluralviewviewtmpldefaultphp;
					$filestozip[] = $sitepluralviewviewtmpldefaultxml;
					// Additional language lines - plural menu view
					$extraSysLanguageLines[] = $varObject->com_language.'_'.$view['plural']['language'].'_VIEW_DEFAULT_TITLE="'.$view['plural']['cap'].' View"';
					$extraSysLanguageLines[] = $varObject->com_language.'_'.$view['plural']['language'].'_VIEW_DEFAULT_DESC="'.$view['plural']['cap'].' Description"';

					/*
					 * Create singular view
					 */
					$sitesingularview				= $siteviews . $view['singular']['safe'] . DS;
					$sitesingularviewviewhtml		= $sitesingularview . 'view.html.php';
					$sitesingularviewviewtmpl		= $sitesingularview . 'tmpl' . DS;
					$singularviewviewtmpldefaultphp = $sitesingularviewviewtmpl . 'default.php';
					$singularviewviewtmpldefaultxml = $sitesingularviewviewtmpl . 'default.xml';
					// Add index.html paths
					$indexpaths[] = $sitesingularview . $indexfile;
					$indexpaths[] = $sitesingularviewviewtmpl . $indexfile;
					// Check folders and create
					FileHelper::foldercheck($sitesingularview);
					FileHelper::foldercheck($sitesingularviewviewtmpl);
					// Add to zip list
					$filestozip[] = $sitesingularview;
					$filestozip[] = $sitesingularviewviewtmpl;
					/*
					 * Create lines for the files
					 */
					// Models
					$singularmodelsmodelfile	= $sitemodels . $view['singular']['safe'] . '.php';
					$singularmodelsmodellines	= SiteFiles::modelsModelSingular($view, $varObject);
					// Views
					$singularviewviewhtmllines				= SiteFiles::viewsViewSingularViewHtml($formfields, $view, $varObject, 'view.html.php');
					$singularviewviewtmpldefaultphplines	= SiteFiles::viewsViewSingularTmplDefaulPHP($formfields, $varObject, 'default.php', $view_count);
					$singularviewviewtmpldefaultxmllines	= SiteFiles::viewsViewSingularTmplDefaulXML($formfields, $view, $varObject, $view_count_string);
					// Additional language lines - singular menu view
					$field	= $formfields->name[0];
					$field	= strtolower($field);
					$field	= ucwords($field);
					// Only letters and numbers allowed
					$field_f	= preg_replace("/[^A-Za-z0-9]/", "_", $field);
					$field_f	= str_replace('__', '_', $field_f);
					$field_f	= str_replace('___', '_', $field_f);
					$field_f	= trim($field_f,'_');
					$field_lower	= strtolower($field_f);
					$field_upper	= strtoupper($field_lower);
					$extraSysLanguageLines[] = $varObject->com_language.'_'.$view['singular']['language'].'_FIELD_'.$field_upper.'_LABEL="Select '.$field.'"';
					$extraSysLanguageLines[] = $varObject->com_language.'_'.$view['singular']['language'].'_FIELD_'.$field_upper.'_DESC="'.$field.' Description"';
					/*
					 * Create files
					 */
					//Views
					$totallinescreated[] = FileHelper::createFile($singularmodelsmodelfile, $singularmodelsmodellines);
					$totallinescreated[] = FileHelper::createFile($sitesingularviewviewhtml, $singularviewviewhtmllines);
					$totallinescreated[] = FileHelper::createFile($singularviewviewtmpldefaultphp, $singularviewviewtmpldefaultphplines);
					$totallinescreated[] = FileHelper::createFile($singularviewviewtmpldefaultxml, $singularviewviewtmpldefaultxmllines);
					$filestozip[] = $singularmodelsmodelfile;
					$filestozip[] = $sitesingularviewviewhtml;
					$filestozip[] = $singularviewviewtmpldefaultphp;
					$filestozip[] = $singularviewviewtmpldefaultxml;

					/**
					 * SITE SIDE - END
					 */

					// Additional language lines
					$extraSysLanguageLines[] = $varObject->com_language.'_'.$view['singular']['language'].'_VIEW_DEFAULT_TITLE="'.$view['singular']['cap'].' View"';
					$extraSysLanguageLines[] = $varObject->com_language.'_'.$view['singular']['language'].'_VIEW_DEFAULT_DESC="'.$view['singular']['cap'].' Description"';
				endif;

				// Create files
				// Controllers
				$totallinescreated[]	= FileHelper::createFile($admincontrollerplural, $admincontrollerplurallines);
				$filestozip[]			= $admincontrollerplural;
				// Models
				$totallinescreated[]	= FileHelper::createFile($adminmodelplural, $adminmodelplurallines);
				$filestozip[]			= $adminmodelplural;
				// Views
				$totallinescreated[]	= FileHelper::createFile($adminviewsviewhtml, $adminviewsviewhtmllines);
				$totallinescreated[]	= FileHelper::createFile($adminviewsviewtmpldefault, $adminviewsviewtmpldefaultlines);
				$filestozip[]			= $adminviewsviewhtml;
				$filestozip[]			= $adminviewsviewtmpldefault;

				if(!is_numeric($view['singular']['safe']) && $varObject->useDatabase):
					$totallinescreated[]	= FileHelper::createFile($adminviewsviewtmpldefaulthead, $adminviewsviewtmpldefaultheadlines);
					$totallinescreated[]	= FileHelper::createFile($adminviewsviewtmpldefaultbody, $adminviewsviewtmpldefaultbodylines);
					$totallinescreated[]	= FileHelper::createFile($adminviewsviewtmpldefaultfoot, $adminviewsviewtmpldefaultfootlines);
					$filestozip[]			= $adminviewsviewtmpldefaulthead;
					$filestozip[]			= $adminviewsviewtmpldefaultbody;
					$filestozip[]			= $adminviewsviewtmpldefaultfoot;
				endif;
			else:
				// This is for when the view is 'categories'
			endif;

			$view_count++;
		endforeach;

		/*
		 * Create category views
		 */
		// start - added v.1.1.5
		$cat_view_count = 0;
		if($varObject->includeCat && $varObject->categoryView):
			foreach($varObject->categoryViewFields as $categoryView):
				// Create cat views
				$sitecatview					= $siteviews . $categoryView['plural']['view_safe'] . "category/";
				$sitecatviewviewhtml			= $sitecatview . "view.html.php";
				$sitecatviewviewtmpl			= $sitecatview . "tmpl/";
				$sitecatviewviewtmpldefaultphp 	= $sitecatviewviewtmpl . "default.php";
				$sitecatviewviewtmpldefaultxml	= $sitecatviewviewtmpl . "default.xml";
				// Add index.html paths
				$indexpaths[] = $sitecatview . $indexfile;
				$indexpaths[] = $sitecatviewviewtmpl . $indexfile;
				// Check folders and create
				FileHelper::foldercheck($sitecatview);
				FileHelper::foldercheck($sitecatviewviewtmpl);
				// Add to zip list
				$filestozip[] = $sitecatview;
				$filestozip[] = $sitecatviewviewtmpl;
				/*
				 * Create lines for the files
				 */
				// Models
				$sitecatmodelsmodelfile	= $sitemodels . $categoryView['plural']['view_safe'] . "category.php";
				$sitecatmodelsmodellines= SiteFiles::modelsModelCat($categoryView, $varObject);
				// Views
				$sitecatviewviewhtmllines			= SiteFiles::viewsViewCatViewHtml($categoryView, $varObject, 'view.html.php');
				$sitecatviewviewtmpldefaultphplines	= SiteFiles::viewsViewCatTmplDefaulPHP($formfields, $varObject, 'default.php', $cat_view_count);
				$cat_view_count_string				= 'category'.Helpers::numtonumtext($cat_view_count);
				$sitecatviewviewtmpldefaultxmllines	= SiteFiles::viewsViewCatTmplDefaulXML($categoryView, $varObject, $cat_view_count_string);
				// Admin Model Fields
				$admincatmodelfieldfile		= $adminmodelsfields.$varObject->comp_m_view.$cat_view_count_string.'.php';
				$admincatmodelfieldlines	= AdminFiles::adminCatModuleFieldsField($categoryView, $varObject, $varObject->comp_m_view.$cat_view_count_string);
				/*
				 * Create files
				 */
				// Views
				$totallinescreated[] = FileHelper::createFile($sitecatmodelsmodelfile, $sitecatmodelsmodellines);
				$totallinescreated[] = FileHelper::createFile($sitecatviewviewhtml, $sitecatviewviewhtmllines);
				$totallinescreated[] = FileHelper::createFile($sitecatviewviewtmpldefaultphp, $sitecatviewviewtmpldefaultphplines);
				$totallinescreated[] = FileHelper::createFile($sitecatviewviewtmpldefaultxml, $sitecatviewviewtmpldefaultxmllines);
				$totallinescreated[] = FileHelper::createFile($admincatmodelfieldfile, $admincatmodelfieldlines);
				$filestozip[] = $sitecatmodelsmodelfile;
				$filestozip[] = $sitecatviewviewhtml;
				$filestozip[] = $sitecatviewviewtmpldefaultphp;
				$filestozip[] = $sitecatviewviewtmpldefaultxml;
				$filestozip[] = $admincatmodelfieldfile;

				// Additional language lines
				$extraSysLanguageLines[] = $varObject->com_language.'_'.$categoryView['plural']['view_lang'].'CATEGORY_VIEW_DEFAULT_TITLE="Category View for '.$categoryView['plural']['view_cap'].'"';
				$extraSysLanguageLines[] = $varObject->com_language.'_'.$categoryView['plural']['view_lang'].'CATEGORY_VIEW_DEFAULT_DESC="Description for Category View of '.$categoryView['plural']['view_cap'].'"';
				$extraSysLanguageLines[] = $varObject->com_language.'_'.$categoryView['plural']['view_lang'].'CATEGORY_FIELD_CATEGORY_LABEL="Category for '.$categoryView['plural']['view_cap'].'"';
				$extraSysLanguageLines[] = $varObject->com_language.'_'.$categoryView['plural']['view_lang'].'CATEGORY_FIELD_CATEGORY_DESC="Select the category for '.$categoryView['plural']['view_cap'].'"';
				$cat_view_count++;
			endforeach;
		endif;
		// end - added v.1.1.5

		// If image upload
		if($varObject->imageUpload):
			// include wideimage into the package
			$toolsfolder = 'tools' . DS;
			$toolsfolderwideimage = $toolsfolder . 'wideimage' . DS;
			$toolsfolderwideimagefont = $toolsfolderwideimage . 'Font' . DS;
			$toolsfolderwideimagemapper = $toolsfolderwideimage . 'Mapper' . DS;
			$toolsfolderwideimageoperation = $toolsfolderwideimage . 'Operation' . DS;
			$toolsfolderwideimagevendor = $toolsfolderwideimage . 'vendor' . DS;
			$toolsfolderwideimagevendorde77 = $toolsfolderwideimagevendor . 'de77' . DS;

			// set paths to files
			$adminassetswideimage = $adminassets . 'wideimage' . DS;
			$adminassetswideimagefont = $adminassetswideimage . 'Font' . DS;
			$adminassetswideimagemapper = $adminassetswideimage . 'Mapper' . DS;
			$adminassetswideimageoperation = $adminassetswideimage . 'Operation' . DS;
			$adminassetswideimagevendor = $adminassetswideimage . 'vendor' . DS;
			$adminassetswideimagevendorde77 = $adminassetswideimagevendor . 'de77' . DS;

			// add index.html to all directories
			$indexpaths[] = $adminassetswideimage . $indexfile;
			$indexpaths[] = $adminassetswideimagefont . $indexfile;
			$indexpaths[] = $adminassetswideimagemapper . $indexfile;
			$indexpaths[] = $adminassetswideimageoperation . $indexfile;
			$indexpaths[] = $adminassetswideimagevendor . $indexfile;
			$indexpaths[] = $adminassetswideimagevendorde77 . $indexfile;

			// check folders
			FileHelper::foldercheck($adminassetswideimage);
			FileHelper::foldercheck($adminassetswideimagefont);
			FileHelper::foldercheck($adminassetswideimagemapper);
			FileHelper::foldercheck($adminassetswideimageoperation);
			FileHelper::foldercheck($adminassetswideimagevendor);
			FileHelper::foldercheck($adminassetswideimagevendorde77);

			// add files to be zipped
			$filestozip[] = $adminassetswideimage;
			$filestozip[] = $adminassetswideimage . 'WideImage.php';
			$filestozip[] = $adminassetswideimage . 'Canvas.php';
			$filestozip[] = $adminassetswideimage . 'Coordinate.php';
			$filestozip[] = $adminassetswideimage . 'Exception.php';
			$filestozip[] = $adminassetswideimagefont;
			$filestozip[] = $adminassetswideimagefont . 'GDF.php';
			$filestozip[] = $adminassetswideimagefont . 'PS.php';
			$filestozip[] = $adminassetswideimagefont . 'TTF.php';
			$filestozip[] = $adminassetswideimage . 'Image.php';
			$filestozip[] = $adminassetswideimagemapper;
			$filestozip[] = $adminassetswideimagemapper . 'BMP.php';
			$filestozip[] = $adminassetswideimagemapper . 'GD.php';
			$filestozip[] = $adminassetswideimagemapper . 'GD2.php';
			$filestozip[] = $adminassetswideimagemapper . 'GIF.php';
			$filestozip[] = $adminassetswideimagemapper . 'JPEG.php';
			$filestozip[] = $adminassetswideimagemapper . 'PNG.php';
			$filestozip[] = $adminassetswideimagemapper . 'TGA.php';
			$filestozip[] = $adminassetswideimage . 'MapperFactory.php';
			$filestozip[] = $adminassetswideimageoperation;
			$filestozip[] = $adminassetswideimageoperation . 'AddNoise.php';
			$filestozip[] = $adminassetswideimageoperation . 'ApplyConvolution.php';
			$filestozip[] = $adminassetswideimageoperation . 'ApplyFilter.php';
			$filestozip[] = $adminassetswideimageoperation . 'ApplyMask.php';
			$filestozip[] = $adminassetswideimageoperation . 'AsGrayscale.php';
			$filestozip[] = $adminassetswideimageoperation . 'AsNegative.php';
			$filestozip[] = $adminassetswideimageoperation . 'AutoCrop.php';
			$filestozip[] = $adminassetswideimageoperation . 'CopyChannelsPalette.php';
			$filestozip[] = $adminassetswideimageoperation . 'CopyChannelsTrueColor.php';
			$filestozip[] = $adminassetswideimageoperation . 'CorrectGamma.php';
			$filestozip[] = $adminassetswideimageoperation . 'Crop.php';
			$filestozip[] = $adminassetswideimageoperation . 'Flip.php';
			$filestozip[] = $adminassetswideimageoperation . 'GetMask.php';
			$filestozip[] = $adminassetswideimageoperation . 'Merge.php';
			$filestozip[] = $adminassetswideimageoperation . 'Mirror.php';
			$filestozip[] = $adminassetswideimageoperation . 'Resize.php';
			$filestozip[] = $adminassetswideimageoperation . 'ResizeCanvas.php';
			$filestozip[] = $adminassetswideimageoperation . 'Rotate.php';
			$filestozip[] = $adminassetswideimageoperation . 'RoundCorners.php';
			$filestozip[] = $adminassetswideimageoperation . 'Unsharp.php';
			$filestozip[] = $adminassetswideimage . 'OperationFactory.php';
			$filestozip[] = $adminassetswideimage . 'PaletteImage.php';
			$filestozip[] = $adminassetswideimage . 'TrueColorImage.php';
			$filestozip[] = $adminassetswideimagevendor;
			$filestozip[] = $adminassetswideimagevendorde77;

			// copy files to temp
			FileHelper::copyToLocation($toolsfolderwideimage . 'WideImage.php', $adminassetswideimage . 'WideImage.php');
			FileHelper::copyToLocation($toolsfolderwideimage . 'Canvas.php', $adminassetswideimage . 'Canvas.php');
			FileHelper::copyToLocation($toolsfolderwideimage . 'Coordinate.php', $adminassetswideimage . 'Coordinate.php');
			FileHelper::copyToLocation($toolsfolderwideimage . 'Exception.php', $adminassetswideimage . 'Exception.php');
			FileHelper::copyToLocation($toolsfolderwideimagefont . 'GDF.php', $adminassetswideimagefont . 'GDF.php');
			FileHelper::copyToLocation($toolsfolderwideimagefont . 'PS.php', $adminassetswideimagefont . 'PS.php');
			FileHelper::copyToLocation($toolsfolderwideimagefont . 'TTF.php', $adminassetswideimagefont . 'TTF.php');
			FileHelper::copyToLocation($toolsfolderwideimage . 'Image.php', $adminassetswideimage . 'Image.php');
			FileHelper::copyToLocation($toolsfolderwideimagemapper . 'BMP.php', $adminassetswideimagemapper . 'BMP.php');
			FileHelper::copyToLocation($toolsfolderwideimagemapper . 'GD.php', $adminassetswideimagemapper . 'GD.php');
			FileHelper::copyToLocation($toolsfolderwideimagemapper . 'GD2.php', $adminassetswideimagemapper . 'GD2.php');
			FileHelper::copyToLocation($toolsfolderwideimagemapper . 'GIF.php', $adminassetswideimagemapper . 'GIF.php');
			FileHelper::copyToLocation($toolsfolderwideimagemapper . 'JPEG.php', $adminassetswideimagemapper . 'JPEG.php');
			FileHelper::copyToLocation($toolsfolderwideimagemapper . 'PNG.php', $adminassetswideimagemapper . 'PNG.php');
			FileHelper::copyToLocation($toolsfolderwideimagemapper . 'TGA.php', $adminassetswideimagemapper . 'TGA.php');
			FileHelper::copyToLocation($toolsfolderwideimage . 'MapperFactory.php', $adminassetswideimage . 'MapperFactory.php');
			FileHelper::copyToLocation($toolsfolderwideimageoperation . 'AddNoise.php', $adminassetswideimageoperation . 'AddNoise.php');
			FileHelper::copyToLocation($toolsfolderwideimageoperation . 'ApplyConvolution.php', $adminassetswideimageoperation . 'ApplyConvolution.php');
			FileHelper::copyToLocation($toolsfolderwideimageoperation . 'ApplyFilter.php', $adminassetswideimageoperation . 'ApplyFilter.php');
			FileHelper::copyToLocation($toolsfolderwideimageoperation . 'ApplyMask.php', $adminassetswideimageoperation . 'ApplyMask.php');
			FileHelper::copyToLocation($toolsfolderwideimageoperation . 'AsGrayscale.php', $adminassetswideimageoperation . 'AsGrayscale.php');
			FileHelper::copyToLocation($toolsfolderwideimageoperation . 'AsNegative.php', $adminassetswideimageoperation . 'AsNegative.php');
			FileHelper::copyToLocation($toolsfolderwideimageoperation . 'AutoCrop.php', $adminassetswideimageoperation . 'AutoCrop.php');
			FileHelper::copyToLocation($toolsfolderwideimageoperation . 'CopyChannelsPalette.php', $adminassetswideimageoperation . 'CopyChannelsPalette.php');
			FileHelper::copyToLocation($toolsfolderwideimageoperation . 'CopyChannelsTrueColor.php', $adminassetswideimageoperation . 'CopyChannelsTrueColor.php');
			FileHelper::copyToLocation($toolsfolderwideimageoperation . 'CorrectGamma.php', $adminassetswideimageoperation . 'CorrectGamma.php');
			FileHelper::copyToLocation($toolsfolderwideimageoperation . 'Crop.php', $adminassetswideimageoperation . 'Crop.php');
			FileHelper::copyToLocation($toolsfolderwideimageoperation . 'Flip.php', $adminassetswideimageoperation . 'Flip.php');
			FileHelper::copyToLocation($toolsfolderwideimageoperation . 'GetMask.php', $adminassetswideimageoperation . 'GetMask.php');
			FileHelper::copyToLocation($toolsfolderwideimageoperation . 'Merge.php', $adminassetswideimageoperation . 'Merge.php');
			FileHelper::copyToLocation($toolsfolderwideimageoperation . 'Mirror.php', $adminassetswideimageoperation . 'Mirror.php');
			FileHelper::copyToLocation($toolsfolderwideimageoperation . 'Resize.php', $adminassetswideimageoperation . 'Resize.php');
			FileHelper::copyToLocation($toolsfolderwideimageoperation . 'ResizeCanvas.php', $adminassetswideimageoperation . 'ResizeCanvas.php');
			FileHelper::copyToLocation($toolsfolderwideimageoperation . 'Rotate.php', $adminassetswideimageoperation . 'Rotate.php');
			FileHelper::copyToLocation($toolsfolderwideimageoperation . 'RoundCorners.php', $adminassetswideimageoperation . 'RoundCorners.php');
			FileHelper::copyToLocation($toolsfolderwideimageoperation . 'Unsharp.php', $adminassetswideimageoperation . 'Unsharp.php');
			FileHelper::copyToLocation($toolsfolderwideimage . 'OperationFactory.php', $adminassetswideimage . 'OperationFactory.php');
			FileHelper::copyToLocation($toolsfolderwideimage . 'PaletteImage.php', $adminassetswideimage . 'PaletteImage.php');
			FileHelper::copyToLocation($toolsfolderwideimage . 'TrueColorImage.php', $adminassetswideimage . 'TrueColorImage.php');
			FileHelper::copyToLocation($toolsfolderwideimagevendorde77 . 'BMP.php', $adminassetswideimagevendorde77 . 'BMP.php');
			FileHelper::copyToLocation($toolsfolderwideimagevendorde77 . 'TGA.php', $adminassetswideimagevendorde77 . 'TGA.php');
		endif;

		// Create index files under all paths
		foreach($indexpaths as $indexpath):
			$totallinescreated[]	= FileHelper::createfile($indexpath, $indexlines);
			$filestozip[]			= $indexpath;
		endforeach;

		// start - added v.0.6.0
		if($varObject->useDatabase):
			$sqlinstallfilelines = array();
			$sqluninstallfilelines = array();
			// Install & Uninstall array parse and build file
			if(is_array($sqlinstallfilelinesarray)):
				foreach($sqlinstallfilelinesarray as $sqlinstallfilegroup):
					foreach($sqlinstallfilegroup as $sqlinstallfileline):
						$sqlinstallfilelines[]	= $sqlinstallfileline;
						$sqlinstallfilelines[]	= $varObject->return;
					endforeach;
				endforeach;
			endif;

			if(is_array($sqluninstallfilelinesarray)):
				foreach($sqluninstallfilelinesarray as $sqluninstallfileline):
					$sqluninstallfilelines[]	= $sqluninstallfileline;
					$sqluninstallfilelines[]	= $varObject->return;
				endforeach;
			endif;

			// Remove last array() element, take off return with array_pop();
			array_pop($sqlinstallfilelines);
			array_pop($sqluninstallfilelines);
		endif;
		// end - added v.0.6.0

		/**
		 *	Handle language files
		 */
		$languagelines		= AdminFiles::languageFile($varObject);
		$languagesyslines	= AdminFiles::languagesysFile($varObject, $extraSysLanguageLines);

		/**
		 *	Handle CSS and JS files
		 */
		$admincsslines = AdminFiles::cssFile($varObject); // added v.0.6.0
		$adminjslines = '';

		/**
		 *	Handle images to folder admin/assets/images/icons/
		 *	copies images from temp to new path for packaging
		 */
		if($varObject->imagesUploaded):
			$tempFolder = 'temp' . DS;
			$origFolder = $tempFolder . 'orig' . DS;
			$manaFolder = $tempFolder . 'mana' . DS; // 48px X 48px
			$menuFolder = $tempFolder . 'menu' . DS; // 16px X 16px
			foreach($varObject->imagesUploaded as $imagestocopy):
				$origPath		= $origFolder . $imagestocopy->orig;
				$manaPath		= $manaFolder . $imagestocopy->orig;
				$menuPath		= $menuFolder . $imagestocopy->orig;
				$origPathNew	= $adminassetsimagesicons . $imagestocopy->orig;
				$manaPathNew	= $adminassetsimagesicons . $imagestocopy->mana;
				$menuPathNew	= $adminassetsimagesicons . $imagestocopy->menu;
				copy($origPath, $origPathNew);
				copy($manaPath, $manaPathNew);
				copy($menuPath, $menuPathNew);
				$filestozip[] = $origPathNew;
				$filestozip[] = $manaPathNew;
				$filestozip[] = $menuPathNew;
			endforeach;
		endif;

		/**
		 *	Create Files
		 */
		// Install files
		$totallinescreated[]	= FileHelper::createFile($installfile, $installlines);
		$totallinescreated[]	= FileHelper::createFile($scriptfile, $scriptlines);
		$filestozip[]			= $installfile;
		$filestozip[]			= $scriptfile;

		// Admin files
		$totallinescreated[] = FileHelper::createFile($accessfile, $access);
		$totallinescreated[] = FileHelper::createFile($configfile, $config);
		$totallinescreated[] = FileHelper::createFile($componentfile, $componentlines);
		$totallinescreated[] = FileHelper::createFile($controllerfile, $controllerlines);

		// start - added v.0.6.0
		if($varObject->useDatabase):
			$totallinescreated[] = FileHelper::createFile($sqlinstallfile, $sqlinstallfilelines);
			$totallinescreated[] = FileHelper::createFile($sqluninstallfile, $sqluninstallfilelines);
			$totallinescreated[] = FileHelper::createFile($sqlupdatesmysqlfile, $sqlinstallfilelines);
		endif;
		// end - added v.0.6.0

		$totallinescreated[] = FileHelper::createFile($helperfile, $helperlines);
		$totallinescreated[] = FileHelper::createFile($languagefile, $languagelines);
		$totallinescreated[] = FileHelper::createFile($languagesysfile, $languagesyslines);
		$totallinescreated[] = FileHelper::createFile($cssfile, $admincsslines);
		$totallinescreated[] = FileHelper::createFile($jsfile, $adminjslines);
		$filestozip[] = $accessfile;
		$filestozip[] = $configfile;
		$filestozip[] = $componentfile;
		$filestozip[] = $controllerfile;

		// start - added v.0.6.0
		if($varObject->useDatabase):
			$filestozip[] = $sqlinstallfile;
			$filestozip[] = $sqluninstallfile;
			$filestozip[] = $sqlupdatesmysqlfile;
		endif;
		// end - added v.0.6.0

		$filestozip[] = $helperfile;
		$filestozip[] = $languagefile;
		$filestozip[] = $languagesysfile;
		$filestozip[] = $cssfile;
		$filestozip[] = $jsfile;

		// Site files
		$totallinescreated[] = FileHelper::createFile($sitecomponentfile, $sitecomponentlines);
		$totallinescreated[] = FileHelper::createFile($sitecontrollerfile, $sitecontrollerlines);
		$totallinescreated[] = FileHelper::createFile($siterouterfile, $siterouterlines);
		$totallinescreated[] = FileHelper::createFile($sitehelperfile, $sitehelperlines);
		$totallinescreated[] = FileHelper::createFile($sitecssfile, "");
		$totallinescreated[] = FileHelper::createFile($sitejsfile, "");
		$filestozip[] = $sitecomponentfile;
		$filestozip[] = $sitecontrollerfile;
		$filestozip[] = $siterouterfile;
		$filestozip[] = $sitehelperfile;
		$filestozip[] = $sitecssfile;
		$filestozip[] = $sitejsfile;

		/**
		 *	Lines created calculate
		 */
		$totallinescalculated = 0;
		foreach($totallinescreated as $totallineseach):
			$totallinescalculated = $totallinescalculated + $totallineseach;
		endforeach;

		// 15 seconds per line - round up or down..
		$totaltimesaved = round(($totallinescalculated / 4) / 60);
		$filecreatedcount = 0;

		/**
		 *	le Zip Up
		 */
		// Set zip path
		$packagename		= $varObject->com_main . '-v.' . $varObject->version . '-joomla_' . $varObject->j_version . '.zip';

		// Create the zip package
		$filescreatedlist	= FileHelper::createZip($filestozip, $datedfolder.$packagename, true, $datedfolder);

		// Database store activity
		// Connect to database and open it
		$newpackagename		= $packagename;
		$currentdate		= date("Y-m-d");
		$currentdate		= " AND date_created >= '".$currentdate." 00:00:00' AND date_created < '".$currentdate." 23:59:59'";
		$packagenamecheck	= $database->select('br_packages', '*', 'package="'.$packagename.'"'.$currentdate);
		// Check if packagename is there today
		if($packagenamecheck):
			$newpackagename		= str_replace('.zip', '-1.zip', $packagename);
			$packagenamecheck	= $database->select('br_packages', '*', 'package="'.$newpackagename.'"'.$currentdate);
			// Check if packagename is there today
			if($packagenamecheck):
				$newpackagename		= str_replace('.zip', '-2.zip', $packagename);
				$packagenamecheck	= $database->select('br_packages', '*', 'package="'.$newpackagename.'"'.$currentdate);
				// Check if packagename is there today
				if($packagenamecheck):
					$newpackagename		= str_replace('.zip', '-3.zip', $packagename);
					$packagenamecheck	= $database->select('br_packages', '*', 'package="'.$newpackagename.'"'.$currentdate);
					// Check if packagename is there today
					if($packagenamecheck):
						$newpackagename		= str_replace('.zip', '-4.zip', $packagename);
						$packagenamecheck	= $database->select('br_packages', '*', 'package="'.$newpackagename.'"'.$currentdate);
						// Check if packagename is there today
						if($packagenamecheck):
							$newpackagename		= str_replace('.zip', '-5.zip', $packagename);
							$packagenamecheck	= $database->select('br_packages', '*', 'package="'.$newpackagename.'"'.$currentdate);
							// Check if packagename is there today
							if($packagenamecheck):
								$newpackagename		= str_replace('.zip', '-6.zip', $packagename);
								$packagenamecheck	= $database->select('br_packages', '*', 'package="'.$newpackagename.'"'.$currentdate);
								// Check if packagename is there today
								if($packagenamecheck):
									$newpackagename		= str_replace('.zip', '-7.zip', $packagename);
									$packagenamecheck	= $database->select('br_packages', '*', 'package="'.$newpackagename.'"'.$currentdate);
									// Check if packagename is there today
									if($packagenamecheck):
										$newpackagename	= str_replace('.zip', '-8.zip', $packagename);
									endif;
								endif;
							endif;
						endif;
					endif;
				endif;
			endif;
		endif;

		// Copy zip to components folder
		$posted_date_folder		= date("Y-m-d");
		$componentsfolder		= MAINDIR . DS . 'components' . DS;
		$componentsfolderindex	= $componentsfolder . 'index.html';
		$todaysdatefolder		= $componentsfolder . $posted_date_folder . DS;
		$todaysdatefolderindex	= $todaysdatefolder . 'index.html';
		$movecomponentzip		= $todaysdatefolder . $newpackagename;

		FileHelper::foldercheck($componentsfolder);
		FileHelper::foldercheck($todaysdatefolder);

		if($filescreatedlist):
			// Format numbers
			//$filecreatedcount	= number_format($filecreatedcount);
			$totallinescalculated_format = number_format($totallinescalculated);

			$filecreated		= $datedfolder.$packagename;
			$filecreated		= str_replace($datedfolder, '', $filecreated);
			$filecreatedcount	= count($filescreatedlist);
			$filecreatedpath	= BASE_URL . 'output' . DS . $dated . DS . $filecreated;
			// Handle the paths of the folders
			$outputdirectpath	= OUTPUTDIR;
			$dateddirectpath	= $outputdirectpath . $dated . DS;
			$dateddirectindex	= $dateddirectpath . 'index.html';
			$filedirectpath		= OUTPUTDIR . $dated . DS . $filecreated;
			// Get size of package
			$bytes				= filesize($filedirectpath);
			$filesize			= FileHelper::formatBytes($bytes);
			// Set permissions of paths
			chmod($outputdirectpath, 0777);
			chmod($dateddirectpath, 0777);
			chmod($filedirectpath, 0777);

			// check to make sure we want to create, not in test mode
			if(CREATE_PACKAGE):

				// Make safe?
				$varObject->description = str_replace("'", "\'", $varObject->description);
				$create_package_record = array (
					'title'			=> $varObject->comp_name,
					'package'		=> $newpackagename,
					'author'		=> $varObject->author,
					'email'			=> $varObject->a_email,
					'website'		=> $varObject->a_url,
					'description'	=> $varObject->description,
					'filesize'		=> $filesize,
					'version'		=> $varObject->version,
					'jversion'		=> $varObject->j_version,
					'brversion'		=> $br_version,
					'lines_created'	=> $totallinescalculated,
					'files_created'	=> $filecreatedcount,
					'date_created'	=> $posted_date
				);
				$database->insert('br_packages', $create_package_record);

				// Set permissions of paths
				chmod($componentsfolder, 0777);
				chmod($todaysdatefolder, 0777);

				// Move component
				if (!copy($filedirectpath, $movecomponentzip)):
					// email out?
					//echo 'package could not be moved..';
				endif;
				// Move index.html - no browsing this folder!
				if (!copy($componentsfolderindex, $todaysdatefolderindex)):
					// email out?
					//echo 'index.html could not be moved..';
				endif;

				// Move index.html - no browsing this folder!
				if (!copy($componentsfolderindex, $dateddirectindex)):
					// email out?
					//echo 'index.html could not be moved..';
				endif;
			else:
				if($varObject->imageUpload){
					print_r('Image upload include:');
					Debug::printify($varObject->imageFields);
				}
				if($varObject->categoryView){
					print_r('Category view include:');
					Debug::printify($varObject->categoryViewFields);
				}
				print_r('$varObject');
				Debug::printify($varObject);
				exit();
			endif;
		endif;

		// Save user record of component and move to their repo
		if($_SESSION['loggedin'] && $filescreatedlist && $_SESSION['paid'] == 1):
			// get all fields to save and relation
			$user_component_record = array(
				'uid' 				=> $_SESSION['uid'],
				'cidparent'			=> $varObject->cidparent,
				'c_name' 			=> $varObject->comp_name,
				'c_file_name' 		=> $packagename,
				'version'			=> $varObject->version,
				'jversion'			=> $varObject->j_version,
				'brversion'			=> $br_version,
				'description'		=> $varObject->description,
				'license'			=> $varObject->license,
				'copyright'			=> $varObject->copyright,
				'author'			=> $varObject->author,
				'a_email'			=> $varObject->a_email,
				'a_url'				=> $varObject->a_url,
				'category_view'		=> $varObject->includeCat,
				'tags_view'			=> $varObject->includeTags,
				'use_usercreated'	=> $varObject->usermodified,
				'use_datecreated'	=> $varObject->datemodified,
				'use_database'		=> $varObject->useDatabase,
				'use_imageupload'	=> $varObject->imageUpload,
				'imageheight'		=> $varObject->imageHeight,
				'imagewidth'		=> $varObject->imageWidth,
				'imagethumbhw'		=> $varObject->imageThumbHW,
				'date_created'		=> $posted_date,
				'filesize'			=> $bytes,
				'lines_created'		=> $totallinescalculated,
				'files_created'		=> $filecreatedcount,
				'minutes_saved' 	=> ($totallinescalculated / 4),
				'downloadcount' 	=> 1
			);
			$cid = $database->insert('br_components', $user_component_record);

			// Set folders for user
			$usersFolder	= MAINDIR . DS . 'users' . DS;
			$userFolder		= $usersFolder . $_SESSION['uid'] . DS;
			$userFolderComp	= $userFolder . $cid . DS;
			$userComponent	= $userFolderComp . $filecreated;

			$usersFolderIndex	= $usersFolder . 'index.html';
			$userFolderIndex	= $userFolder . 'index.html';
			$userFolderCompIndex= $userFolderComp . 'index.html';

			FileHelper::foldercheck($usersFolder);
			FileHelper::foldercheck($userFolder);
			FileHelper::foldercheck($userFolderComp);

			// Set permissions of paths
			chmod($usersFolder, 0777);
			chmod($userFolder, 0777);
			chmod($userFolderComp, 0777);

			if (!copy($filedirectpath, $userComponent)):
				// send e-mail?
			endif;
			// Move index.html - no browsing this folder!
			if (!copy($componentsfolderindex, $usersFolderIndex)):
				// send e-mail?
			endif;
			if (!copy($componentsfolderindex, $userFolderIndex)):
				// send e-mail?
			endif;
			if (!copy($componentsfolderindex, $userFolderCompIndex)):
				// send e-mail?
			endif;

			$c = 0;
			foreach($varObject->allViews as $record_view):

				$record_view_fields = array();
				// Make sure there is formfields
				if($varObject->formFields):
					if(is_object($varObject->formFields[$c])):
						foreach($varObject->formFields[$c] as $key=>$record_view_field):
							if($key != 'count'):
								$record_view_fields[$key] = $record_view_field;
							endif;
						endforeach;
						$record_view_fields = serialize($record_view_fields);
					endif;
				endif;

				$user_component_view_record = array(
					'cid' 			=> $cid,
					'plural'		=> $record_view['plural']['orig'],
					'singular'		=> $record_view['singular']['orig'],
					'fields'		=> $record_view_fields,
					'date_created'	=> $posted_date
				);
				$vid = $database->insert('br_components_views', $user_component_view_record);
				$c++;
			endforeach;
		endif;

		// Call header
		$pageTitle = 'Component Created | Free | Joomla 2.5 & Joomla 3.0';
		$pageActive = 'home';
		$pageActiveBreadcrumb = '<li class="active">Component Created</li>';
		include('template/header.php');
	?>
				<div id="section-container">
					<div class="container">
						<div class="row">
							<div class="span12">
								<?php
								if($filescreatedlist):
								?>
								<div class="jumbotron">
									<h2><?php echo $varObject->comp_name; ?> component has been created..</h2>
									<p id="step1" class="lead">Total files created: <?php echo $filecreatedcount; ?></p>
									<p id="step2" class="lead">Total lines created: <?php echo $totallinescalculated_format; ?></p>
									<p id="step3" class="lead">Total time saved: <?php echo $totaltimesaved; ?> Hours <span class="small">(if it took 15 seconds per line to write)</span></p>
									<p id="countdowntime"><span class="badge badge-inverse">15</span> seconds</p>
									<a class="btn btn-large btn-success" id="download-full-package" href="<?php echo $filecreatedpath; ?>">Download (<?php echo $filesize; ?>)</a>
									<br />
									<br />
									<hr>
									<a href="contact.php" target="_blank" class="btn">Suggest a better process</a>
									<p class="lead">Please let me know what can be done to make this tool easier for you! I want this to be a great tool, but need feedback.</p>
								</div>
								<?php
								else:
								?>
								<div class="jumbotron">
									<h1><img src="images/black-rabbit.png" width="100"> Black Rabbit<br />Component Creator</h1>
									<p class="lead">Tired of creating a file structure every time you create a new component for Joomla? Let us do it for you! This <strong>easy-to-use</strong> tool creates an installable component package from the configurations you set below. Just select which <strong>Joomla version</strong> you want it to install to and get to typing. No sign-up necessary!</p>
									<a class="btn btn-large btn-success" href="index.php#start">Get Started</a>
								</div>

								<?php
								endif;
								?>
							</div><!-- /.span12 -->
						</div><!-- /.row -->
					</div><!-- /.container -->
				</div><!-- /#section-container -->
	<?php
		// Call footer
		include('template/footer.php');

	else:

		header('location:index.php');
		exit();

	endif;

?>
