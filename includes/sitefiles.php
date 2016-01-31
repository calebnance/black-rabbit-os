<?php
/**
 *
 *
 */
class SiteFiles 
{
	public static function controllerFile($varObject, $filename)
	{
		$controllerFileLines[] = '<?php'.$varObject->return;
		$controllerFileLines[] = Helpers::phpheader($filename, $varObject);
		$controllerFileLines[] = Helpers::nodirectaccess($varObject);
		$controllerFileLines[] = $varObject->return;
		$controllerFileLines[] = '// import Joomla controller library'.$varObject->return;
		$controllerFileLines[] = 'jimport(\'joomla.application.component.controller\');'.$varObject->return;
		$controllerFileLines[] = $varObject->return;
		$controllerFileLines[] = '/**'.$varObject->return;
		$controllerFileLines[] = ' * '.$varObject->comp_m_view_cap.' Component Controller'.$varObject->return;
		$controllerFileLines[] = ' */'.$varObject->return;
		$controllerFileLines[] = 'class '.$varObject->comp_m_view_cap.'Controller extends '.$varObject->j_controller.$varObject->return;
		$controllerFileLines[] = '{'.$varObject->return;
		$controllerFileLines[] = $varObject->return;
		$controllerFileLines[] = '}'.$varObject->return;
		$controllerFileLines[] = '?>';
			
		return $controllerFileLines;
	}
	
	public static function componentFile($varObject)
	{
		$filename = $varObject->comp_m_view.'.php';
		$componentFileLines[] = '<?php'.$varObject->return;
		$componentFileLines[] = Helpers::phpheader($filename, $varObject);
		$componentFileLines[] = Helpers::nodirectaccess($varObject);
		$componentFileLines[] = $varObject->return;
		// Check if Joomla 3.0
		if($varObject->j_version == '3.0' || $varObject->j_version == '3.2'):
			$componentFileLines[] = '// Added for Joomla 3.0'.$varObject->return;
			$componentFileLines[] = 'if(!defined(\'DS\')){'.$varObject->return;
			$componentFileLines[] = $varObject->tab1.'define(\'DS\',DIRECTORY_SEPARATOR);'.$varObject->return;
			$componentFileLines[] = '};'.$varObject->return;
			$componentFileLines[] = $varObject->return;
		endif;
		$componentFileLines[] = '// Set the component css/js'.$varObject->return;
		$componentFileLines[] = '$document = JFactory::getDocument();'.$varObject->return;
		$componentFileLines[] = '$document->addStyleSheet(\'components/'.$varObject->com_main.'/assets/css/'.$varObject->comp_m_view.'.css\');'.$varObject->return;
		$componentFileLines[] = $varObject->return;
		$componentFileLines[] = '// Require helper file'.$varObject->return;
		$componentFileLines[] = 'JLoader::register(\''.$varObject->comp_m_view_cap.'Helper\', dirname(__FILE__) . DS . \'helpers\' . DS . \''.$varObject->comp_m_view.'.php\');'.$varObject->return;
		$componentFileLines[] = $varObject->return;
		$componentFileLines[] = '// import joomla controller library'.$varObject->return;
		$componentFileLines[] = 'jimport(\'joomla.application.component.controller\');'.$varObject->return;
		$componentFileLines[] = $varObject->return;
		$componentFileLines[] = '// Get an instance of the controller prefixed by '.$varObject->comp_m_view_cap.$varObject->return;
		$componentFileLines[] = '$controller = '.$varObject->j_controller.'::getInstance(\''.$varObject->comp_m_view_cap.'\');'.$varObject->return;
		$componentFileLines[] = $varObject->return;
		$componentFileLines[] = '// Perform the request task'.$varObject->return;
		$componentFileLines[] = '$controller->execute(JRequest::getCmd(\'task\'));'.$varObject->return;
		$componentFileLines[] = $varObject->return;
		$componentFileLines[] = '// Redirect if set by the controller'.$varObject->return;
		$componentFileLines[] = '$controller->redirect();'.$varObject->return;
		$componentFileLines[] = '?>';
			
		return $componentFileLines;
	}
	
	public static function helperFile($varObject)
	{
		$filename = $varObject->comp_m_view.'.php';
		$helperFileLines[] = '<?php'.$varObject->return;
		$helperFileLines[] = Helpers::phpheader($filename, $varObject);
		$helperFileLines[] = Helpers::nodirectaccess($varObject);
		$helperFileLines[] = $varObject->return;
		$helperFileLines[] = '/**'.$varObject->return;
		$helperFileLines[] = ' * '.$varObject->comp_m_view_cap.' component helper'.$varObject->return;
		$helperFileLines[] = ' */'.$varObject->return;
		$helperFileLines[] = 'abstract class '.$varObject->comp_m_view_cap.'Helper'.$varObject->return;
		$helperFileLines[] = '{'.$varObject->return;
		$helperFileLines[] = $varObject->return;
		$helperFileLines[] = '}'.$varObject->return;
		$helperFileLines[] = '?>';
		
		return $helperFileLines;
	}
	
