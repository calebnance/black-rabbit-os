<?php
class Files
{
	// index.html
	public static function indexFile()
	{
		return '<html><body bgcolor="#FFFFFF"></body></html>';
	}

	// install.xml (component name)
	public static function installFile($varObject)
	{
		$install[] = '<?xml version="1.0" encoding="utf-8"?>'.$varObject->return;
		$install[] = '<extension type="component" version="'.$varObject->j_version.'" method="upgrade">'.$varObject->return;
		$install[] = $varObject->tab1.'<name>'.$varObject->com_language.'</name>'.$varObject->return;
		$install[] = $varObject->tab1.'<creationDate>'.$varObject->created.'</creationDate>'.$varObject->return;
		$install[] = $varObject->tab1.'<author>'.$varObject->author.'</author>'.$varObject->return;
		$install[] = $varObject->tab1.'<authorEmail>'.$varObject->a_email.'</authorEmail>'.$varObject->return;
		$install[] = $varObject->tab1.'<authorUrl>'.$varObject->a_url.'</authorUrl>'.$varObject->return;
		$install[] = $varObject->tab1.'<copyright>'.$varObject->copyright.'</copyright>'.$varObject->return;
		$install[] = $varObject->tab1.'<license>'.$varObject->license.'</license>'.$varObject->return;
		$install[] = $varObject->tab1.'<version>'.$varObject->version.'</version>'.$varObject->return;
		$install[] = $varObject->tab1.'<description><![CDATA['.$varObject->return;
		$install[] = $varObject->tab2.'<h1>'.$varObject->comp_name.' (v.'.$varObject->version.')</h1>'.$varObject->return;
		$install[] = $varObject->tab2.'<div style="clear: both;"></div>'.$varObject->return;
		$install[] = $varObject->tab2.'<p>'.$varObject->description.'. <strong>Built for Joomla '.$varObject->j_version.'.</strong></p>'.$varObject->return;
		$install[] = $varObject->tab2.'<p>Created by <a href="http://'.$varObject->a_url.'" target="_blank">'.$varObject->author.' | '.$varObject->a_url.'</a>'.$varObject->return;
		$install[] = $varObject->tab1.']]></description>'.$varObject->return;
		$install[] = $varObject->return;

		// start - added v.0.6.0
		if ($varObject->useDatabase):
			// Install Section - Joomla 1.5/2.5/3.0
			$install[] = $varObject->tab1.'<!-- Runs on install; New in Joomla 1.5 -->'.$varObject->return;
			$install[] = $varObject->tab1.'<install>'.$varObject->return;
			$install[] = $varObject->tab2.'<sql>'.$varObject->return;
			$install[] = $varObject->tab3.'<file driver="mysql" charset="utf8">sql/install.mysql.utf8.sql</file>'.$varObject->return;
			$install[] = $varObject->tab2.'</sql>'.$varObject->return;
			$install[] = $varObject->tab1.'</install>'.$varObject->return;
			$install[] = $varObject->return;
			$install[] = $varObject->tab1.'<!-- Runs on uninstall; New in Joomla 1.5 -->'.$varObject->return;
			$install[] = $varObject->tab1.'<uninstall>'.$varObject->return;
			$install[] = $varObject->tab2.'<sql>'.$varObject->return;
			$install[] = $varObject->tab3.'<file driver="mysql" charset="utf8">sql/uninstall.mysql.utf8.sql</file>'.$varObject->return;
			$install[] = $varObject->tab2.'</sql>'.$varObject->return;
			$install[] = $varObject->tab1.'</uninstall>'.$varObject->return;
			$install[] = $varObject->return;
		endif;

		// Script Section - Joomla 2.5 / 3.0
		$install[] = $varObject->tab1.'<!-- Runs on install/uninstall/update; New in Joomla 2.5 -->'.$varObject->return;
		$install[] = $varObject->tab1.'<scriptfile>script.php</scriptfile>'.$varObject->return;
		$install[] = $varObject->return;

		// start - added v.0.6.0
		if ($varObject->useDatabase):
			// Update Section - Joomla 2.5 / 3.0
			$install[] = $varObject->tab1.'<!-- Update Schema; New in Joomla 2.5 -->'.$varObject->return;
			$install[] = $varObject->tab1.'<update>'.$varObject->return;
			$install[] = $varObject->tab2.'<schemas>'.$varObject->return;
			$install[] = $varObject->tab3.'<schemapath type="mysql">sql/updates/mysql/</schemapath>'.$varObject->return;
			$install[] = $varObject->tab2.'</schemas>'.$varObject->return;
			$install[] = $varObject->tab1.'</update>'.$varObject->return;
			$install[] = $varObject->return;
		endif;
		// end - added v.0.6.0

		// Site Files Section
		$install[] = $varObject->tab1.'<files folder="site">'.$varObject->return;
		$install[] = $varObject->tab2.'<filename>controller.php</filename>'.$varObject->return;
		$install[] = $varObject->tab2.'<filename>index.html</filename>'.$varObject->return;
		$install[] = $varObject->tab2.'<filename>router.php</filename>'.$varObject->return; // added v.0.6.0
		$install[] = $varObject->tab2.'<filename>'.$varObject->comp_m_view.'.php</filename>'.$varObject->return;
		//$lines[] = $varObject->tab2.'<folder>controllers</folder>'.$varObject->return;
		$install[] = $varObject->tab2.'<folder>assets</folder>'.$varObject->return;
		$install[] = $varObject->tab2.'<folder>helpers</folder>'.$varObject->return;
		$install[] = $varObject->tab2.'<folder>models</folder>'.$varObject->return;
		$install[] = $varObject->tab2.'<folder>views</folder>'.$varObject->return;
		$install[] = $varObject->tab1.'</files>'.$varObject->return;

		// Administrator Files Section
		$install[] = $varObject->tab1.'<administration>'.$varObject->return;

		// start - added v.0.6.0
		$main_view_image = '';
		if ($varObject->imagesUploaded[$varObject->comp_m_view]):
			//<menu img="../media/com_helloworld/images/tux-16x16.png">COM_HELLOWORLD_MENU</menu>
			$main_view_image = ' img="components/'.$varObject->com_main.'/assets/images/icons/'.$varObject->imagesUploaded[$varObject->comp_m_view]->menu.'"';
		endif;
		// end - added v.0.6.0

		$install[]	= $varObject->tab2.'<menu'.$main_view_image.'>'.$varObject->com_language_menu.'</menu>'.$varObject->return;

		// handle submenu if other views are set!
		$imageIndex	= 1;
		if (count($varObject->allViews)):
			$install[] = $varObject->tab2.'<submenu>'.$varObject->return;
			$install[] = $varObject->tab3.'<!-- Instead of link you can specify individual link attributes -->'.$varObject->return;
			foreach($varObject->allViews as $view):
				// start - added v.0.6.0
				$view_image = '';
				if ($varObject->imagesUploaded[$view['plural']['orig']]):
					$view_image = ' img="components/'.$varObject->com_main.'/assets/images/icons/'.$varObject->imagesUploaded[$view['plural']['orig']]->menu.'"';
				endif;
				// end - added v.0.6.0
				$install[] = $varObject->tab3.'<menu option="'.$varObject->com_main.'" view="'.$view['plural']['safe'].'"'.$view_image.'>'.$varObject->com_language_menu.'_'.$view['plural']['language'].'</menu>'.$varObject->return; // added v.0.6.0
			endforeach;
			// Check for include of categories
			if ($varObject->includeCat):
				$install[] = $varObject->tab3.'<menu link="option=com_categories&amp;extension='.$varObject->com_main.'">'.$varObject->com_language_menu.'_MENU_CATEGORIES</menu>'.$varObject->return;
			endif;
			$install[] = $varObject->tab2.'</submenu>'.$varObject->return;
		endif;
		$install[] = $varObject->tab2.'<files folder="admin">'.$varObject->return;
		$install[] = $varObject->tab3.'<filename>access.xml</filename>'.$varObject->return;
		$install[] = $varObject->tab3.'<filename>config.xml</filename>'.$varObject->return;
		$install[] = $varObject->tab3.'<filename>controller.php</filename>'.$varObject->return;
		$install[] = $varObject->tab3.'<filename>index.html</filename>'.$varObject->return;
		$install[] = $varObject->tab3.'<filename>'.$varObject->comp_m_view.'.php</filename>'.$varObject->return;
		$install[] = $varObject->tab3.'<folder>assets</folder>'.$varObject->return;
		$install[] = $varObject->tab3.'<folder>controllers</folder>'.$varObject->return;
		$install[] = $varObject->tab3.'<folder>helpers</folder>'.$varObject->return;
		$install[] = $varObject->tab3.'<folder>models</folder>'.$varObject->return;

		// start - added v.0.6.0
		if ($varObject->useDatabase):
			$install[] = $varObject->tab3.'<folder>sql</folder>'.$varObject->return;
			$install[] = $varObject->tab3.'<folder>tables</folder>'.$varObject->return;
		endif;
		// end - added v.0.6.0

		$install[] = $varObject->tab3.'<folder>views</folder>'.$varObject->return;
		$install[] = $varObject->tab2.'</files>'.$varObject->return;
		$install[] = $varObject->return;
		$install[] = $varObject->tab2.'<languages folder="admin">'.$varObject->return;
		$install[] = $varObject->tab3.'<language tag="en-GB">language/en-GB/en-GB.'.$varObject->com_main.'.ini</language>'.$varObject->return;
		$install[] = $varObject->tab3.'<language tag="en-GB">language/en-GB/en-GB.'.$varObject->com_main.'.sys.ini</language>'.$varObject->return;
		$install[] = $varObject->tab2.'</languages>'.$varObject->return;
		$install[] = $varObject->return;
		$install[] = $varObject->tab1.'</administration>'.$varObject->return;

		// Finish it up
		$install[] = '</extension>';

		return $install;
	}

