<?php
class Helpers
{
 	public static function phpheader($filename, $varObject)
 	{
	 	// Header PHP File
		$phpheader  = '/*------------------------------------------------------------------------'.$varObject->return;
		$phpheader .= '# '.$filename.' - '.$varObject->comp_name.' Component'.$varObject->return;
		$phpheader .= '# ------------------------------------------------------------------------'.$varObject->return;
		$phpheader .= '# author    '.$varObject->author.$varObject->return;
		$phpheader .= '# copyright '.$varObject->copyright.$varObject->return;
		$phpheader .= '# license   '.$varObject->license.$varObject->return;
		$phpheader .= '# website   '.$varObject->a_url.$varObject->return;
		$phpheader .= '-------------------------------------------------------------------------*/'.$varObject->return;
		$phpheader .= ''.$varObject->return;

		return $phpheader;
 	}

 	public static function nodirectaccess($varObject)
 	{
 		$nodirectaccess = "// No direct access to this file".$varObject->return;
 		$nodirectaccess .= "defined('_JEXEC') or die('Restricted access');".$varObject->return;

 		return $nodirectaccess;
 	}

 	public static function numtonumtext($number){
 		$text = array(
 			'zero',
 			'one',
 			'two',
 			'three',
 			'four',
 			'five',
 			'six',
 			'seven',
 			'eight',
 			'nine',
 			'ten',
 			'eleven',
 			'twelve',
 			'thirteen',
 			'fourteen',
 			'fifteen',
 			'sixteen',
 			'seventeen',
 			'eighteen',
 			'nineteen',
 			'twenty',
 			'twentyone',
 			'twentytwo',
 			'twentythree',
 			'twentyfour',
 			'twentyfive',
 			'twentysix',
 			'twentyseven',
 			'twentyeight',
 			'twentynine',
 			'thirtyone',
 			'thirtytwo',
 			'thirtythree',
 			'thirtyfour',
 			'thirtyfive',
 			'thirtysix',
 			'thirtyseven',
 			'thirtyeight',
 			'thirtynine',
 			'forty',
 			'fortyone',
 			'fortytwo',
 			'fortythree',
 			'fortyfour',
 			'fortyfive',
 			'fortysix',
 			'fortyseven',
 			'fortyeight',
 			'fortynine',
 			'fifty',
 		);

 		if (array_key_exists($number, $text)) {
 			$return = $text[$number];
 		} else {
 			$characters = 'abcdefghijklmnopqrstuvwxyz';
 			$randomString = '';
 			for ($i = 0; $i < 5; $i++) {
 				$randomString .= $characters[rand(0, strlen($characters) - 1)];
 			}

 			// random
 			$return = $randomString;
 		}

	 	return $return;
 	}
}
