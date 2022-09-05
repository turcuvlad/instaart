<!DOCTYPE html>
<?php
session_start();


if(!isset($_SESSION['a_email'])){
	header("location: index.php");
}

$check_email=$_SESSION['a_email'];
if($check_email!='admin@instaart')
include("includes/header.php");
else include("includes/header_admin.php");

?>
<html>
	
	<style>

#content{
	width: 70%;
	background-color: rgb(255, 248, 231);
	border: 4px  goldenrod ;
}
#btn-post{
	min-width: 25%;
	max-width: 25%;
	background-color:rgb(255, 248, 231);
}
#insert_post{
	background-image: url("images/gold.jpg");
	object-fit: cover;
	border: 4px  goldenrod ;
	padding: 40px 50px;
}

.noselect {
  -webkit-touch-callout: none;
    -webkit-user-select: none;
     -khtml-user-select: none;
       -moz-user-select: none;
        -ms-user-select: none;
            user-select: none;
		-webkit-tap-highlight-color: transparent;
}

button {
	width: 150px;
	height: 50px;
	cursor: pointer;
	font-size: 20px;
	font-weight: bold;
	color: goldenrod;
	background: white;
	border: 2px goldenrod;
	box-shadow: 5px 5px 0 goldenrod,
		-5px -5px 0 goldenrod,
		-5px 5px 0 goldenrod,
		5px -5px 0 goldenrod;
	transition: 500ms ease-in-out;
}

button:hover {
	box-shadow: 20px 5px 0 goldenrod, -20px -5px 0 goldenrod;
}

button:focus {
	outline: none;
}


	  body{
   background-color: #000000;
   padding: 0px;
   margin: 0px;
 }

#gradient
{
  width: 100%;
  height: 500%;
  padding: 0px;
  margin: 0px;
}
	</style>

	<script>

var colors = new Array(
  [62,35,255],
  [60,255,60],
  [255,35,98],
  [45,175,230],
  [255,0,255],
  [255,128,0]);

var step = 0;
//color table indices for: 
// current color left
// next color left
// current color right
// next color right
var colorIndices = [0,1,2,3];

//transition speed
var gradientSpeed = 0.002;

function updateGradient()
{
  
  if ( $===undefined ) return;
  
var c0_0 = colors[colorIndices[0]];
var c0_1 = colors[colorIndices[1]];
var c1_0 = colors[colorIndices[2]];
var c1_1 = colors[colorIndices[3]];

var istep = 1 - step;
var r1 = Math.round(istep * c0_0[0] + step * c0_1[0]);
var g1 = Math.round(istep * c0_0[1] + step * c0_1[1]);
var b1 = Math.round(istep * c0_0[2] + step * c0_1[2]);
var color1 = "rgb("+r1+","+g1+","+b1+")";

var r2 = Math.round(istep * c1_0[0] + step * c1_1[0]);
var g2 = Math.round(istep * c1_0[1] + step * c1_1[1]);
var b2 = Math.round(istep * c1_0[2] + step * c1_1[2]);
var color2 = "rgb("+r2+","+g2+","+b2+")";

 $('#gradient').css({
   background: "-webkit-gradient(linear, left top, right top, from("+color1+"), to("+color2+"))"}).css({
    background: "-moz-linear-gradient(left, "+color1+" 0%, "+color2+" 100%)"});
  
  step += gradientSpeed;
  if ( step >= 1 )
  {
    step %= 1;
    colorIndices[0] = colorIndices[1];
    colorIndices[2] = colorIndices[3];
    
    //pick two new target color indices
    //do not pick the same as the current one
    colorIndices[1] = ( colorIndices[1] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length;
    colorIndices[3] = ( colorIndices[3] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length;
    
  }
}

setInterval(updateGradient,10);
	</script>


<head>
	<?php
		$artist = $_SESSION['a_email'];
		$get_artist = "select * from artists where a_email='$artist'";
		$run_artist = mysqli_query($con,$get_artist);
		$row = mysqli_fetch_array($run_artist);

		$artist_name = $row['a_name'];
	?>
	<title><?php echo "$artist_name"; ?></title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
	
	

<!-- button-->
<!--	<link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet">-->

</head>
<body>
<div id="gradient" >

<?php if($artist!='admin@instaart'){ ?>
<div class="row">
	<div id="insert_post" class="col-sm-12" style="border: 4px solid goldenrod ;">
		<center>
		<form action="home.php?id=<?php echo $artist_id; ?>" method="post" id="f" enctype="multipart/form-data">
		<textarea class="form-control" id="content" rows="4" name="content" placeholder="Any interesting news?"></textarea><br><br><br><br><br>
		<label class="btn btn-warning" id="upload_image_button">Select Image
		 <input type="file" name="upload_image" accept="image/png, image/jpeg" size="40"> 
		</label>
		<button id="btn-post" class="name noselect" name="subPost"><p style="font-family: Copperplate, Copperplate Gothic Light, fantasy; font-size: 25px;">POST</p></button>
		</form>
		
		<?php 
		insertPost(); ?>
		</center>
	</div>
</div>

<?php } ?>

<div class="row">
	<div class="col-sm-12">
	<center><h2 style="font-family: Copperplate, Copperplate Gothic Light, fantasy; font-size: 40px; "><strong>News Feed</strong></h2><br></center>
		<?php 
		if($artist!='admin@instaart')
		echo get_posts();
		else
		echo get_posts_for_admin();
		 ?>
	</div>
</div>
</div>


</body>
</html>