	// script.php
	public static function scriptFile($varObject, $filename)
	{
		$script[] = '<?php'.$varObject->return;
		$script[] = Helpers::phpheader($filename, $varObject);
		$script[] = Helpers::nodirectaccess($varObject);
		$script[] = $varObject->return;
		$script[] = 'jimport(\'joomla.installer.installer\');'.$varObject->return; // added v.0.6.0
		$script[] = 'jimport(\'joomla.installer.helper\');'.$varObject->return; // added v.0.6.0
		$script[] = $varObject->return;
		$script[] = '/**'.$varObject->return;
		$script[] = ' * Script file of '.$varObject->comp_name.' component'.$varObject->return;
		$script[] = ' */'.$varObject->return;
		$script[] = 'class '.$varObject->com_main.'InstallerScript'.$varObject->return;
		$script[] = '{'.$varObject->return;
		$script[] = $varObject->tab1.'/**'.$varObject->return;
		$script[] = $varObject->tab1.' * method to install the component'.$varObject->return;
		$script[] = $varObject->tab1.' *'.$varObject->return;
		$script[] = $varObject->tab1.' *'.$varObject->return;
		$script[] = $varObject->tab1.' * @return void'.$varObject->return;
		$script[] = $varObject->tab1.' */'.$varObject->return;
		$script[] = $varObject->tab1.'function install($parent)'.$varObject->return;
		$script[] = $varObject->tab1.'{'.$varObject->return;
		$script[] = $varObject->return;
		$script[] = $varObject->tab1.'}'.$varObject->return;
		$script[] = $varObject->return;
		$script[] = $varObject->tab1.'/**'.$varObject->return;
		$script[] = $varObject->tab1.' * method to uninstall the component'.$varObject->return;
		$script[] = $varObject->tab1.' *'.$varObject->return;
		$script[] = $varObject->tab1.' * @return void'.$varObject->return;
		$script[] = $varObject->tab1.' */'.$varObject->return;
		$script[] = $varObject->tab1.'function uninstall($parent)'.$varObject->return;
		$script[] = $varObject->tab1.'{'.$varObject->return;
		$script[] = $varObject->return;
		$script[] = $varObject->tab1.'}'.$varObject->return;
		$script[] = $varObject->return;
		$script[] = $varObject->tab1.'/**'.$varObject->return;
		$script[] = $varObject->tab1.' * method to update the component'.$varObject->return;
		$script[] = $varObject->tab1.' *'.$varObject->return;
		$script[] = $varObject->tab1.' * @return void'.$varObject->return;
		$script[] = $varObject->tab1.' */'.$varObject->return;
		$script[] = $varObject->tab1.'function update($parent)'.$varObject->return;
		$script[] = $varObject->tab1.'{'.$varObject->return;
		$script[] = $varObject->return;
		$script[] = $varObject->tab1.'}'.$varObject->return;
		$script[] = $varObject->return;
		$script[] = $varObject->tab1.'/**'.$varObject->return;
		$script[] = $varObject->tab1.' * method to run before an install/update/uninstall method'.$varObject->return;
		$script[] = $varObject->tab1.' *'.$varObject->return;
		$script[] = $varObject->tab1.' * @return void'.$varObject->return;
		$script[] = $varObject->tab1.' */'.$varObject->return;
		$script[] = $varObject->tab1.'function preflight($type, $parent)'.$varObject->return;
		$script[] = $varObject->tab1.'{'.$varObject->return;
		$script[] = $varObject->return;
		$script[] = $varObject->tab1.'}'.$varObject->return;
		$script[] = $varObject->return;
		$script[] = $varObject->tab1.'/**'.$varObject->return;
		$script[] = $varObject->tab1.' * method to run after an install/update/uninstall method'.$varObject->return;
		$script[] = $varObject->tab1.' *'.$varObject->return;
		$script[] = $varObject->tab1.' * @return void'.$varObject->return;
		$script[] = $varObject->tab1.' */'.$varObject->return;
		$script[] = $varObject->tab1.'function postflight($type, $parent)'.$varObject->return;
		$script[] = $varObject->tab1.'{'.$varObject->return;
		$script[] = $varObject->return;
		$script[] = $varObject->tab1.'}'.$varObject->return;
		$script[] = '}'.$varObject->return;
		$script[] = '?>';

		return $script;
	}

}
