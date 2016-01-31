<?php
/**
 *
 *
 */
class AdminFiles
{
	public static function accessFile($varObject)
	{
		$access[] = '<?xml version="1.0" encoding="utf-8" ?>'.$varObject->return;
		$access[] = '<access component="'.$varObject->com_main.'">'.$varObject->return;
		$access[] = $varObject->tab1.'<section name="component">'.$varObject->return;
		$access[] = $varObject->tab2.'<action name="core.admin" title="JACTION_ADMIN" description="JACTION_ADMIN_COMPONENT_DESC" />'.$varObject->return;
		$access[] = $varObject->tab2.'<action name="core.manage" title="JACTION_MANAGE" description="JACTION_MANAGE_COMPONENT_DESC" />'.$varObject->return;
		$access[] = $varObject->tab2.'<action name="core.create" title="JACTION_CREATE" description="JACTION_CREATE_COMPONENT_DESC" />'.$varObject->return;
		$access[] = $varObject->tab2.'<action name="core.delete" title="JACTION_DELETE" description="JACTION_DELETE_COMPONENT_DESC" />'.$varObject->return;
		$access[] = $varObject->tab2.'<action name="core.edit" title="JACTION_EDIT" description="JACTION_EDIT_COMPONENT_DESC" />'.$varObject->return;
		$access[] = $varObject->tab1.'</section>'.$varObject->return;
		
		// If categories is a view, make sure to add it to the access file
		if(in_array('categories',$varObject->views) || in_array('category',$varObject->views) || $varObject->includeCat):
			$access[] = $varObject->tab1.'<section name="category">'.$varObject->return;
			$access[] = $varObject->tab2.'<action name="core.create" title="JACTION_CREATE" description="COM_CATEGORIES_ACCESS_CREATE_DESC" />'.$varObject->return;
			$access[] = $varObject->tab2.'<action name="core.delete" title="JACTION_DELETE" description="COM_CATEGORIES_ACCESS_DELETE_DESC" />'.$varObject->return;
			$access[] = $varObject->tab2.'<action name="core.edit" title="JACTION_EDIT" description="COM_CATEGORIES_ACCESS_EDIT_DESC" />'.$varObject->return;
			$access[] = $varObject->tab2.'<action name="core.edit.state" title="JACTION_EDITSTATE" description="COM_CATEGORIES_ACCESS_EDITSTATE_DESC" />'.$varObject->return;
			$access[] = $varObject->tab2.'<action name="core.edit.own" title="JACTION_EDITOWN" description="COM_CATEGORIES_ACCESS_EDITOWN_DESC" />'.$varObject->return;
			$access[] = $varObject->tab1.'</section>'.$varObject->return;	
		endif;
		
		$access[] = '</access>';
		
		return $access;
	}
	
	public static function configFile($varObject)
	{
		$config[] = '<?xml version="1.0" encoding="utf-8"?>'.$varObject->return;
		$config[] = '<config>'.$varObject->return;
		$config[] = $varObject->tab1.'<fieldset'.$varObject->return;
		$config[] = $varObject->tab2.'name="permissions"'.$varObject->return;
		$config[] = $varObject->tab2.'label="JCONFIG_PERMISSIONS_LABEL"'.$varObject->return;
		$config[] = $varObject->tab2.'description="JCONFIG_PERMISSIONS_DESC">'.$varObject->return;
		$config[] = $varObject->tab2.'<field'.$varObject->return;
		$config[] = $varObject->tab3.'name="rules"'.$varObject->return;
		$config[] = $varObject->tab3.'type="rules"'.$varObject->return;
		$config[] = $varObject->tab3.'label="JCONFIG_PERMISSIONS_LABEL"'.$varObject->return;
		$config[] = $varObject->tab3.'class="inputbox"'.$varObject->return;
		$config[] = $varObject->tab3.'validate="rules"'.$varObject->return;
		$config[] = $varObject->tab3.'filter="rules"'.$varObject->return;
		$config[] = $varObject->tab3.'component="'.$varObject->com_main.'"'.$varObject->return;
		$config[] = $varObject->tab3.'section="component"'.$varObject->return;
		$config[] = $varObject->tab2.'/>'.$varObject->return;
		$config[] = $varObject->tab1.'</fieldset>'.$varObject->return;
		
		if($varObject->imageUpload):
			$config[] = $varObject->tab1.'<fieldset'.$varObject->return;
			$config[] = $varObject->tab2.'name="image_params"'.$varObject->return;
			$config[] = $varObject->tab2.'label="Images"'.$varObject->return;
			$config[] = $varObject->tab2.'description="Image paremeters">'.$varObject->return;
			$config[] = $varObject->tab2.'<field'.$varObject->return;
			$config[] = $varObject->tab3.'name="image_width"'.$varObject->return;
			$config[] = $varObject->tab3.'type="text"'.$varObject->return;
			$config[] = $varObject->tab3.'label="Width (px)"'.$varObject->return;
			$config[] = $varObject->tab3.'description="Set the width of the image in px to be resized to. (Max: 900)"'.$varObject->return;
			$config[] = $varObject->tab3.'default="'.$varObject->imageWidth.'"'.$varObject->return;
			$config[] = $varObject->tab2.'/>'.$varObject->return;
			$config[] = $varObject->tab2.'<field'.$varObject->return;
			$config[] = $varObject->tab3.'name="image_height"'.$varObject->return;
			$config[] = $varObject->tab3.'type="text"'.$varObject->return;
			$config[] = $varObject->tab3.'label="Height (px)"'.$varObject->return;
			$config[] = $varObject->tab3.'description="Set the height of the image in px to be resized to. (Max: 700)"'.$varObject->return;
			$config[] = $varObject->tab3.'default="'.$varObject->imageHeight.'"'.$varObject->return;
			$config[] = $varObject->tab2.'/>'.$varObject->return;
			$config[] = $varObject->tab2.'<field'.$varObject->return;
			$config[] = $varObject->tab3.'name="image_thumb_width"'.$varObject->return;
			$config[] = $varObject->tab3.'type="text"'.$varObject->return;
			$config[] = $varObject->tab3.'label="Thumbnail Width (px)"'.$varObject->return;
			$config[] = $varObject->tab3.'description="Set the width of the image thumbnail in px to be resized to. (Max: 400)"'.$varObject->return;
			$config[] = $varObject->tab3.'default="'.$varObject->imageThumbHW.'"'.$varObject->return;
			$config[] = $varObject->tab2.'/>'.$varObject->return;
			$config[] = $varObject->tab2.'<field'.$varObject->return;
			$config[] = $varObject->tab3.'name="image_thumb_height"'.$varObject->return;
			$config[] = $varObject->tab3.'type="text"'.$varObject->return;
			$config[] = $varObject->tab3.'label="Thumbnail Height (px)"'.$varObject->return;
			$config[] = $varObject->tab3.'description="Set the height of the image thumbnail in px to be resized to. (Max: 400)"'.$varObject->return;
			$config[] = $varObject->tab3.'default="'.$varObject->imageThumbHW.'"'.$varObject->return;
			$config[] = $varObject->tab2.'/>'.$varObject->return;
			$config[] = $varObject->tab1.'</fieldset>'.$varObject->return;
		endif;
		
		$config[] = '</config>';
		
		return $config;
	}
	
	public static function componentFile($varObject)
	{
		$filename = $varObject->comp_m_view.'.php';
		$componentlines[] = '<?php'.$varObject->return;
		$componentlines[] = Helpers::phpheader($filename, $varObject);
		$componentlines[] = Helpers::nodirectaccess($varObject);
		$componentlines[] = $varObject->return;
		
		// Check if Joomla 3.0
		if($varObject->j_version == '3.0' || $varObject->j_version == '3.2'):
			$componentlines[] = '// Added for Joomla 3.0'.$varObject->return;
			$componentlines[] = 'if(!defined(\'DS\')){'.$varObject->return;
			$componentlines[] = $varObject->tab1.'define(\'DS\',DIRECTORY_SEPARATOR);'.$varObject->return;
			$componentlines[] = '};'.$varObject->return;
			$componentlines[] = $varObject->return;
		endif;
		
		$componentlines[] = '// Access check.'.$varObject->return;
		$componentlines[] = 'if (!JFactory::getUser()->authorise(\'core.manage\', \''.$varObject->com_main.'\')){'.$varObject->return;
		$componentlines[] = $varObject->tab1.'return JError::raiseWarning(404, JText::_(\'JERROR_ALERTNOAUTHOR\'));'.$varObject->return;
		$componentlines[] = '};'.$varObject->return;
		$componentlines[] = $varObject->return;
		
		// Only Joomla 3.0 supported
		if($varObject->j_version == '3.0' || $varObject->j_version == '3.2'):
			$componentlines[] = '// Load cms libraries'.$varObject->return;
			$componentlines[] = 'JLoader::registerPrefix(\'J\', JPATH_PLATFORM . \'/cms\');'.$varObject->return;
			$componentlines[] = '// Load joomla libraries without overwrite'.$varObject->return;
			$componentlines[] = 'JLoader::registerPrefix(\'J\', JPATH_PLATFORM . \'/joomla\',false);'.$varObject->return;
			$componentlines[] = $varObject->return;
		endif;
		
		$componentlines[] = '// require helper files'.$varObject->return;
		$componentlines[] = 'JLoader::register(\''.$varObject->comp_m_view_cap.'Helper\', dirname(__FILE__) . DS . \'helpers\' . DS . \''.$filename.'\');'.$varObject->return;
		$componentlines[] = $varObject->return;
		$componentlines[] = '// import joomla controller library'.$varObject->return;
		$componentlines[] = 'jimport(\'joomla.application.component.controller\');'.$varObject->return;
		$componentlines[] = $varObject->return;
		$componentlines[] = '// Add CSS file for all pages'.$varObject->return;
		$componentlines[] = '$document = JFactory::getDocument();'.$varObject->return;
		$componentlines[] = '$document->addStyleSheet(\'components/'.$varObject->com_main.'/assets/css/'.$varObject->comp_m_view.'.css\');'.$varObject->return;
		$componentlines[] = '$document->addScript(\'components/'.$varObject->com_main.'/assets/js/'.$varObject->comp_m_view.'.js\');'.$varObject->return;
		$componentlines[] = $varObject->return;
		$componentlines[] = '// Get an instance of the controller prefixed by '.$varObject->comp_m_view_cap.$varObject->return;
		$componentlines[] = '$controller = '.$varObject->j_controller.'::getInstance(\''.$varObject->comp_m_view_cap.'\');'.$varObject->return;
		$componentlines[] = $varObject->return;
		$componentlines[] = '// Perform the Request task'.$varObject->return;
		
		if($varObject->j_version == '3.0' || $varObject->j_version == '3.2'):
			$componentlines[] = '$controller->execute(JFactory::getApplication()->input->get(\'task\'));'.$varObject->return;
		else:
			$componentlines[] = '$controller->execute(JRequest::getCmd(\'task\'));'.$varObject->return;
		endif;
		
		$componentlines[] = $varObject->return;
		$componentlines[] = '// Redirect if set by the controller'.$varObject->return;
		$componentlines[] = '$controller->redirect();'.$varObject->return;
		$componentlines[] = $varObject->return;
		$componentlines[] = '?>';
		
		return $componentlines;
	}
	
	public static function controllerFile($varObject, $filename)
	{
		$controllerlines[] = '<?php'.$varObject->return;
		$controllerlines[] = Helpers::phpheader($filename, $varObject);
		$controllerlines[] = Helpers::nodirectaccess($varObject);
		$controllerlines[] = $varObject->return;
		$controllerlines[] = '// import Joomla controller library'.$varObject->return;
		$controllerlines[] = 'jimport(\'joomla.application.component.controller\');'.$varObject->return;
		$controllerlines[] = $varObject->return;
		$controllerlines[] = '/**'.$varObject->return;
		$controllerlines[] = ' * General Controller of '.$varObject->comp_m_view_cap.' component'.$varObject->return;
		$controllerlines[] = ' */'.$varObject->return;
		$controllerlines[] = 'class '.$varObject->comp_m_view_cap.'Controller extends '.$varObject->j_controller.$varObject->return;
		$controllerlines[] = '{'.$varObject->return;
		$controllerlines[] = $varObject->tab1.'/**'.$varObject->return;
		$controllerlines[] = $varObject->tab1.' * display task'.$varObject->return;
		$controllerlines[] = $varObject->tab1.' *'.$varObject->return;
		$controllerlines[] = $varObject->tab1.' * @return void'.$varObject->return;
		$controllerlines[] = $varObject->tab1.' */'.$varObject->return;
		$controllerlines[] = $varObject->tab1.$varObject->j_controller_display_function.$varObject->return;
		$controllerlines[] = $varObject->tab1.'{'.$varObject->return;
		$controllerlines[] = $varObject->tab2.'// set default view if not set'.$varObject->return;
		$controllerlines[] = $varObject->tab2.'JRequest::setVar(\'view\', JRequest::getCmd(\'view\', \''.$varObject->comp_m_view_cap.'\'));'.$varObject->return;
		$controllerlines[] = $varObject->return;
		$controllerlines[] = $varObject->tab2.'// call parent behavior'.$varObject->return;
		$controllerlines[] = $varObject->tab2.'parent::display($cachable);'.$varObject->return;
		$controllerlines[] = $varObject->return;
		$controllerlines[] = $varObject->tab2.'// set view'.$varObject->return;
		$controllerlines[] = $varObject->tab2.'$view = strtolower(JRequest::getVar(\'view\'));'.$varObject->return;
		$controllerlines[] = $varObject->return;
		$controllerlines[] = $varObject->tab2.'// Set the submenu'.$varObject->return;
		$controllerlines[] = $varObject->tab2.$varObject->comp_m_view_cap.'Helper::addSubmenu($view);'.$varObject->return;
		$controllerlines[] = $varObject->tab1.'}'.$varObject->return;
		$controllerlines[] = '}'.$varObject->return;
		$controllerlines[] = '?>';
		
		return $controllerlines;
	}
	
