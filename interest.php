<!DOCTYPE html>
<?php
session_start();


    if(isset($_SESSION['u_email'])){
        include("includes/header_user.php");
        }

?>
<html>
    <head>
        <title>Artwork</title>
        <meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">

    </head>

    <body>

  <?php  
    if (isset($_GET['art_id'])) {
		global $con;
		$get_id = $_GET['art_id'];
		$get_art = "select * from art_pieces where art_id='$get_id'";
		$run_art = mysqli_query($con, $get_art);
		$row_art = mysqli_fetch_array($run_art);
		$art_id = $row_art['art_id'];
		$artist_id = $row_art['artist_id'];
		$title = $row_art['title'];
		$image = $row_art['image'];
		$author = $row_art['author'];
        $description = $row_art['description'];
        $status = $row_art['status'];
        $price = $row_art['price'];
        $currency = $row_art['currency'];
        $art_date = $row_art['art_date'];




		$get_interest = "select * from activity where user_id='$user_id' and art_id='$get_id'";
		$run_activity = mysqli_query($con, $get_interest);
		$row_activity = mysqli_fetch_array($run_activity);
		$u_id = $row_activity['user_id'];
		$art2_id = $row_activity['art_id'];
		$status2 = $row_activity['status'];



		


		$artist = "select * from artists where artist_id='$artist_id'";

		$run_artist = mysqli_query($con, $artist);
		$row_artist = mysqli_fetch_array($run_artist);

        $artist_id= $row_artist['artist_id'];
		$artist_firstname = $row_artist['a_first_name'];
		$artist_lastname = $row_artist['a_last_name'];
		$artist_image = $row_artist['a_image'];



		$artist_com = $_SESSION['a_email'];
		$get_com = "select * from artists where a_email='$artist_com'";

		$run_com = mysqli_query($con, $get_com);
		$row_com = mysqli_fetch_array($run_com);

		$artist_com_id = $row_com['artist_id'];
		$artist_com_lastname = $row_com['a_last_name'];

		if (isset($_GET['art_id'])) {
			$art_id = $_GET['art_id'];
		}

		$get_posts = "select art_id from art_pieces where art_id='$art_id'";
		$run_artist = mysqli_query($con, $get_posts);

		$art_id = $_GET['art_id'];

		$art = $_GET['art_id'];
		$get_artist = "select * from art_pieces where art_id='$art'";
		$run_artist = mysqli_query($con, $get_artist);
		$row = mysqli_fetch_array($run_artist);

		$a_id = $row['art_id'];

		if ($a_id != $art_id) {
			echo "<script>alert('Error!')</script>";
			echo "<script>window.open('home.php','_self')</script>";
		} else {

		//	if ($status == "unavailable" ) {
				echo "
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
					<div class='row'>
						<div class='col-sm-2'>
						<p><img src='artists/$artist_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-6'>
							<h3><a style='text-decoration:none; cursor:pointer;color #996633;' href='artist_page.php?artist_id=$artist_id'>$artist_firstname $artist_lastname </a></h3>
							<h4><small style='color:black;'>finished on <strong>$art_date</strong></small></h4>
							<h4><small style='color:black;'>status: <strong>$status</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
							<center><img id='posts-img' src='imageart/$image' style='height:25%; width:25%'></center>
	
						</div>
					</div><br>
					<div class='row'>
						<div class='col-sm-12'>
							<center><h2>$title</h2></center>
	
						</div>
					</div><br>
                    <div class='row'>
                    <div class='col-sm-12'>
                        <center><h4>$description</h4></center>
                    </div>
                </div><br>

				<h1><$status</h1>
";
if($price!='0' && $status='available'){
echo "
                <div class='col-sm-12'>
                        <center><h4>$price $currency</h4></center>
                    </div>
					";
					echo "
                </div><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			

";}
else
{
	echo "
                <div class='col-sm-12'>
                        <center><h4>PRICE UNAVAILABLE</h4></center>
                    </div>
					";
					echo "
                </div><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br> ";
}

//$get_id   -->current art
//$art2_id  -->art from activities, might be NULL
if( $get_id!=$art2_id && $status2!='pending' && $status2!='Dispatched' && $status2!='Delivered' && $status!='unavailable'){
echo"


			<div class='row'>
            <div class='col-sm-3'>

            </div>
            <div class='col-sm-6'>
    <form action='' method='post' enctype='multipart/form-data'>
                <table class='table table-bordered'>
                    <center><h3>Announce $artist_firstname $artist_lastname that you are intrested to buy his artwork. $artist_firstname will contact you for a furher collaboration.</h3></center>
                    <tr align='center'>
                    <td colspan='8'>
                    <input type='submit' class='btn btn-danger' name='announce' style='width:250px'; value='Announce'>
                    </td>
                    </tr>
                  <br>
                  </table>

                  </form>
                </div>
            <div class='col-sm-3'>

            
        </div>
		</div><br><br><br>


			";}
			
			else if($get_id==$art2_id){
				echo"
			

			<div class='row'>
            <div class='col-sm-3'>

            </div>
            <div class='col-sm-6'>
    
                
                    <center><h3>You have already announced the artist about your interest!</h3></center>
                    
                </div>
            <div class='col-sm-3'>

            </div><br><br><br>
        </div>  </div><br><br><br>";
		
			}


			if(isset($_POST['announce'])){
				
		$check = "select * from activity where user_id='$user_id' and art_id='$art_id' and status!='Canceled by User'";
		$run_check = mysqli_query($con, $check);

		$check = mysqli_num_rows($run_check);

		if($check == 1){
			echo "<script>alert('Your have already announced that you are intrested in this!')</script>";
			echo "<script>window.open('home_user.php', '_self')</script>";
			exit();
		}
				
				$insert = "INSERT into activity (artist_id,user_id,status,date,art_id,price,currency, title, phone_user, email_user)
		values('$artist_id','$user_id','pending',NOW(),'$art_id','$price','$currency', '$title','$user_phone','$user_email')";
			
				$run=mysqli_query($con, $insert);
			
				if($run){
					echo"<script>alert('The artist was announced!')</script>";
					echo"<script>window.open('home_user.php' , '_self')</script>";
				}
			}



		//	} 
		}
	}


?>
    </body>

    
    
</html>