	public static function routerFile($varObject, $filename)
	{
		$routerFileLines[] = '<?php'.$varObject->return;
		$routerFileLines[] = Helpers::phpheader($filename, $varObject);
		$routerFileLines[] = Helpers::nodirectaccess($varObject);
		$routerFileLines[] = $varObject->return;
		$routerFileLines[] = 'function '.$varObject->comp_m_view_cap.'BuildRoute(&$query)'.$varObject->return;
		$routerFileLines[] = '{'.$varObject->return;
		$routerFileLines[] = $varObject->tab1.'$segments = array();'.$varObject->return;
		$routerFileLines[] = $varObject->return;
		$routerFileLines[] = $varObject->tab1.'if(isset($query[\'view\'])){'.$varObject->return;
		$routerFileLines[] = $varObject->tab2.'$segments[] = $query[\'view\'];'.$varObject->return;
		$routerFileLines[] = $varObject->tab2.'unset($query[\'view\']);'.$varObject->return;
		$routerFileLines[] = $varObject->tab1.'};'.$varObject->return;
		$routerFileLines[] = $varObject->return;
		$routerFileLines[] = $varObject->tab1.'if(isset($query[\'id\'])){'.$varObject->return;
		$routerFileLines[] = $varObject->tab2.'$segments[] = $query[\'id\'];'.$varObject->return;
		$routerFileLines[] = $varObject->tab2.'unset($query[\'id\']);'.$varObject->return;
		$routerFileLines[] = $varObject->tab1.'};'.$varObject->return;
		$routerFileLines[] = $varObject->return;
		$routerFileLines[] = $varObject->tab1.'return $segments;'.$varObject->return;
		$routerFileLines[] = '}'.$varObject->return;
		$routerFileLines[] = $varObject->return;
		$routerFileLines[] = 'function '.$varObject->comp_m_view_cap.'ParseRoute($segments)'.$varObject->return;
		$routerFileLines[] = '{'.$varObject->return;
		$routerFileLines[] = $varObject->tab1.'$vars = array();'.$varObject->return;
		$routerFileLines[] = $varObject->tab1.'// Count segments'.$varObject->return;
		$routerFileLines[] = $varObject->tab1.'$count = count($segments);'.$varObject->return;
		$routerFileLines[] = $varObject->tab1.'//Handle View and Identifier'.$varObject->return;
		$routerFileLines[] = $varObject->tab1.'switch($segments[0])'.$varObject->return;
		$routerFileLines[] = $varObject->tab1.'{'.$varObject->return;
		
		// Parse through views
		foreach($varObject->allViews as $view):
		$routerFileLines[] = $varObject->tab2.'case \''.$view['plural']['safe'].'\':'.$varObject->return;
		$routerFileLines[] = $varObject->tab3.'$id = explode(\':\', $segments[$count-1]);'.$varObject->return;
		$routerFileLines[] = $varObject->tab3.'$vars[\'id\'] = (int) $id[0];'.$varObject->return;
		$routerFileLines[] = $varObject->tab3.'$vars[\'view\'] = \''.$view['plural']['safe'].'\';'.$varObject->return;
		$routerFileLines[] = $varObject->tab3.'break;'.$varObject->return;
		$routerFileLines[] = $varObject->return;
		$routerFileLines[] = $varObject->tab2.'case \''.$view['singular']['safe'].'\':'.$varObject->return;
		$routerFileLines[] = $varObject->tab3.'$id = explode(\':\', $segments[$count-1]);'.$varObject->return;
		$routerFileLines[] = $varObject->tab3.'$vars[\'id\'] = (int) $id[0];'.$varObject->return;
		$routerFileLines[] = $varObject->tab3.'$vars[\'view\'] = \''.$view['singular']['safe'].'\';'.$varObject->return;
		$routerFileLines[] = $varObject->tab3.'break;'.$varObject->return;
		endforeach;
		
		$routerFileLines[] = $varObject->tab1.'}'.$varObject->return;
		$routerFileLines[] = $varObject->return;
		$routerFileLines[] = $varObject->tab1.'return $vars;'.$varObject->return;
		$routerFileLines[] = '}'.$varObject->return;
		$routerFileLines[] = '?>';
		
		return $routerFileLines;		
	}
	
	/**
	 *	PLURAL VIEW - SITE
	 */
	
	// plural model
	public static function modelsModelPlural($view, $varObject)
	{		
		$filename = $view['plural']['safe'].'.php';
		$modelsModel[] = '<?php'.$varObject->return;
		$modelsModel[] = Helpers::phpheader($filename, $varObject);
		$modelsModel[] = Helpers::nodirectaccess($varObject);
		$modelsModel[] = '// import the Joomla modellist library'.$varObject->return;
		$modelsModel[] = 'jimport(\'joomla.application.component.modellist\');'.$varObject->return;
		$modelsModel[] = '/**'.$varObject->return;
		$modelsModel[] = ' * '.$view['plural']['cap'].' Model'.$varObject->return;
		$modelsModel[] = ' */'.$varObject->return;
		$modelsModel[] = 'class '.$varObject->comp_m_view_cap.'Model'.$view['plural']['safe'].' extends JModelList'.$varObject->return;
		$modelsModel[] = '{'.$varObject->return;
		$modelsModel[] = $varObject->tab1.'/**'.$varObject->return;
		$modelsModel[] = $varObject->tab1.' * Method to build an SQL query to load the list data.'.$varObject->return;
		$modelsModel[] = $varObject->tab1.' *'.$varObject->return;
		$modelsModel[] = $varObject->tab1.' * @return      string  An SQL query'.$varObject->return;
		$modelsModel[] = $varObject->tab1.' */'.$varObject->return;
		$modelsModel[] = $varObject->tab1.'protected function getListQuery()'.$varObject->return;
		$modelsModel[] = $varObject->tab1.'{'.$varObject->return;
		$modelsModel[] = $varObject->tab2.'// Create a new query object.'.$varObject->return;
		$modelsModel[] = $varObject->tab2.'$db = JFactory::getDBO();'.$varObject->return;
		$modelsModel[] = $varObject->tab2.'$query = $db->getQuery(true);'.$varObject->return;
		$modelsModel[] = $varObject->tab2.'// Select some fields'.$varObject->return;
		$modelsModel[] = $varObject->tab2.'$query->select(\'*\');'.$varObject->return;
		$modelsModel[] = $varObject->tab2.'// From the '.$varObject->comp_m_view.'_'.$view['singular']['safe'].' table'.$varObject->return;
		$modelsModel[] = $varObject->tab2.'$query->from(\'#__'.$varObject->comp_m_view.'_'.$view['singular']['safe'].'\');'.$varObject->return;
		$modelsModel[] = $varObject->return;
		$modelsModel[] = $varObject->tab2.'return $query;'.$varObject->return;
		$modelsModel[] = $varObject->tab1.'}'.$varObject->return;
		$modelsModel[] = '}'.$varObject->return;
		$modelsModel[] = '?>';
		
		return $modelsModel;
	}
	
