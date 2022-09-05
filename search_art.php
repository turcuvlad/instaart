<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['a_email'])){
include("includes/header.php");
} else
if(isset($_SESSION['u_email'])){
    include("includes/header_user.php");
    }
    
/* 
if(!isset($_SESSION['a_email']) || !isset($_SESSION['u_email']) ){
	header("location: index.php");
}
*/
?>
<html>
<div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>

<style>


.bg {
  animation:slide 3s ease-in-out infinite alternate;
  background-image: linear-gradient(-60deg, #FFFAFA 50%, #FFF5EE 50%);
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
</style>
<head>

	
	<title>Find art</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<body>
<div class="row">
    <div class="col-sm-12">
        <center><h2>Find New Art Pieces by descriprion</h2></center><br><br>
<div class="row">
<div class="col-sm-12">
    <center>
   
        <form class="search_form" actions="">
            <input type="text" placeholder="search by Topic" name="search_art">
            <button class="btn btn-info" type="submit" name="search_art_btn">Search</button>
        </form>
        </div>
	 </center>
    <div class="col-sm-4">
    </div>
</div> <br><br>
<?php search_art(); ?>
    </div>
	
</div>

</body>
</html>