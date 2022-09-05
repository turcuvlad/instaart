<?php
session_start();
include("includes/connection.php");
?>

<?php

if (isset($_POST['sign_up'])) {

	$first_name = htmlentities(mysqli_real_escape_string($con, $_POST['u_first_name']));
	$last_name = htmlentities(mysqli_real_escape_string($con, $_POST['u_last_name']));
	$pass = htmlentities(mysqli_real_escape_string($con, $_POST['u_pass']));
	$email = htmlentities(mysqli_real_escape_string($con, $_POST['u_email']));
	$phone = htmlentities(mysqli_real_escape_string($con, $_POST['u_phone']));


	$pass_confirm = htmlentities(mysqli_real_escape_string($con, $_POST['u_pass_confirm']));

	if ($pass != $pass_confirm) {
		//echo"<script>alert('Passwords do not match!')</script>";
		echo "<script>swal('Warning!','Passwords do not match!', 'warning');</script>";
		exit();
	}
	if (strlen($pass) < 4) {
		//echo"<script>alert('Password should be minimum 4 characters!')</script>";
		echo "<script>swal('Warning!','Password should be minimum 4 characters!', 'warning');</script>";

		exit();
	}

	$check_email = "select * from users where u_email='$email'";
	$run_email = mysqli_query($con, $check_email);

	$check = mysqli_num_rows($run_email);

	if ($check == 1) {
		//echo "<script>alert('Email already exist, Please try using another email')</script>";
		echo "<script>swal('Warning!','Email already exist, Please try using another email!', 'warning')
		.then((value) => { 
			window.open('signup_user.php', '_self')
            }); </script>";
		//echo "<script>window.open('signup.php', '_self')</script>";
		exit();
	}



	$insert = "INSERT into users (u_first_name,u_last_name,u_pass,u_email,u_phone)
		values('$first_name','$last_name','" . md5($pass) . "','$email','$phone')";

	$query = mysqli_query($con, $insert);


	if ($query) {
		//echo "<script>alert('Well Done $first_name, you are good to go.')</script>";
		echo "<script>
			swal('Well Done $first_name,', 'you are good to go!', 'success')
            .then((value) => { 
			window.open('signin_user.php', '_self')
            }); </script>";



		//echo "<script>window.open('index.php', '_self')</script>";
	} else {
		echo "<script>alert('Registration failed, please try again!')</script>";
		echo "<script>window.open('signup.php', '_self')</script>";
	}
}
?>