	// plural view - view.html.php
	public static function viewsViewPluralViewHtml($view, $varObject, $filename)
	{		
		$viewHTML[] = '<?php'.$varObject->return;
		$viewHTML[] = Helpers::phpheader($filename, $varObject);
		$viewHTML[] = Helpers::nodirectaccess($varObject);
		$viewHTML[] = '// import Joomla view library'.$varObject->return;
		$viewHTML[] = 'jimport(\'joomla.application.component.view\');'.$varObject->return;
		$viewHTML[] = '/**'.$varObject->return;
		$viewHTML[] = ' * HTML '.$view['plural']['cap'].' View class for the '.$varObject->comp_name.' Component'.$varObject->return;
		$viewHTML[] = ' */'.$varObject->return;
		$viewHTML[] = 'class '.$varObject->comp_m_view_cap.'View'.$view['plural']['safe'].' extends '.$varObject->j_view.$varObject->return;
		$viewHTML[] = '{'.$varObject->return;
		$viewHTML[] = $varObject->tab1.'// Overwriting JView display method'.$varObject->return;
		$viewHTML[] = $varObject->tab1.'function display($tpl = null)'.$varObject->return;
		$viewHTML[] = $varObject->tab1.'{'.$varObject->return;
		$viewHTML[] = $varObject->tab2.'// Assign data to the view'.$varObject->return;
		$viewHTML[] = $varObject->tab2.'$this->items = $this->get(\'Items\');'.$varObject->return;
		$viewHTML[] = $varObject->tab2.'// Check for errors.'.$varObject->return;
		$viewHTML[] = $varObject->tab2.'if (count($errors = $this->get(\'Errors\'))){'.$varObject->return;
		$viewHTML[] = $varObject->tab3.'JError::raiseError(500, implode(\'<br />\', $errors));'.$varObject->return;
		$viewHTML[] = $varObject->tab3.'return false;'.$varObject->return;
		$viewHTML[] = $varObject->tab2.'};'.$varObject->return;
		$viewHTML[] = $varObject->tab2.'// Display the view'.$varObject->return;
		$viewHTML[] = $varObject->tab2.'parent::display($tpl);'.$varObject->return;
		$viewHTML[] = $varObject->tab1.'}'.$varObject->return;
		$viewHTML[] = '}'.$varObject->return;
		$viewHTML[] = '?>';
		
		return $viewHTML;
	}
	
	// plural view tmpl - default.php
	public static function viewsViewPluralTmplDefaulPHP($formfields, $view, $varObject, $filename, $view_count)
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
		
		$defaultPHP[] = '<?php'.$varObject->return;
		$defaultPHP[] = Helpers::phpheader($filename, $varObject);
		$defaultPHP[] = Helpers::nodirectaccess($varObject);
		if($categoryLookUp):
			$defaultPHP[] = $varObject->return;
			$defaultPHP[] = '// Connect to database'.$varObject->return;
			$defaultPHP[] = '$db = JFactory::getDBO();'.$varObject->return;
		endif;
		$defaultPHP[] = 'jimport(\'joomla.filter.output\');'.$varObject->return; // added v.0.6.0
		$defaultPHP[] = '?>'.$varObject->return;
		$defaultPHP[] = '<div id="'.$varObject->comp_m_view.'-'.$view['plural']['safe'].'">'.$varObject->return;
		$defaultPHP[] = $varObject->tab1.'<?php foreach($this->items as $item){ ?>'.$varObject->return;
		$defaultPHP[] = $varObject->tab2.'<?php'.$varObject->return;
		if($categoryLookUp):
			$defaultPHP[] = $varObject->tab2.'$item->'.$categoryField.' = $db->setQuery(\'SELECT #__categories.title FROM #__categories WHERE #__categories.id = "\'.$item->'.$categoryField.'.\'"\')->loadResult();'.$varObject->return;
		endif;
		$defaultPHP[] = $varObject->tab2.'if(empty($item->alias)){'.$varObject->return;
		
		$link = $formfields->name_safe[0];
		
		$defaultPHP[] = $varObject->tab3.'$item->alias = $item->'.$link.';'.$varObject->return;
		$defaultPHP[] = $varObject->tab2.'};'.$varObject->return;
		$defaultPHP[] = $varObject->tab2.'$item->alias = JFilterOutput::stringURLSafe($item->alias);'.$varObject->return;
		$defaultPHP[] = $varObject->tab2.'$item->linkURL = JRoute::_(\'index.php?option=com_'.$varObject->comp_m_view.'&view='.$view['singular']['safe'].'&id=\'.$item->id.\':\'.$item->alias);'.$varObject->return;
		$defaultPHP[] = $varObject->tab2.'?>'.$varObject->return;
		
		// Make sure there is formfields
		if($formfields->name):		
			// Parse through fields and just display them
			foreach($formfields->name as $key=>$field):
				$field			= strtolower($field);
				$field			= ucwords($field);
				$field_lower	= $formfields->name_safe[$key];
				if($varObject->imageUpload):
					$foundImage = false;
					if(is_array($varObject->imageFields[$view_count])){
						foreach($varObject->imageFields[$view_count] as $image_name):
							if($image_name['fieldnamesafe'] == $field_lower):
								$defaultPHP[] = $varObject->tab2.'<?php if($item->'.$field_lower.'){ ?>'.$varObject->return;
								$defaultPHP[] = $varObject->tab3.'<p><strong>'.$field.'</strong>: <img src="images/'.$varObject->com_main.'/thumb/<?php echo $item->'.$field_lower.'; ?>" /></p>'.$varObject->return;
								$defaultPHP[] = $varObject->tab2.'<?php } ?>'.$varObject->return;
								$foundImage = true;
							endif;
						endforeach;
					}
					
