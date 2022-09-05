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

    
    <!--  jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

  

</head>

<script>
    
    $(document).ready(function() {
        var date_input = $('input[name="art_date"]'); //our date input has the name "date"
        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
        var options = {
            format: 'yyyy/mm/dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        };
     //   date_input.datepicker(options);
    })
</script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $(function() {
        $("#status").click(function() {
            if ($(this).is(":checked")) {
                $("#price").removeAttr("disabled");
                $("#price").focus();
                $("#currency").removeAttr("disabled");
                $("#currency").focus();
            } else {
                $("#price").attr("disabled", "disabled");
                $("#currency").attr("disabled", "disabled");
            }
        });
    });
</script>
<script>
    function myFunction() {
        var x = document.getElementById("status").checked;
        document.getElementById("demo").innerHTML = x;
    }
</script>
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


    .center {
        margin: auto;
        width: 60%;
        border: 3px solid #DEB887;
        padding: 10px;
    }
</style>

<body>
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
		";

            ?>

        </div>
    </div>
    <!-- artists art -->
    <div>
        <?php
        global $con;
        if (isset($_GET['artist_id'])) {
            $artist_id = $_GET['artist_id'];
        }

        echo "<center> <a href='profile.php?artist_id=$artist_id' class='btn btn-primary btn-lg'/>Posts</a></center><br><br>";

        ?>
     
        <div class="center" style="background-color: #fcf4e8;">
            <center>
                <h2>insert your latest work</h2>
            </center>
            <div class="l-part">
                <form action=" " method="post" enctype="multipart/form-data">
                    <h4>Title</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                        <input type="text" class="form-control" placeholder="Title" name="title" required="required">
                    </div><br>
                    <h4>Description:</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                        <input type="text" class="form-control" placeholder="Description: working methods, fomat, motivation etc." name="description" required="required">
                    </div><br>
                    <h4>Finish Date</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        <input type="date" class="form-control datepicker" placeholder="date" name="art_date" required="required">
                    </div><br>
                    <h4>Status</h4>
                    <div class="input-group">
                        <!--	<span class="input-group-addon"><i class="glyphicon glyphicon-check"></i></span> -->
                        <h5> Is it available?
                            <input type="checkbox" id="status" name="status" /></p>
                        </h5>

                    </div><br>
                    <div id="form_div" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                        <input id="price" type="number" class="form-control" placeholder="price" name="price" required="required" disabled="disabled">

                    </div><br>


                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-euro"></i></span>
                        <select id="currency" class="form-control input-md" placeholder="currency" name="currency" required="required" disabled="disabled">>
                            <option disabled>Select your currency</option>
                            <option>RON</option>
                            <option>EURO</option>
                            <option>DOLLAR</option>
                        </select>

                    </div><br>

                    <div class="input-group">
                       <span class="input-group-addon"><i class="glyphicon glyphicon-check"></i></span>    

                        <label class="btn btn-warning"  style="text-align: center;color: white; width: 100%; text-align: center;">Select Image
                            <input type="file" id="image" name="image" size="30"  accept="image/png, image/jpeg">
                        </label>
                    </div>

                    <br><br>
                    <center> <button id="btn-post-art" class="btn btn-warning" name="subArt" style="min-width: 25%;max-width: 25%;">Post</button></center><br>
                  
                </form>
                
                <?php 
                
                if( empty($_POST["status"]) ) { insertUnavailableArt(); }
                else { insertArt(); }
                
                
                
              //  insertArt(); ?>


            </div><br><br>

            </div>

        
    

<div>
<?php

            global $con;
			if (isset($_GET['artist_id'])) {
				$artist_id = $_GET['artist_id'];
			}
			
			$get_art = "select * from art_pieces where artist_id = '$artist_id' order by 1 desc ";

			$run_art = mysqli_query($con, $get_art);
			while ($row_art = mysqli_fetch_array($run_art)) {

				$art_id = $row_art['art_id'];
				$artist_id = $row_art['artist_id'];
				$title = $row_art['title'];
				$description = $row_art['description'];
				$art_date = $row_art['art_date'];
                $status = $row_art['status'];
                $price = $row_art['price'];
                $currency = $row_art['currency'];
                $image = $row_art['image'];
                $author = $row_art['author'];

				$artist = "select * from artists where artist_id='$artist_id' ";

				$run_artist = mysqli_query($con, $artist);
				$row_artist = mysqli_fetch_array($run_artist);
				$artist_firstname = $row_artist['a_first_name'];$artist_lastname = $row_artist['a_last_name'];
				
                
                echo "<br><br>
                <center>
                <div class='container'>
                <div class='card' style='width:50%; background-color: #fcf4e8' >
                
                  <img class='card-img-top' src='imageart/$image' style='width:100%'>
                <center>  <div class='card-body' '>
                    <h4 class='card-title'>$title</h4>
                    <p class='card-text'>$description</p>
                    <h5><strong>$status</strong></h5>
                    <a href='art.php?art_id=$art_id' style='float:right;'><button class='btn btn-info'>See more</button></a><br><br>
                    
                  </div> <center>
                </div>
              </div>
            </center><br><br><br>
			" ;}
       //     <a href='art.php?art_id=$art_id'   class='btn btn-primary stretched-link'>See more:</a>

        ?> 
</div>

    </div>
    <div class='col-sm-2'>

    </div>

</body>
</html>