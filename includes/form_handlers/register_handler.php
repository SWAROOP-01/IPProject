<?php

	// DEFINING VARIBALES
	$reg_username = ''; $reg_email = ''; $reg_mnumber = ''; $reg_pass1 = '';$reg_pass2 = '';$reg_date = ''; $reg_check = '';
	$error_array = array();
	
	// REGISTER
	if(isset($_POST['reg_submit'])){

		$reg_username = strip_tags($_POST['reg_username']); 
        $reg_username = str_replace(' ','',$reg_username);
		$reg_username = ucfirst(strtolower($reg_username));
		$_SESSION['reg_username'] = $reg_username; // Storing varibale to a session

		$reg_email = strip_tags($_POST['reg_email']); 
		$reg_email = str_replace(' ','',$reg_email);
		$_SESSION['reg_email'] = $reg_email; // Storing varibale to a session
		
		$reg_mnumber = strip_tags($_POST['reg_mnumber']); 
		$reg_mnumber = str_replace(' ','',$reg_mnumber);
		$_SESSION['reg_mnumber'] = $reg_mnumber; // Storing varibale to a session
		
		$reg_pass1 = strip_tags($_POST['reg_pass1']); 
		// $_SESSION['reg_pass1'] = $reg_pass1; // Storing varibale to a session

        $reg_pass2 = strip_tags($_POST['reg_pass2']); 
		// $_SESSION['reg_pass2'] = $reg_pass2; // Storing varibale to a session

		$reg_date = date('Y-m-d');
		

		// ADDING constraints

		//USERNAME length		
		if(strlen($reg_username) > 15 || strlen($reg_username) < 3 ){
			array_push($error_array,"Username must be between 3-13 characcters");
		}
		//username alphabets only 
		if(!ctype_alpha($reg_username)){
			array_push($error_array,"Please Enter Alphabets only in Username");
		}

		// password checks
		if($reg_pass1 != $reg_pass2){
			array_push($error_array,"Passwords do not match");
		} else {
			if(preg_match('/[^A-Za-z0-9]/', $reg_pass1)){
				array_push($error_array,"You can only use characters and numbers");
			}
		}

		if(strlen($reg_pass1) > 16 || strlen($reg_pass1) < 7){
			array_push($error_array,"Password length must be between 7-16");
		}

		// Mnumber length
		if(strlen($reg_mnumber) <6 || strlen($reg_mnumber) >14 ){
			array_push($error_array,"Enter Valid Mobile Number");
		}

		if(ctype_alpha($reg_mnumber)){
			array_push($error_array,"Please Dont use Alphabets in number");
		}

		//Duplicate email

		$check_email_query = mysqli_query($con,"SELECT email FROM users WHERE email='$reg_email'");
		// echo mysqli_num_rows($check_email_query);
		if(mysqli_num_rows($check_email_query) != 0){
			array_push($error_array,"' " . $reg_email . " '". " This Email is already in use :(  " );
		}



		// ENCRYPT PASSWORD
		if(empty($error_array)){
			$reg_pass1 = md5($reg_pass1);
			// echo $reg_pass1;

			//Check Duplicate Entries
			$check_username_query = mysqli_query($con,"SELECT username FROM users WHERE username='$reg_username'");
			$poll_1 = 0;
	
			while(mysqli_num_rows($check_username_query) != 0 ){
				$poll_1++;
				$reg_username = $reg_username . "_" . $poll_1;
				$check_username_query = mysqli_query($con,"SELECT username FROM users WHERE username='$reg_username'");
				// echo $reg_username;
			}		
		
			//Assigning random image profiles
			$rand = rand(1,8);

			if($rand == 1){
				$profile_pic = "../../Public/Images/avatar-dog-saint-bernard-puppy-512.png";
			} elseif($rand == 2){
				$profile_pic = "../../Public/Images/avatars-dog-bernese-mountain-dog-512.png";
			} elseif($rand == 3){
				$profile_pic = "../../Public/Images/avatars-dogs-boxer-goofy-512.png";
			} elseif($rand == 4){
				$profile_pic = "../../Public/Images/avatars-dogs-newfoundland-bone-512.png";
			} else{
				$profile_pic = "../../Public/Images/avatars-pitbull-dogs-ears-512.png";
			}

			// INSERTING USER INFO IN DATABASE
			$ins_query = mysqli_query($con , "INSERT INTO users VALUES ('$reg_username', '$reg_email', '$reg_mnumber', '$reg_pass1', '$reg_check', '', '$reg_date', '$profile_pic', '0', '0', 'no', ',')");
			array_push($error_array,$reg_username ." You are registered successfully! you are good to log in ...");
			
			//Clear session variables 
			$_SESSION['reg_username'] = "";
			$_SESSION['reg_email'] = "";
			$_SESSION['reg_mnumber'] = "";
			$_SESSION['reg_pass1'] = "";
			$_SESSION['reg_pass2'] = "";			
		}
		
	}


?>