					if($foundImage == false):
						//check for first field and put at link on it.
						if($field_lower == $link):
							$defaultPHP[] = $varObject->tab2.'<p><strong>'.$field.'</strong>: <a href="<?php echo $item->linkURL; ?>"><?php echo $item->'.$field_lower.'; ?></a></p>'.$varObject->return;
						else:
							$defaultPHP[] = $varObject->tab2.'<p><strong>'.$field.'</strong>: <?php echo $item->'.$field_lower.'; ?></p>'.$varObject->return;
						endif;
					endif;
				else:
					//check for first field and put at link on it.
					if($field_lower == $link):
						$defaultPHP[] = $varObject->tab2.'<p><strong>'.$field.'</strong>: <a href="<?php echo $item->linkURL; ?>"><?php echo $item->'.$field_lower.'; ?></a></p>'.$varObject->return;
					else:
						$defaultPHP[] = $varObject->tab2.'<p><strong>'.$field.'</strong>: <?php echo $item->'.$field_lower.'; ?></p>'.$varObject->return;
					endif;
				endif;
			endforeach;
		endif;
		
		$defaultPHP[] = $varObject->tab2.'<p><strong>Link URL</strong>: <a href="<?php echo $item->linkURL; ?>">Go to page</a> - <?php echo $item->linkURL; ?></p>'.$varObject->return;
		$defaultPHP[] = $varObject->tab2.'<br /><br />'.$varObject->return;
		$defaultPHP[] = $varObject->tab1.'<?php }; ?>'.$varObject->return;
		$defaultPHP[] = '</div>'.$varObject->return;
		
