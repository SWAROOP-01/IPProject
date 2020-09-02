<?php

if(isset($_POST['log_submit'])){

    //Sanitize Email
    $log_email = filter_var( $_POST['log_email'], FILTER_SANITIZE_EMAIL);
    $_SESSION['log_email'] = $log_email;
    //encryt password
    $log_password = md5($_POST['log_password']);

    // To Get User Ifo and to check email and password
    $login_db_query = mysqli_query($con,"SELECT * FROM users WHERE email = '$log_email' AND password = '$log_password' ");
    $login_check_query = mysqli_num_rows($login_db_query);
    $login_messege_array = array();

    if($login_check_query == 1){
        // Fetching User Info
        $row = mysqli_fetch_array($login_db_query);
        $username = $row['username'];
        $_SESSION['username'] = $username;

        // TO Re-Open If Account is CLOSED
        $user_closed_query = mysqli_query($con,"SELECT * FROM users WHERE email = '$log_email' and user_closed='yes' ");
        echo mysqli_num_rows($user_closed_query);
        if(mysqli_num_rows($user_closed_query) == 1){
            echo "yes Im inside";
            $reopen_acc =  mysqli_query($con , "UPDATE users SET user_closed='no' WHERE email='$log_email'");
        }
        
        // Redirecting to Index Page
        header("Location: ../Main/index.php");
        exit();

    }   else if($login_check_query == 0){
        array_push($login_messege_array , "Email or Password Incorrect!" );
    } else{
        echo "Database Compromised";
    }


    
}

?>

