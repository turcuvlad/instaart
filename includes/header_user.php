<?php
include("includes/connection.php");
include("functions/functions.php");
?>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>Welcome </title>
	<link rel="icon" type="image/x-icon" href="images/Logo.png" />

	<!-- Google fonts-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
	<!-- Core theme CSS (includes Bootstrap)-->
	<link href="style/style1.css" rel="stylesheet" />

	<!-- JS alerts -->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>
<style>

</style>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark" id="mainNav">

	<div class="container">

		<button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation" style=" font-size : 20px; width: 100%; height: 100px;">
			InstaArt
			<i class="fas fa-bars ml-1"></i>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">

			<ul class="navbar-nav text-uppercase ml-auto">


				<?php
				$user = $_SESSION['u_email'];
				$get_user = "select * from users where u_email='$user'";
				$run_user = mysqli_query($con, $get_user);
				$row = mysqli_fetch_array($run_user);

				$user_id = $row['user_id'];
				$first_name = $row['u_first_name'];
				$last_name = $row['u_last_name'];
				//	$status = $row['u_status'];
				$user_pass = $row['u_pass'];
				$user_email = $row['u_email'];
				$user_phone = $row['u_phone'];


				/* 
			$artist_art = "select * from art_pieces where artist_id='$artist_id'"; 
			$run_art = mysqli_query($con,$artist_art); 
			$art = mysqli_num_rows($run_art);*/
				?>
				<!--   <li class="nav-item"><a class="nav-link js-scroll-trigger" style=" font-size: 15px;font-weight: 900;" href='profile.php?<?php echo "user_id=$user_id" ?>'><?php echo "$first_name"; ?></a></li> -->
				<li class="nav-item"><a class="navbar-brand js-scroll-trigger" href="home_user.php"><img src="images/Logo.png" alt="" style="width: 40px; height: 40px;" /></a></li>
				<li class="nav-item"><a class="nav-link js-scroll-trigger" href="artists.php" style=" font-size: 15px;font-weight: 900;">Find Artists</a></li>
				<li class="nav-item"><a class="nav-link js-scroll-trigger" href="search_art.php" style=" font-size: 15px;font-weight: 900;">Find Artwork</a></li>
				<li class="nav-item"><a class="nav-link js-scroll-trigger" href="deals.php" style=" font-size: 15px;font-weight: 900;">Deals</a></li>



				<?php
				//DE MODIFICAT!!!!
				echo "

						<li class='dropdown' >
							<a href='#'  data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><span><i class='glyphicon glyphicon-plus' style ='top: 15px;color: rgb(194, 148, 10)'></i></span></a>
							<ul class='dropdown-menu' >
							<li>
							<a style ='top: 15px;color: rgb(194, 148, 10)' href='interests_user.php?user_id=$user_id'>interests and orders</a>
						</li>
					
							
						
								<li role='separator' class='divider'></li>
								<li>
									<a style ='top: 15px;color: rgb(194, 148, 10)' href='edit_account_user.php?user_id=$user_id'>Edit Account</a>
								</li>
								<li>
									<a style ='top: 15px;color: rgb(194, 148, 10)' href='change_pass_user.php?user_id=$user_id'>Change Password</a>
								</li>
								<li role='separator' class='divider'></li>
								<li>
									<a style ='top: 15px;color: rgb(194, 148, 10)' href='logout.php'>Logout</a>
								</li>
							</ul>
						</li>
						";
				?>
			</ul>

		</div>
	</div>


	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

		</div>


		<!-- Bootstrap core JS-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
		<!-- Third party plugin JS-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
		<!-- Core theme JS-->
		<script src="functions/script_index.js"></script>
</nav>