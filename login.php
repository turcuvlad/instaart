<?php
session_start();

include("includes/connection.php");

	if (isset($_POST['login'])) {

		$email = htmlentities(mysqli_real_escape_string($con, $_POST['a_email']));
		$pass = htmlentities(mysqli_real_escape_string($con, $_POST['a_pass']));

		$select_artist = "select * from artists where a_email='$email' AND a_pass='".md5($pass)."'";
		$query= mysqli_query($con, $select_artist);
		$check_artist = mysqli_num_rows($query);

		if($check_artist == 1 && $email=='admin@instaart'){
			$_SESSION['a_email'] = $email;

			echo "<script>window.open('admin.php?page=1', '_self')</script>";
		} else
		if($check_artist == 1 && $email!='admin@instaart'){
			$_SESSION['a_email'] = $email;

			echo "<script>window.open('home.php', '_self')</script>";
		}else{
			echo"<script>alert('Your Email or Password is incorrect')</script>";
		}
	}
?>