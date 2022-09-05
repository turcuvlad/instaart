<?php
session_start();

include("includes/connection.php");

	if (isset($_POST['login'])) {

		$email = htmlentities(mysqli_real_escape_string($con, $_POST['u_email']));
		$pass = htmlentities(mysqli_real_escape_string($con, $_POST['u_pass']));

		$select_artist = "select * from users where u_email='$email' AND u_pass='".md5($pass)."'";
		$query= mysqli_query($con, $select_artist);
		$check_artist = mysqli_num_rows($query);

		if($check_artist == 1){
			$_SESSION['u_email'] = $email;

			echo "<script>window.open('home_user.php', '_self')</script>";
		}else{
			echo"<script>alert('Your Email or Password is incorrect')</script>";
		}
	}
?>