	public static function helperFile($varObject)
	{
		$filename = $varObject->comp_m_view.'.php';
		$helperlines[] = '<?php'.$varObject->return;
		$helperlines[] = Helpers::phpheader($filename, $varObject);
		$helperlines[] = Helpers::nodirectaccess($varObject);
		$helperlines[] = $varObject->return;
		$helperlines[] = '/**'.$varObject->return;
		$helperlines[] = ' * '.$varObject->comp_m_view_cap.' component helper.'.$varObject->return;
		$helperlines[] = ' */'.$varObject->return;
		$helperlines[] = 'abstract class '.$varObject->comp_m_view_cap.'Helper'.$varObject->return;
		$helperlines[] = '{'.$varObject->return;
		$helperlines[] = $varObject->tab1.'/**'.$varObject->return;
		$helperlines[] = $varObject->tab1.' *	Configure the Linkbar.'.$varObject->return;
		$helperlines[] = $varObject->tab1.' */'.$varObject->return;
		$helperlines[] = $varObject->tab1.'public static function addSubmenu($submenu) '.$varObject->return;
		$helperlines[] = $varObject->tab1.'{'.$varObject->return;
		$categories = 0;
		
		// Handle views
		foreach($varObject->allViews as $view):
			// Check for categories view
			if($view['plural']['safe'] == 'categories' || $view['plural']['safe'] == 'category'):
				$helperlines[] = $varObject->tab2.$varObject->j_helper_sub_menu_type.'::addEntry(JText::_(\''.$view['plural']['cap'].'\'), \'index.php?option=com_categories&view=categories&extension='.$varObject->com_main.'\', $submenu == \''.$view['plural']['safe'].'\');'.$varObject->return;
				$categories = 1;
			else:
				$helperlines[] = $varObject->tab2.$varObject->j_helper_sub_menu_type.'::addEntry(JText::_(\''.$view['plural']['cap'].'\'), \'index.php?option='.$varObject->com_main.'&view='.$view['plural']['safe'].'\', $submenu == \''.$view['plural']['safe'].'\');'.$varObject->return;
			endif;
		endforeach;
		
		// Check for categories include
		if($varObject->includeCat):
			$helperlines[] = $varObject->tab2.$varObject->j_helper_sub_menu_type.'::addEntry(JText::_(\'Categories\'), \'index.php?option=com_categories&view=categories&extension='.$varObject->com_main.'\', $submenu == \'categories\');'.$varObject->return;
			$categories = 1;
		endif;
		
		// If categories are being used, set the title
		if($categories):
			$helperlines[] = $varObject->return;
			$helperlines[] = $varObject->tab2.'// set some global property'.$varObject->return;
			$helperlines[] = $varObject->tab2.'$document = JFactory::getDocument();'.$varObject->return;
			$helperlines[] = $varObject->tab2.'if ($submenu == \'categories\'){'.$varObject->return;
			$helperlines[] = $varObject->tab3.'$document->setTitle(JText::_(\'Categories - '.$varObject->comp_m_view_cap.'\'));'.$varObject->return;
			$helperlines[] = $varObject->tab2.'};'.$varObject->return;
		endif;
		
		$helperlines[] = $varObject->tab1.'}'.$varObject->return;
		$helperlines[] = $varObject->return;
		$helperlines[] = $varObject->tab1.'/**'.$varObject->return;
		$helperlines[] = $varObject->tab1.' *	Get the actions'.$varObject->return;
		$helperlines[] = $varObject->tab1.' */'.$varObject->return;
		$helperlines[] = $varObject->tab1.'public static function getActions($Id = 0)'.$varObject->return;
		$helperlines[] = $varObject->tab1.'{'.$varObject->return;
		$helperlines[] = $varObject->tab2.'jimport(\'joomla.access.access\');'.$varObject->return;
		$helperlines[] = $varObject->return;
		$helperlines[] = $varObject->tab2.'$user	= JFactory::getUser();'.$varObject->return;
		$helperlines[] = $varObject->tab2.'$result	= new JObject;'.$varObject->return;
		$helperlines[] = $varObject->return;
		$helperlines[] = $varObject->tab2.'if (empty($Id)){'.$varObject->return;
		$helperlines[] = $varObject->tab3.'$assetName = \''.$varObject->com_main.'\';'.$varObject->return;
		$helperlines[] = $varObject->tab2.'} else {'.$varObject->return;
		$helperlines[] = $varObject->tab3.'$assetName = \''.$varObject->com_main.'.message.\'.(int) $Id;'.$varObject->return;
		$helperlines[] = $varObject->tab2.'};'.$varObject->return;
		$helperlines[] = $varObject->return;
		$helperlines[] = $varObject->tab2.'$actions = JAccess::getActions(\''.$varObject->com_main.'\', \'component\');'.$varObject->return;
		$helperlines[] = $varObject->return;
		$helperlines[] = $varObject->tab2.'foreach ($actions as $action){'.$varObject->return;
		$helperlines[] = $varObject->tab3.'$result->set($action->name, $user->authorise($action->name, $assetName));'.$varObject->return;
		$helperlines[] = $varObject->tab2.'};'.$varObject->return;
		$helperlines[] = $varObject->return;
		$helperlines[] = $varObject->tab2.'return $result;'.$varObject->return;
		$helperlines[] = $varObject->tab1.'}'.$varObject->return;
		
		
		if($varObject->imageUpload):
			$helperlines[] = $varObject->return;
			$helperlines[] = $varObject->tab1.'/**'.$varObject->return;
			$helperlines[] = $varObject->tab1.' *	File Uploader'.$varObject->return;
			$helperlines[] = $varObject->tab1.' */'.$varObject->return;
			$helperlines[] = $varObject->tab1.'public static function imageUpload($file, $data, $fieldname)'.$varObject->return;
			$helperlines[] = $varObject->tab1.'{'.$varObject->return;
			$helperlines[] = $varObject->tab2.'$componentParams	= JComponentHelper::getParams(\''.$varObject->com_main.'\');'.$varObject->return;
			$helperlines[] = $varObject->tab2.'$maxWidth			= $componentParams->get(\'image_width\', 600);'.$varObject->return;
			$helperlines[] = $varObject->tab2.'$maxHeight			= $componentParams->get(\'image_height\', 500);'.$varObject->return;
			$helperlines[] = $varObject->tab2.'$maxThumbWidth		= $componentParams->get(\'image_thumb_width\', 150);'.$varObject->return;
			$helperlines[] = $varObject->tab2.'$maxThumbHeight		= $componentParams->get(\'image_thumb_height\', 150);'.$varObject->return;
			$helperlines[] = $varObject->return;
			$helperlines[] = $varObject->tab2.'// Include file system helpers'.$varObject->return;
			$helperlines[] = $varObject->tab2.'jimport(\'joomla.filesystem.file\');'.$varObject->return;
			$helperlines[] = $varObject->tab2.'jimport(\'joomla.filesystem.folder\');'.$varObject->return;
			$helperlines[] = $varObject->return;
			$helperlines[] = $varObject->tab2.'// Include wideimage - http://wideimage.sourceforge.net'.$varObject->return;
			$helperlines[] = $varObject->tab2.'require_once(\'components/'.$varObject->com_main.'/assets/wideimage/WideImage.php\');'.$varObject->return;
			$helperlines[] = $varObject->return;
			$helperlines[] = $varObject->tab2.'// Set message array'.$varObject->return;
			$helperlines[] = $varObject->tab2.'$info = array();'.$varObject->return;
			$helperlines[] = $varObject->return;
			$helperlines[] = $varObject->tab2.'// Set folders'.$varObject->return;
			$helperlines[] = $varObject->tab2.'$mediaFolder	= JPATH_SITE . DS . \'images\' . DS . \''.$varObject->com_main.'\';'.$varObject->return;
			$helperlines[] = $varObject->tab2.'$thumbFolder	= $mediaFolder . DS . \'thumb\';'.$varObject->return;
			$helperlines[] = $varObject->tab2.'$tmpFolder		= $mediaFolder . DS . \'tmp\';'.$varObject->return;
			$helperlines[] = $varObject->return;
			$helperlines[] = $varObject->tab2.'// File size limit 10000000kb or 10MB'.$varObject->return;
			$helperlines[] = $varObject->tab2.'$fileSize = $file[\'size\'][$fieldname];'.$varObject->return;
			$helperlines[] = $varObject->tab2.'if($fileSize > 10000000){'.$varObject->return;
			$helperlines[] = $varObject->tab3.'$info[\'error\']	= 1;'.$varObject->return;
			$helperlines[] = $varObject->tab3.'$info[\'msg\']	= JText::_(\'Can not upload a file over 10MB, please make this file smaller so that it is under the limit\');'.$varObject->return;
			$helperlines[] = $varObject->tab3.'return $info;'.$varObject->return;
			$helperlines[] = $varObject->tab2.'}'.$varObject->return;
			$helperlines[] = $varObject->return;
			$helperlines[] = $varObject->tab2.'// Any errors the server registered on uploading'.$varObject->return;
			$helperlines[] = $varObject->tab2.'$fileError = $file[\'error\'][$fieldname];'.$varObject->return;
			$helperlines[] = $varObject->tab2.'if ($fileError > 0){'.$varObject->return;
			$helperlines[] = $varObject->tab3.'switch ($fileError)'.$varObject->return;
			$helperlines[] = $varObject->tab3.'{'.$varObject->return;
			$helperlines[] = $varObject->tab4.'case 1:'.$varObject->return;
			$helperlines[] = $varObject->tab5.'$info[\'error\']	= 1;'.$varObject->return;
			$helperlines[] = $varObject->tab5.'$info[\'msg\']	= JText::_(\'Image is larger than the php.ini allows, please make changes to your server php.ini file\');'.$varObject->return;
			$helperlines[] = $varObject->tab5.'return $info;'.$varObject->return;
			$helperlines[] = $varObject->tab4.'case 2:'.$varObject->return;
			$helperlines[] = $varObject->tab5.'$info[\'error\']	= 1;'.$varObject->return;
			$helperlines[] = $varObject->tab5.'$info[\'msg\']	= JText::_(\'The form does not allow this sized image to be uploaded, please resize the image\');'.$varObject->return;
			$helperlines[] = $varObject->tab5.'return $info;'.$varObject->return;
			$helperlines[] = $varObject->tab4.'case 3:'.$varObject->return;
			$helperlines[] = $varObject->tab5.'$info[\'error\']	= 1;'.$varObject->return;
			$helperlines[] = $varObject->tab5.'$info[\'msg\']	= JText::_(\'There was an error when trying to upload your image, partial image uploaded only.\');'.$varObject->return;
			$helperlines[] = $varObject->tab5.'return $info;'.$varObject->return;
			$helperlines[] = $varObject->tab4.'case 4:'.$varObject->return;
			$helperlines[] = $varObject->tab5.'$info[\'error\']	= 1;'.$varObject->return;
			$helperlines[] = $varObject->tab5.'$info[\'msg\']	= JText::_(\'Error, no image present.\');'.$varObject->return;
			$helperlines[] = $varObject->tab5.'return $info;'.$varObject->return;
			$helperlines[] = $varObject->tab3.'}'.$varObject->return;
			$helperlines[] = $varObject->tab2.'}'.$varObject->return;
			$helperlines[] = $varObject->return;
			$helperlines[] = $varObject->tab2.'// Create folders if they do not exist'.$varObject->return;
			$helperlines[] = $varObject->tab2.'if(!JFolder::exists($mediaFolder)){'.$varObject->return;
			$helperlines[] = $varObject->tab3.'JFolder::create($mediaFolder);'.$varObject->return;
			$helperlines[] = $varObject->tab2.'}'.$varObject->return;
			$helperlines[] = $varObject->tab2.'if(!JFolder::exists($thumbFolder)){'.$varObject->return;
			$helperlines[] = $varObject->tab3.'JFolder::create($thumbFolder);'.$varObject->return;
			$helperlines[] = $varObject->tab2.'}'.$varObject->return;
			$helperlines[] = $varObject->tab2.'if(!JFolder::exists($tmpFolder)){'.$varObject->return;
			$helperlines[] = $varObject->tab3.'JFolder::create($tmpFolder);'.$varObject->return;
			$helperlines[] = $varObject->tab2.'}'.$varObject->return;
			$helperlines[] = $varObject->return;
			$helperlines[] = $varObject->tab2.'// Handle photo'.$varObject->return;
			$helperlines[] = $varObject->tab2.'$fileName 	= $file[\'name\'][$fieldname];'.$varObject->return;
			$helperlines[] = $varObject->tab2.'$fileName	= preg_replace("/[^A-Za-z0-9._]/", "", $fileName);'.$varObject->return;
			$helperlines[] = $varObject->tab2.'$fileTemp 	= $file[\'tmp_name\'][$fieldname];'.$varObject->return;
			$helperlines[] = $varObject->tab2.'$filePath	= $mediaFolder . DS . $fileName;'.$varObject->return;
			$helperlines[] = $varObject->tab2.'$thumbPath	= $thumbFolder . DS . $fileName;'.$varObject->return;
			$helperlines[] = $varObject->tab2.'$tmpArea		= $tmpFolder . DS . $fileName;'.$varObject->return;
			$helperlines[] = $varObject->return;
			$helperlines[] = $varObject->tab2.'//Check for allowed extensions'.$varObject->return;
			$helperlines[] = $varObject->tab2.'$uploadedFileNameParts	= explode(\'.\',$fileName);'.$varObject->return;
			$helperlines[] = $varObject->tab2.'$uploadedFileExtension	= array_pop($uploadedFileNameParts);'.$varObject->return;
			$helperlines[] = $varObject->tab2.'$uploadedFileExtension	= strtolower($uploadedFileExtension);'.$varObject->return;
			$helperlines[] = $varObject->tab2.'$validFileExts			= explode(\',\', \'jpeg,jpg,png,gif\');'.$varObject->return;
			$helperlines[] = $varObject->return;
			$helperlines[] = $varObject->tab2.'//assume the extension is false until we know its ok'.$varObject->return;
			$helperlines[] = $varObject->tab2.'$extOk = false;'.$varObject->return;
			$helperlines[] = $varObject->return;
			$helperlines[] = $varObject->tab2.'//go through every ok extension, if the ok extension matches the file extension (case insensitive)'.$varObject->return;
			$helperlines[] = $varObject->tab2.'//then the file extension is ok'.$varObject->return;
			$helperlines[] = $varObject->tab2.'foreach($validFileExts as $key => $value){'.$varObject->return;
			$helperlines[] = $varObject->tab3.'if(preg_match("/$value/i", $uploadedFileExtension )){'.$varObject->return;
			$helperlines[] = $varObject->tab4.'$extOk			= true;'.$varObject->return;
			$helperlines[] = $varObject->tab4.'$fileExtension	= $value;'.$varObject->return;
			$helperlines[] = $varObject->tab3.'}'.$varObject->return;
			$helperlines[] = $varObject->tab2.'}'.$varObject->return;
			$helperlines[] = $varObject->return;
			$helperlines[] = $varObject->tab2.'// Check if acceptable extension'.$varObject->return;
			$helperlines[] = $varObject->tab2.'if($extOk == false){'.$varObject->return;
			$helperlines[] = $varObject->tab3.'$info[\'error\']	= 1;'.$varObject->return;
			$helperlines[] = $varObject->tab3.'$info[\'msg\']	= JText::_(\'Not acceptable image extension\');'.$varObject->return;
			$helperlines[] = $varObject->return;
			$helperlines[] = $varObject->tab3.'return $info;'.$varObject->return;
			$helperlines[] = $varObject->tab2.'}'.$varObject->return;
			$helperlines[] = $varObject->return;
			$helperlines[] = $varObject->tab2.'// Get image information'.$varObject->return;
			$helperlines[] = $varObject->tab2.'list($width, $height, $type, $attr) = getimagesize($fileTemp);'.$varObject->return;
			$helperlines[] = $varObject->return;
			$helperlines[] = $varObject->tab2.'// Check if there is a file'.$varObject->return;
			$helperlines[] = $varObject->tab2.'if($fileName){'.$varObject->return;
			$helperlines[] = $varObject->tab3.'// Try to upload file'.$varObject->return;
			$helperlines[] = $varObject->tab3.'if(!JFile::upload($fileTemp, $filePath)){'.$varObject->return;
			$helperlines[] = $varObject->tab4.'$info[\'error\']	= 1;'.$varObject->return;
			$helperlines[] = $varObject->tab4.'$info[\'msg\']	= JText::_(\'There was an error uploading your image, please try again\');'.$varObject->return;
			$helperlines[] = $varObject->return;
			$helperlines[] = $varObject->tab4.'return $info;'.$varObject->return;
			$helperlines[] = $varObject->tab3.'} else { // Else file has been uploaded!'.$varObject->return;
			$helperlines[] = $varObject->tab4.'// restrictions taken into account'.$varObject->return;
			$helperlines[] = $varObject->tab4.'if($maxWidth > 900){'.$varObject->return;
			$helperlines[] = $varObject->tab5.'$maxWidth = 900;'.$varObject->return;
			$helperlines[] = $varObject->tab4.'}'.$varObject->return;
			$helperlines[] = $varObject->tab4.'if($maxHeight > 700){'.$varObject->return;
			$helperlines[] = $varObject->tab5.'$maxHeight = 700;'.$varObject->return;
			$helperlines[] = $varObject->tab4.'}'.$varObject->return;
			$helperlines[] = $varObject->tab4.'if($maxThumbWidth > 400){'.$varObject->return;
			$helperlines[] = $varObject->tab5.'$maxThumbWidth = 400;'.$varObject->return;
			$helperlines[] = $varObject->tab4.'}'.$varObject->return;
			$helperlines[] = $varObject->tab4.'if($maxThumbHeight > 400){'.$varObject->return;
			$helperlines[] = $varObject->tab5.'$maxThumbHeight = 400;'.$varObject->return;
			$helperlines[] = $varObject->tab4.'}'.$varObject->return;
			$helperlines[] = $varObject->return;
			$helperlines[] = $varObject->tab4.'// Full Image'.$varObject->return;
			$helperlines[] = $varObject->tab4.'// if the image is huge, then we need to resize on the fly'.$varObject->return;
			$helperlines[] = $varObject->tab4.'// so that wideimage library can do its thing'.$varObject->return;
			$helperlines[] = $varObject->tab4.'if($width > 900 || $height > 700){'.$varObject->return;
			$helperlines[] = $varObject->tab5.'if($uploadedFileExtension == "jpg" || $uploadedFileExtension == "jpeg" ){'.$varObject->return;
			$helperlines[] = $varObject->tab6.'$src = imagecreatefromjpeg($filePath);'.$varObject->return;
			$helperlines[] = $varObject->tab5.'} elseif($uploadedFileExtension == "png"){'.$varObject->return;
			$helperlines[] = $varObject->tab6.'$src = imagecreatefrompng($filePath);'.$varObject->return;
			$helperlines[] = $varObject->tab5.'} else {'.$varObject->return;
			$helperlines[] = $varObject->tab6.'$src = imagecreatefromgif($filePath);'.$varObject->return;
			$helperlines[] = $varObject->tab5.'}'.$varObject->return;
			$helperlines[] = $varObject->return;
			$helperlines[] = $varObject->tab5.'list($width, $height) = getimagesize($filePath);'.$varObject->return;
			$helperlines[] = $varObject->return;
			$helperlines[] = $varObject->tab5.'$wRatio		= $width / $maxWidth;'.$varObject->return;
			$helperlines[] = $varObject->tab5.'$hRatio		= $height / $maxHeight;'.$varObject->return;
			$helperlines[] = $varObject->tab5.'$maxRatio	= max($wRatio, $hRatio);'.$varObject->return;
			$helperlines[] = $varObject->tab5.'if ($maxRatio > 1) {'.$varObject->return;
			$helperlines[] = $varObject->tab6.'$newwidth	= $width / $maxRatio;'.$varObject->return;
			$helperlines[] = $varObject->tab6.'$newheight	= $height / $maxRatio;'.$varObject->return;
			$helperlines[] = $varObject->tab5.'} else {'.$varObject->return;
			$helperlines[] = $varObject->tab6.'$newwidth	= $width;'.$varObject->return;
			$helperlines[] = $varObject->tab6.'$newheight	= $height;'.$varObject->return;
			$helperlines[] = $varObject->tab5.'}'.$varObject->return;
			$helperlines[] = $varObject->return;
			$helperlines[] = $varObject->tab5.'$tmp				= imagecreatetruecolor($newwidth, $newheight);'.$varObject->return;
			$helperlines[] = $varObject->tab5.'$backgroundColor	= imagecolorallocate($tmp, 255, 255, 255);'.$varObject->return;
			$helperlines[] = $varObject->return;
			$helperlines[] = $varObject->tab5.'imagefill($tmp, 0, 0, $backgroundColor);'.$varObject->return;
			$helperlines[] = $varObject->tab5.'imagecopyresampled($tmp, $src, 0, 0, 0, 0,$newwidth, $newheight, $width, $height);'.$varObject->return;
			$helperlines[] = $varObject->tab5.'imagejpeg($tmp, $filePath, 100);'.$varObject->return;
			$helperlines[] = $varObject->tab5.'imagedestroy($src);'.$varObject->return;
			$helperlines[] = $varObject->tab5.'imagedestroy($tmp);'.$varObject->return;
			$helperlines[] = $varObject->tab4.'}'.$varObject->return;
			$helperlines[] = $varObject->return;
			$helperlines[] = $varObject->tab4.'// Thumb Image'.$varObject->return;
			$helperlines[] = $varObject->tab4.'$image	= WideImage::load($filePath);'.$varObject->return;
			$helperlines[] = $varObject->tab4.'$resized	= $image->resize($maxThumbWidth, $maxThumbHeight, \'outside\')->crop(\'center\', \'center\', $maxThumbWidth, $maxThumbHeight);'.$varObject->return;
			$helperlines[] = $varObject->tab4.'$resized->saveToFile($thumbPath);'.$varObject->return;
			$helperlines[] = $varObject->return;
			$helperlines[] = $varObject->tab4.'// Full Image'.$varObject->return;
			$helperlines[] = $varObject->tab4.'$image	= WideImage::load($filePath);'.$varObject->return;
			$helperlines[] = $varObject->tab4.'$resized	= $image->resize($maxWidth, $maxHeight, \'outside\')->crop(\'center\', \'middle\', $maxWidth, $maxHeight);'.$varObject->return;
			$helperlines[] = $varObject->tab4.'$resized->saveToFile($filePath);'.$varObject->return;
			$helperlines[] = $varObject->return;
			$helperlines[] = $varObject->tab4.'// Set return variables'.$varObject->return;
			$helperlines[] = $varObject->tab4.'$info[$fieldname]	= $fileName;'.$varObject->return;
			$helperlines[] = $varObject->tab4.'$info[\'error\']		= 0;'.$varObject->return;
			$helperlines[] = $varObject->tab4.'$info[\'msg\']		= JText::_(\'File Uploaded!\');'.$varObject->return;
			$helperlines[] = $varObject->return;
			$helperlines[] = $varObject->tab4.'return $info;'.$varObject->return;
			$helperlines[] = $varObject->tab3.'}'.$varObject->return;
			$helperlines[] = $varObject->tab2.'} else {'.$varObject->return;
			$helperlines[] = $varObject->tab3.'$info[\'error\']	= 1;'.$varObject->return;
			$helperlines[] = $varObject->tab3.'$info[\'msg\']	= JText::_(\'No image selected to upload\');'.$varObject->return;
			$helperlines[] = $varObject->return;
			$helperlines[] = $varObject->tab3.'return $info;'.$varObject->return;
			$helperlines[] = $varObject->tab2.'}'.$varObject->return;
			$helperlines[] = $varObject->tab1.'}'.$varObject->return;
		endif;
		
		$helperlines[] = '}'.$varObject->return;
		$helperlines[] = '?>';
		
		return $helperlines;
	}
	
