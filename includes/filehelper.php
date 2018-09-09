<?php
/**
 *
 *
 */
class FileHelper
{
 	public static function filecheck($file)
 	{
 		// check to make sure we want to create, not in test mode
 		if(CREATE_PACKAGE):
	 		if (!file_exists($file)):
				fopen($file, 'w') or die('can\'t open file');
				//fclose($file);
			endif;
		endif;
 	}

 	public static function foldercheck($folder)
 	{
 		// check to make sure we want to create, not in test mode
 		if(CREATE_PACKAGE):
		 	if (!file_exists($folder)):
				mkdir($folder, 0700);
			endif;
		endif;
 	}

 	public static function createFile($filepath, $lines)
 	{
 		$line_count = 0;

 		// check to make sure we want to create, not in test mode
 		if(CREATE_PACKAGE):
	 		FileHelper::filecheck($filepath);

	 		$filepath = fopen($filepath, 'w+') or die('can\'t open file');
	 		if($lines):
				foreach($lines as $line):
					fwrite($filepath, $line);
					$line_count++;
				endforeach;
			endif;
			fclose($filepath);
		else:
			foreach($lines as $line):
				$line_count++;
			endforeach;
		endif;


		return $line_count;
 	}

 	public static function copyToLocation($original, $dest){
 		copy($original, $dest);
 	}

