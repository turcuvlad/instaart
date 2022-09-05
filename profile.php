<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");

if (!isset($_SESSION['a_email'])) {
	header("location: index.php");
}
?>
<html>
<div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>


<head>
	<?php
	$artist = $_SESSION['a_email'];
	$get_artist = "select * from artists where a_email='$artist'";
	$run_artist = mysqli_query($con, $get_artist);
	$row = mysqli_fetch_array($run_artist);

	$artist_name = $row['a_name'];
	?>
	<title><?php echo "$artist_name"; ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<style>

.bg {
  animation:slide 3s ease-in-out infinite alternate;
  background-image: linear-gradient(-60deg, #DEB887 50%, #FAEBD7 50%);
  bottom:0;
  left:-50%;
  opacity:.5;
  position:fixed;
  right:-50%;
  top:0;
  z-index:-1;
}

.bg2 {
  animation-direction:alternate-reverse;
  animation-duration:8s;
}

.bg3 {
  animation-duration:9s;
}



@keyframes slide {
  0% {
    transform:translateX(-25%);
  }
  100% {
    transform:translateX(25%);
  }
}



	#cover-img {
		height: 400px;
		width: 100%;
	}

	#profile-img {
		position: absolute;
		top: 70px;
		left: 40px;
	}

	#update_profile {
		position: relative;
		top: -33px;
		cursor: pointer;
		left: 93px;
		border-radius: 4px;
		background-color: rgba(0, 0, 0, 0.1);
		transform: translate(-50%, -50%);
	}

	#button_profile {
		position: absolute;
		top: 82%;
		left: 50%;
		cursor: pointer;
		transform: translate(-50%, -50%);
	}

	#own_post{
		margin:auto;
		border: 5px solid #DEB887;
		background-color: #fcf4e8;
		padding: 40px 50px;
		width: 70%;
	
	}

	#posts-img{
		margin-left: auto;
  margin-right: auto;
		height:60%;
		width:60%;
	}
</style>