		return $defaultPHP;
	}
	
	// plural view tmpl - default.xml
	public static function viewsViewPluralTmplDefaulXML($view, $varObject)
	{		
		$defaultXML[] = '<?xml version="1.0" encoding="utf-8" ?>'.$varObject->return;
		$defaultXML[] = '<metadata>'.$varObject->return;
		$defaultXML[] = $varObject->tab1.'<layout title="'.$varObject->com_language.'_'.$view['plural']['language'].'_VIEW_DEFAULT_TITLE">'.$varObject->return;
		$defaultXML[] = $varObject->tab2.'<message>'.$varObject->com_language.'_'.$view['plural']['language'].'_VIEW_DEFAULT_DESC</message>'.$varObject->return;
		$defaultXML[] = $varObject->tab1.'</layout>'.$varObject->return;
		$defaultXML[] = '</metadata>';
		
		return $defaultXML;
	}
	
	/**
	 *	SINGULAR VIEW - SITE
	 */
	 
	// singular model
	public static function modelsModelSingular($view, $varObject)
	{
		$filename = $view['singular']['safe'].'.php';
		$modelsModel[] = '<?php'.$varObject->return;
		$modelsModel[] = Helpers::phpheader($filename, $varObject);
		$modelsModel[] = Helpers::nodirectaccess($varObject);
		$modelsModel[] = '// import Joomla modelitem library'.$varObject->return;
		$modelsModel[] = 'jimport(\'joomla.application.component.modelitem\');'.$varObject->return;
		$modelsModel[] = $varObject->return;
		$modelsModel[] = '/**'.$varObject->return;
		$modelsModel[] = ' * '.$view['singular']['cap'].' Model for '.$varObject->comp_m_view_cap.' Component'.$varObject->return;
		$modelsModel[] = ' */'.$varObject->return;
		$modelsModel[] = 'class '.$varObject->comp_m_view_cap.'Model'.$view['singular']['safe'].' extends '.$varObject->j_model_item.$varObject->return;
		$modelsModel[] = '{'.$varObject->return;
		$modelsModel[] = $varObject->tab1.'/**'.$varObject->return;
		$modelsModel[] = $varObject->tab1.' * Model context string.'.$varObject->return;
		$modelsModel[] = $varObject->tab1.' *'.$varObject->return;
		$modelsModel[] = $varObject->tab1.' * @var		string'.$varObject->return;
		$modelsModel[] = $varObject->tab1.' */'.$varObject->return;
		$modelsModel[] = $varObject->tab1.'protected $_context = \''.$varObject->com_main.'.'.$view['singular']['safe'].'\';'.$varObject->return;
		$modelsModel[] = $varObject->return;
		$modelsModel[] = $varObject->tab1.'/**'.$varObject->return;
		$modelsModel[] = $varObject->tab1.' * Method to auto-populate the model state.'.$varObject->return;
		$modelsModel[] = $varObject->tab1.' *'.$varObject->return;
		$modelsModel[] = $varObject->tab1.' * Note. Calling getState in this method will result in recursion.'.$varObject->return;
		$modelsModel[] = $varObject->tab1.' *'.$varObject->return;
		$modelsModel[] = $varObject->tab1.' * @since	1.6'.$varObject->return;
		$modelsModel[] = $varObject->tab1.' */'.$varObject->return;
		$modelsModel[] = $varObject->tab1.'protected function populateState()'.$varObject->return;
		$modelsModel[] = $varObject->tab1.'{'.$varObject->return;
		$modelsModel[] = $varObject->tab2.'$app = JFactory::getApplication(\'site\');'.$varObject->return;
		$modelsModel[] = $varObject->return;
		$modelsModel[] = $varObject->tab2.'// Load state from the request.'.$varObject->return;
		$modelsModel[] = $varObject->tab2.'$pk = JRequest::getInt(\'id\');'.$varObject->return;
		$modelsModel[] = $varObject->tab2.'$this->setState(\''.$view['singular']['safe'].'.id\', $pk);'.$varObject->return;
		$modelsModel[] = $varObject->tab2.'// Load the parameters.'.$varObject->return;
		$modelsModel[] = $varObject->tab2.'$params = $app->getParams();'.$varObject->return;
		$modelsModel[] = $varObject->tab2.'$this->setState(\'params\', $params);'.$varObject->return;
		$modelsModel[] = $varObject->tab1.'}'.$varObject->return;
		$modelsModel[] = $varObject->return;
		$modelsModel[] = $varObject->tab1.'/**'.$varObject->return;
		$modelsModel[] = $varObject->tab1.' * Method to get '.$view['singular']['cap'].' data.'.$varObject->return;
		$modelsModel[] = $varObject->tab1.' *'.$varObject->return;
		$modelsModel[] = $varObject->tab1.' * @param	integer	The id of the '.$view['singular']['cap'].'.'.$varObject->return;
		$modelsModel[] = $varObject->tab1.' *'.$varObject->return;
		$modelsModel[] = $varObject->tab1.' * @return	mixed	Menu item data object on success, false on failure.'.$varObject->return;
		$modelsModel[] = $varObject->tab1.' */'.$varObject->return;
		$modelsModel[] = $varObject->tab1.'public function &getItem($pk = null)'.$varObject->return;
		$modelsModel[] = $varObject->tab1.'{'.$varObject->return;
		$modelsModel[] = $varObject->tab2.'// Initialise variables.'.$varObject->return;
		$modelsModel[] = $varObject->tab2.'$pk = (!empty($pk)) ? $pk : (int) $this->getState(\''.$view['singular']['safe'].'.id\');'.$varObject->return;
		$modelsModel[] = $varObject->tab2.'if ($this->_item === null) {'.$varObject->return;
		$modelsModel[] = $varObject->tab3.'$this->_item = array();'.$varObject->return;
		$modelsModel[] = $varObject->tab2.'}'.$varObject->return;
		$modelsModel[] = $varObject->tab2.'if (!isset($this->_item[$pk])) {'.$varObject->return;
		$modelsModel[] = $varObject->tab3.'try {'.$varObject->return;
		$modelsModel[] = $varObject->tab4.'$db = $this->getDbo();'.$varObject->return;
		$modelsModel[] = $varObject->tab4.'$query = $db->getQuery(true);'.$varObject->return;
		$modelsModel[] = $varObject->tab4.'$query->select(\'*\');'.$varObject->return;
		$modelsModel[] = $varObject->tab4.'$query->from(\'#__'.$varObject->comp_m_view.'_'.$view['singular']['safe'].'\');'.$varObject->return;
		$modelsModel[] = $varObject->tab4.'$query->where(\'id = "\'.$pk.\'"\');'.$varObject->return; // added 0.6.0
		$modelsModel[] = $varObject->tab4.'$db->setQuery($query);'.$varObject->return;
		$modelsModel[] = $varObject->tab4.'$data = $db->loadObject();'.$varObject->return;
		$modelsModel[] = $varObject->tab4.'$this->_item[$pk] = $data;'.$varObject->return;
		$modelsModel[] = $varObject->tab3.'}'.$varObject->return;
		$modelsModel[] = $varObject->tab3.'catch (JException $e)'.$varObject->return;
		$modelsModel[] = $varObject->tab3.'{'.$varObject->return;
		$modelsModel[] = $varObject->tab4.'if ($e->getCode() == 404) {'.$varObject->return;
		$modelsModel[] = $varObject->tab5.'// Need to go thru the error handler to allow Redirect to work.'.$varObject->return;
		$modelsModel[] = $varObject->tab5.'JError::raiseError(404, $e->getMessage());'.$varObject->return;
		$modelsModel[] = $varObject->tab4.'} else {'.$varObject->return;
		$modelsModel[] = $varObject->tab5.'$this->setError($e);'.$varObject->return;
		$modelsModel[] = $varObject->tab5.'$this->_item[$pk] = false;'.$varObject->return;
		$modelsModel[] = $varObject->tab4.'}'.$varObject->return;
		$modelsModel[] = $varObject->tab3.'}'.$varObject->return;
		$modelsModel[] = $varObject->tab2.'}'.$varObject->return;
		$modelsModel[] = $varObject->return;
		$modelsModel[] = $varObject->tab2.'return $this->_item[$pk];'.$varObject->return;
		$modelsModel[] = $varObject->tab1.'}'.$varObject->return;
		$modelsModel[] = '}'.$varObject->return;
		$modelsModel[] = '?>';
		
		return $modelsModel;
	}
	
	public static function viewsViewSingularViewHtml($formfields, $view, $varObject, $filename)
	{
		$categoryLookUp	= 0;
		$categoryField	= '';
		
		// Make sure there is formfields
		if($formfields->type):
			if(array_search("category", $formfields->type) && $varObject->includeCat):
				$categoryField	= array_search("category", $formfields->type);
				$categoryField	= strtolower($formfields->name_safe[$categoryField]);
				$categoryLookUp	= 1;
			endif;
		endif;
		
		$viewHTML[] = '<?php'.$varObject->return;
		$viewHTML[] = Helpers::phpheader($filename, $varObject);
		$viewHTML[] = Helpers::nodirectaccess($varObject);
		$viewHTML[] = $varObject->return;
		$viewHTML[] = '// import Joomla view library'.$varObject->return;
		$viewHTML[] = 'jimport(\'joomla.application.component.view\');'.$varObject->return;
		$viewHTML[] = $varObject->return;
		$viewHTML[] = '/**'.$varObject->return;
		$viewHTML[] = ' * HTML '.$view['singular']['cap'].' View class for the '.$varObject->comp_m_view_cap.' Component'.$varObject->return;
		$viewHTML[] = ' */'.$varObject->return;
		$viewHTML[] = 'class '.$varObject->comp_m_view_cap.'View'.$view['singular']['safe'].' extends '.$varObject->j_view.$varObject->return;
		$viewHTML[] = '{'.$varObject->return;
		$viewHTML[] = $varObject->tab1.'// Overwriting '.$varObject->j_view.' display method'.$varObject->return;
		$viewHTML[] = $varObject->tab1.'function display($tpl = null)'.$varObject->return;
		$viewHTML[] = $varObject->tab1.'{'.$varObject->return;
		$viewHTML[] = $varObject->tab2.'// Assign data to the view'.$varObject->return;
		$viewHTML[] = $varObject->tab2.'$this->item = $this->get(\'Item\');'.$varObject->return;
		if($categoryLookUp):
			$viewHTML[] = $varObject->tab2.'$db = JFactory::getDBO();'.$varObject->return;
			$viewHTML[] = $varObject->tab2.'$this->item->'.$categoryField.' = $db->setQuery(\'SELECT #__categories.title FROM #__categories WHERE #__categories.id = "\'.$this->item->'.$categoryField.'.\'"\')->loadResult();'.$varObject->return;
		endif;
		$viewHTML[] = $varObject->return;
		$viewHTML[] = $varObject->tab2.'// Check for errors.'.$varObject->return;
		$viewHTML[] = $varObject->tab2.'if (count($errors = $this->get(\'Errors\'))){'.$varObject->return;
		$viewHTML[] = $varObject->tab3.'JError::raiseError(500, implode(\'<br />\', $errors));'.$varObject->return;
		$viewHTML[] = $varObject->tab3.'return false;'.$varObject->return;
		$viewHTML[] = $varObject->tab2.'};'.$varObject->return;
		$viewHTML[] = $varObject->return;
		$viewHTML[] = $varObject->tab2.'// Display the view'.$varObject->return;
		$viewHTML[] = $varObject->tab2.'parent::display($tpl);'.$varObject->return;
		$viewHTML[] = $varObject->tab1.'}'.$varObject->return;
		$viewHTML[] = '}'.$varObject->return;
		$viewHTML[] = '?>';
		
		return $viewHTML;
	}
	
	public static function viewsViewSingularTmplDefaulPHP($formfields, $varObject, $filename, $view_count)
	{
		$defaultPHP[] = '<?php'.$varObject->return;
		$defaultPHP[] = Helpers::phpheader($filename, $varObject);
		$defaultPHP[] = Helpers::nodirectaccess($varObject);
		$defaultPHP[] = $varObject->return;
		$defaultPHP[] = '?>'.$varObject->return;
		$defaultPHP[] = '<div id="'.$varObject->comp_m_view.'-content">'.$varObject->return;
		// Make sure there is formfields
		if($formfields->name):
			// Parse through fields and just display them
			foreach($formfields->name as $key=>$field):
				$field			= strtolower($field);
				$field			= ucwords($field);
				$field_lower	= $formfields->name_safe[$key];
				if($varObject->imageUpload):
					$imageFound = false;
					if(is_array($varObject->imageFields[$view_count])){
						foreach($varObject->imageFields[$view_count] as $image_name):
							if($image_name['fieldnamesafe'] == $field_lower):
								$defaultPHP[] = $varObject->tab1.'<?php if($this->item->'.$field_lower.'){ ?>'.$varObject->return;
								$defaultPHP[] = $varObject->tab2.'<p><strong>'.$field.'</strong>: <img src="images/'.$varObject->com_main.'/<?php echo $this->item->'.$field_lower.'; ?>" /></p>'.$varObject->return;
								$defaultPHP[] = $varObject->tab1.'<?php } ?>'.$varObject->return;
								$imageFound = true;
							endif;
						endforeach;
					}
					
					if($imageFound == false):
						$defaultPHP[] = $varObject->tab1.'<p><strong>'.$field.'</strong>: <?php echo $this->item->'.$field_lower.'; ?></p>'.$varObject->return;
					endif;
				else:
					$defaultPHP[] = $varObject->tab1.'<p><strong>'.$field.'</strong>: <?php echo $this->item->'.$field_lower.'; ?></p>'.$varObject->return;
				endif;
			endforeach;
		endif;

		$defaultPHP[] = '</div>';
		
		return $defaultPHP;
	}
	
	public static function viewsViewSingularTmplDefaulXML($formfields, $view, $varObject, $view_count)
	{	
		$field = $formfields->name[0];
		$field = strtolower($field);
		$field = ucwords($field);
		// Only letters and numbers allowed
		$field_f = $formfields->name_safe[0];
		$field_lower = strtolower($field_f);
		$field_upper = strtoupper($field_lower);
		
		$defaultXML[] = '<?xml version="1.0" encoding="utf-8" ?>'.$varObject->return;
		$defaultXML[] = '<metadata>'.$varObject->return;
		$defaultXML[] = $varObject->tab1.'<layout title="'.$varObject->com_language.'_'.$view['singular']['language'].'_VIEW_DEFAULT_TITLE">'.$varObject->return;
		$defaultXML[] = $varObject->tab2.'<message>'.$varObject->com_language.'_'.$view['singular']['language'].'_VIEW_DEFAULT_DESC</message>'.$varObject->return;
		$defaultXML[] = $varObject->tab1.'</layout>'.$varObject->return;
		$defaultXML[] = $varObject->tab1.'<fields'.$varObject->return;
		$defaultXML[] = $varObject->tab2.'name="request"'.$varObject->return;
		$defaultXML[] = $varObject->tab2.'addfieldpath="/administrator/components/'.$varObject->com_main.'/models/fields"'.$varObject->return;
		$defaultXML[] = $varObject->tab1.'>'.$varObject->return;
		$defaultXML[] = $varObject->tab2.'<fieldset name="request">'.$varObject->return;
		$defaultXML[] = $varObject->tab3.'<field'.$varObject->return;
		$defaultXML[] = $varObject->tab4.'name="id"'.$varObject->return;
		$defaultXML[] = $varObject->tab4.'required="true"'.$varObject->return;
		$defaultXML[] = $varObject->tab4.'type="'.$varObject->comp_m_view.$view_count.'"'.$varObject->return;
		$defaultXML[] = $varObject->tab4.'label="'.$varObject->com_language.'_'.$view['singular']['language'].'_FIELD_'.$field_upper.'_LABEL"'.$varObject->return;
        $defaultXML[] = $varObject->tab4.'description="'.$varObject->com_language.'_'.$view['singular']['language'].'_FIELD_'.$field_upper.'_DESC"'.$varObject->return;
        $defaultXML[] = $varObject->tab3.'/>'.$varObject->return;
        $defaultXML[] = $varObject->tab2.'</fieldset>'.$varObject->return;
        $defaultXML[] = $varObject->tab1.'</fields>'.$varObject->return;
		$defaultXML[] = '</metadata>';
		
		return $defaultXML;		
	}
	
	/**
	 *	CATEGORY VIEW - SITE
	 */
	 
	// category model
	public static function modelsModelCat($view, $varObject)
	{
		$filename = $view['plural']['view_safe'].'category.php';
		$modelsModel[] = '<?php'.$varObject->return;
		$modelsModel[] = Helpers::phpheader($filename, $varObject);
		$modelsModel[] = Helpers::nodirectaccess($varObject);
		$modelsModel[] = '// import the Joomla modellist library'.$varObject->return;
		$modelsModel[] = 'jimport(\'joomla.application.component.modellist\');'.$varObject->return;
		$modelsModel[] = $varObject->return;
		$modelsModel[] = '/**'.$varObject->return;
		$modelsModel[] = ' * '.$view['plural']['view_cap'].' Cateory Model for '.$varObject->comp_m_view_cap.' Component'.$varObject->return;
		$modelsModel[] = ' */'.$varObject->return;
		$modelsModel[] = 'class '.$varObject->comp_m_view_cap.'Model'.$view['plural']['view_safe'].'category extends JModelList'.$varObject->return;
		$modelsModel[] = '{'.$varObject->return;
		$modelsModel[] = $varObject->tab1 . '/**'.$varObject->return;
		$modelsModel[] = $varObject->tab1 . ' * Method to build an SQL query to load the list data.'.$varObject->return;
		$modelsModel[] = $varObject->tab1 . ' *'.$varObject->return;
		$modelsModel[] = $varObject->tab1 . ' * @return      string  An SQL query'.$varObject->return;
		$modelsModel[] = $varObject->tab1 . ' */'.$varObject->return;
		$modelsModel[] = $varObject->tab1 . 'protected function getListQuery()'.$varObject->return;
		$modelsModel[] = $varObject->tab1 . '{'.$varObject->return;
		$modelsModel[] = $varObject->tab2 . '$pk = JRequest::getInt(\'id\');'.$varObject->return;
		$modelsModel[] = $varObject->return;
		$modelsModel[] = $varObject->tab2 . '// Create a new query object.'.$varObject->return;
		$modelsModel[] = $varObject->tab2 . '$db = JFactory::getDBO();'.$varObject->return;
		$modelsModel[] = $varObject->tab2 . '$query	= $db->getQuery(true);'.$varObject->return;
		$modelsModel[] = $varObject->tab2 . '// Select some fields'.$varObject->return;
		$modelsModel[] = $varObject->tab2 . '$query->select(\'*\');'.$varObject->return;
		$modelsModel[] = $varObject->tab2 . '// From the products_product table'.$varObject->return;
		$modelsModel[] = $varObject->tab2 . '$query->from(\'#__' . $varObject->comp_m_view . '_' . $view['singular']['view_safe'] . '\');'.$varObject->return;
		$modelsModel[] = $varObject->tab2 . '$query->where(\'category="\' . $pk . \'"\');'.$varObject->return;
		$modelsModel[] = $varObject->return;
		$modelsModel[] = $varObject->tab2 . 'return $query;'.$varObject->return;
		$modelsModel[] = $varObject->tab1 . '}'.$varObject->return;
		$modelsModel[] = '}'.$varObject->return;
		$modelsModel[] = '?>';
		
		return $modelsModel;
	}
	
	public static function viewsViewCatViewHtml($view, $varObject, $filename)
	{		
		$viewHTML[] = '<?php'.$varObject->return;
		$viewHTML[] = Helpers::phpheader($filename, $varObject);
		$viewHTML[] = Helpers::nodirectaccess($varObject);
		$viewHTML[] = $varObject->return;
		$viewHTML[] = '// import Joomla view library'.$varObject->return;
		$viewHTML[] = 'jimport(\'joomla.application.component.view\');'.$varObject->return;
		$viewHTML[] = $varObject->return;
		$viewHTML[] = '/**'.$varObject->return;
		$viewHTML[] = ' * HTML '.$view['plural']['view_cap'].' Category View class for the '.$varObject->comp_m_view_cap.' Component'.$varObject->return;
		$viewHTML[] = ' */'.$varObject->return;
		$viewHTML[] = 'class '.$varObject->comp_m_view_cap.'View'.$view['plural']['view_safe'].'category extends '.$varObject->j_view.$varObject->return;
		$viewHTML[] = '{'.$varObject->return;
		$viewHTML[] = $varObject->tab1.'// Overwriting '.$varObject->j_view.' display method'.$varObject->return;
		$viewHTML[] = $varObject->tab1.'function display($tpl = null)'.$varObject->return;
		$viewHTML[] = $varObject->tab1.'{'.$varObject->return;
		$viewHTML[] = $varObject->tab2.'// Assign data to the view'.$varObject->return;
		$viewHTML[] = $varObject->tab2.'$this->items = $this->get(\'Items\');'.$varObject->return;
		$viewHTML[] = $varObject->return;
		$viewHTML[] = $varObject->tab2.'// Check for errors.'.$varObject->return;
		$viewHTML[] = $varObject->tab2.'if (count($errors = $this->get(\'Errors\'))){'.$varObject->return;
		$viewHTML[] = $varObject->tab3.'JError::raiseError(500, implode(\'<br />\', $errors));'.$varObject->return;
		$viewHTML[] = $varObject->tab3.'return false;'.$varObject->return;
		$viewHTML[] = $varObject->tab2.'};'.$varObject->return;
		$viewHTML[] = $varObject->return;
		$viewHTML[] = $varObject->tab2.'// Display the view'.$varObject->return;
		$viewHTML[] = $varObject->tab2.'parent::display($tpl);'.$varObject->return;
		$viewHTML[] = $varObject->tab1.'}'.$varObject->return;
		$viewHTML[] = '}'.$varObject->return;
		$viewHTML[] = '?>';
		
		return $viewHTML;
	}
	
	public static function viewsViewCatTmplDefaulPHP($formfields, $varObject, $filename, $view_count)
	{	
		$defaultPHP[] = '<?php'.$varObject->return;
		$defaultPHP[] = Helpers::phpheader($filename, $varObject);
		$defaultPHP[] = Helpers::nodirectaccess($varObject);
		$defaultPHP[] = $varObject->return;
		$defaultPHP[] = '?>'.$varObject->return;
		$defaultPHP[] = '<h1 class="page-header"><?php echo $this->document->title; ?></h1>'.$varObject->return;
		$defaultPHP[] = '<div id="category-'.$varObject->comp_m_view.'-content">'.$varObject->return;
		$defaultPHP[] = '<?php foreach($this->items as $item){ ?>'.$varObject->return;
		// Make sure there is formfields
		if($formfields->name):
			// Parse through fields and just display them
			foreach($formfields->name as $key=>$field):
				$field			= strtolower($field);
				$field			= ucwords($field);
				$field_lower	= $formfields->name_safe[$key];
				$imageFound		= false;
				if($varObject->imageUpload):
					if(is_array($varObject->imageFields[$view_count])){
						foreach($varObject->imageFields[$view_count] as $image_name):
							if($image_name['fieldnamesafe'] == $field_lower):
								$defaultPHP[] = $varObject->tab1.'<?php if($item->'.$field_lower.'){ ?>'.$varObject->return;
								$defaultPHP[] = $varObject->tab2.'<p><strong>'.$field.'</strong>: <img src="images/'.$varObject->com_main.'/<?php echo $item->'.$field_lower.'; ?>" /></p>'.$varObject->return;
								$defaultPHP[] = $varObject->tab1.'<?php } ?>'.$varObject->return;
								$imageFound = true;
							endif;
						endforeach;
					}
				endif;
				
				if($imageFound == false):
					$defaultPHP[] = $varObject->tab1.'<p><strong>'.$field.'</strong>: <?php echo $item->'.$field_lower.'; ?></p>'.$varObject->return;
				endif;
			endforeach;
		endif;
		$defaultPHP[] = '<?php } ?>'.$varObject->return;
		$defaultPHP[] = '</div>';
		
		return $defaultPHP;
	}
	
	public static function viewsViewCatTmplDefaulXML($view, $varObject, $view_count_string)
	{	
		$defaultXML[] = '<?xml version="1.0" encoding="utf-8" ?>'.$varObject->return;
		$defaultXML[] = '<metadata>'.$varObject->return;
		$defaultXML[] = $varObject->tab1.'<layout title="'.$varObject->com_language.'_'.$view['plural']['view_lang'].'CATEGORY_VIEW_DEFAULT_TITLE">'.$varObject->return;
		$defaultXML[] = $varObject->tab2.'<message>'.$varObject->com_language.'_'.$view['plural']['view_lang'].'CATEGORY_VIEW_DEFAULT_DESC</message>'.$varObject->return;
		$defaultXML[] = $varObject->tab1.'</layout>'.$varObject->return;
		$defaultXML[] = $varObject->tab1.'<fields'.$varObject->return;
		$defaultXML[] = $varObject->tab2.'name="request"'.$varObject->return;
		$defaultXML[] = $varObject->tab2.'addfieldpath="/administrator/components/'.$varObject->com_main.'/models/fields"'.$varObject->return;
		$defaultXML[] = $varObject->tab1.'>'.$varObject->return;
		$defaultXML[] = $varObject->tab2.'<fieldset name="request">'.$varObject->return;
		$defaultXML[] = $varObject->tab3.'<field'.$varObject->return;
		$defaultXML[] = $varObject->tab4.'name="id"'.$varObject->return;
		$defaultXML[] = $varObject->tab4.'required="true"'.$varObject->return;
		$defaultXML[] = $varObject->tab4.'type="'.$varObject->comp_m_view.$view_count_string.'"'.$varObject->return;
		$defaultXML[] = $varObject->tab4.'label="'.$varObject->com_language.'_'.$view['plural']['view_lang'].'CATEGORY_FIELD_CATEGORY_LABEL"'.$varObject->return;
        $defaultXML[] = $varObject->tab4.'description="'.$varObject->com_language.'_'.$view['plural']['view_lang'].'CATEGORY_FIELD_CATEGORY_DESC"'.$varObject->return;
        $defaultXML[] = $varObject->tab3.'/>'.$varObject->return;
        $defaultXML[] = $varObject->tab2.'</fieldset>'.$varObject->return;
        $defaultXML[] = $varObject->tab1.'</fields>'.$varObject->return;
		$defaultXML[] = '</metadata>';
		
		return $defaultXML;		
	}
}
?>