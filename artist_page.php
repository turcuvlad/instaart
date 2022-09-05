<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['a_email'])){
    include("includes/header.php");
    }else
    if(isset($_SESSION['u_email'])){
        include("includes/header_user.php");
        }
/*
if(!isset($_SESSION['a_email'])){
	header("location: index.php");
}
*/
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
<style>
    body {background-color: #f2e6d9;}

#own_post{
    border: 5px solid #DEB887;
    padding: 70px 90px;
    width:90%;
}
#posts_img{
    height: 45%;
    width: 45%;
}
</style>
<body>
<div class="row">
    <?php
    
if(isset($_GET['artist_id'])){
    $artist_id = $_GET['artist_id'];
}
if($artist_id<0 || $artist_id ==""){
    echo "<script>alert('!!Error!!')</script>";
  echo"<script>window.open('home.php','_self')</script>";
}else{
	?>
    <div class="col-sm-12">
    <?php
    if(isset($_GET['artist_id'])){
    global $con;
    $artist_id = $_GET['artist_id'];

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
			//$artist_cover = $row['a_cover'];
			$register_date = $row['a_registration_date'];
            $artist_studies = $row['a_studies'];
echo"

     <div class='col-sm-1'></div>
     <center>
     <div style='background-color: #DEB887;' class='col-sm-3'>
     <h2>Information: </h2>
     <img  src='artists/$artist_image' class='img-circle' width='150px' height='150px'>
     <br><br>
     <ul class='list-group'>

    

     <li class='list-group-item' title='Name'><strong>$first_name $last_name</strong</li>
     <li class='list-group-item' title='Description'><strong>$describe_artist</strong</li>
     <li class='list-group-item' title='EMail'><strong>$artist_email</strong</li>
     <li class='list-group-item' title='Specialization'><strong>$artist_specialization</strong</li>
     <li class='list-group-item' title='Gender'><strong>$artist_gender</strong</li>
     <li class='list-group-item' title='Studies:'><strong>$artist_studies</strong</li>
     </ul>

"; //nu e inchis intentionat..
$artist=$_SESSION['a_email'];
$get_artist="select * from artists where a_email='$artist'";

$run_artist=mysqli_query($con, $get_artist);
$row=mysqli_fetch_array($run_artist);
//din search
$artist_own_id=$row['artist_id']; //id-ul meu

if($artist_id == $artist_own_id){
echo"<a href='edit_account.php?artist_id=$artist_own_id' class='btn btn-success'/>Edit Profile</a><br><br><br>";
}

$check_art = "select * from art_pieces where artist_id='$artist_id'";
		$run_check_art = mysqli_query($con, $check_art);

		$check = mysqli_num_rows($run_check_art);

		if($check >= 1){
echo"<a href='artist_artwork.php?artist_id=$artist_id' class='btn btn-warning'/>Artwork</a><br><br><br>";}


$artist2 = "select * from artists where a_specialization='$artist_specialization' and posts='yes' and artist_id!='$artist_id' order by rand()  limit 1";

$run_artist2 = mysqli_query($con, $artist2);
$row_artist2 = mysqli_fetch_array($run_artist2);
$check_artist2 = mysqli_num_rows($run_artist2);
if($check_artist2>0){
$artist_id2=$row_artist2['artist_id'];
$first_name2=$row_artist2['a_first_name'];
$last_name2=$row_artist2['a_last_name'];


echo"<br><br>
<h4>More like $first_name $last_name</h4>

<a style='text-decoration: none; cursor: pointer; color: #987918
				   'href ='artist_page.php?artist_id=$artist_id2'>
				   <strong><h4>$first_name2  $last_name2 </h4></strong>
				   </a>
                   <br>
";
        }
//acum se inchide
echo"</div></center>";
}

    ?>

<div class="col-sm-8">
       <h1><strong><?php echo  "$first_name $last_name"; ?></strong>'s Posts</h1>
       
       <?php
       global $con;

       if(isset($_GET['artist_id'])){
        $artist_id = $_GET['artist_id'];
       }

       $get_posts = "select * from posts where artist_id='$artist_id' ORDER by 1 DESC LIMIT 5";
       $run_posts= mysqli_query($con, $get_posts);
       echo" <br>";
       while( $row_posts = mysqli_fetch_array($run_posts)){
            $post_id=$row_posts['post_id'];
            $p_artist_id=$row_posts['artist_id'];
            $content=$row_posts['post_content'];
            $upload_image=$row_posts['upload_image'];
            $post_date=$row_posts['post_date'];

            $artist="select * from artists where artist_id='$p_artist_id' and posts='yes'";
            $run_artist=mysqli_query($con, $artist); //2
            $row_artist = mysqli_fetch_array($run_artist);


            $first_name = $row_artist['a_first_name']; 
			$last_name = $row_artist['a_last_name'];
            $artist_image = $row_artist['a_image'];

           echo" <br> <div>";

            if ($content == "No" && strlen($upload_image) >= 1) {
                echo"
                <div id='own_post'>
                    <div class='row'>
                        <div class='col-sm-12'>
                            <p><img src='artists/$artist_image' class='img-circle' width='100px' height='100px'><p>
                        </div>
                        <div class='col-sm-4'>
                            <h3><a style='text-decoration: none; cursor: pointer; color: #996633;' href='artist_page.php?artist_id=$p_artist_id'>$first_name $last_name</a></h3>
                            <h4><small style='color: black;'>Updated a post on $post_date <small></h4>
                        </div>
                        <div class='col-sm-4'>
                        </div>
                    </div>
                    <div class='row'>
                        
                    <center><img id='posts-img' src='imagepost/$upload_image' style='height: 100%; width: 100%;'><center>
                        
                    </div><br>
                    <div class='col-sm-12'>
                    <a href='single_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-warning'>View</button></a>
                    </div>
                </div><br><br>
                ";


            }
  
            else if (strlen($content) >= 1 && strlen($upload_image) >= 1) {
                echo "
        <div id='own_post'>
        <div class='row'>
        <div class='col-sm-12'>
        <p><img src='artists/$artist_image' class='img-circle' width='100px' height='100px'></p>
        </div>
        <div class='col-sm-4'>
        <h3><a style='text-decoration:none; cursor:pointer;color: #996633;' href='artist_page.php?artist_id=$p_artist_id'>$first_name $last_name</a></h3>
        <h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
        </div>
        <div class='col-sm-4'>
        </div>
        </div>
        <div class='row>
        <div class='col-sm-2>
        <h3><p>$content</p></h3>
        <center><img id='posts-img' src='imagepost/$upload_image' style='height: 80%; width: 80%;'><center>
        </div>
        <br>
        <div class='col-sm-12'>
        <a href='single_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-warning'>View</button></a>

        <br><br>
        </div><br><br></div> 
        </div><br><br><br>
        ";
            }
            else {
                echo "
        <div id='own_post'>
        <div class='row'>
        <div class='col-sm-12'>
        <p><img src='artists/$artist_image' class='img-circle' width='100px' height='100px'></p>
        </div>
        <div class='col-sm-4'>
        <h3><a style='text-decoration:none; cursor:pointer;color: #996633;' href='artist_page.php?artist_id=$p_artist_id'>$first_name $last_name</a></h3>
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
        <div class='col-sm-10'>
        <a href='single_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-warning'>View</button></a>
        </div>
        <br>
        </div><br><br></div> 
        ";
            }

       }
       ?>
 
</div>

</div>
</div>
<?php } ?>
</body>
</html>