<body id="page-top">
	<div class="row">
		<div class="col-sm-2">
		</div>
		<div class="col-sm-8">
			<?php
			echo "
			<div>
				<div><img id='cover-img' class='img-rounded' src='cover/$artist_cover' alt='cover'></div>
				<form action='profile.php?artist_id=$artist_id' method='post' enctype='multipart/form-data'>

				<ul class='nav pull-left' style='position:absolute;top:10px;left:40px;'>
					<li class='dropdown'>
						<button class='dropdown-toggle btn btn-default' data-toggle='dropdown'>Change Cover</button>
						<div class='dropdown-menu'>
							<center>
							<p>Click <strong>Select Cover</strong> and then click the <br> <strong>Update Cover</strong></p>
							<label class='btn btn-info'> Select Cover
							<input type='file' name='a_cover' size='60' />
							</label><br><br>
							<button name='submit' class='btn btn-info'>Update Cover</button>
							</center>
						</div>
					</li>
				</ul>

				</form>
			</div>
			<div id='profile-img'>
				<img src='artists/$artist_image' alt='Profile' class='img-circle' width='180px' height='185px'>
				<form action='profile.php?artist_id='$artist_id' method='post' enctype='multipart/form-data'>

				<label id='update_profile'> Select Profile
				<input type='file' name='a_image' size='60' />
				</label><br><br>
				<button id='button_profile' name='update' class='btn btn-info'>Update Profile</button>
				</form>
			</div><br>
			";
			?>
			<?php

			if (isset($_POST['submit'])) {

				$a_cover = $_FILES['a_cover']['name'];
				$image_tmp = $_FILES['a_cover']['tmp_name'];
				$random_number = rand(1, 100);
				$location = "/Users/vladturcu/.bitnami/stackman/machines/xampp/volumes/root/htdocs/instaart/cover/$a_cover";

				if ($a_cover == '') {
					echo "<script>alert('Please Select Cover Image')</script>";
					echo "<script>window.open('profile.php?artist_id=$artist_id' , '_self')</script>";
					echo "<script>copy</script>";
					exit();
				} else {

					move_uploaded_file($image_tmp, "cover/$a_cover");
					$update = "update artists set a_cover='$a_cover' where artist_id='$artist_id'";

					$run = mysqli_query($con, $update);

					if ($run) {
						echo "<script>alert('Your Cover Updated')</script>";
						echo "<script>window.open('profile.php?artist_id=$artist_id' , '_self')</script>";
					}
				}
			}

			?>
		</div>
		
		<?php
		if (isset($_POST['update'])) {

			$a_image = $_FILES['a_image']['name'];
			$image_tmp = $_FILES['a_image']['tmp_name'];
			$random_number = rand(1, 100);

			if ($a_image == '') {
				echo "<script>alert('Please Select Profile Image on clicking on your profile image')</script>";
				echo "<script>window.open('profile.php?artist_id=$artist_id' , '_self')</script>";
				exit();
			} else {
				move_uploaded_file($image_tmp, "artists/$a_image.$random_number");
				$update = "update artists set a_image='$a_image.$random_number' where artist_id='$artist_id'";

				$run = mysqli_query($con, $update);

				if ($run) {
					echo "<script>alert('Your Profile Updated')</script>";
					echo "<script>window.open('profile.php?artist_id=$artist_id' , '_self')</script>";
				}
			}

		}
		?>
		
		<div class="col-sm-2">
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-2">
		</div>
		<div class="col-sm-8" style="background-color: #fcf4e8;text-align: center;left: 0,5%;bottom: 110px;border-radius: 5px;">
			<?php
			echo "
			<center><h2><strong>About</strong></h2></center>
			<center><h4><strong>$first_name $last_name</strong></h4></center>
			<p><strong><i style='color:grey;'>$describe_artist</i></strong></p><br>
			<p><strong>E-Mail: </strong> $artist_email</p><br>
			<p><strong>Specialization: </strong> $artist_specialization</p><br>
			<p><strong>Studies: </strong> $artist_studies</p><br>
			<p><strong>Member Since: </strong> $register_date</p><br>
			<p><strong>Gender: </strong> $artist_gender</p><br>
			<p><strong>Date of Birth: </strong> $artist_birthday</p><br>
		" ;
		
			?>
			
		</div>
		</div>
		<div>

		</div>
		<!-- artists post -->
		<div>
			<?php
			
			echo"<center> <a href='profile_art.php?artist_id=$artist_id' class='btn btn-primary btn-lg'/>Art Pieces</a></center><br><br>"; 
			
			global $con;
			if (isset($_GET['artist_id'])) {
				$artist_id = $_GET['artist_id'];
			}
			
			$get_posts = "select * from posts where artist_id = '$artist_id' order by 1 desc limit 5";

			$run_posts = mysqli_query($con, $get_posts);
			while ($row_posts = mysqli_fetch_array($run_posts)) {

				$post_id = $row_posts['post_id'];
				$artist_id = $row_posts['artist_id'];
				$content = $row_posts['post_content'];
				$upload_image = $row_posts['upload_image'];
				$post_date = $row_posts['post_date'];

				$artist = "select * from artists where artist_id='$artist_id' and posts='yes'";

				$run_artist = mysqli_query($con, $artist);
				$row_artist = mysqli_fetch_array($run_artist);

				$artist_name = $row_artist['a_name'];

				$artist_firstname = $row_artist['a_first_name'];$artist_lastname = $row_artist['a_last_name'];
				$artist_image = $row_artist['a_image'];

				
						

				if ($content == "No" && strlen($upload_image) >= 1) {
					echo "
			<div id='own_post'>
			<div class='row'>
			<div class='col-sm-12'>
			<p><img src='artists/$artist_image' class='img-circle' width='100px' height='100px'></p>
			</div>
			<div class='col-sm-4'>
			<h3><a style='text-decoration:none; cursor:pointer;color: #996633;' href='artist_page.php?artist_id=$artist_id'>$artist_firstname $artist_lastname</a></h3>
			<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
			</div>
			<div class='col-sm-4'>
			</div>
			</div>
			<div class='row>
			<div class='col-sm-2'>
			<center><img id='posts-img' src='imagepost/$upload_image' style='height:60%; width:60%;'></center>
			</div>
			<br>
			<div class='col-sm-11'>
			<a href='single_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a>
			<a href='functions/delete_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-danger'>Delete</button></a><br>
			<br>
			</div><br><br></div> 
			</div><br><br><br>
			";
				} else if (strlen($content) >= 1 && strlen($upload_image) >= 1) {
					echo "
			<div id='own_post'>
			<div class='row'>
			<div class='col-sm-12'>
			<p><img src='artists/$artist_image' class='img-circle' width='100px' height='100px'></p>
			</div>
			<div class='col-sm-4'>
			<h3><a style='text-decoration:none; cursor:pointer;color: #996633;' href='artist_page.php?artist_id=$artist_id'>$artist_firstname $artist_lastname</a></h3>
			<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
			</div>
			<div class='col-sm-4'>
			</div>
			</div>
			<div class='row>
			<div class='col-sm-2>
			<h3><p>$content</p></h3>
			<center><img id='posts-img' src='imagepost/$upload_image' style='height:60%; width:60%;'></center>
			</div>
			<br>
			<div class='col-sm-11'>
			<a href='single_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a>
			<a href='edit_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Edit</button></a>
			<a href='functions/delete_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-danger'>Delete</button></a><br>
			<br><br>
			</div><br><br></div> 
			</div><br><br><br>
			";
				} else {
					echo "
			<div id='own_post'>
			<div class='row'>
			<div class='col-sm-12'>
			<p><img src='artists/$artist_image' class='img-circle' width='100px' height='100px'></p>
			</div>
			<div class='col-sm-4'>
			<h3><a style='text-decoration:none; cursor:pointer;color: #996633;' href='artist_page.php?artist_id=$artist_id'>$artist_firstname $artist_lastname</a></h3>
			<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
			</div>
			<div class='col-sm-4'>
			</div>
			</div>
			<div class='row>
			<div class='col-sm-2'>
			<h3><p>$content</p></h3>
			</div>
			<br>
			<div class='col-sm-11'>
			<a href='single_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a>
			<a href='edit_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Edit</button></a>
			<a href='functions/delete_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-danger'>Delete</button></a><br>
			<br>
			</div><br><br></div> 
			</div><br><br><br>
			";
				}


				include("functions/delete_post.php");
			}
			?>
		</div>
		<div class='col-sm-2'>

		</div>
	
</body>

</html>