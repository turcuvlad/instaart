<?php
session_start();
include("includes/connection.php");

	if(isset($_POST['sign_up'])){

		$first_name = htmlentities(mysqli_real_escape_string($con,$_POST['a_first_name']));
		$last_name = htmlentities(mysqli_real_escape_string($con,$_POST['a_last_name']));
		$pass = htmlentities(mysqli_real_escape_string($con,$_POST['a_pass']));
		$email = htmlentities(mysqli_real_escape_string($con,$_POST['a_email']));
		$specialization = htmlentities(mysqli_real_escape_string($con,$_POST['a_specialization']));
		$gender = htmlentities(mysqli_real_escape_string($con,$_POST['a_gender']));
		$birthday = htmlentities(mysqli_real_escape_string($con,$_POST['a_birthday']));
		$posts = "no";
		$newgid = sprintf('%05d', rand(0, 999999));
        $studies = htmlentities(mysqli_real_escape_string($con,$_POST['a_studies']));

		$artistname = strtolower($first_name . "_" . $last_name . "_" . $newgid);
		$check_username_query = "select a_name from artists where a_email='$email'";
		$run_username = mysqli_query($con,$check_username_query);


		$pass_confirm = htmlentities(mysqli_real_escape_string($con,$_POST['a_pass_confirm']));

		if($pass != $pass_confirm){
			echo"<script>alert('Passwords do not match!')</script>";
			exit();
		}
		if(strlen($pass) <4 ){
			echo"<script>alert('Password should be minimum 4 characters!')</script>";
			exit();
		}

		$check_email = "select * from artists where a_email='$email'";
		$run_email = mysqli_query($con, $check_email);

		$check = mysqli_num_rows($run_email);

		if($check == 1){
			//echo "<script>alert('Email already exist, Please try using another email')</script>";
			//echo "<script>window.open('signup.php', '_self')</script>";
			echo "<script>swal('Warning!','Email already exist, Please try using another email!', 'warning')
		.then((value) => { 
			window.open('signup.php', '_self')
            }); </script>";
			exit();
		}

		$rand = rand(1, 3); //Random number between 1 and 3

			if($rand == 1)
				$profile_pic = "user1.jpg";
			else if($rand == 2)
				$profile_pic = "user2.jpg";
			else if($rand == 3)
				$profile_pic = "user3.jpg";

		$insert = "INSERT into artists (a_first_name,a_last_name,a_name,describe_artist,a_pass,a_email,a_specialization,a_gender,a_birthday,a_image,a_cover,a_registration_date,posts,a_studies)
		values('$first_name','$last_name','$artistname','no description yet.','".md5($pass)."','$email','$specialization','$gender','$birthday','$profile_pic','cover.jpg',NOW(),'$posts','$studies')";
		
		$query = mysqli_query($con, $insert);

		if($query){
			echo "<script>
			swal('Well Done $first_name,', 'you are good to go!', 'success')
            .then((value) => { 
			window.open('signin.php', '_self')
            }); </script>";
		}
		else{
			echo "<script>alert('Registration failed, please try again!')</script>";
			echo "<script>window.open('signup.php', '_self')</script>";
		}
	}
?>