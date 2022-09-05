<!DOCTYPE html>
<html>
<head>
	<title>Signin</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- JS alerts -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	
</head>
<style>
	body{
		overflow-x: hidden;
	}
	.main-content{
		width: 50%;
		height: 40%;
		margin: 10px auto;
		background-color: #fff;
		border: 2px solid #AB850D;
		padding: 40px 50px;
	}
	.header{
		border: 0px solid #000;
		margin-bottom: 5px;
	}
	.well{
		background-color: #D6AA21;
	}
	#signin{
		width: 60%;
		border-radius: 30px;
		background-color: #EBC95E;
    border: 1px solid #AB850D;
    color: #AB850D;
	}
	.overlap-text{
		position: relative;
	}
	.overlap-text a{
		position: absolute;
		top: 8px;
		right: 10px;
		font-size: 14px;
		text-decoration: none;
		font-family: 'Overpass Mono', monospace;
		letter-spacing: -1px;

	}
</style>
<body>
<div class="row">
	<div class="col-sm-12">
		<div class="well">
			<center><h1 style="color: white;">InstaArt</h1></center>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="main-content">
			<div class="header">
				<h3 style="text-align: center;"><strong>Login to your account</strong></h3>
			</div>
			<div class="l-part">
				<form action="" method="post">
					<input type="email" name="a_email" placeholder="Email" required="required" class="form-control input-md"><br>
					<div class="overlap-text">
						<input type="password" name="a_pass" placeholder="Password" required="required" class="form-control input-md"><br>
					<!--	<a style="text-decoration:none;float: right;color: #187FAB;" data-toggle="tooltip" title="Reset Password" href="forgot_password.php">Forgot?</a> -->
					</div>
					

					<center><button id="signin" class="btn btn-info btn-lg" name="login">Login</button></center>
					<center><a style="text-decoration: none;color: #AB850D;" data-toggle="tooltip" title="Create Account!" href="signup.php">Don't have an account?</a><br><br></center>
					<?php include("login.php"); ?>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
  <!-- Footer-->
  <footer class="footer py-4">
            <div class="container">
                <div >
                 <center>  <div >Copyright © Turcu Vlad</div> </center> 
                   
                </div>
            </div>
        </footer>
</html>