	public static function languageFile($varObject)
	{
		$languagelines[] = $varObject->com_language .'_N_ITEMS_DELETED="%s item(s) deleted."'.$varObject->return;
		$languagelines[] = $varObject->com_language .'_N_ITEMS_DELETED_1="%s item deleted."'.$varObject->return;
		$languagelines[] = $varObject->com_language .'_CONFIGURATION="'.$varObject->comp_m_view_cap.' Configuration"'.$varObject->return; // added v.0.6.0
		$languagelines[] = $varObject->com_language .'_N_ITEMS_CHECKED_IN="%s item(s) checked in."'; // added v.1.1.0
		
		return $languagelines;
	}
	
	public static function languagesysFile($varObject, $extraSysLanguageLines)
	{
		$languagesyslines[] = $varObject->com_language . '="' . $varObject->comp_m_view_cap . '"'.$varObject->return;
		$languagesyslines[] = $varObject->com_language_menu . '="' . $varObject->comp_m_view_cap . ' Manager"';
		
		if($varObject->allViews):
			$languagesyslines[] = $varObject->return . $varObject->return;
			foreach($varObject->allViews as $view):
				$languagesyslines[] = $varObject->com_language_menu.'_'.$view['plural']['language'].'="'.$view['plural']['cap'].'"';
				$languagesyslines[] = $varObject->return;
			endforeach;
			// Check for include of categories
			if($varObject->includeCat):
				$languagesyslines[] = $varObject->com_language_menu.'_MENU_CATEGORIES="Categories"';
				$languagesyslines[] = $varObject->return;
			endif;
			array_pop($languagesyslines);
		endif;
		
		if(!empty($extraSysLanguageLines)):
			$languagesyslines[] = $varObject->return . $varObject->return;
			foreach($extraSysLanguageLines as $extraSysLanguageLine):
				$languagesyslines[] = $extraSysLanguageLine;
				$languagesyslines[] = $varObject->return;
			endforeach;
			// Remove last array() entry, which is the return
			array_pop($languagesyslines);
		endif;
		
		return $languagesyslines;
	}
	
	public static function cssFile($varObject)
	{
		$csslines[] = '';
		// Check for views
		if(count($varObject->allViews)):
			// Parse through the views
			foreach($varObject->allViews as $view):
				// Check if there are images in the object, if so, add them
				if(isset($varObject->imagesUploaded[$view['plural']['orig']])):
					$csslines[] = '.icon-48-' . $view['plural']['safe'] . ' { background-image: url(\'../images/icons/'.$varObject->imagesUploaded[$view['plural']['orig']]->mana.'\'); }';
					$csslines[] = $varObject->return;
					$csslines[] = '.icon-48-' . $view['singular']['safe'] . ' { background-image: url(\'../images/icons/'.$varObject->imagesUploaded[$view['plural']['orig']]->mana.'\'); }';
					$csslines[] = $varObject->return;
				endif;
			endforeach;
			// Remove last array() entry, which is the return
			array_pop($csslines);
		endif;
		
		return $csslines;
	}
	
	public static function viewsViewHtml25($view, $varObject, $filename)
	{
		$viewhtmllines[] = '<?php'.$varObject->return;
		$viewhtmllines[] = Helpers::phpheader($filename, $varObject);
		$viewhtmllines[] = Helpers::nodirectaccess($varObject);
		$viewhtmllines[] = $varObject->return;
		$viewhtmllines[] = '// import Joomla view library'.$varObject->return;
		$viewhtmllines[] = 'jimport(\'joomla.application.component.view\');'.$varObject->return;
		$viewhtmllines[] = $varObject->return;
		$viewhtmllines[] = '/**'.$varObject->return;
		$viewhtmllines[] = ' * '.$view['plural']['orig'].' View'.$varObject->return;
		$viewhtmllines[] = ' */'.$varObject->return;
		$viewhtmllines[] = 'class '.$varObject->comp_m_view_cap.'View'.$view['plural']['safe'].' extends '.$varObject->j_view.$varObject->return;
		$viewhtmllines[] = '{'.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.'/**'.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.' * '.$view['plural']['cap'].' view display method'.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.' * @return void'.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.' */'.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.'function display($tpl = null) '.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.'{'.$varObject->return;
		
		// start - added v.0.6.0
		if($varObject->useDatabase):
			$viewhtmllines[] = $varObject->tab2.'// Get data from the model'.$varObject->return;
			$viewhtmllines[] = $varObject->tab2.'$items = $this->get(\'Items\');'.$varObject->return;
			$viewhtmllines[] = $varObject->tab2.'$pagination = $this->get(\'Pagination\');'.$varObject->return;
			$viewhtmllines[] = $varObject->return;
			$viewhtmllines[] = $varObject->tab2.'// Check for errors.'.$varObject->return;
			$viewhtmllines[] = $varObject->tab2.'if (count($errors = $this->get(\'Errors\'))){'.$varObject->return;
			$viewhtmllines[] = $varObject->tab3.'JError::raiseError(500, implode(\'<br />\', $errors));'.$varObject->return;
			$viewhtmllines[] = $varObject->tab3.'return false;'.$varObject->return;
			$viewhtmllines[] = $varObject->tab2.'};'.$varObject->return;
			$viewhtmllines[] = $varObject->return;
			$viewhtmllines[] = $varObject->tab2.'// Assign data to the view'.$varObject->return;
			$viewhtmllines[] = $varObject->tab2.'$this->items = $items;'.$varObject->return;
			$viewhtmllines[] = $varObject->tab2.'$this->pagination = $pagination;'.$varObject->return;
			$viewhtmllines[] = $varObject->return;
		endif;
		// end - added v.0.6.0
		
		// Don't need a toolbar if this is just a view by itself
		if(!is_numeric($view['singular']['safe'])):
			$viewhtmllines[] = $varObject->tab2.'// Set the toolbar'.$varObject->return;
			$viewhtmllines[] = $varObject->tab2.'$this->addToolBar();'.$varObject->return;
			$viewhtmllines[] = $varObject->return;
		endif;
		
		$viewhtmllines[] = $varObject->tab2.'// Display the template'.$varObject->return;
		$viewhtmllines[] = $varObject->tab2.'parent::display($tpl);'.$varObject->return;
		$viewhtmllines[] = $varObject->return;
		$viewhtmllines[] = $varObject->tab2.'// Set the document'.$varObject->return;
		$viewhtmllines[] = $varObject->tab2.'$this->setDocument();'.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.'}'.$varObject->return;
		$viewhtmllines[] = $varObject->return;
		
		// Don't need a toolbar if this is just a view by itself
		if(!is_numeric($view['singular']['safe'])):
			$viewhtmllines[] = $varObject->tab1.'/**'.$varObject->return;
			$viewhtmllines[] = $varObject->tab1.' * Setting the toolbar'.$varObject->return;
			$viewhtmllines[] = $varObject->tab1.' */'.$varObject->return;
			$viewhtmllines[] = $varObject->tab1.'protected function addToolBar() '.$varObject->return;
			$viewhtmllines[] = $varObject->tab1.'{'.$varObject->return;
			
			// start - added v.0.6.0
			if($varObject->useDatabase):
				$viewhtmllines[] = $varObject->tab2.'$canDo = '.$varObject->comp_m_view_cap.'Helper::getActions();'.$varObject->return;
			endif;
			// end - added v.0.6.0
			
			$viewhtmllines[] = $varObject->tab2.'JToolBarHelper::title(JText::_(\''.$varObject->comp_m_view_cap.' Manager\'), \''.$varObject->comp_m_view.'\');'.$varObject->return;
			
			// start - added v.0.6.0
			if($varObject->useDatabase):
				$viewhtmllines[] = $varObject->tab2.'if($canDo->get(\'core.create\')){'.$varObject->return;
				$viewhtmllines[] = $varObject->tab3.'JToolBarHelper::addNew(\''.$view['singular']['safe'].'.add\', \'JTOOLBAR_NEW\');'.$varObject->return;
				$viewhtmllines[] = $varObject->tab2.'};'.$varObject->return;
				$viewhtmllines[] = $varObject->tab2.'if($canDo->get(\'core.edit\')){'.$varObject->return;
				$viewhtmllines[] = $varObject->tab3.'JToolBarHelper::editList(\''.$view['singular']['safe'].'.edit\', \'JTOOLBAR_EDIT\');'.$varObject->return;
				$viewhtmllines[] = $varObject->tab2.'};'.$varObject->return;
				$viewhtmllines[] = $varObject->tab2.'if($canDo->get(\'core.delete\')){'.$varObject->return;
				$viewhtmllines[] = $varObject->tab3.'JToolBarHelper::deleteList(\'\', \''.$view['plural']['safe'].'.delete\', \'JTOOLBAR_DELETE\');'.$varObject->return;
				$viewhtmllines[] = $varObject->tab2.'};'.$varObject->return;
				$viewhtmllines[] = $varObject->tab2.'if($canDo->get(\'core.admin\')){'.$varObject->return;
				$viewhtmllines[] = $varObject->tab3.'JToolBarHelper::divider();'.$varObject->return;
				$viewhtmllines[] = $varObject->tab3.'JToolBarHelper::preferences(\''.$varObject->com_main.'\');'.$varObject->return;
				$viewhtmllines[] = $varObject->tab2.'};'.$varObject->return;
			endif;
			// end - added v.0.6.0
			
			$viewhtmllines[] = $varObject->tab1.'}'.$varObject->return;
			$viewhtmllines[] = $varObject->return;
		endif;
		
		$viewhtmllines[] = $varObject->tab1.'/**'.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.' * Method to set up the document properties'.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.' *'.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.' *'.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.' * @return void'.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.' */'.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.'protected function setDocument() '.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.'{'.$varObject->return;
		$viewhtmllines[] = $varObject->tab2.'$document = JFactory::getDocument();'.$varObject->return;
		$viewhtmllines[] = $varObject->tab2.'$document->setTitle(JText::_(\''.$varObject->comp_m_view_cap.' Manager - Administrator\'));'.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.'}'.$varObject->return;
		$viewhtmllines[] = '}'.$varObject->return;
		$viewhtmllines[] = '?>';
		
		return $viewhtmllines;
	}
	
	public static function viewsViewHtml30($view, $varObject, $filename)
	{
		$viewhtmllines[] = '<?php'.$varObject->return;
		$viewhtmllines[] = Helpers::phpheader($filename, $varObject);
		$viewhtmllines[] = Helpers::nodirectaccess($varObject);
		$viewhtmllines[] = $varObject->return;
		$viewhtmllines[] = '// import Joomla view library'.$varObject->return;
		$viewhtmllines[] = 'jimport(\'joomla.application.component.view\');'.$varObject->return;
		$viewhtmllines[] = $varObject->return;
		$viewhtmllines[] = '/**'.$varObject->return;
		$viewhtmllines[] = ' * '.$view['plural']['orig'].' View'.$varObject->return;
		$viewhtmllines[] = ' */'.$varObject->return;
		$viewhtmllines[] = 'class '.$varObject->comp_m_view_cap.'View'.$view['plural']['safe'].' extends '.$varObject->j_view.$varObject->return;
		$viewhtmllines[] = '{'.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.'/**'.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.' * '.$view['plural']['cap'].' view display method'.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.' * @return void'.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.' */'.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.'function display($tpl = null) '.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.'{'.$varObject->return;
		$viewhtmllines[] = $varObject->tab2.'// Include helper submenu'.$varObject->return;
		$viewhtmllines[] = $varObject->tab2.$varObject->comp_m_view_cap.'Helper::addSubmenu(\''.$view['plural']['safe'].'\');'.$varObject->return;
		$viewhtmllines[] = $varObject->return;
		
		// start - added v.0.6.0
		if($varObject->useDatabase):
			$viewhtmllines[] = $varObject->tab2.'// Get data from the model'.$varObject->return;
			$viewhtmllines[] = $varObject->tab2.'$items = $this->get(\'Items\');'.$varObject->return;
			$viewhtmllines[] = $varObject->tab2.'$pagination = $this->get(\'Pagination\');'.$varObject->return;
			$viewhtmllines[] = $varObject->return;
			$viewhtmllines[] = $varObject->tab2.'// Check for errors.'.$varObject->return;
			$viewhtmllines[] = $varObject->tab2.'if (count($errors = $this->get(\'Errors\'))){'.$varObject->return;
			$viewhtmllines[] = $varObject->tab3.'JError::raiseError(500, implode(\'<br />\', $errors));'.$varObject->return;
			$viewhtmllines[] = $varObject->tab3.'return false;'.$varObject->return;
			$viewhtmllines[] = $varObject->tab2.'};'.$varObject->return;
			$viewhtmllines[] = $varObject->return;
			$viewhtmllines[] = $varObject->tab2.'// Assign data to the view'.$varObject->return;
			$viewhtmllines[] = $varObject->tab2.'$this->items = $items;'.$varObject->return;
			$viewhtmllines[] = $varObject->tab2.'$this->pagination = $pagination;'.$varObject->return;
			$viewhtmllines[] = $varObject->return;
		endif;
		// end - added v.0.6.0
		
		// Don't need a toolbar if this is just a view by itself
		if(!is_numeric($view['singular']['safe'])):
			$viewhtmllines[] = $varObject->tab2.'// Set the toolbar'.$varObject->return;
			$viewhtmllines[] = $varObject->tab2.'$this->addToolBar();'.$varObject->return;
			$viewhtmllines[] = $varObject->tab2.'// Show sidebar'.$varObject->return;
			$viewhtmllines[] = $varObject->tab2.'$this->sidebar = JHtmlSidebar::render();'.$varObject->return;
			$viewhtmllines[] = $varObject->return;
		endif;
		
		$viewhtmllines[] = $varObject->tab2.'// Display the template'.$varObject->return;
		$viewhtmllines[] = $varObject->tab2.'parent::display($tpl);'.$varObject->return;
		$viewhtmllines[] = $varObject->return;
		$viewhtmllines[] = $varObject->tab2.'// Set the document'.$varObject->return;
		$viewhtmllines[] = $varObject->tab2.'$this->setDocument();'.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.'}'.$varObject->return;
		$viewhtmllines[] = $varObject->return;
		
		// Don't need a toolbar if this is just a view by itself
		if(!is_numeric($view['singular']['safe'])):
			$viewhtmllines[] = $varObject->tab1.'/**'.$varObject->return;
			$viewhtmllines[] = $varObject->tab1.' * Setting the toolbar'.$varObject->return;
			$viewhtmllines[] = $varObject->tab1.' */'.$varObject->return;
			$viewhtmllines[] = $varObject->tab1.'protected function addToolBar() '.$varObject->return;
			$viewhtmllines[] = $varObject->tab1.'{'.$varObject->return;
			
			// start - added v.0.6.0
			if($varObject->useDatabase):
				$viewhtmllines[] = $varObject->tab2.'$canDo = '.$varObject->comp_m_view_cap.'Helper::getActions();'.$varObject->return;
			endif;
			// end - added v.0.6.0
			
			$viewhtmllines[] = $varObject->tab2.'JToolBarHelper::title(JText::_(\''.$varObject->comp_m_view_cap.' Manager\'), \''.$varObject->comp_m_view.'\');'.$varObject->return;
			
			// start - added v.0.6.0
			if($varObject->useDatabase):
				$viewhtmllines[] = $varObject->tab2.'if($canDo->get(\'core.create\')){'.$varObject->return;
				$viewhtmllines[] = $varObject->tab3.'JToolBarHelper::addNew(\''.$view['singular']['safe'].'.add\', \'JTOOLBAR_NEW\');'.$varObject->return;
				$viewhtmllines[] = $varObject->tab2.'};'.$varObject->return;
				$viewhtmllines[] = $varObject->tab2.'if($canDo->get(\'core.edit\')){'.$varObject->return;
				$viewhtmllines[] = $varObject->tab3.'JToolBarHelper::editList(\''.$view['singular']['safe'].'.edit\', \'JTOOLBAR_EDIT\');'.$varObject->return;
				$viewhtmllines[] = $varObject->tab2.'};'.$varObject->return;
				$viewhtmllines[] = $varObject->tab2.'if($canDo->get(\'core.delete\')){'.$varObject->return;
				$viewhtmllines[] = $varObject->tab3.'JToolBarHelper::deleteList(\'\', \''.$view['plural']['safe'].'.delete\', \'JTOOLBAR_DELETE\');'.$varObject->return;
				$viewhtmllines[] = $varObject->tab2.'};'.$varObject->return;
				$viewhtmllines[] = $varObject->tab2.'if($canDo->get(\'core.admin\')){'.$varObject->return;
				$viewhtmllines[] = $varObject->tab3.'JToolBarHelper::divider();'.$varObject->return;
				$viewhtmllines[] = $varObject->tab3.'JToolBarHelper::preferences(\''.$varObject->com_main.'\');'.$varObject->return;
				$viewhtmllines[] = $varObject->tab2.'};'.$varObject->return;
			endif;
			// end - added v.0.6.0
			
			$viewhtmllines[] = $varObject->tab1.'}'.$varObject->return;
			$viewhtmllines[] = $varObject->return;
		endif;
		
		$viewhtmllines[] = $varObject->tab1.'/**'.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.' * Method to set up the document properties'.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.' *'.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.' *'.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.' * @return void'.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.' */'.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.'protected function setDocument() '.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.'{'.$varObject->return;
		$viewhtmllines[] = $varObject->tab2.'$document = JFactory::getDocument();'.$varObject->return;
		$viewhtmllines[] = $varObject->tab2.'$document->setTitle(JText::_(\''.$varObject->comp_m_view_cap.' Manager - Administrator\'));'.$varObject->return;
		$viewhtmllines[] = $varObject->tab1.'}'.$varObject->return;
		$viewhtmllines[] = '}'.$varObject->return;
		$viewhtmllines[] = '?>';
		
		return $viewhtmllines;
	}
	
