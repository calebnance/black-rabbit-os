<?php
	// make sure to check for sql injection! in all of these areas being added!
	$email_code = $_SERVER['QUERY_STRING'];
	
	if($email_code):
		// include files
		include('master.php');
		
		$database	= new Database(HOST, DBNAME, DBUSER, DBPASS);
		$email_code = database::preventInjection($email_code);
		$nocode		= $database->select('br_users', 'DISTINCT id', 'email_code="'.$email_code.'"', 'object');
		
		// is there a validate code in the database
		if($nocode):
			$valid		= $database->select('br_users', 'DISTINCT id', 'email_code="'.$email_code.'" AND email_validated="1"', 'object');
			
			// has the code already been validated?
			if(!$valid[0]):
				$user = array();
				$user['email_validated']= 1;
				$user['date_validated']	= date('Y-m-d H:i:s');
				$database->update('br_users', $user, 'id='.$nocode[0]->id);
				
				// let's just make them login again, way easier
				session_start();
				session_destroy();
				
				header('location: index.php?msg=5');
				exit();
			else:
				header('location: index.php?msg=4');
				exit();
			endif;
		else:
			header('location: index.php?msg=3');
			exit();
		endif;
	else:
		header('location: index.php?msg=3');
		exit();
	endif;
?>