<?php
	// Start Session
	session_start();


	// CONNECTING TO THE DATABASE
    $con = mysqli_connect("localhost" ,"root","","pawfectDB");
    if(mysqli_connect_errno()){
        echo "Failed To Connect !  " . mysqli_connect_errno();
    }

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
		$_SESSION['reg_pass1'] = $reg_pass1; // Storing varibale to a session

        $reg_pass2 = strip_tags($_POST['reg_pass2']); 
		$_SESSION['reg_pass2'] = $reg_pass2; // Storing varibale to a session

		$reg_date = date('Y-m-d');
		

		// ADDING constraints
		if(strlen($reg_username) > 15 || strlen($reg_username) < 3 ){
			array_push($error_array,"Username must be between 3-13 characcters");
		}

		if($reg_pass1 != $reg_pass2){
			array_push($error_array,"Passwords do not match");
		} else {
			if(preg_match('/[^A-Za-z0-9]/', $reg_pass1)){
				array_push($error_array,"You can only use characters and numbers");
			}
		}

		if(strlen($reg_pass1) > 16 || strlen($reg_pass1) < 7){
			array_push($error_array,"password length must be between 7-16");
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

<!DOCTYPE html>
<html>
<head>
	<title>Login and Registration Form</title>
	<link rel="stylesheet" type="text/css" href="../../Public/Stylesheets/app.css">

	<!-- fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Alata&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/8e5b7275f2.js" crossorigin="anonymous"></script>
</head>
<body>
	<div class="hero">
		<div class="form-box">
			<div class="button-box">
				<div id="btn"></div>
				<button type="button" class="toggle-btn" onclick="login()">Log In</button>
				<button type="button" class="toggle-btn" onclick="register()">Register</button>
			</div>

            <div class="brand" style="text-align : center;">
                <h2><i class="fas fa-paw"></i> Paw4Paw</h2>     
            </div>

			<form id="login" class="input-group" method="POST">
				<input name='log_username' type="text" class="input-field" placeholder="Username" required>
				<input name='log_password' type="password" class="input-field" placeholder="Enter Password" required>
				<input name='log_check' type="checkbox" class="check-box"><span>Remember Password </span>
				<button name='log_submit' class="submit-btn" type="submit">Log in</button>

				<a style = 'color : black; font-size : .8rem; font-weight : 300;' href="#">Forgot Password?</a>
			</form>

			<form id="register" class="input-group" method="POST">
				<input name='reg_username' type="text" class="input-field" placeholder="Username" value="<?php
						if(isset($_SESSION['reg_username'])){
							echo $_SESSION['reg_username'];
						}
					?>" required>
				<input name='reg_email' type="email" class="input-field" placeholder="Email Id" value="<?php
						if(isset($_SESSION['reg_email'])){
							echo $_SESSION['reg_email'];
						}
					?>" required>
				<input name='reg_mnumber' type="text" class="input-field" placeholder="Mobile Number" value="<?php
						if(isset($_SESSION['reg_mnumber'])){
							echo $_SESSION['reg_mnumber'];
						}
					?>" required>
				<input name='reg_pass1' type="password" class="input-field" placeholder="Enter a Password" required>
				<input name='reg_pass2' type="password" class="input-field" placeholder="Re-Enter Password" required>

				<!-- error message -->
				<?php
					if(isset($error_array)){
				?>
				<div style="font-size : .8rem; color: red;" class="input-field">
					<?php
					foreach($error_array as $val){
							echo $val . " | ";
						}
					?>
				</div>
				<?php
					}
				?>

				<input name='reg_check' type="checkbox" class="check-box"><span>I agree to the terms and conditions </span>
				<button name='reg_submit' class="submit-btn" type="submit">Register</button>



			</form>
			
		</div>
		
	</div>


	<script type= 'text/javascript' src = '../../Public/Javascript/log_reg.js'></script>

</body>
</html>