	public static function viewsViewDefault25($view, $varObject, $filename)
	{
		$viewhtmldefaultlines[] = '<?php'.$varObject->return;
		$viewhtmldefaultlines[] = Helpers::phpheader($filename, $varObject);
		$viewhtmldefaultlines[] = Helpers::nodirectaccess($varObject);
		$viewhtmldefaultlines[] = $varObject->return;
		$viewhtmldefaultlines[] = '// load tooltip behavior'.$varObject->return;
		$viewhtmldefaultlines[] = 'JHtml::_(\'behavior.tooltip\');'.$varObject->return;
		$viewhtmldefaultlines[] = '?>'.$varObject->return;
		
		// start - added v.0.6.0
		if($varObject->useDatabase):
			$viewhtmldefaultlines[] = '<form action="<?php echo JRoute::_(\'index.php?option='.$varObject->com_main.'&view='.$view['plural']['safe'].'\'); ?>" method="post" name="adminForm" id="adminForm">'.$varObject->return;
			$viewhtmldefaultlines[] = $varObject->tab1.'<table class="adminlist">'.$varObject->return;
			$viewhtmldefaultlines[] = $varObject->tab2.'<thead><?php echo $this->loadTemplate(\'head\');?></thead>'.$varObject->return;
			$viewhtmldefaultlines[] = $varObject->tab2.'<tfoot><?php echo $this->loadTemplate(\'foot\');?></tfoot>'.$varObject->return;
			$viewhtmldefaultlines[] = $varObject->tab2.'<tbody><?php echo $this->loadTemplate(\'body\');?></tbody>'.$varObject->return;
			$viewhtmldefaultlines[] = $varObject->tab1.'</table>'.$varObject->return;
			$viewhtmldefaultlines[] = $varObject->tab1.'<div>'.$varObject->return;
			$viewhtmldefaultlines[] = $varObject->tab2.'<input type="hidden" name="task" value="" />'.$varObject->return;
			$viewhtmldefaultlines[] = $varObject->tab2.'<input type="hidden" name="boxchecked" value="0" />'.$varObject->return;
			$viewhtmldefaultlines[] = $varObject->tab2.'<?php echo JHtml::_(\'form.token\'); ?>'.$varObject->return;
			$viewhtmldefaultlines[] = $varObject->tab1.'</div>'.$varObject->return;
			$viewhtmldefaultlines[] = '</form>';
		endif;
		// end - added v.0.6.0
		
		return $viewhtmldefaultlines;
	}
	
	public static function viewsViewDefault30($view, $varObject, $filename)
	{
		$viewhtmldefaultlines[] = '<?php'.$varObject->return;
		$viewhtmldefaultlines[] = Helpers::phpheader($filename, $varObject);
		$viewhtmldefaultlines[] = Helpers::nodirectaccess($varObject);
		$viewhtmldefaultlines[] = $varObject->return;
		$viewhtmldefaultlines[] = '// load tooltip behavior'.$varObject->return;
		$viewhtmldefaultlines[] = 'JHtml::_(\'behavior.tooltip\');'.$varObject->return;
		$viewhtmldefaultlines[] = 'JHtml::_(\'behavior.multiselect\');'.$varObject->return;
		$viewhtmldefaultlines[] = 'JHtml::_(\'dropdown.init\');'.$varObject->return;
		$viewhtmldefaultlines[] = 'JHtml::_(\'formbehavior.chosen\', \'select\');'.$varObject->return;
		$viewhtmldefaultlines[] = '?>'.$varObject->return;
		$viewhtmldefaultlines[] = '<form action="<?php echo JRoute::_(\'index.php?option='.$varObject->com_main.'&view='.$view['plural']['safe'].'\'); ?>" method="post" name="adminForm" id="adminForm">'.$varObject->return;
		$viewhtmldefaultlines[] = '<?php if(!empty( $this->sidebar)){ ?>'.$varObject->return;
		$viewhtmldefaultlines[] = $varObject->tab1.'<div id="j-sidebar-container" class="span2">'.$varObject->return;
		$viewhtmldefaultlines[] = $varObject->tab2.'<?php echo $this->sidebar; ?>'.$varObject->return;
		$viewhtmldefaultlines[] = $varObject->tab1.'</div>'.$varObject->return;
		$viewhtmldefaultlines[] = $varObject->tab1.'<div id="j-main-container" class="span10">'.$varObject->return;
		$viewhtmldefaultlines[] = '<?php } else { ?>'.$varObject->return;
		$viewhtmldefaultlines[] = $varObject->tab1.'<div id="j-main-container">'.$varObject->return;
		$viewhtmldefaultlines[] = '<?php }; ?>'.$varObject->return;
		
		// start - added v.0.6.0
		if($varObject->useDatabase):
			$viewhtmldefaultlines[] = $varObject->tab2.'<table class="table table-striped">'.$varObject->return;
			$viewhtmldefaultlines[] = $varObject->tab3.'<thead><?php echo $this->loadTemplate(\'head\');?></thead>'.$varObject->return;
			$viewhtmldefaultlines[] = $varObject->tab3.'<tfoot><?php echo $this->loadTemplate(\'foot\');?></tfoot>'.$varObject->return;
			$viewhtmldefaultlines[] = $varObject->tab3.'<tbody><?php echo $this->loadTemplate(\'body\');?></tbody>'.$varObject->return;
			$viewhtmldefaultlines[] = $varObject->tab2.'</table>'.$varObject->return;
		endif;
		// end - added v.0.6.0
		
		$viewhtmldefaultlines[] = $varObject->tab2.'<div>'.$varObject->return;
		$viewhtmldefaultlines[] = $varObject->tab3.'<input type="hidden" name="task" value="" />'.$varObject->return;
		$viewhtmldefaultlines[] = $varObject->tab3.'<input type="hidden" name="boxchecked" value="0" />'.$varObject->return;
		$viewhtmldefaultlines[] = $varObject->tab3.'<?php echo JHtml::_(\'form.token\'); ?>'.$varObject->return;
		$viewhtmldefaultlines[] = $varObject->tab2.'</div>'.$varObject->return;
		$viewhtmldefaultlines[] = $varObject->tab1.'</div>'.$varObject->return;
		$viewhtmldefaultlines[] = '</form>';

		return $viewhtmldefaultlines;
	}
	
	public static function viewsViewDefaultHead($varObject, $formfields, $filename)
	{
		$viewhtmldefaultheadlines[] = '<?php'.$varObject->return;
		$viewhtmldefaultheadlines[] = Helpers::phpheader($filename, $varObject);
		$viewhtmldefaultheadlines[] = Helpers::nodirectaccess($varObject);
		$viewhtmldefaultheadlines[] = $varObject->return;
		$viewhtmldefaultheadlines[] = '?>'.$varObject->return;
		$viewhtmldefaultheadlines[] = '<tr>'.$varObject->return;
		$viewhtmldefaultheadlines[] = $varObject->tab1.'<th width="5">'.$varObject->return;
		$viewhtmldefaultheadlines[] = $varObject->tab2.'<?php echo JText::_(\'ID\'); ?>'.$varObject->return;
		$viewhtmldefaultheadlines[] = $varObject->tab1.'</th>'.$varObject->return;
		$viewhtmldefaultheadlines[] = $varObject->tab1.'<th width="20">'.$varObject->return;
		$viewhtmldefaultheadlines[] = $varObject->tab2.'<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />'.$varObject->return;
		$viewhtmldefaultheadlines[] = $varObject->tab1.'</th>'.$varObject->return;
		
		// Make sure there is formfields
		if($formfields->name):
			$shown = 0;
			// Parse through fields
			foreach($formfields->name as $key=>$field):
				// Check if field is required to show on manager
				if($formfields->show):
					if (array_key_exists($key, $formfields->show)):
						$field = ucwords($field);
						$viewhtmldefaultheadlines[] = $varObject->tab1.'<th>'.$varObject->return;
						$viewhtmldefaultheadlines[] = $varObject->tab2.'<?php echo JText::_(\''.$field.'\'); ?>'.$varObject->return;
						$viewhtmldefaultheadlines[] = $varObject->tab1.'</th>'.$varObject->return;
					endif;
					$shown = 1;
				endif;
			endforeach;
			// default at least the first field to be the edit field
			if($shown != 1):
				$viewhtmldefaultheadlines[] = $varObject->tab1.'<th>'.$varObject->return;
				$viewhtmldefaultheadlines[] = $varObject->tab2.'<?php echo JText::_(\''.$formfields->name[0].'\'); ?>'.$varObject->return;
				$viewhtmldefaultheadlines[] = $varObject->tab1.'</th>'.$varObject->return;
			endif;
		endif;
		
		$viewhtmldefaultheadlines[] = '</tr>';
		
		return $viewhtmldefaultheadlines;
	}
	
	public static function viewsViewDefaultBody($view, $varObject, $formfields, $filename)
	{
		
		$categoryLookUp	= 0;
		$categoryField	= '';
		
		// Make sure there is formfields
		if($formfields->type):
			if(array_search("category", $formfields->type) && $varObject->includeCat):
				$categoryField = array_search("category", $formfields->type);
				$categoryField = strtolower($formfields->name_safe[$categoryField]);
				$categoryLookUp = 1;
			endif;
		endif;
		
		$firstfield = 1;
		$viewhtmldefaultbodylines[] = '<?php'.$varObject->return;
		$viewhtmldefaultbodylines[] = Helpers::phpheader($filename, $varObject);
		$viewhtmldefaultbodylines[] = Helpers::nodirectaccess($varObject);
		$viewhtmldefaultbodylines[] = $varObject->return;
		$viewhtmldefaultbodylines[] = '$edit = "index.php?option='.$varObject->com_main.'&view='.$view['plural']['safe'].'&task='.$view['singular']['safe'].'.edit";'.$varObject->return;
		$viewhtmldefaultbodylines[] = '$user = JFactory::getUser();'.$varObject->return;
		$viewhtmldefaultbodylines[] = '$userId = $user->get(\'id\');'.$varObject->return;
		
		if($categoryLookUp):
			$viewhtmldefaultbodylines[] = $varObject->return;
			$viewhtmldefaultbodylines[] = '// Connect to database'.$varObject->return;
			$viewhtmldefaultbodylines[] = '$db = JFactory::getDBO();'.$varObject->return;
		endif;
		
		$viewhtmldefaultbodylines[] = '?>'.$varObject->return;
		$viewhtmldefaultbodylines[] = '<?php foreach($this->items as $i => $item){'.$varObject->return;
		$viewhtmldefaultbodylines[] = $varObject->tab1.'$canCheckin	= $user->authorise(\'core.manage\', \'com_checkin\') || $item->checked_out == $userId || $item->checked_out == 0;'.$varObject->return;
		$viewhtmldefaultbodylines[] = $varObject->tab1.'$userChkOut	= JFactory::getUser($item->checked_out);'.$varObject->return;
		
		if($categoryLookUp):
			$viewhtmldefaultbodylines[] = $varObject->tab1.'$categoryTitle = $db->setQuery(\'SELECT #__categories.title FROM #__categories WHERE #__categories.id = "\'.$item->'.$categoryField.'.\'"\')->loadResult();'.$varObject->return;
		endif;
		
		$viewhtmldefaultbodylines[] = $varObject->tab1.'?>'.$varObject->return;
		$viewhtmldefaultbodylines[] = $varObject->tab1.'<tr class="row<?php echo $i % 2; ?>">'.$varObject->return;
		$viewhtmldefaultbodylines[] = $varObject->tab2.'<td>'.$varObject->return;
		$viewhtmldefaultbodylines[] = $varObject->tab3.'<?php echo $item->id; ?>'.$varObject->return;
		$viewhtmldefaultbodylines[] = $varObject->tab2.'</td>'.$varObject->return;
		$viewhtmldefaultbodylines[] = $varObject->tab2.'<td>'.$varObject->return;
		$viewhtmldefaultbodylines[] = $varObject->tab3.'<?php echo JHtml::_(\'grid.id\', $i, $item->id); ?>'.$varObject->return;
		$viewhtmldefaultbodylines[] = $varObject->tab2.'</td>'.$varObject->return;
		
		// Make sure there are formfields
		if($formfields->name_safe):
			$shown = 0;
			// Parse through fields
			foreach($formfields->name_safe as $key=>$field):
				// Check if field is required
				if($formfields->show):
					if (array_key_exists($key, $formfields->show)):
						$viewhtmldefaultbodylines[] = $varObject->tab2.'<td>'.$varObject->return;
						if($firstfield == 1):
							$viewhtmldefaultbodylines[] = $varObject->tab3.'<?php echo $item->'.$field.'; ?> - (<a href="<?php echo $edit; ?>&id=<?php echo $item->id; ?>"><?php echo \'Edit\'; ?></a>)'.$varObject->return;
							$viewhtmldefaultbodylines[] = $varObject->tab3.'<?php if ($item->checked_out){ ?>'.$varObject->return;
							$viewhtmldefaultbodylines[] = $varObject->tab4.'<?php echo JHtml::_(\'jgrid.checkedout\', $i, $userChkOut->name, $item->checked_out_time, \''.$view['plural']['safe'].'.\', $canCheckin); ?>'.$varObject->return;
							$viewhtmldefaultbodylines[] = $varObject->tab3.'<?php } ?>'.$varObject->return;
							$firstfield++;
						else:
							if($formfields->type[$key] == 'category' && $categoryLookUp):
								$viewhtmldefaultbodylines[] = $varObject->tab3.'<a href="index.php?option=com_categories&task=category.edit&id=<?php echo $item->'.$field.'; ?>&extension='.$varObject->com_main.'"><?php echo $categoryTitle; ?></a>'.$varObject->return;
							else:
								$viewhtmldefaultbodylines[] = $varObject->tab3.'<?php echo $item->'.$field.'; ?>'.$varObject->return;
							endif;
						endif;
						$viewhtmldefaultbodylines[] = $varObject->tab2.'</td>'.$varObject->return;
					endif;
					$shown = 1;
				endif;
			endforeach;
			// default at least the first field to be the edit field
			if($shown != 1):
				$viewhtmldefaultbodylines[] = $varObject->tab2.'<td>'.$varObject->return;
				$viewhtmldefaultbodylines[] = $varObject->tab3.'<?php echo $item->'.$formfields->name_safe[0].'; ?> - (<a href="<?php echo $edit; ?>&id=<?php echo $item->id; ?>"><?php echo \'Edit\'; ?></a>)'.$varObject->return;
				$viewhtmldefaultbodylines[] = $varObject->tab3.'<?php if ($item->checked_out){ ?>'.$varObject->return;
				$viewhtmldefaultbodylines[] = $varObject->tab4.'<?php echo JHtml::_(\'jgrid.checkedout\', $i, $userChkOut->name, $item->checked_out_time, \''.$view['plural']['safe'].'.\', $canCheckin); ?>'.$varObject->return;
				$viewhtmldefaultbodylines[] = $varObject->tab3.'<?php } ?>'.$varObject->return;
				$viewhtmldefaultbodylines[] = $varObject->tab2.'</td>'.$varObject->return;
			endif;
		endif;
		
		$viewhtmldefaultbodylines[] = $varObject->tab1.'</tr>'.$varObject->return;
		$viewhtmldefaultbodylines[] = '<?php } ?>';
		
		return $viewhtmldefaultbodylines;
	}
	
