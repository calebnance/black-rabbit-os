<?php
class ModuleHelper
{
	public static function phpheader($filename, $varObject)
	{
	 	// Header PHP File
		$phpheader  = '/*------------------------------------------------------------------------'.$varObject->return;
		$phpheader .= '# '.$filename.' - '.$varObject->name.' Module'.$varObject->return;
		$phpheader .= '# ------------------------------------------------------------------------'.$varObject->return;
		$phpheader .= '# author    '.$varObject->author.$varObject->return;
		if ($varObject->copyright){
		$phpheader .= '# copyright '.$varObject->copyright.$varObject->return;
		}
		if ($varObject->license){
		$phpheader .= '# license   '.$varObject->license.$varObject->return;
		}
		if ($varObject->author_url){
		$phpheader .= '# website   '.$varObject->author_url.$varObject->return;
		}
		$phpheader .= '-------------------------------------------------------------------------*/'.$varObject->return;
		$phpheader .= ''.$varObject->return;

		return $phpheader;
	}

	public static function nodirectaccess($varObject)
	{
		$nodirectaccess  = '// No direct access to this file'.$varObject->return;
		$nodirectaccess .= 'defined(\'_JEXEC\') or die(\'Restricted access\');'.$varObject->return;

		return $nodirectaccess;
	}

	public static function modulefile($varObject){
		$modulefile		= array();
		$modulefile[]	= '<?php'.$varObject->return;
		$modulefile[]	= ModuleHelper::phpheader('mod_' . $varObject->filename . '.php', $varObject);
		$modulefile[]	= ModuleHelper::nodirectaccess($varObject);
		$modulefile[]	= $varObject->return;
		$modulefile[]	= '// Include the syndicate functions only once'.$varObject->return;
		if ($varObject->jversion == '3.0'){
			$modulefile[]	= 'require_once __DIR__ . \'/helper.php\';'.$varObject->return;
		} else {
			$modulefile[]	= 'require_once( dirname(__FILE__).DS.\'helper.php\' );'.$varObject->return;
		}
		$modulefile[]	= $varObject->return;
		$modulefile[]	= 'require(JModuleHelper::getLayoutPath(\'mod_'.$varObject->filename.'\'));'.$varObject->return;
		$modulefile[]	= '?>';

		return $modulefile;
	}

	public static function modulexml($varObject){
		$xml	= array();
		$xml[]	= '<?xml version="1.0" encoding="utf-8"?>'.$varObject->return;
		$xml[]	= '<extension type="module" version="' . $varObject->jversion . '" client="site" method="upgrade">'.$varObject->return;
		$xml[]	= $varObject->tab1.'<name>' . $varObject->name . '</name>'.$varObject->return;
		$xml[]	= $varObject->tab1.'<author>' . $varObject->author . '</author>'.$varObject->return;
		$xml[]	= $varObject->tab1.'<version>' . $varObject->version . '</version>'.$varObject->return;
		$xml[]	= $varObject->tab1.'<description>' . $varObject->description . '</description>'.$varObject->return;
		$xml[]	= $varObject->tab1.'<files>'.$varObject->return;
		$xml[]	= $varObject->tab2.'<filename>mod_' . $varObject->filename . '.xml</filename>'.$varObject->return;
		$xml[]	= $varObject->tab2.'<filename module="mod_' . $varObject->filename . '">mod_' . $varObject->filename . '.php</filename>'.$varObject->return;
		$xml[]	= $varObject->tab2.'<filename>index.html</filename>'.$varObject->return;
		$xml[]	= $varObject->tab2.'<filename>helper.php</filename>'.$varObject->return;
		$xml[]	= $varObject->tab2.'<folder>tmpl</folder>'.$varObject->return;
		$xml[]	= $varObject->tab1.'</files>'.$varObject->return;
		$xml[]	= $varObject->tab1.'<config>'.$varObject->return;
		$xml[]	= $varObject->tab1.'</config>'.$varObject->return;
		$xml[]	= '</extension>';

		return $xml;
 	}

 	public static function helperfile($varObject){

	 	$helper		= array();
	 	$helper[]	= '<?php'.$varObject->return;
		$helper[]	= ModuleHelper::phpheader('helper.php', $varObject);
		$helper[]	= ModuleHelper::nodirectaccess($varObject);
		$helper[]	= $varObject->return;
	 	$helper[]	= '/*'.$varObject->return;
	 	$helper[]	= ' *	' . ucwords($varObject->name) . ' Helper Class'.$varObject->return;
	 	$helper[]	= ' */'.$varObject->return;
	 	$helper[]	= 'class mod' . $varObject->filename . 'Helper {'.$varObject->return;
	 	$helper[]	= $varObject->return;
	 	$helper[]	= '}'.$varObject->return;
	 	$helper[]	= '?>';

	 	return $helper;
 	}

 	public static function defaultfile($varObject){
	 	$default	= array();
	 	$default[]	= '<?php'.$varObject->return;
		$default[]	= ModuleHelper::phpheader('default.php', $varObject);
		$default[]	= ModuleHelper::nodirectaccess($varObject);
		$default[]	= '?>';

		return $default;
 	}
}
