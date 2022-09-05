<!DOCTYPE html>
<?php


session_start();
if(isset($_SESSION['a_email'])){
    include("includes/header.php");
    }
    if(isset($_SESSION['u_email'])){
        include("includes/header_user.php");
        }



 function make_slides($con, $get_art){
            $output = '';
            $count = 0;

            
            $run_art = mysqli_query($con, $get_art);    
		while ($row_art = mysqli_fetch_array($run_art)) {

				$art_id = $row_art['art_id'];
				$title = $row_art['title'];
				$description = $row_art['description'];
				$art_date = $row_art['art_date'];
                $status = $row_art['status'];
                $price = $row_art['price'];
                $currency = $row_art['currency'];
                $image = $row_art['image'];
               
			
            if($count == 0)
  {
   $output .= '<div class="item active">';
  }
  else
  {
   $output .= '<div class="item">';
  }

  if($status=='unavailable' && isset($_SESSION['u_email'])){
  $output .= ' <h2 style=" font-weight: bold;">'.$title.'</h2> 
  

  <center>     <img  class="resize" src="imageart/'.$image.'" alt="'.$title.'" />  </center> 
   <div class="carousel-caption">
    
   </div>
   <h3 >'.$description.'</h3>
   <h5 style="color:AntiqueWhite;">'.$status.'</h5>
   <div class="col-lg-12" style="text-align:center">  
   </div>
   <br><br>
  </div>
  
  ';
  }
  else if($status=='available' && isset($_SESSION['u_email'])){


    $output .= ' <h2 style=" font-weight: bold;">'.$title.'</h2> 
  
  <a href="interest.php?art_id='.$art_id.'" ><button class="btn btn-warning">interested in buying</button></a><br><br>
  <center>     <img  class="resize" src="imageart/'.$image.'" alt="'.$title.'" />  </center> 
   <div class="carousel-caption">
    
   </div>
   <h3 >'.$description.'</h3>
   <h5 style="color:AntiqueWhite;">'.$status.'</h5>
   <h5 style="color:AntiqueWhite;">'.$price.' '.$currency.'</h5>
   <div class="col-lg-12" style="text-align:center">  
   </div>
   <br><br>
  </div>
  
  ';
  }
  if($status=='unavailable' && isset($_SESSION['a_email'])){
    $output .= ' <h2 style=" font-weight: bold;">'.$title.'</h2> 
    
    <br><br>
    <center>     <img  class="resize" src="imageart/'.$image.'" alt="'.$title.'" />  </center> 
     <div class="carousel-caption">
      
     </div>
     <h3 >'.$description.'</h3>
     <h5 style="color:AntiqueWhite;">'.$status.'</h5>
     <div class="col-lg-12" style="text-align:center">  
     </div>
     <br><br>
    </div>
    
    ';
    }
    else if($status=='available' && isset($_SESSION['a_email'])){
      $output .= ' <h2 style=" font-weight: bold;">'.$title.'</h2> 
    
    <br><br>
    <center>     <img  class="resize" src="imageart/'.$image.'" alt="'.$title.'" />  </center> 
     <div class="carousel-caption">
      
     </div>
     <h3 >'.$description.'</h3>
     <h5 style="color:AntiqueWhite;">'.$status.'</h5>
     <h5 style="color:AntiqueWhite;">'.$price.' '.$currency.'</h5>
     <div class="col-lg-12" style="text-align:center">  
     </div>
     <br><br>
    </div>
    
    ';
    }
  $count = $count + 1;
 }
 return $output;
        }

function make_slides_indicators($con, $get_art){
            $output = '';
            $count = 0;

            
            $run_art = mysqli_query($con, $get_art);    
		while ($row_art = mysqli_fetch_array($run_art)) {
			
			
            if($count == 0){
                $output .= '
                <li data-target="#dynamic_slide_show" data-slide-to="'.$count.'" class="active"> </li>
                ';
            }
            else
            {
                $output .= '
                <li data-target="#dynamic_slide_show" data-slide-to="'.$count.'" > </li>
                ';
            }
            $count = $count+1;
   
        }   
               return $output;
        }   


?>
<html>
<head>
	
	<title>Find artists</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">


    
</head>

<div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>

<style>


.bg {
  animation:slide 3s ease-in-out infinite alternate;
  background-image: linear-gradient(-60deg, #DDA0DD 50%, #6A5ACD 50%);
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

.resize {
    width: auto;
    height: 600px;
}
    #cover-img {
        height: 400px;
        width: 80%;
        background-size: cover;
    }

    #profile-img {
        position: absolute;
        top: 70px;
        left: 40px;
    }


    .center {
        margin: auto;
        width: 60%;
        border: 3px solid #DEB887;
        padding: 10px;
    }