	public static function viewsViewDefaultFoot($varObject, $formfields, $filename)
	{
		//Set column number
		$colspan = 0;
		
		// Make sure there is formfields
		if($formfields->name):
			// Parse through fields
			foreach($formfields->name as $key=>$field):
				// Check if field is required
				if($formfields->show):
					if (array_key_exists($key, $formfields->show)):
						$colspan++;		
					endif;
				endif;
			endforeach;
		endif;
		
		// default at least the first field to be the edit field
		if($colspan == 0):
			$colspan++;
		endif;
		
		// Add 2 to colspan for id field and checkbox (present by default in list manager)
		$colspan = $colspan + 2;
		
		$viewhtmldefaultfootlines[] = '<?php'.$varObject->return;
		$viewhtmldefaultfootlines[] = Helpers::phpheader($filename, $varObject);
		$viewhtmldefaultfootlines[] = Helpers::nodirectaccess($varObject);
		$viewhtmldefaultfootlines[] = $varObject->return;
		$viewhtmldefaultfootlines[] = '?>'.$varObject->return;
		$viewhtmldefaultfootlines[] = '<tr>'.$varObject->return;
		$viewhtmldefaultfootlines[] = $varObject->tab1.'<td colspan="'.$colspan.'"><?php echo $this->pagination->getListFooter(); ?></td>'.$varObject->return;
		$viewhtmldefaultfootlines[] = '</tr>';
				
		return $viewhtmldefaultfootlines;
	}
	
	public static function viewsViewSingularViewHtml($view, $varObject, $filename)
	{
		$viewsingularviewhtml[] = '<?php'.$varObject->return;
		$viewsingularviewhtml[] = Helpers::phpheader($filename, $varObject);
		$viewsingularviewhtml[] = Helpers::nodirectaccess($varObject);
		$viewsingularviewhtml[] = $varObject->return;
		$viewsingularviewhtml[] = '// import Joomla view library'.$varObject->return;
		$viewsingularviewhtml[] = 'jimport(\'joomla.application.component.view\');'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->return;
		$viewsingularviewhtml[] = '/**'.$varObject->return;
		$viewsingularviewhtml[] = ' * '.$view['singular']['cap'].' View'.$varObject->return;
		$viewsingularviewhtml[] = ' */'.$varObject->return;
		$viewsingularviewhtml[] = 'class '.$varObject->comp_m_view_cap.'View'.$view['singular']['safe'].' extends '.$varObject->j_view.$varObject->return;
		$viewsingularviewhtml[] = '{'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab1.'/**'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab1.' * display method of '.$view['singular']['cap'].' view'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab1.' * @return void'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab1.' */'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab1.'public function display($tpl = null)'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab1.'{'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'// get the Data'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'$form = $this->get(\'Form\');'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'$item = $this->get(\'Item\');'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'$script = $this->get(\'Script\');'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'// Check for errors.'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'if (count($errors = $this->get(\'Errors\'))){'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab3.'JError::raiseError(500, implode(\'<br />\', $errors));'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab3.'return false;'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'};'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'// Assign the variables'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'$this->form = $form;'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'$this->item = $item;'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'$this->script = $script;'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'// Set the toolbar'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'$this->addToolBar();'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'// Display the template'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'parent::display($tpl);'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'// Set the document'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'$this->setDocument();'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab1.'}'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->return;
		$viewsingularviewhtml[] = $varObject->return;
		$viewsingularviewhtml[] = $varObject->tab1.'/**'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab1.' * Setting the toolbar'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab1.' */'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab1.'protected function addToolBar()'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab1.'{'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.$varObject->j_view_single_view_html_hide_menu.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'$user = JFactory::getUser();'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'$userId	= $user->id;'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'$isNew = $this->item->id == 0;'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'$canDo = '.$varObject->comp_m_view_cap.'Helper::getActions($this->item->id);'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'JToolBarHelper::title($isNew ? JText::_(\''.$view['singular']['cap'].' :: New\') : JText::_(\''.$view['singular']['cap'].' :: Edit\'), \''.$view['singular']['safe'].'\');'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'// Built the actions for new and existing records.'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'if ($isNew){'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab3.'// For new records, check the create permission.'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab3.'if ($canDo->get(\'core.create\')){'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab4.'JToolBarHelper::apply(\''.$view['singular']['safe'].'.apply\', \'JTOOLBAR_APPLY\');'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab4.'JToolBarHelper::save(\''.$view['singular']['safe'].'.save\', \'JTOOLBAR_SAVE\');'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab4.'JToolBarHelper::custom(\''.$view['singular']['safe'].'.save2new\', \'save-new.png\', \'save-new_f2.png\', \'JTOOLBAR_SAVE_AND_NEW\', false);'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab3.'};'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab3.'JToolBarHelper::cancel(\''.$view['singular']['safe'].'.cancel\', \'JTOOLBAR_CANCEL\');'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'} else {'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab3.'if ($canDo->get(\'core.edit\')){'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab4.'// We can save the new record'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab4.'JToolBarHelper::apply(\''.$view['singular']['safe'].'.apply\', \'JTOOLBAR_APPLY\');'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab4.'JToolBarHelper::save(\''.$view['singular']['safe'].'.save\', \'JTOOLBAR_SAVE\');'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab4.'// We can save this record, but check the create permission to see'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab4.'// if we can return to make a new one.'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab4.'if ($canDo->get(\'core.create\')){'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab5.'JToolBarHelper::custom(\''.$view['singular']['safe'].'.save2new\', \'save-new.png\', \'save-new_f2.png\', \'JTOOLBAR_SAVE_AND_NEW\', false);'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab4.'};'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab3.'};'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab3.'if ($canDo->get(\'core.create\')){'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab4.'JToolBarHelper::custom(\''.$view['singular']['safe'].'.save2copy\', \'save-copy.png\', \'save-copy_f2.png\', \'JTOOLBAR_SAVE_AS_COPY\', false);'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab3.'};'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab3.'JToolBarHelper::cancel(\''.$view['singular']['safe'].'.cancel\', \'JTOOLBAR_CLOSE\');'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'};'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab1.'}'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->return;
		$viewsingularviewhtml[] = $varObject->tab1.'/**'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab1.' * Method to set up the document properties'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab1.' *'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab1.' * @return void'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab1.' */'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab1.'protected function setDocument()'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab1.'{'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'$isNew = ($this->item->id < 1);'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'$document = JFactory::getDocument();'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'$document->setTitle($isNew ? JText::_(\''.$view['singular']['cap'].' :: New :: Administrator\') : JText::_(\''.$view['singular']['cap'].' :: Edit :: Administrator\'));'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'$document->addScript(JURI::root() . $this->script);'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'$document->addScript(JURI::root() . "administrator/components/'.$varObject->com_main.'/views/'.$view['singular']['safe'].'/submitbutton.js");'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab2.'JText::script(\''.$view['singular']['safe'].' not acceptable. Error\');'.$varObject->return;
		$viewsingularviewhtml[] = $varObject->tab1.'}'.$varObject->return;
		$viewsingularviewhtml[] = '}'.$varObject->return;
		$viewsingularviewhtml[] = '?>';
				
		return $viewsingularviewhtml;
	}
	
	public static function viewsViewSingularViewSubmitButton($view, $varObject, $filename)
	{	
		$viewsingularviewsubmit[] = '/**'.$varObject->return;
		$viewsingularviewsubmit[] = ' *'.$varObject->tab1.$view['singular']['cap'].' : Submit Button Override'.$varObject->return;
		$viewsingularviewsubmit[] = ' *'.$varObject->tab1.'Filename : '.$filename.$varObject->return;
		$viewsingularviewsubmit[] = ' *'.$varObject->return;
		$viewsingularviewsubmit[] = ' *'.$varObject->tab1.'Author : '.$varObject->author.$varObject->return;
		$viewsingularviewsubmit[] = ' *'.$varObject->tab1.'Component : '.$varObject->comp_name.$varObject->return;
		$viewsingularviewsubmit[] = ' *'.$varObject->return;
		$viewsingularviewsubmit[] = ' *'.$varObject->tab1.'Copyright : '.$varObject->copyright.$varObject->return;
		$viewsingularviewsubmit[] = ' *'.$varObject->tab1.'License : '.$varObject->license.$varObject->return;
		$viewsingularviewsubmit[] = ' *'.$varObject->return;
		$viewsingularviewsubmit[] = ' */'.$varObject->return;
		$viewsingularviewsubmit[] = 'Joomla.submitbutton = function(task)'.$varObject->return;
		$viewsingularviewsubmit[] = '{'.$varObject->return;
		$viewsingularviewsubmit[] = $varObject->tab1.'if (task == \'\'){'.$varObject->return;
		$viewsingularviewsubmit[] = $varObject->tab2.'return false;'.$varObject->return;
		$viewsingularviewsubmit[] = $varObject->tab1.'} else { '.$varObject->return;
		$viewsingularviewsubmit[] = $varObject->tab2.'var isValid=true;'.$varObject->return;
		$viewsingularviewsubmit[] = $varObject->tab2.'var action = task.split(\'.\');'.$varObject->return;
		$viewsingularviewsubmit[] = $varObject->tab2.'if (action[1] != \'cancel\' && action[1] != \'close\'){'.$varObject->return;
		$viewsingularviewsubmit[] = $varObject->tab3.'var forms = $$(\'form.form-validate\');'.$varObject->return;
		$viewsingularviewsubmit[] = $varObject->tab3.'for (var i=0;i<forms.length;i++){'.$varObject->return;
		$viewsingularviewsubmit[] = $varObject->tab4.'if (!document.formvalidator.isValid(forms[i])){'.$varObject->return;
		$viewsingularviewsubmit[] = $varObject->tab5.'isValid = false;'.$varObject->return;
		$viewsingularviewsubmit[] = $varObject->tab5.'break;'.$varObject->return;
		$viewsingularviewsubmit[] = $varObject->tab4.'}'.$varObject->return;
		$viewsingularviewsubmit[] = $varObject->tab3.'}'.$varObject->return;
		$viewsingularviewsubmit[] = $varObject->tab2.'}'.$varObject->return;
		$viewsingularviewsubmit[] = $varObject->tab2.'if (isValid){'.$varObject->return;
		$viewsingularviewsubmit[] = $varObject->tab3.'Joomla.submitform(task);'.$varObject->return;
		$viewsingularviewsubmit[] = $varObject->tab3.'return true;'.$varObject->return;
		$viewsingularviewsubmit[] = $varObject->tab2.'} else {'.$varObject->return;
		$viewsingularviewsubmit[] = $varObject->tab3.'alert(Joomla.JText._(\''.$view['singular']['safe'].', some values are not acceptable.\',\'Some values are unacceptable\'));'.$varObject->return;
		$viewsingularviewsubmit[] = $varObject->tab3.'return false;'.$varObject->return;
		$viewsingularviewsubmit[] = $varObject->tab2.'}'.$varObject->return;
		$viewsingularviewsubmit[] = $varObject->tab1.'}'.$varObject->return;
		$viewsingularviewsubmit[] = '}';
		
		return $viewsingularviewsubmit;
	}
	