 	/*
 	 *	creates a compressed zip file
 	 *	author	- David Walsh
 	 *	url		- http://davidwalsh.name/create-zip-php
 	 */
 	public static function createZip($files = array(), $destination = '', $overwrite = false, $base)
 	{
 		$filesreturn = array();
 		//if the zip file already exists and overwrite is false, return false
 		if(file_exists($destination) && !$overwrite) { return false; }
 		//vars
 		$valid_files = array();
 		//if files were passed in...
 		if(is_array($files)) {
 			//cycle through each file
 			foreach($files as $file) {
 				if(CREATE_PACKAGE):
	 				//make sure the file exists
	 				if(file_exists($file)):
	 					$valid_files[] = $file;
	 				endif;
	 			else:
	 				$valid_files[] = $file;
	 			endif;
 			}
 		}
 		//if we have good files...
 		if(count($valid_files)) {
 			//create the archive
 			$zip = new ZipArchive();
 			if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) { return false; }
 			//add the files
 			foreach($valid_files as $file) {
 				$local = str_replace($base, '', $file);
 				$filesreturn[] = $local;
 				// check to make sure we want to create, not in test mode
 				if(CREATE_PACKAGE):
 					$zip->addFile($file,$local);
 				endif;
 			}
 			//debug
 			//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
 			//close the zip -- done!
 			$zip->close();
 			//check to make sure the file exists
 			//return file_exists($destination);
 			return $filesreturn;
 		}
 		else
 		{
 			return false;
 		}
 	}

 	public static function formatBytes($a_bytes)
 	{
 		if ($a_bytes < 1024):
 			return $a_bytes .' B';
 		elseif ($a_bytes < 1048576):
 			return round($a_bytes / 1024, 2) .' KB';
 		elseif ($a_bytes < 1073741824):
 			return round($a_bytes / 1048576, 2) . ' MB';
 		elseif ($a_bytes < 1099511627776):
 			return round($a_bytes / 1073741824, 2) . ' GB';
 		endif;
 	}

 	public static function dir_is_empty($dir) {
 		if (!is_readable($dir)) return NULL;

 		return (count(scandir($dir)) == 2);
 	}

 	public static function deleteDir($dirpath)
 	{
 		if (substr($dirpath, strlen($dirpath) - 1, 1) != '/'):
 			$dirpath .= '/';
 		endif;
 		$filestodelete = glob($dirpath . '*', GLOB_MARK);
 		foreach ($filestodelete as $filetodelete):
 			if (is_dir($filetodelete)):
 				self::deleteDir($filetodelete);
 			else:
 				unlink($filetodelete);
 			endif;
 		endforeach;

 		// Delete directory if empty
 		if (FileHelper::dir_is_empty($dirpath)):
	 		rmdir($dirpath);
	 	else:
	 		//echo 'Not empty';
	 	endif;
 	}

 	//start - added v.0.6.0
 	public static function safeString($string)
 	{
	 	$string = strtolower($string);
		$string = str_replace(' ', '', $string);
		$string = str_replace('-', '', $string);
		$string = str_replace('_', '', $string);
		$string = str_replace('@', '', $string);	// added v.0.6.0
		$string = str_replace('&', '', $string);	// added v.0.6.0
		$string = str_replace('!', '', $string);	// added v.0.6.0
		$string = str_replace('.', '', $string);	// added v.0.6.0
		$string = str_replace(',', '', $string);	// added v.0.6.0
		$string = str_replace('[', '', $string);	// added v.0.6.0
		$string = str_replace(']', '', $string);	// added v.0.6.0
		$string = str_replace(';', '', $string);	// added v.0.6.0
		$string = str_replace(':', '', $string);	// added v.0.6.0
		$string = str_replace('#', '', $string);	// added v.0.6.0
		$string = str_replace('$', '', $string);	// added v.0.6.0
		$string = str_replace('^', '', $string);	// added v.0.6.0
		$string = str_replace('%', '', $string);	// added v.0.6.0
		$string = str_replace('(', '', $string);	// added v.0.6.0
		$string = str_replace(')', '', $string);	// added v.0.6.0
		$string = str_replace('{', '', $string);	// added v.0.6.0
		$string = str_replace('}', '', $string);	// added v.0.6.0
		$string = str_replace('+', '', $string);	// added v.0.6.0
		$string = str_replace('=', '', $string);	// added v.0.6.0
		$string = str_replace('?', '', $string);	// added v.0.6.0
		$string = str_replace('/', '', $string);	// added v.0.6.0
		$string = str_replace('"', '', $string);	// added v.0.6.0
		$string = str_replace('<', '', $string);	// added v.0.6.0
		$string = str_replace('>', '', $string);	// added v.0.6.0
		$string = str_replace('|', '', $string);	// added v.0.6.0
		$string = str_replace('~', '', $string);	// added v.0.6.0
		$string = str_replace('`', '', $string);	// added v.0.6.0
		$string = str_replace('\'', '', $string);	// added v.0.6.0

	 	return $string;
 	}
 	//end - added v.0.6.0

 	public static function onlyVersion($version){
	 	$verion = preg_replace("/[^0-9.]/", "", $version);

	 	return $verion;
 	}

 	public static function preventInjection($string){
 		// OR
 		$string = str_replace(' OR ', ' ', $string);
 		$string = str_replace(' Or ', ' ', $string);
 		$string = str_replace(' oR ', ' ', $string);
 		// LIKE
	 	$string = str_replace(' LIKE ', ' ', $string);
	 	$string = str_replace(' Like ', ' ', $string);
	 	$string = str_replace(' LIke ', ' ', $string);
	 	$string = str_replace(' LIKe ', ' ', $string);
	 	$string = str_replace(' lIKE ', ' ', $string);
	 	$string = str_replace(' liKE ', ' ', $string);
	 	$string = str_replace(' LikE ', ' ', $string);
	 	$string = str_replace(' LIke ', ' ', $string);
	 	// ALL
	 	$string = str_replace(' * ', ' ', $string);
	 	// AND
	 	$string = str_replace(' AND ', ' ', $string);
	 	$string = str_replace(' And ', ' ', $string);
	 	$string = str_replace(' aNd ', ' ', $string);
	 	$string = str_replace(' anD ', ' ', $string);
	 	$string = str_replace(' AnD ', ' ', $string);
	 	$string = str_replace(' ANd ', ' ', $string);
	 	$string = str_replace(' aND ', ' ', $string);
	 	// ON
	 	$string = str_replace(' ON ', ' ', $string);
	 	$string = str_replace(' On ', ' ', $string);
	 	$string = str_replace(' oN ', ' ', $string);

	 	// clear double spaces
	 	$string = str_replace('  ', ' ', $string);

	 	return $string;
 	}

    /*
    NO LONGER NEEDED
 	public static function br_encrypt($text)
	{
		return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $salt, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
	}

	public static function br_decrypt($text)
	{
		return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $salt, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
	}
    */

	public static function startsession($user_info)
	{
		session_start();
		$_SESSION['loggedin']	= 1;
		$_SESSION['uid']		= $user_info[0]['id'];
		$_SESSION['fname']		= $user_info[0]['fname'];
		$_SESSION['lname']		= $user_info[0]['lname'];
		$_SESSION['email']		= $user_info[0]['email'];
		$_SESSION['emailv']		= $user_info[0]['email_validated'];
		$_SESSION['paid']		= $user_info[0]['paypal_payment_status'];
		$_SESSION['timeout']	= time();

		// connect to database
		$database	= new Database(HOST, DBNAME, DBUSER, DBPASS);
		$date = date('Y-m-d H:i:s');
		$user = array();
		// stamp if this is the first time logging in
		if($user_info[0]['date_logged_in'] == '0000-00-00 00:00:00'):
			$user['date_logged_in'] = $date;
		endif;
		$user['date_last_logged_in'] = $date;
		$database->update('br_users', $user, 'id='.$user_info[0]['id']);

		// if they have a language already set, lets use it!
		if(!empty($user_info[0]['language'])):
			$_SESSION['language']	= $user_info[0]['language'];
		endif;

		FileHelper::timeoutsession();
	}

	public static function checksession()
	{
		session_start();
		if($_SESSION['loggedin'] == 1):
			FileHelper::timeoutsession();
		endif;
	}

	public static function timeoutsession()
	{
		session_start();
		if ($_SESSION['timeout'] + 120 * 60 < time()): // 2 hours of inactive time
			session_destroy();

			header('Location: index.php?msg=8');
		else:
			$_SESSION['timeout']	= time();
		endif;
	}

	public static function endsession()
	{
		session_start();
		session_destroy();

		header('Location: index.php?msg=6');
	}

	public static function languagesession($language, $return_url){
		$_SESSION['language'] = $language;

		// Check if they are logged in
		if(isset($_SESSION['loggedin'])):
			// Make sure we have an id to work with
			if(isset($_SESSION['uid'])):
				// Connect to database
				$database = new Database(HOST, DBNAME, DBUSER, DBPASS);
				// Get user information for add or update
				$user_info = $database->select('br_users', '*', 'id="'.$_SESSION['uid'].'"', 'object');
				// if empty
				if(empty($user_info[0]->language) || $user_info[0]->language != $language):
					$data = array(
						'language' => $language
					);
					$database->update('br_users', $data, 'id="'.$_SESSION['uid'].'"');
				endif;
			endif;
		endif;
		// Return to page they were at with new language
		header('Location: ' . $return_url);
	}

	public static function curl_request($url, $vars){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		//$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		return $response;
	}

	public static function sendEmail($to, $from, $subject, $msg, $to_notify = '', $subject_notify = '', $msg_notify = '')
	{
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		//$headers .= 'To: '.$to.'' . "\r\n";
		$headers .= 'From: Black Rabbit <'.$from.'>' . "\r\n";

		// Send mail
		mail($to, $subject, $msg, $headers);

		if($to_notify){
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			//$headers .= 'To: '.$to_notify.'' . "\r\n";
			$headers .= 'From: Black Rabbit <'.$from.'>' . "\r\n";
			// Send mail
			mail($to_notify, $subject_notify, $msg_notify, $headers);
		}
	}

}
?>