.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 65%;
  height: 45%;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}
</style>



<body>
<div class="row">
    <?php
   
if(isset($_GET['artist_id'])){
    $artist_id = $_GET['artist_id'];
}
if(isset($_SESSION['a_email']) && ($artist_id<0 || $artist_id =="")){
    echo "<script>alert('!!Error!!')</script>";
  echo"<script>window.open('home.php','_self')</script>";
}else{
	?>
    <div class="col-sm-12">
    <?php
    if(isset($_GET['artist_id'])){
    global $con;
    $artist_id = $_GET['artist_id'];
 //id-ul artistului cu lucrari
    $query = "select * from artists where artist_id='$artist_id'";
    $run = mysqli_query($con, $query );
    $row = mysqli_fetch_array($run);

    $first_name=$row['artist_first_name'];
    $last_name=$row['artist_last_name'];
}

    ?>
<?php
if(isset($_GET['artist_id'])){
    global $con;
    $artist_id = $_GET['artist_id'];

    $query = "select * from artists where artist_id='$artist_id'";
    $run = mysqli_query($con, $query );
    $row = mysqli_fetch_array($run);

            $artist_id = $row['artist_id']; 
			
			$first_name = $row['a_first_name'];
			$last_name = $row['a_last_name'];
			$describe_artist = $row['describe_artist'];
			
			$artist_email = $row['a_email'];
			$artist_specialization = $row['a_specialization'];
			$artist_gender = $row['a_gender'];
			$artist_birthday = $row['a_birthday'];
			$artist_image = $row['a_image'];
			$artist_cover = $row['a_cover'];
			$register_date = $row['a_registration_date'];
            $artist_studies = $row['a_studies'];
echo"

<div>
<center><div><img id='cover-img' class='img-rounded' src='cover/$artist_cover' alt='cover'></div></center>
<form action='profile.php?artist_id=$artist_id' method='post' enctype='multipart/form-data'>

</form>
</div>
</div><br>

"; //nu e inchis intentionat..
$artist=$_SESSION['a_email'];
$get_artist="select * from artists where a_email='$artist'";

$run_artist=mysqli_query($con, $get_artist);
$row=mysqli_fetch_array($run_artist);
//din search
$artist_own_id=$row['artist_id']; //id-ul meu

//acum se inchide
echo"</div></center>";
echo "
<div class='title'>
 <h1 style:'text-align: center;'>$first_name  $last_name's <br/>PORTFOLIO</h1>
</div>
";
}

    ?>
<style>
   
   @import url('https://fonts.googleapis.com/css?family=Montserrat');


.title {
  font-family: "Montserrat";
  text-align: center;
  color: #FFF;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 30vh;
  letter-spacing: 1px;
}

h1 {
  background-image: url(https://media.giphy.com/media/wt72BXzU305Lq/giphy.gif);
  background-size: cover;
  color: transparent;
  -moz-background-clip: text;
  -webkit-background-clip: text;
  background-clip: text;
  text-transform: uppercase;
  font-size: 100px;
  line-height: .75;
  margin: 5px 0;
  text-align: center;
}
/* styling my button */

.white-mode {
  text-decoration: none;
  padding: 7px 10px;
  background-color: #122;
  border-radius: 3px;
  color: #FFF;
  transition: .35s ease-in-out;
  position: absolute;
  left: 15px;
  bottom: 15px;
  font-family: "Montserrat";
}

.white-mode:hover {
  background-color: #FFF;
  color: #122;
}

   
</style>

<?php

            global $con;
           
			if (isset($_GET['artist_id'])) {
				$artist_id = $_GET['artist_id'];
			}

            
			
			$get_art = "select * from art_pieces where artist_id = '$artist_id' order by 1 desc  ";

			$run_art = mysqli_query($con, $get_art);
		
            
       
        ?> 
       
    <center> 
    <div class="card bg-secondary text-white">
     <div id="dynamic_slide_show" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
            <?php echo make_slides_indicators($con, $get_art) ?>
            </ol>

            <div class="carousel-inner">
     <?php echo make_slides($con, $get_art); ?>
    </div>
    <a class="left carousel-control" href="#dynamic_slide_show" data-slide="prev">
     <span class="glyphicon glyphicon-chevron-left"></span>
     <span class="sr-only">Previous</span>
    </a>

    <a class="right carousel-control" href="#dynamic_slide_show" data-slide="next">
     <span class="glyphicon glyphicon-chevron-right"></span>
     <span class="sr-only">Next</span>
    </a>
            </div>
            
  </div>
  </center> 


</div>
</div>
<br><br>
<?php 

}
  ?>
</body>
</html>