	public static function viewsViewSingularViewEdit25($view, $varObject, $filename, $view_count)
	{
		$viewsingularhtmledit[] = '<?php'.$varObject->return;
		$viewsingularhtmledit[] = Helpers::phpheader($filename, $varObject);
		$viewsingularhtmledit[] = Helpers::nodirectaccess($varObject);
		$viewsingularhtmledit[] = $varObject->return;
		$viewsingularhtmledit[] = 'JHtml::addIncludePath(JPATH_COMPONENT.\'/helpers/html\');'.$varObject->return;
		$viewsingularhtmledit[] = 'JHtml::_(\'behavior.tooltip\');'.$varObject->return;
		$viewsingularhtmledit[] = 'JHtml::_(\'behavior.formvalidation\');'.$varObject->return;
		$viewsingularhtmledit[] = '$params = $this->form->getFieldsets(\'params\');'.$varObject->return;
		
		if($varObject->imageUpload):
			$viewsingularhtmledit[] = '$componentParams = JComponentHelper::getParams(\''.$varObject->com_main.'\');'.$varObject->return;
		endif;
		
		$viewsingularhtmledit[] = $varObject->return;
		$viewsingularhtmledit[] = '?>'.$varObject->return;
		
		if($varObject->imageUpload):
			$viewsingularhtmledit[] = '<style type="text/css">'.$varObject->return;
			$viewsingularhtmledit[] = $varObject->tab1.'.full, .thumb { border: 1px solid #CCC; float: left; margin: 0 10px 0 0; padding: 10px; }'.$varObject->return;
			$viewsingularhtmledit[] = $varObject->tab1.'.full h2, .thumb h2 { margin: 0; padding: 0; }'.$varObject->return;
			$viewsingularhtmledit[] = '</style>'.$varObject->return;
		endif;
		
		$viewsingularhtmledit[] = '<form action="<?php echo JRoute::_(\'index.php?option='.$varObject->com_main.'&layout=edit&id=\'.(int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab1.'<div class="width-100 fltlft">'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab2.'<fieldset class="adminform">'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab3.'<legend><?php echo JText::_( \'Details\' ); ?></legend>'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab3.'<div class="adminformlist">'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab4.'<?php foreach($this->form->getFieldset(\'details\') as $field){ ?>'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab5.'<div>'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab6.'<?php echo $field->label; echo $field->input;?>'.$varObject->return;
		
		if($varObject->imageUpload):
			if(is_array($varObject->imageFields[$view_count])){
				foreach($varObject->imageFields[$view_count] as $image_name):
					$viewsingularhtmledit[] = $varObject->tab6.'<?php if($field->fieldname == \''.$image_name['fieldnamesafe'].'\' && $field->value){ ?>'.$varObject->return;
					$viewsingularhtmledit[] = $varObject->tab6.'<label>Delete Image</label><input type="checkbox" name="'.$image_name['fieldnamesafe'].'_delete" value="1" />'.$varObject->return;
					$viewsingularhtmledit[] = $varObject->tab6.'<div class="' . $varObject->j_clear_class . '"></div>'.$varObject->return;
					$viewsingularhtmledit[] = $varObject->tab6.'<?php } ?>'.$varObject->return;
				endforeach;
			}
		endif;
		
		$viewsingularhtmledit[] = $varObject->tab5.'</div>'.$varObject->return;
		
		if($varObject->imageUpload):
			$viewsingularhtmledit[] = $varObject->tab5.'<?php if($field->fieldname == \''.$image_name['fieldnamesafe'].'\' && $field->value){ ?>'.$varObject->return;
			$viewsingularhtmledit[] = $varObject->tab5.'<label>Image Preview</label>'.$varObject->return;
			$viewsingularhtmledit[] = $varObject->tab5.'<div class="full">'.$varObject->return;
			$viewsingularhtmledit[] = $varObject->tab6.'<h2>Full Image</h2>'.$varObject->return;
			$viewsingularhtmledit[] = $varObject->tab6.'<img src="<?php echo JURI::root(false) . \'images/'.$varObject->com_main.'/\' . $field->value; ?>" />'.$varObject->return;
			$viewsingularhtmledit[] = $varObject->tab5.'</div>'.$varObject->return;
			$viewsingularhtmledit[] = $varObject->tab5.'<div class="thumb">'.$varObject->return;
			$viewsingularhtmledit[] = $varObject->tab6.'<h2>Thumb Image</h2>'.$varObject->return;
			$viewsingularhtmledit[] = $varObject->tab6.'<img src="<?php echo JURI::root(false) . \'images/'.$varObject->com_main.'/thumb/\' . $field->value; ?>" />'.$varObject->return;
			$viewsingularhtmledit[] = $varObject->tab5.'</div>'.$varObject->return;
			$viewsingularhtmledit[] = $varObject->tab5.'<?php } ?>'.$varObject->return;
		endif;
		
		$viewsingularhtmledit[] = $varObject->tab5.'<div class="' . $varObject->j_clear_class . '"></div>'.$varObject->return;
		
		$viewsingularhtmledit[] = $varObject->tab4.'<?php }; ?>'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab3.'</div>'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab2.'</fieldset>'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab1.'</div>'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab1.'<div>'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab2.'<input type="hidden" name="task" value="'.$view['singular']['safe'].'.edit" />'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab2.'<?php echo JHtml::_(\'form.token\'); ?>'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab1.'</div>'.$varObject->return;
		$viewsingularhtmledit[] = '</form>';
		
		return $viewsingularhtmledit;
	}
	
	public static function viewsViewSingularViewEdit30($view, $varObject, $filename, $view_count)
	{
		$viewsingularhtmledit[] = '<?php'.$varObject->return;
		$viewsingularhtmledit[] = Helpers::phpheader($filename, $varObject);
		$viewsingularhtmledit[] = Helpers::nodirectaccess($varObject);
		$viewsingularhtmledit[] = $varObject->return;
		$viewsingularhtmledit[] = 'JHtml::addIncludePath(JPATH_COMPONENT.\'/helpers/html\');'.$varObject->return;
		$viewsingularhtmledit[] = 'JHtml::_(\'behavior.tooltip\');'.$varObject->return;
		$viewsingularhtmledit[] = 'JHtml::_(\'behavior.formvalidation\');'.$varObject->return;
		$viewsingularhtmledit[] = 'JHtml::_(\'formbehavior.chosen\', \'select\');'.$varObject->return;
		$viewsingularhtmledit[] = 'JHtml::_(\'behavior.keepalive\');'.$varObject->return;
		$viewsingularhtmledit[] = '$params = $this->form->getFieldsets(\'params\');'.$varObject->return;
		
		if($varObject->imageUpload):
			$viewsingularhtmledit[] = '$componentParams = JComponentHelper::getParams(\''.$varObject->com_main.'\');'.$varObject->return;
		endif;
		
		$viewsingularhtmledit[] = $varObject->return;
		$viewsingularhtmledit[] = '?>'.$varObject->return;
		
		if($varObject->imageUpload):
			$viewsingularhtmledit[] = '<style type="text/css">'.$varObject->return;
			$viewsingularhtmledit[] = $varObject->tab1.'.full, .thumb { border: 1px solid #CCC; float: left; margin: 0 10px 0 0; padding: 10px; }'.$varObject->return;
			$viewsingularhtmledit[] = $varObject->tab1.'.full h2, .thumb h2 { margin: 0; padding: 0; }'.$varObject->return;
			$viewsingularhtmledit[] = '</style>'.$varObject->return;
		endif;
		
		$viewsingularhtmledit[] = '<ul class="nav nav-tabs hidden" >'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab1.'<li class="active"><a data-toggle="tab" href="#home">tab</a></li>'.$varObject->return;
		$viewsingularhtmledit[] = '</ul>'.$varObject->return;
		$viewsingularhtmledit[] = '<form action="<?php echo JRoute::_(\'index.php?option='.$varObject->com_main.'&layout=edit&id=\'.(int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab1.'<div class="row-fluid">'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab2.'<div class="span12 form-horizontal">'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab3.'<fieldset class="adminform">'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab4.'<legend><?php echo JText::_( \'Details\' ); ?></legend>'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab4.'<div class="adminformlist">'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab5.'<?php foreach($this->form->getFieldset(\'details\') as $field){ ?>'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab6.'<div>'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab7.'<?php echo $field->label; echo $field->input;?>'.$varObject->return;
		
		if($varObject->imageUpload):
			if(is_array($varObject->imageFields[$view_count])){
				foreach($varObject->imageFields[$view_count] as $image_name):
					$viewsingularhtmledit[] = $varObject->tab7.'<?php if($field->fieldname == \''.$image_name['fieldnamesafe'].'\' && $field->value){ ?>'.$varObject->return;
					$viewsingularhtmledit[] = $varObject->tab7.'<label>Delete Image</label><input type="checkbox" name="'.$image_name['fieldnamesafe'].'_delete" value="1" />'.$varObject->return;
					$viewsingularhtmledit[] = $varObject->tab7.'<div class="' . $varObject->j_clear_class . '"></div>'.$varObject->return;
					$viewsingularhtmledit[] = $varObject->tab7.'<?php } ?>'.$varObject->return;
				endforeach;
			}
		endif;
		
		$viewsingularhtmledit[] = $varObject->tab6.'</div>'.$varObject->return;
		
		if($varObject->imageUpload):
			if(is_array($varObject->imageFields[$view_count])){
				foreach($varObject->imageFields[$view_count] as $image_name):
					$viewsingularhtmledit[] = $varObject->tab6.'<?php if($field->fieldname == \''.$image_name['fieldnamesafe'].'\' && $field->value){ ?>'.$varObject->return;
					$viewsingularhtmledit[] = $varObject->tab6.'<label>Image Preview</label>'.$varObject->return;
					$viewsingularhtmledit[] = $varObject->tab6.'<div class="full">'.$varObject->return;
					$viewsingularhtmledit[] = $varObject->tab7.'<h2>Full Image</h2>'.$varObject->return;
					$viewsingularhtmledit[] = $varObject->tab7.'<img src="<?php echo JURI::root(false) . \'images/'.$varObject->com_main.'/\' . $field->value; ?>" />'.$varObject->return;
					$viewsingularhtmledit[] = $varObject->tab6.'</div>'.$varObject->return;
					$viewsingularhtmledit[] = $varObject->tab6.'<div class="thumb">'.$varObject->return;
					$viewsingularhtmledit[] = $varObject->tab7.'<h2>Thumb Image</h2>'.$varObject->return;
					$viewsingularhtmledit[] = $varObject->tab7.'<img src="<?php echo JURI::root(false) . \'images/'.$varObject->com_main.'/thumb/\' . $field->value; ?>" />'.$varObject->return;
					$viewsingularhtmledit[] = $varObject->tab6.'</div>'.$varObject->return;
					$viewsingularhtmledit[] = $varObject->tab6.'<?php } ?>'.$varObject->return;
				endforeach;
			}
		endif;
		
		$viewsingularhtmledit[] = $varObject->tab6.'<div class="' . $varObject->j_clear_class . '"></div>'.$varObject->return;
		
		$viewsingularhtmledit[] = $varObject->tab5.'<?php }; ?>'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab4.'</div>'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab3.'</fieldset>'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab2.'</div>'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab1.'</div>'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab1.'<div>'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab2.'<input type="hidden" name="task" value="'.$view['singular']['safe'].'.edit" />'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab2.'<?php echo JHtml::_(\'form.token\'); ?>'.$varObject->return;
		$viewsingularhtmledit[] = $varObject->tab1.'</div>'.$varObject->return;
		$viewsingularhtmledit[] = '</form>';
		
		return $viewsingularhtmledit;
	}
	
	public static function adminControllerPlural($view, $varObject)
	{
		$filename = $view['plural']['safe'] . '.php';
		$adminControllerPlural[] = '<?php'.$varObject->return;
		$adminControllerPlural[] = Helpers::phpheader($filename, $varObject);
		$adminControllerPlural[] = Helpers::nodirectaccess($varObject);
		$adminControllerPlural[] = $varObject->return;
		$adminControllerPlural[] = '// import Joomla controlleradmin library'.$varObject->return;
		$adminControllerPlural[] = 'jimport(\'joomla.application.component.controlleradmin\');'.$varObject->return;
		$adminControllerPlural[] = $varObject->return;
		$adminControllerPlural[] = '/**'.$varObject->return;
		$adminControllerPlural[] = ' * '.$view['plural']['cap'].' Controller'.$varObject->return;
		$adminControllerPlural[] = ' */'.$varObject->return;
		$adminControllerPlural[] = 'class '.$varObject->comp_m_view_cap.'Controller'.$view['plural']['safe'].' extends JControllerAdmin'.$varObject->return;
		$adminControllerPlural[] = '{'.$varObject->return;
		$adminControllerPlural[] = $varObject->tab1.'/**'.$varObject->return;
		$adminControllerPlural[] = $varObject->tab1.' * Proxy for getModel.'.$varObject->return;
		$adminControllerPlural[] = $varObject->tab1.' * @since	2.5'.$varObject->return;
		$adminControllerPlural[] = $varObject->tab1.' */'.$varObject->return;
		$adminControllerPlural[] = $varObject->tab1.'public function getModel($name = \''.$view['singular']['safe'].'\', $prefix = \''.$varObject->comp_m_view_cap.'Model\')'.$varObject->return;
		$adminControllerPlural[] = $varObject->tab1.'{'.$varObject->return;
		$adminControllerPlural[] = $varObject->tab2.'$model = parent::getModel($name, $prefix, array(\'ignore_request\' => true));'.$varObject->return;
		$adminControllerPlural[] = $varObject->tab2.$varObject->return;
		$adminControllerPlural[] = $varObject->tab2.'return $model;'.$varObject->return;
		$adminControllerPlural[] = $varObject->tab1.'}'.$varObject->return;
		$adminControllerPlural[] = '}'.$varObject->return;
		$adminControllerPlural[] = '?>';
		
		return $adminControllerPlural;
	}
	
	public static function adminControllerSingular($view, $varObject, $view_count)
	{
		$filename = $view['singular']['safe'] . '.php';
		$adminControllerSingular[] = '<?php'.$varObject->return;
		$adminControllerSingular[] = Helpers::phpheader($filename, $varObject);
		$adminControllerSingular[] = Helpers::nodirectaccess($varObject);
		$adminControllerSingular[] = $varObject->return;
		$adminControllerSingular[] = '// import Joomla controllerform library'.$varObject->return;
		$adminControllerSingular[] = 'jimport(\'joomla.application.component.controllerform\');'.$varObject->return;
		$adminControllerSingular[] = $varObject->return;
		$adminControllerSingular[] = '/**'.$varObject->return;
		$adminControllerSingular[] = ' * '.$view['plural']['cap'].' Controller '.$view['singular']['cap'].$varObject->return;
		$adminControllerSingular[] = ' */'.$varObject->return;
		$adminControllerSingular[] = 'class '.$varObject->comp_m_view_cap.'Controller'.$view['singular']['safe'].' extends JControllerForm'.$varObject->return;
		$adminControllerSingular[] = '{'.$varObject->return;
		$adminControllerSingular[] = $varObject->tab1.'public function __construct($config = array())'.$varObject->return;
		$adminControllerSingular[] = $varObject->tab1.'{'.$varObject->return;
		$adminControllerSingular[] = $varObject->tab2.'$this->view_list = \''.$view['plural']['safe'].'\'; // safeguard for setting the return view listing to the main view.'.$varObject->return;
		$adminControllerSingular[] = $varObject->tab2.'parent::__construct($config);'.$varObject->return;
		$adminControllerSingular[] = $varObject->tab1.'}'.$varObject->return;
		$adminControllerSingular[] = $varObject->return;
		$adminControllerSingular[] = $varObject->tab1.'/**'.$varObject->return;
		$adminControllerSingular[] = $varObject->tab1.' * Function that allows child controller access to model data'.$varObject->return;
		$adminControllerSingular[] = $varObject->tab1.' * after the data has been saved.'.$varObject->return;
		$adminControllerSingular[] = $varObject->tab1.' * '.$varObject->return;
		$adminControllerSingular[] = $varObject->tab1.' * @param   JModel  &$model     The data model object.'.$varObject->return;
		$adminControllerSingular[] = $varObject->tab1.' * @param   array   $validData  The validated data.'.$varObject->return;
		$adminControllerSingular[] = $varObject->tab1.' * '.$varObject->return;
		$adminControllerSingular[] = $varObject->tab1.' * @return  void'.$varObject->return;
		$adminControllerSingular[] = $varObject->tab1.' * '.$varObject->return;
		$adminControllerSingular[] = $varObject->tab1.' * @since   11.1'.$varObject->return;
		$adminControllerSingular[] = $varObject->tab1.' */'.$varObject->return;
		$adminControllerSingular[] = $varObject->tab1.'protected function postSaveHook(' . $varObject->j_model . ' &$model, $validData = array())'.$varObject->return;
		$adminControllerSingular[] = $varObject->tab1.'{'.$varObject->return;
		
		
		$adminControllerSingular[] = $varObject->tab2.'// Get a handle to the Joomla! application object'.$varObject->return;
		$adminControllerSingular[] = $varObject->tab2.'$application = JFactory::getApplication();'.$varObject->return;
		$adminControllerSingular[] = $varObject->return;
		
		if($varObject->datemodified):
			$adminControllerSingular[] = $varObject->tab2.'$date = date(\'Y-m-d H:i:s\');'.$varObject->return;
			$adminControllerSingular[] = $varObject->tab2.'if($validData[\'date_created\'] == \'0000-00-00 00:00:00\'){'.$varObject->return;
			$adminControllerSingular[] = $varObject->tab3.'$data[\'date_created\'] = $date;'.$varObject->return;
			$adminControllerSingular[] = $varObject->tab2.'}'.$varObject->return;
			$adminControllerSingular[] = $varObject->tab2.'$data[\'date_modified\'] = $date;'.$varObject->return;
			$adminControllerSingular[] = $varObject->return;
		endif;
		
		if($varObject->usermodified):
			$adminControllerSingular[] = $varObject->tab2.'$user = JFactory::getUser();'.$varObject->return;
			$adminControllerSingular[] = $varObject->tab2.'if($validData[\'user_created\'] == 0){'.$varObject->return;
			$adminControllerSingular[] = $varObject->tab3.'$data[\'user_created\'] = $user->id;'.$varObject->return;
			$adminControllerSingular[] = $varObject->tab2.'}'.$varObject->return;
			$adminControllerSingular[] = $varObject->tab2.'$data[\'user_modified\'] = $user->id;'.$varObject->return;
			$adminControllerSingular[] = $varObject->return;
		endif;
		
		if($varObject->imageUpload):
			if(is_array($varObject->imageFields[$view_count])){
				foreach($varObject->imageFields[$view_count] as $image_name):
					$adminControllerSingular[] = $varObject->tab2.'// Delete Image Checked'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab2.'if(array_key_exists(\''.$image_name['fieldnamesafe'].'_delete\', $_POST)){'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab3.'$data[\''.$image_name['fieldnamesafe'].'\'] = \'\'; // set image to nothing in database'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab3.'// Delete Image Entirely Check'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab3.'$db = JFactory::getDBO();'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab3.'$query = $db->getQuery(true)->select(\''.$image_name['fieldnamesafe'].'\')->from(\'#__'.$varObject->comp_m_view.'_'.$view['singular']['safe'].'\')->where(\'id="\' . $validData[\'id\'] . \'"\');'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab3.'$db->setQuery((string)$query);'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab3.'$'.$image_name['fieldnamesafe'].' = $db->loadResult();'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab3.'if($'.$image_name['fieldnamesafe'].'){'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab4.'$query = $db->getQuery(true)->select(\'CASE WHEN COUNT(*) > 0 THEN 1 ELSE 0 END\')->from(\'#__'.$varObject->comp_m_view.'_'.$view['singular']['safe'].'\')->where(\''.$image_name['fieldnamesafe'].'="\' . $'.$image_name['fieldnamesafe'].' . \'" AND id!="\' . $validData[\'id\'] . \'"\');'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab4.'$db->setQuery((string)$query);'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab4.'$using = $db->loadResult();'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab4.'if($using == 0){ // free to delete'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab5.'// Include file system helpers'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab5.'jimport(\'joomla.filesystem.file\');'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab5.'jimport(\'joomla.filesystem.folder\');'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab5.'$full_image = JPATH_SITE . DS . \'images\' . DS . \''.$varObject->com_main.'\' . DS . $'.$image_name['fieldnamesafe'].';'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab5.'$thum_image = JPATH_SITE . DS . \'images\' . DS . \''.$varObject->com_main.'\' . DS . \'thumb\' . DS . $'.$image_name['fieldnamesafe'].';'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab5.'JFile::delete($thum_image);'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab5.'if(JFile::delete($full_image)){'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab6.'// Add a message to the message queue'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab6.'$application->enqueueMessage(\'Image has been deleted!\', \'notice\');'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab5.'} else {'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab6.'// Add a message to the message queue'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab6.'$application->enqueueMessage(\'Image could not be deleted, but was removed from this item.\', \'error\');'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab5.'}'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab4.'} else {'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab5.'// Add a message to the message queue'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab5.'$application->enqueueMessage(\'Image has been removed from this item, but can not be deleted because it is being used elsewhere.\', \'notice\');'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab4.'}'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab3.'}'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab2.'}'.$varObject->return;
					$adminControllerSingular[] = $varObject->return;
					$adminControllerSingular[] = $varObject->tab2.'// Upload Image'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab2.'$file = JRequest::getVar(\'jform\', array(), \'files\', \'array\');'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab2.'if($file[\'name\'][\''.$image_name['fieldnamesafe'].'\']){'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab3.'$info = '.$varObject->comp_m_view_cap.'Helper::imageUpload($file, $data, \''.$image_name['fieldnamesafe'].'\');'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab3.'if($info[\'error\'] == 0){'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab4.'$data[\''.$image_name['fieldnamesafe'].'\'] = $info[\''.$image_name['fieldnamesafe'].'\'];'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab3.'} else {'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab4.'// Add a message to the message queue'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab4.'$application->enqueueMessage($info[\'msg\'], \'error\');'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab3.'}'.$varObject->return;
					$adminControllerSingular[] = $varObject->tab2.'}'.$varObject->return;
					$adminControllerSingular[] = $varObject->return;
				endforeach;
			}
		endif;
		
		$adminControllerSingular[] = $varObject->tab2.'$model->save($data);'.$varObject->return;
		$adminControllerSingular[] = $varObject->return;
		
		$adminControllerSingular[] = $varObject->tab1.'}'.$varObject->return;
		$adminControllerSingular[] = $varObject->return;
		$adminControllerSingular[] = '}'.$varObject->return;
		$adminControllerSingular[] = '?>';
		
		return $adminControllerSingular;
	}
	
	public static function adminModelPlural($view, $varObject)
	{
		$filename = $view['plural']['safe'] . '.php';
		$adminModelPlural[] = '<?php'.$varObject->return;
		$adminModelPlural[] = Helpers::phpheader($filename, $varObject);
		$adminModelPlural[] = Helpers::nodirectaccess($varObject);
		$adminModelPlural[] = $varObject->return;
		$adminModelPlural[] = '// import the Joomla modellist library'.$varObject->return;
		$adminModelPlural[] = 'jimport(\'joomla.application.component.modellist\');'.$varObject->return;
		$adminModelPlural[] = '/**'.$varObject->return;
		$adminModelPlural[] = ' * '.$view['plural']['cap'].' Model'.$varObject->return;
		$adminModelPlural[] = ' */'.$varObject->return;
		$adminModelPlural[] = 'class '.$varObject->comp_m_view_cap.'Model'.$view['plural']['safe'].' extends JModelList'.$varObject->return;
		$adminModelPlural[] = '{'.$varObject->return;
		
		// start - added v.0.6.0
		if($varObject->useDatabase):
			$adminModelPlural[] = $varObject->tab1.'/**'.$varObject->return;
			$adminModelPlural[] = $varObject->tab1.' * Method to build an SQL query to load the list data.'.$varObject->return;
			$adminModelPlural[] = $varObject->tab1.' *'.$varObject->return;
			$adminModelPlural[] = $varObject->tab1.' * @return	string	An SQL query'.$varObject->return;
			$adminModelPlural[] = $varObject->tab1.' */'.$varObject->return;
			$adminModelPlural[] = $varObject->tab1.'protected function getListQuery()'.$varObject->return;
			$adminModelPlural[] = $varObject->tab1.'{'.$varObject->return;
			$adminModelPlural[] = $varObject->tab2.'// Create a new query object.'.$varObject->return;
			$adminModelPlural[] = $varObject->tab2.'$db = JFactory::getDBO();'.$varObject->return;
			$adminModelPlural[] = $varObject->tab2.'$query = $db->getQuery(true);'.$varObject->return;
			$adminModelPlural[] = $varObject->return;
			$adminModelPlural[] = $varObject->tab2.'// Select some fields'.$varObject->return;
			$adminModelPlural[] = $varObject->tab2.'$query->select(\'*\');'.$varObject->return;
			$adminModelPlural[] = $varObject->return;
			$adminModelPlural[] = $varObject->tab2.'// From the '.$varObject->comp_m_view.'_'.$view['singular']['safe'].' table'.$varObject->return;
			$adminModelPlural[] = $varObject->tab2.'$query->from(\'#__'.$varObject->comp_m_view.'_'.$view['singular']['safe'].'\');'.$varObject->return;
			$adminModelPlural[] = $varObject->return;
			$adminModelPlural[] = $varObject->tab2.'return $query;'.$varObject->return;
			$adminModelPlural[] = $varObject->tab1.'}'.$varObject->return;
		endif;
		// end - added v.0.6.0
		
		$adminModelPlural[] = '}'.$varObject->return;
		$adminModelPlural[] = '?>';
		
		return $adminModelPlural;
	}
	
	public static function adminModelSingular($view, $varObject)
	{
		$filename = $view['singular']['safe'] . '.php';
		$adminModelSingular[] = '<?php'.$varObject->return;
		$adminModelSingular[] = Helpers::phpheader($filename, $varObject);
		$adminModelSingular[] = Helpers::nodirectaccess($varObject);
		$adminModelSingular[] = $varObject->return;
		$adminModelSingular[] = '// import Joomla modelform library'.$varObject->return;
		$adminModelSingular[] = 'jimport(\'joomla.application.component.modeladmin\');'.$varObject->return;
		$adminModelSingular[] = $varObject->return;
		$adminModelSingular[] = '/**'.$varObject->return;
		$adminModelSingular[] = ' * '.$view['singular']['cap'].' Model'.$varObject->return;
		$adminModelSingular[] = ' */'.$varObject->return;
		$adminModelSingular[] = 'class '.$varObject->comp_m_view_cap.'Model'.$view['singular']['safe'].' extends JModelAdmin'.$varObject->return;
		$adminModelSingular[] = '{'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.'/**'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' * Method override to check if you can edit an existing record.'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' *'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' * @param	array	$data	An array of input data.'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' * @param	string	$key	The name of the key for the primary key.'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' *'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' * @return	boolean'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' * @since	2.5'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' */'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.'protected function allowEdit($data = array(), $key = \'id\')'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.'{'.$varObject->return;
		$adminModelSingular[] = $varObject->tab2.'// Check specific edit permission then general edit permission.'.$varObject->return;
		$adminModelSingular[] = $varObject->tab2.'return JFactory::getUser()->authorise(\'core.edit\', \''.$varObject->com_main.'.message.\'. ((int) isset($data[$key]) ? $data[$key] : 0)) or parent::allowEdit($data, $key);'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.'}'.$varObject->return;
		$adminModelSingular[] = $varObject->return;
		$adminModelSingular[] = $varObject->tab1.'/**'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' * Returns a reference to the a table object, always creating it.'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' *'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' * @param	type	The table type to instantiate'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' * @param	string	A prefix for the table class name. Optional.'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' * @param	array	Configuration array for model. Optional.'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' * @return	JTable	A database object'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' * @since	2.5'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' */'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.'public function getTable($type = \''.$view['singular']['safe'].'\', $prefix = \''.$varObject->comp_m_view_cap.'Table\', $config = array())'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.'{'.$varObject->return;
		$adminModelSingular[] = $varObject->tab2.'return JTable::getInstance($type, $prefix, $config);'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.'}'.$varObject->return;
		$adminModelSingular[] = $varObject->return;
		$adminModelSingular[] = $varObject->tab1.'/**'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' * Method to get the record form.'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' *'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' * @param	array	$data		Data for the form.'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' * @return	mixed	A JForm object on success, false on failure'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' * @since	2.5'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' */'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.'public function getForm($data = array(), $loadData = true)'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.'{'.$varObject->return;
		$adminModelSingular[] = $varObject->tab2.'// Get the form.'.$varObject->return;
		$adminModelSingular[] = $varObject->tab2.'$form = $this->loadForm(\''.$varObject->com_main.'.'.$view['singular']['safe'].'\', \''.$view['singular']['safe'].'\', array(\'control\' => \'jform\', \'load_data\' => $loadData));'.$varObject->return;
		$adminModelSingular[] = $varObject->return;
		$adminModelSingular[] = $varObject->tab2.'if (empty($form)){'.$varObject->return;
		$adminModelSingular[] = $varObject->tab3.'return false;'.$varObject->return;
		$adminModelSingular[] = $varObject->tab2.'};'.$varObject->return;
		$adminModelSingular[] = $varObject->return;
		$adminModelSingular[] = $varObject->tab2.'return $form;'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.'}'.$varObject->return;
		$adminModelSingular[] = $varObject->return;
		$adminModelSingular[] = $varObject->tab1.'/**'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' * Method to get the script that have to be included on the form'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' *'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' * @return string	script files'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' */'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.'public function getScript()'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.'{'.$varObject->return;
		$adminModelSingular[] = $varObject->tab2.'return \'administrator/components/'.$varObject->com_main.'/models/forms/'.$view['singular']['safe'].'.js\';'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.'}'.$varObject->return;
		$adminModelSingular[] = $varObject->return;
		$adminModelSingular[] = $varObject->tab1.'/**'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' * Method to get the data that should be injected in the form.'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' *'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' * @return	mixed	The data for the form.'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' * @since	2.5'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.' */'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.'protected function loadFormData() '.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.'{'.$varObject->return;
		$adminModelSingular[] = $varObject->tab2.'// Check the session for previously entered form data.'.$varObject->return;
		$adminModelSingular[] = $varObject->tab2.'$data = JFactory::getApplication()->getUserState(\''.$varObject->com_main.'.edit.'.$view['singular']['safe'].'.data\', array());'.$varObject->return;
		$adminModelSingular[] = $varObject->return;
		$adminModelSingular[] = $varObject->tab2.'if (empty($data)){'.$varObject->return;
		$adminModelSingular[] = $varObject->tab3.'$data = $this->getItem();'.$varObject->return;
		$adminModelSingular[] = $varObject->tab2.'};'.$varObject->return;
		$adminModelSingular[] = $varObject->return;
		$adminModelSingular[] = $varObject->tab1.'return $data;'.$varObject->return;
		$adminModelSingular[] = $varObject->tab1.'}'.$varObject->return;
		$adminModelSingular[] = '}'.$varObject->return;
		$adminModelSingular[] = '?>';
		
		return $adminModelSingular;
	}
	
	public static function adminModelFormsForm($formfields, $varObject)
	{
		$adminModelFormsForm[] = '<?xml version="1.0" encoding="utf-8"?>'.$varObject->return;
		$adminModelFormsForm[] = '<form'.$varObject->return;
		$adminModelFormsForm[] = $varObject->tab1.'addrulepath="/administrator/components/'.$varObject->com_main.'/models/rules"'.$varObject->return;
		$adminModelFormsForm[] = $varObject->tab1.'addfieldpath="/administrator/components/'.$varObject->com_main.'/models/fields"'.$varObject->return;
		$adminModelFormsForm[] = '>'.$varObject->return;
		$adminModelFormsForm[] = $varObject->tab1.'<fieldset name="details">'.$varObject->return;
		$adminModelFormsForm[] = $varObject->tab2.'<field'.$varObject->return;
		$adminModelFormsForm[] = $varObject->tab3.'name="id"'.$varObject->return;
		$adminModelFormsForm[] = $varObject->tab3.'type="hidden"'.$varObject->return;
		$adminModelFormsForm[] = $varObject->tab2.'/>'.$varObject->return;
		
		if($varObject->datemodified):
			$adminModelFormsForm[] = $varObject->tab2.'<field'.$varObject->return;
			$adminModelFormsForm[] = $varObject->tab3.'name="date_created"'.$varObject->return;
			$adminModelFormsForm[] = $varObject->tab3.'type="hidden"'.$varObject->return;
			$adminModelFormsForm[] = $varObject->tab2.'/>'.$varObject->return;
		endif;
		
		if($varObject->usermodified):
			$adminModelFormsForm[] = $varObject->tab2.'<field'.$varObject->return;
			$adminModelFormsForm[] = $varObject->tab3.'name="user_created"'.$varObject->return;
			$adminModelFormsForm[] = $varObject->tab3.'type="hidden"'.$varObject->return;
			$adminModelFormsForm[] = $varObject->tab2.'/>'.$varObject->return;		
		endif;
		
		// Make sure there is formfields
		if($formfields->name):
			// Parse through fields
			foreach($formfields->name as $key=>$field):
				// Set variables to empty
				$default = $required = $validate = $class = $size = $filter = $width = $format = $first = $last = $step = $rows = $cols = $extension = '';
				
				// Capitalize the field word(s)
				$field = strtolower($field);
				$field = ucwords($field);
				
				// pull safe value
				$field_lower = $formfields->name_safe[$key];
	
				// Check if field has a default
				if(array_key_exists($key, $formfields->default)):
					$default = $formfields->default[$key];
				endif;
				
				// Check if field is to be on the manager
				if($formfields->show):
					if(array_key_exists($key, $formfields->show)):
						//echo 'show in manager';
					endif;
				endif;
				
				// Check if field is required
				if($formfields->required):
					if (array_key_exists($key, $formfields->required)):
						//echo 'required'.$key;
						$required = $varObject->tab3.'required="true"'.$varObject->return;
						$validate = 'validate-';
					endif;
				endif;
				
				// Set end var
				$end = 1;
				
				// Type of field
				$type = $formfields->type[$key];
				switch ($type) {
					case 'calendar':
						$format = $varObject->tab3.'format="%Y-%m-%d"'.$varObject->return;
						break;
					case 'category':
						$extension = $varObject->tab3.'extension="'.$varObject->com_main.'"'.$varObject->return;
						break;
					case 'editor':
						$filter = $varObject->tab3.'filter="safehtml"'.$varObject->return;
						$width = $varObject->tab3.'width="300"'.$varObject->return;
						break;
					case 'hidden':
					case 'file':
						// nothing special to add for these
						break;
					case 'integer':
					case 'list':
						// Check for number list
						if(strpos($default, '##')):
							$numbers = explode('##', $default);
							$first = $varObject->tab3.'first="'.$numbers[0].'"'.$varObject->return;
							$last = $varObject->tab3.'last="'.$numbers[1].'"'.$varObject->return;
							$step = $varObject->tab3.'step="1"'.$varObject->return;
							$default = $numbers[0];
						endif;
						// Check for word list
						if(strpos($default, ',')):
							$options = explode(',', $default);
							foreach($options as $newkey=>$option):
								$option = trim($option);
								if(strpos($option, '[') == 0 && strpos($option, ']')):
									$option = str_replace('[', '', $option);
									$option = str_replace(']', '', $option);
									$options[$newkey] = $option;
									$default = $option;
								endif;
							endforeach;
							$end = 2;
						endif;
						break;
					case 'radio':
						if(strpos($default, ',')):
							$options = explode(',', $default);
							foreach($options as $newkey=>$option):
								$option = trim($option);
								if(strpos($option, '[') == 0 && strpos($option, ']')):
									$option = str_replace('[', '', $option);
									$option = str_replace(']', '', $option);
									$options[$newkey] = $option;
									$default = $option;
								endif;
							endforeach;
							$end = 2;
						endif;
						break;
					case 'checkbox':
					case 'text':
					case 'numbers':
						$class = $varObject->tab3.'class="inputbox '.$validate.$field_lower.'"'.$varObject->return;
						$size = $varObject->tab3.'size="40"'.$varObject->return;
						break;
					case 'textarea':
						$rows = $varObject->tab3.'rows="10"'.$varObject->return;
						$cols = $varObject->tab3.'cols="5"'.$varObject->return;
						break;
				}
				
				$adminModelFormsForm[] = $varObject->tab2.'<field'.$varObject->return;
				$adminModelFormsForm[] = $class;
				$adminModelFormsForm[] = $varObject->tab3.'default="'.$default.'"'.$varObject->return;
				$adminModelFormsForm[] = $varObject->tab3.'description=""'.$varObject->return;
				$adminModelFormsForm[] = $varObject->tab3.'label="'.$field.'"'.$varObject->return;
				$adminModelFormsForm[] = $varObject->tab3.'name="'.$field_lower.'"'.$varObject->return;
				$adminModelFormsForm[] = $required;
				$adminModelFormsForm[] = $size;
				$adminModelFormsForm[] = $filter;
				$adminModelFormsForm[] = $width;
				$adminModelFormsForm[] = $format;
				$adminModelFormsForm[] = $extension;
				$adminModelFormsForm[] = $first;
				$adminModelFormsForm[] = $last;
				$adminModelFormsForm[] = $step;
				$adminModelFormsForm[] = $rows;
				$adminModelFormsForm[] = $cols;
				$adminModelFormsForm[] = $varObject->tab3.'type="'.$type.'"'.$varObject->return;
				if($validate):
					$adminModelFormsForm[] = $varObject->tab3.'validate="'.$field_lower.'"'.$varObject->return;;
				endif;
				
				// end of field
				if($end == 1):
					$adminModelFormsForm[] = $varObject->tab2.'/>'.$varObject->return;
				elseif($end == 2):
					$adminModelFormsForm[] = $varObject->tab2.'>'.$varObject->return;
					foreach($options as $key=>$option):
						$option = trim($option);
						$adminModelFormsForm[] = $varObject->tab3.'<option'.$varObject->return;
						$adminModelFormsForm[] = $varObject->tab4.'value="'.$option.'">'.ucwords($option).'</option>'.$varObject->return;
					endforeach;
					$adminModelFormsForm[] = $varObject->tab2.'</field>'.$varObject->return;
				endif;
				
			endforeach;
		endif;
		
		
		$adminModelFormsForm[] = $varObject->tab1.'</fieldset>'.$varObject->return;
		$adminModelFormsForm[] = '</form>';
		
		return $adminModelFormsForm;
	}
	
	public static function adminModelFormsFormJS($formfields, $view, $varObject)
	{
		$filename = $view['singular']['safe'] . '.js';
		
		$adminModelFormsFormJS[] = '/**'.$varObject->return;
		$adminModelFormsFormJS[] = ' *'.$varObject->tab1.$view['singular']['orig'].' : Validate'.$varObject->return;
		$adminModelFormsFormJS[] = ' *'.$varObject->tab1.'Filename : '.$filename.$varObject->return;
		$adminModelFormsFormJS[] = ' *'.$varObject->return;
		$adminModelFormsFormJS[] = ' *'.$varObject->tab1.'Author : '.$varObject->author.$varObject->return;
		$adminModelFormsFormJS[] = ' *'.$varObject->tab1.'Component : '.$varObject->comp_name.$varObject->return;
		$adminModelFormsFormJS[] = ' *'.$varObject->return;
		$adminModelFormsFormJS[] = ' *'.$varObject->tab1.'Copyright : '.$varObject->copyright.$varObject->return;
		$adminModelFormsFormJS[] = ' *'.$varObject->tab1.'License : '.$varObject->license.$varObject->return;
		$adminModelFormsFormJS[] = ' *'.$varObject->return;
		$adminModelFormsFormJS[] = ' **/'.$varObject->return;
		$adminModelFormsFormJS[] = 'window.addEvent(\'domready\', function() {'.$varObject->return;
		
		// Make sure there is formfields
		if($formfields->name):
			// Parse through fields
			foreach($formfields->name as $key=>$field):
				$field_lower = $formfields->name_safe[$key];
				// Check if field is required
				if($formfields->required):
					if (array_key_exists($key, $formfields->required)):
						$adminModelFormsFormJS[] = $varObject->tab1.'document.formvalidator.setHandler(\''.$field_lower.'\','.$varObject->return;
						$adminModelFormsFormJS[] = $varObject->tab2.'function (value) {'.$varObject->return;
						$adminModelFormsFormJS[] = $varObject->tab3.'regex=/^[^_]+$/;'.$varObject->return;
						$adminModelFormsFormJS[] = $varObject->tab3.'return regex.test(value);'.$varObject->return;
						$adminModelFormsFormJS[] = $varObject->tab1.'});'.$varObject->return;
					endif;
				endif;
			endforeach;
		endif;
		
		$adminModelFormsFormJS[] = '});';
		
		return $adminModelFormsFormJS;
	}
	
	public static function adminModuleFieldsField($formfields, $adminmodelfieldfilename, $view, $varObject, $view_count_string)
	{	
		$field = $formfields->name_safe[0];
		$filename = $varObject->comp_m_view.$view_count_string . '.php';
		
		$adminModuleFieldsFieldLine[] = '<?php'.$varObject->return;
		$adminModuleFieldsFieldLine[] = Helpers::phpheader($filename, $varObject);
		$adminModuleFieldsFieldLine[] = Helpers::nodirectaccess($varObject);
		$adminModuleFieldsFieldLine[] = $varObject->return;
		$adminModuleFieldsFieldLine[] = '// import the list field type'.$varObject->return;
		$adminModuleFieldsFieldLine[] = 'jimport(\'joomla.form.helper\');'.$varObject->return;
		$adminModuleFieldsFieldLine[] = 'JFormHelper::loadFieldClass(\'list\');'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->return;
		$adminModuleFieldsFieldLine[] = '/**'.$varObject->return;
		$adminModuleFieldsFieldLine[] = ' * '.$field.' Form Field class for the '.$varObject->comp_m_view_cap.' component'.$varObject->return;
		$adminModuleFieldsFieldLine[] = ' */'.$varObject->return;
		$adminModuleFieldsFieldLine[] = 'class JFormField'.$adminmodelfieldfilename.' extends JFormFieldList'.$varObject->return;
		$adminModuleFieldsFieldLine[] = '{'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab1.'/**'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab1.' * The '.$field.' field type.'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab1.' *'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab1.' * @var		string'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab1.' */'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab1.'protected $type = \''.$adminmodelfieldfilename.'\';'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab1.'/**'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab1.' * Method to get a list of options for a list input.'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab1.' *'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab1.' * @return	array		An array of JHtml options.'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab1.' */'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab1.'protected function getOptions()'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab1.'{'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab2.'$db = JFactory::getDBO();'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab2.'$query = $db->getQuery(true);'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab2.'$query->select(\'#__'.$varObject->comp_m_view.'_'.$view['singular']['safe'].'.id as id, #__'.$varObject->comp_m_view.'_'.$view['singular']['safe'].'.'.$field.' as '.$field.'\');'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab2.'$query->from(\'#__'.$varObject->comp_m_view.'_'.$view['singular']['safe'].'\');'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab2.'$db->setQuery((string)$query);'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab2.'$items = $db->loadObjectList();'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab2.'$options = array();'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab2.'if($items){'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab3.'foreach($items as $item){'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab4.'$options[] = JHtml::_(\'select.option\', $item->id, ucwords($item->'.$field.'));'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab3.'};'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab2.'};'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab2.'$options = array_merge(parent::getOptions(), $options);'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab2.'return $options;'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab1.'}'.$varObject->return;
		$adminModuleFieldsFieldLine[] = '}'.$varObject->return;
		$adminModuleFieldsFieldLine[] = '?>';
		
		return $adminModuleFieldsFieldLine;
	}
	
	public static function adminCatModuleFieldsField($view, $varObject, $view_count_string)
	{	
		/*
		// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import the list field type
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

/**
 * Category Form Field class for the Products component
 * /
class JFormFieldproductsone extends JFormFieldList
{
	/**
	 * The title field type.
	 *
	 * @var		string
	 * /
	protected $type = 'productsone';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return	array		An array of JHtml options.
	 * /
	protected function getOptions()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('#__categories.id as id, #__categories.title as title');
		$query->from('#__categories');
		$query->where('extension="com_products"');
		$db->setQuery((string)$query);
		$items = $db->loadObjectList();
		$options = array();
		if($items){
			foreach($items as $item){
				$options[] = JHtml::_('select.option', $item->id, ucwords($item->title));
			};
		};
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
		*/
		$adminModuleFieldsFieldLine[] = '<?php'.$varObject->return;
		$adminModuleFieldsFieldLine[] = Helpers::phpheader($filename, $varObject);
		$adminModuleFieldsFieldLine[] = Helpers::nodirectaccess($varObject);
		$adminModuleFieldsFieldLine[] = $varObject->return;
		$adminModuleFieldsFieldLine[] = '// import the list field type'.$varObject->return;
		$adminModuleFieldsFieldLine[] = 'jimport(\'joomla.form.helper\');'.$varObject->return;
		$adminModuleFieldsFieldLine[] = 'JFormHelper::loadFieldClass(\'list\');'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->return;
		$adminModuleFieldsFieldLine[] = '/**'.$varObject->return;
		$adminModuleFieldsFieldLine[] = ' * ' . $view['plural']['view_cap'] . ' Category Select Form Field class for the '.$varObject->comp_m_view_cap.' component'.$varObject->return;
		$adminModuleFieldsFieldLine[] = ' */'.$varObject->return;
		$adminModuleFieldsFieldLine[] = 'class JFormField'.$view_count_string.' extends JFormFieldList'.$varObject->return;
		$adminModuleFieldsFieldLine[] = '{'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab1.'/**'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab1.' * The '.$view_count_string.' field type.'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab1.' *'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab1.' * @var		string'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab1.' */'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab1.'protected $type = \''.$view_count_string.'\';'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab1.'/**'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab1.' * Method to get a list of options for a list input.'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab1.' *'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab1.' * @return	array		An array of JHtml options.'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab1.' */'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab1.'protected function getOptions()'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab1.'{'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab2.'$db = JFactory::getDBO();'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab2.'$query = $db->getQuery(true);'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab2.'$query->select(\'#__categories.id as id, #__categories.title as title\');'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab2.'$query->from(\'#__categories\');'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab2.'$query->where(\'extension="' . $varObject->com_main . '"\');'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab2.'$db->setQuery((string)$query);'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab2.'$items = $db->loadObjectList();'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab2.'$options = array();'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab2.'if($items){'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab3.'foreach($items as $item){'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab4.'$options[] = JHtml::_(\'select.option\', $item->id, ucwords($item->title));'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab3.'};'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab2.'};'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab2.'$options = array_merge(parent::getOptions(), $options);'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab2.'return $options;'.$varObject->return;
		$adminModuleFieldsFieldLine[] = $varObject->tab1.'}'.$varObject->return;
		$adminModuleFieldsFieldLine[] = '}'.$varObject->return;
		$adminModuleFieldsFieldLine[] = '?>';
		
		return $adminModuleFieldsFieldLine;
	}
	
	public static function adminModelRulesRule($formfields, $varObject)
	{
		// Make sure you don't overwrite a rule
		$created_rule = 0;
		// Make sure there is formfields
		if($formfields->name):
			// Parse through fields
			foreach($formfields->name as $key=>$field):
				$field_lower = $formfields->name_safe[$key];
				// Check if field is required
				if($formfields->required):
					if (array_key_exists($key, $formfields->required)):
						$filename = $field_lower . '.php';
						$adminModelRulesRule[$created_rule]['filename'] = $filename;
						$adminModelRulesRule[$created_rule][] = '<?php'.$varObject->return;
						$adminModelRulesRule[$created_rule][] = Helpers::phpheader($filename, $varObject);
						$adminModelRulesRule[$created_rule][] = Helpers::nodirectaccess($varObject);
						$adminModelRulesRule[$created_rule][] = $varObject->return;
						$adminModelRulesRule[$created_rule][] = '// import Joomla formrule library'.$varObject->return;
						$adminModelRulesRule[$created_rule][] = 'jimport(\'joomla.form.formrule\');'.$varObject->return;
						$adminModelRulesRule[$created_rule][] = '/**'.$varObject->return;
						$adminModelRulesRule[$created_rule][] = ' * Form Rule class for the Joomla Framework.'.$varObject->return;
						$adminModelRulesRule[$created_rule][] = ' */'.$varObject->return;
						$adminModelRulesRule[$created_rule][] = 'class JFormRule'.$field_lower.' extends JFormRule'.$varObject->return;
						$adminModelRulesRule[$created_rule][] = '{'.$varObject->return;
						$adminModelRulesRule[$created_rule][] = $varObject->tab1.'/**'.$varObject->return;
						$adminModelRulesRule[$created_rule][] = $varObject->tab1.' * The regular expression.'.$varObject->return;
						$adminModelRulesRule[$created_rule][] = $varObject->tab1.' *'.$varObject->return;
						$adminModelRulesRule[$created_rule][] = $varObject->tab1.' * @access	protected'.$varObject->return;
						$adminModelRulesRule[$created_rule][] = $varObject->tab1.' * @var		string'.$varObject->return;
						$adminModelRulesRule[$created_rule][] = $varObject->tab1.' * @since	2.5'.$varObject->return;
						$adminModelRulesRule[$created_rule][] = $varObject->tab1.' */'.$varObject->return;
						$adminModelRulesRule[$created_rule][] = $varObject->tab1.'protected $regex = \'^[^_]+$\';'.$varObject->return;
						$adminModelRulesRule[$created_rule][] = '}'.$varObject->return;
						$adminModelRulesRule[$created_rule][] = '?>';
						$created_rule++;
					endif;
				endif;
			endforeach;
		endif;
		
		return $adminModelRulesRule;
	}
	
	public static function adminSQLInstallFile($formfields, $view, $varObject)
	{	
		$adminSQLInstallLine[] = 'CREATE TABLE IF NOT EXISTS `#__'.$varObject->comp_m_view.'_'.$view['singular']['safe'].'` (';
		$adminSQLInstallLine[] = $varObject->space2 . '`id` int(11) NOT NULL AUTO_INCREMENT,';
		// Make sure there is formfields
		if($formfields->name):
			foreach($formfields->name as $key=>$field):
				$field			= strtolower($field);
				$field			= ucwords($field);
				$field_lower	= $formfields->name_safe[$key];
				
				// Type of field
				switch ($formfields->type[$key]) {
					case 'calendar':
						$adminSQLInstallLine[] = $varObject->space2 . '`'.$field_lower.'` DATE NOT NULL,';
						break;
					case 'editor':
					case 'textarea':
						$adminSQLInstallLine[] = $varObject->space2 . '`'.$field_lower.'` TEXT NOT NULL DEFAULT \'\',';
						break;
					case 'category':
					case 'integer':
					case 'numbers':
						$adminSQLInstallLine[] = $varObject->space2 . '`'.$field_lower.'` int(11) NOT NULL DEFAULT \'0\',';
						break;
					case 'list':
					case 'radio':
					case 'text':
					case 'hidden':
					case 'file':
						$adminSQLInstallLine[] = $varObject->space2 . '`'.$field_lower.'` varchar(256) NOT NULL,';
						break;
				}
				
			endforeach;
		endif;
		
		// User & Date Created/Modified
		if($varObject->usermodified):
			$adminSQLInstallLine[] = $varObject->space2 . '`user_created` int(11) NOT NULL DEFAULT \'0\',';
			$adminSQLInstallLine[] = $varObject->space2 . '`user_modified` int(11) NOT NULL DEFAULT \'0\',';
		endif;
		if($varObject->datemodified):
			$adminSQLInstallLine[] = $varObject->space2 . '`date_created` DATETIME NOT NULL,';
			$adminSQLInstallLine[] = $varObject->space2 . '`date_modified` DATETIME NOT NULL,';
		endif;
		
		// Add checked out support
		$adminSQLInstallLine[] = $varObject->space2 . '`checked_out` int(11) NOT NULL,';
		$adminSQLInstallLine[] = $varObject->space2 . '`checked_out_time` DATETIME NOT NULL,';
		
		$adminSQLInstallLine[] = $varObject->space2 . 'PRIMARY KEY  (`id`)';
		$adminSQLInstallLine[] = ') ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;';
		
		return $adminSQLInstallLine;
	}
	
	public static function adminSQLUninstallFile($formfields, $view, $varObject)
	{
		$adminSQLUninstallLine = 'DROP TABLE IF EXISTS `#__'.$varObject->comp_m_view.'_'.$view['singular']['safe'].'`;';
		
		return $adminSQLUninstallLine;
	}
	
	public static function adminTable($view, $varObject)
	{
		$filename = $view['singular']['safe'] . '.php';
		$adminTable[] = '<?php'.$varObject->return;
		$adminTable[] = Helpers::phpheader($filename, $varObject);
		$adminTable[] = Helpers::nodirectaccess($varObject);
		$adminTable[] = $varObject->return;
		$adminTable[] = '// import Joomla table library'.$varObject->return;
		$adminTable[] = 'jimport(\'joomla.database.table\');'.$varObject->return;
		$adminTable[] = $varObject->return;
		$adminTable[] = '/**'.$varObject->return;
		$adminTable[] = ' * '.$view['plural']['cap'].' Table '.$view['singular']['cap'].' class'.$varObject->return;
		$adminTable[] = ' */'.$varObject->return;
		$adminTable[] = 'class '.$varObject->comp_m_view_cap.'Table'.$view['singular']['safe'].' extends JTable'.$varObject->return;
		$adminTable[] = '{'.$varObject->return;
		$adminTable[] = $varObject->tab1.'/**'.$varObject->return;
		$adminTable[] = $varObject->tab1.' * Constructor'.$varObject->return;
		$adminTable[] = $varObject->tab1.' *'.$varObject->return;
		$adminTable[] = $varObject->tab1.' * @param object Database connector object'.$varObject->return;
		$adminTable[] = $varObject->tab1.' */'.$varObject->return;
		$adminTable[] = $varObject->tab1.'function __construct(&$db) '.$varObject->return;
		$adminTable[] = $varObject->tab1.'{'.$varObject->return;
		$adminTable[] = $varObject->tab2.'parent::__construct(\'#__'.$varObject->comp_m_view.'_'.$view['singular']['safe'].'\', \'id\', $db);'.$varObject->return;
		$adminTable[] = $varObject->tab1.'}'.$varObject->return;
		$adminTable[] = $varObject->return;
		$adminTable[] = $varObject->tab1.'/**'.$varObject->return;
		$adminTable[] = $varObject->tab1.' * Method to compute the default name of the asset.'.$varObject->return;
		$adminTable[] = $varObject->tab1.' * The default name is in the form \'table_name.id\''.$varObject->return;
		$adminTable[] = $varObject->tab1.' * where id is the value of the primary key of the table.'.$varObject->return;
		$adminTable[] = $varObject->tab1.' *'.$varObject->return;
		$adminTable[] = $varObject->tab1.' * @return	string'.$varObject->return;
		$adminTable[] = $varObject->tab1.' * @since	2.5'.$varObject->return;
		$adminTable[] = $varObject->tab1.' */'.$varObject->return;
		$adminTable[] = $varObject->tab1.'protected function _getAssetName()'.$varObject->return;
		$adminTable[] = $varObject->tab1.'{'.$varObject->return;
		$adminTable[] = $varObject->tab2.'$k = $this->_tbl_key;'.$varObject->return;
		$adminTable[] = $varObject->tab2.'return \''.$varObject->com_main.'.message.\'.(int) $this->$k;'.$varObject->return;
		$adminTable[] = $varObject->tab1.'}'.$varObject->return;
		$adminTable[] = $varObject->return;
		$adminTable[] = $varObject->tab1.'/**'.$varObject->return;
		$adminTable[] = $varObject->tab1.' * Method to return the title to use for the asset table.'.$varObject->return;
		$adminTable[] = $varObject->tab1.' *'.$varObject->return;
		$adminTable[] = $varObject->tab1.' * @return	string'.$varObject->return;
		$adminTable[] = $varObject->tab1.' * @since	2.5'.$varObject->return;
		$adminTable[] = $varObject->tab1.' */'.$varObject->return;
		$adminTable[] = $varObject->tab1.'protected function _getAssetTitle()'.$varObject->return;
		$adminTable[] = $varObject->tab1.'{'.$varObject->return;
		$adminTable[] = $varObject->tab2.'return $this->title;'.$varObject->return;
		$adminTable[] = $varObject->tab1.'}'.$varObject->return;
		$adminTable[] = $varObject->return;
		$adminTable[] = $varObject->tab1.'/**'.$varObject->return;
		$adminTable[] = $varObject->tab1.' * Get the parent asset id for the record'.$varObject->return;
		$adminTable[] = $varObject->tab1.' *'.$varObject->return;
		$adminTable[] = $varObject->tab1.' * @return	int'.$varObject->return;
		$adminTable[] = $varObject->tab1.' * @since	2.5'.$varObject->return;
		$adminTable[] = $varObject->tab1.' */'.$varObject->return;
		$adminTable[] = $varObject->tab1.$varObject->j_table_getassetparentid_function.$varObject->return;
		$adminTable[] = $varObject->tab1.'{'.$varObject->return;
		$adminTable[] = $varObject->tab2.'$asset = JTable::getInstance(\'Asset\');'.$varObject->return;
		$adminTable[] = $varObject->tab2.'$asset->loadByName(\''.$varObject->com_main.'\');'.$varObject->return;
		$adminTable[] = $varObject->return;
		$adminTable[] = $varObject->tab2.'return $asset->id;'.$varObject->return;
		$adminTable[] = $varObject->tab1.'}'.$varObject->return;
		$adminTable[] = ''.$varObject->return;
		$adminTable[] = '}'.$varObject->return;
		$adminTable[] = '?>';
		
		return $adminTable;
	}	
}
?>