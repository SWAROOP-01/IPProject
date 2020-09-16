<?php
	require "../../config/config.php";
	require "../../includes/form_handlers/register_handler.php";
	require "../../includes/form_handlers/login_handler.php";
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
	<!-- IMAGE CONTAINER FULL -->
	<div class="hero">
		<!-- SMALL CONTAINER -->
		<div class="form-box">

			<!-- REGISTER  / LOGIN BUTTONS  -->
			<div class="button-box">
				<div id="btn"></div>
				<button type="button" class="toggle-btn" onclick="login()">Log In</button>
				<button type="button" class="toggle-btn" onclick="register()">Register</button>
			</div>

			<!-- BRAND NAME s -->
            <div class="brand" style="text-align : center;">
                <h2><i class="fas fa-paw"></i> Paw4Paw</h2>     
            </div>

			<!-- LOGIN FORM  -->
			<form id="login" class="input-group" method="POST" action = "loginandregistration.php">
				<input name='log_email' type="text" class="input-field" placeholder="email" value = "<?php
					if(isset($_SESSION['log_email'])){
						echo $_SESSION['log_email'];
					}
				?>" required>
				<input name='log_password' type="password" class="input-field" placeholder="Enter Password" required>
				<button name='log_submit' class="submit-btn" type="submit" style= "margin-top : 20px;">Log in</button>
				<br>
				<a style = 'color : black; font-size : .9rem; font-weight : 300;' href="#">Forgot Password?</a>

				<!-- error message -->
				<?php
					if(isset($login_messege_array)){
				?>
				<div style="font-size : .8rem; color: red;" class="input-field">
					<?php
					foreach($login_messege_array as $val){
							echo $val . " | ";
						}
					?>
				</div>
				<?php
					}
				?>

			</form>

			<!-- REGISTERATION FORM  -->
			<form id="register" class="input-group" method="POST" action = "loginandregistration.php">
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

				<input name='reg_check' type="checkbox" class="check-box">
					<span style="color : black; font-size : .9rem; font-weight : 200;">I agree that the above information is true to my knowledge.
					</span>
				<button name='reg_submit' class="submit-btn" type="submit">Register</button>
			</form>
		</div>
		
	</div>


	<script type= 'text/javascript' src = '../../Public/Javascript/log_reg.js'></script>

</body>
</html>