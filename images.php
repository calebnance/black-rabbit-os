<?php
/*********
 * Black Rabbit Component Creator
 * by Caleb Nance
 */

// Get files uploaded
$post = $_POST;
$files = $_FILES;

if(empty($files)):
	?>
	<div class="alert alert-error">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<p>Please make sure you have selected at least one image to upload.</p>
	</div>
	<?php
else:

	include('assets/wideimage/lib/WideImage.php');

	//print_r($files);
	$views			= $post['imagesname'];
	$images 		= $files['images'];
	$imagesCount	= count($images['name']);

	// Set arrays
	$msg		= array();
	$error		= array();
	$imagesList	= array();

	// Base path and folders
	$basepath	= dirname($_SERVER['PHP_SELF']);
	$tempFolder = 'temp/';
	$origFolder = $tempFolder . 'orig/';
	$manaFolder = $tempFolder . 'mana/'; // 48px X 48px
	$menuFolder = $tempFolder . 'menu/'; // 16px X 16px

	// Parse through all images trying to upload..
	for($i=0; $i < $imagesCount; $i++):

		$fileSize	= $images['size'][$i];
		$fileError	= $images['error'][$i];

		// Filename handle
		$fileName	= $images['name'][$i];
		$fileName	= preg_replace("/[^A-Za-z0-9._]/", "", $fileName);
		$fileTemp	= $images['tmp_name'][$i];
		$origPath	= $origFolder . $fileName;
		$manaPath	= $manaFolder . $fileName;
		$menuPath	= $menuFolder . $fileName;

		if($fileSize > 2000000):
			$msg[] = 'Can not upload an image over 2MB, please resize the image so that it is under the 2MB limit.';
			$error[] = 1;
		else:
			// Any errors the server registered on uploading
			if ($fileError > 0):
	        	switch ($fileError)
	        	{
	        		case 1:
		        		$msg[]	= 'File is too large than the php ini allows';
		        		$error[]= 1;
	        		case 2:
		        		$msg[]	= 'The form does not allow this sized file to be uploaded, please resize the image.';
		        		$error[]= 1;
	        		case 3:
		        		$msg[]	= 'There was an error when trying to upload your photo, partial file uploaded only.';
		        		$error[]= 1;
	        		case 4:
		        		$msg[]	= 'Error, no file present';
		        		$error[]= 1;
	        	}
	        else:
	        	//Check for allowed extensions
				$uploadedFileNameParts	= explode('.',$fileName);
				$uploadedFileExtension	= array_pop($uploadedFileNameParts);
				$uploadedFileExtension	= strtolower($uploadedFileExtension);
				$validFileExts			= explode(',', 'jpeg,jpg,png,gif');
				$extOk					= false;

				foreach($validFileExts as $key => $value):
					if(preg_match("/$value/i", $uploadedFileExtension)):
						$extOk = true;
					endif;
				endforeach;

				if($extOk == false):
					$msg[]		= 'File extension not allowed, please select a jpeg, jpg, png, or gif.';
					$error[]	= 1;
				else:
					// Check if file exists already
					/*
					if(file_exists($origPath)):
						$msg[]	= $fileName . ' already exists. ';
						$error[]= 1;
					else:
					*/
						// Check height and width
						list($width, $height, $type, $attr) = getimagesize($fileTemp);
						if($width > 2000 || $height > 2000):
							$msg[]	= 'Picture is too large to resize in this browser, please make sure it is not over 2000px height or 2000px width.';
							$error[]= 1;
						else:
							move_uploaded_file($fileTemp, $origPath);
							// Manager image
							$manaImage = WideImage::load($origPath);
							$resized = $manaImage->resize(48, 48, 'outside')->crop('center', 'center', 48, 48);
							$resized->saveToFile($manaPath);
							// Menu image
							$menuImage = WideImage::load($origPath);
							$resized = $menuImage->resize(16, 16, 'outside')->crop('center', 'center', 16, 16);
							$resized->saveToFile($menuPath);
							$msg[] = $origPath . ' uploaded!';
							$error[] = 0;
							$imagesList[$i] = $fileName;
						endif;
					//endif;
				endif;
			endif;
		endif;
	endfor;

	$i = 0;
	$hidden = '';
	foreach($error as $display):
		if($display):
			?>
			<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<p><?php echo $msg[$i]; ?></p>
			</div>
			<?php
		else:
	?>
		<div class="previewImage">
			<h4><?php echo ucwords($views[$i]); ?> Image</h4>
			Manager Image: <img src="temp/mana/<?php echo $imagesList[$i]; ?>" />
			Menu Image: <img src="temp/menu/<?php echo $imagesList[$i]; ?>" />
		</div>
		<?php
		$hidden .= '<input type="hidden" name="imagesUploaded['.strtolower($views[$i]).']" value="' . $imagesList[$i] . '" />';
		endif;
		$i++;
	endforeach;
	?>
	<div id="addToHiddenImages"><?php echo $hidden; ?></div>
	<?php
endif;
exit();

?>
