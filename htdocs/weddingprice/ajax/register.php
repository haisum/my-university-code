<?php 
	require '../config/config.php';
	if(isset($_SESSION['userId'])){
		echo "You are laready logged in";
		exit();
	}
	require_once '../classes/database/objects/class.database.php';
	require_once '../classes/database/objects/class.user.php';	
	if(isset($_POST['email_reg'])){
		require_once '../classes/Validator.php';
		require_once '../classes/Random.php';
		$validate = new Validator();
		$email = $_POST['email_reg'];
		$email = htmlentities($email);
		$error = null;
		if(!$validate->isValidEmail($email)){
			$error .= "-Invalid Email Id";
		}
		if($email == ""){
			$error .= "-Email Can't be empty";
		}
		$user = new User();
		$userList = $user->GetList(array(array('email', '=' , $email)), '', true, 1);
		if(count($userList)>0){
			$error .= "-Email already Registered. <strong><a href='" . URL . "/forgot-password.php' style='color:#fff;text-decoration:underline;'>Forgot Password?</a></strong>";
		}
		if($error != null){
			echo "<p>" . $error . "</p>";
	}
		else{
			$password = Random::getRandom(14);
			$to      = $email;		
			$linkUrl = URL . '/login.php';
			$mailSent = false;
			try{
				require_once '../classes/database/objects/class.database.php';
				require_once '../classes/database/objects/class.user.php';
				$user = new User();
				$user->email = $email;
				$user->isActive = 'No';
				$user->type = 'Normal';
				$user->lastLogin = strftime("%y-%m-%d %H:%M:%S");
				$user->registrationDate = strftime("%y-%m-%d %H:%M:%S");
				$user->password = sha1($password);
				$user->Save();
				require_once '../classes/database/objects/class.emailtemplate.php';
				require_once '../classes/Mail.php';
				$emailObj = new Mail();
				$emailObj->sendRegisterationEmail($password, $linkUrl, $to);
				echo "<p>An Email containing your password has been sent to you on <strong style='color:#000;'>{$email}</strong>. You may use it to login and complete registeration process.</p>";
			}
			catch(Exception $e){
				echo "<p>An error occured while sending mail. Message: {$e->getMessage()}</p>";
			}
			
		}
	}
?>