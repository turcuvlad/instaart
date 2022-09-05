<?php
include("includes/connection.php");
include("functions/functions.php");
?>

<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="home.php">InstaArt</a>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	      	
	      	<?php 
			$artist = $_SESSION['a_email'];
			$get_artist = "select * from artists where a_email='$artist'"; 
			$run_artist = mysqli_query($con,$get_artist);
			$row=mysqli_fetch_array($run_artist);
					
			$artist_id = $row['artist_id']; 
			$artist_name = $row['a_name'];
			$first_name = $row['a_first_name'];
			$last_name = $row['a_last_name'];
			$describe_artist = $row['describe_artist'];
			$artist_pass = $row['a_pass'];
			$artist_email = $row['a_email'];
			$artist_specialization = $row['a_specialization'];
			$artist_gender = $row['a_gender'];
			$artist_birthday = $row['a_birthday'];
			$artist_image = $row['a_image'];
			$artist_cover = $row['a_cover'];
			$register_date = $row['a_registration_date'];
            $artist_studies = $row['a_studies'];
					
					
			$artist_art = "select * from art_pieces where artist_id='$artist_id'"; 
			$run_art = mysqli_query($con,$artist_art); 
			$art = mysqli_num_rows($run_art);
			?>

	        <li><a href='profile.php?<?php echo "artist_id=$artist_id" ?>'><?php echo "$first_name"; ?></a></li>
	     
			<li><a href="artists.php">Find Artists</a></li>
			


					<?php
						echo"

						<li class='dropdown'>
							<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><span><i class='glyphicon glyphicon-chevron-down'></i></span></a>
							<ul class='dropdown-menu'>
								<li>
									<a href='profile_art.php?artist_id=$artist_id'>My Art  <span class='badge badge-secondary'>$art</span></a>
								</li>
								<li role='separator' class='divider'></li>
								<li>
									<a href='edit_account.php?artist_id=$artist_id'>Edit Account</a>
								</li>
								<li>
									<a href='change_pass.php?artist_id=$artist_id'>Change Password</a>
								</li>
								<li role='separator' class='divider'></li>
								<li>
									<a href='logout.php'>Logout</a>
								</li>
							</ul>
						</li>
						";
					?>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<form class="navbar-form navbar-left" method="get" action="results.php">
						<div class="form-group">
							<input type="text" class="form-control" name="artist_query" placeholder="Search">
						</div>
						<button type="submit" class="btn btn-info" name="search">Search</button>
					</form>
				</li>
			</ul>
		</div>
	</div>
</nav>