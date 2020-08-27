<?php

	// CONNECTING TO THE DATABASE
    $con = mysqli_connect("localhost" ,"root","","pawfectDB");
    if(mysqli_connect_errno()){
        echo "Failed To Connect !  " . mysqli_connect_errno();
    }

	// REGISTER
	if(isset($_POST['reg_submit'])){
		// DEFINING VARIBALES
		$reg_username = ''; $reg_email = ''; $reg_mnumber = ''; $reg_pass1 = '';$reg_pass2 = '';$reg_date = ''; $reg_check = '';

		$reg_username = strip_tags($_POST['reg_username']); 
        $reg_username = str_replace(' ','',$reg_username);
		$reg_username = ucfirst(strtolower($reg_username));

		$reg_email = strip_tags($_POST['reg_email']); 
		$reg_email = str_replace(' ','',$reg_email);
		
		$reg_mnumber = strip_tags($_POST['reg_mnumber']); 
		$reg_mnumber = str_replace(' ','',$reg_mnumber);
		
		$reg_pass1 = strip_tags($_POST['reg_pass1']); 

        $reg_pass2 = strip_tags($_POST['reg_pass2']); 

        $reg_date = date('Y-m-d');

		// ADDING constraints
		if(strlen($reg_username) > 25 || strlen($reg_username) < 3 ){
			echo "YOUR USERNAME MUST BE BETWEEN 2-25 Chars      ";
		}

		if($reg_pass1 != $reg_pass2){
			echo "password DO NOT MATCH   ";
		} else {
			if(preg_match('/[^A-Za-z0-9]/', $reg_pass1)){
				echo "Password Must contain Characters and numbers";
			}
		}

		if(strlen($reg_pass1) > 16 || strlen($reg_pass1) < 7){
			echo "password must be between 8-15 Characters";
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
				<input name='log_password' type="text" class="input-field" placeholder="Enter Password" required>
				<input name='log_check' type="checkbox" class="check-box"><span>Remember Password </span>
				<button name='log_submit' class="submit-btn" type="submit">Log in</button>

				<a style = 'color : black; font-size : .8rem; font-weight : 300;' href="#">Forgot Password?</a>
				

 
			</form>
			<form id="register" class="input-group" method="POST">
				<input name='reg_username' type="text" class="input-field" placeholder="Username" required>
				<input name='reg_email' type="email" class="input-field" placeholder="Email Id" required>
				<input name='reg_mnumber' type="text" class="input-field" placeholder="Mobile Number" required>
				<input name='reg_pass1' type="text" class="input-field" placeholder="Enter a Password" required>
				<input name='reg_pass2' type="text" class="input-field" placeholder="Re-Enter Password" required>

				<input name='reg_check' type="checkbox" class="check-box"><span>I agree to the terms and conditions </span>
				<button name='reg_submit' class="submit-btn" type="submit">Register</button>
			</form>
		</div>
		
	</div>


	<script type= 'text/javascript' src = './log_reg.js'></script>

</body>
</html>