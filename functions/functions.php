<?php

$con = mysqli_connect("localhost", "root", "", "instaart") or die("Connection was not established");

//function for inserting post

function insertPost()
{
	if (isset($_POST['subPost'])) {
		global $con;
		global $artist_id;

		$content = htmlentities($_POST['content']);
		$upload_image = $_FILES['upload_image']['name'];
		$image_tmp = $_FILES['upload_image']['tmp_name'];
		$random_number = rand(1, 100);
        
		
		if (strlen($content) > 500) {   
			echo "<script>alert('Please Use 500 or less than 500 words!')</script>";
			echo "<script>window.open('home.php', '_self')</script>";
		} else {
			if (strlen($upload_image) >= 1 && strlen($content) >= 1) {
				move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");
				$insert = "insert into posts (artist_id, post_content, upload_image, post_date) values('$artist_id', '$content', '$upload_image.$random_number', NOW())";

				$run = mysqli_query($con, $insert);

				if ($run) {
					//echo "<script>alert('Your Post updated a moment ago!')</script>";
					//echo "<script>window.open('home.php', '_self')</script>";
					echo "<script>
			swal('Well Done,', 'Your Post updated a moment ago!', 'success')
            .then((value) => { 
			window.open('home.php', '_self')
            }); </script>";

					$update = "update artists set posts='yes' where artist_id='$artist_id'";
					$run_update = mysqli_query($con, $update);
				}

				exit();
			}
			
			else {
				if ($upload_image == '' && $content == '') {   
					echo "<script>alert('Error Occured while uploading!')</script>";
					echo "<script>window.open('home.php', '_self')</script>";
				} else {
					if ($content == '') {
						move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");
						$insert = "INSERT into posts (artist_id,post_content,upload_image,post_date) values ('$artist_id','No','$upload_image.$random_number',NOW())";
						$run = mysqli_query($con, $insert);

						if ($run) {
							//echo "<script>alert('Your Post updated a moment ago!')</script>";
							//echo "<script>window.open('home.php', '_self')</script>";
							echo "<script>
			swal('Well Done,', 'Your Post updated a moment ago!', 'success')
            .then((value) => { 
			window.open('home.php', '_self')
            }); </script>";

							$update = "update artists set posts='yes' where artist_id='$artist_id'";
							$run_update = mysqli_query($con, $update);
						}

						exit();
					} else {
						$insert = "insert into posts (artist_id, post_content, post_date) values('$artist_id', '$content', NOW())";
						$run = mysqli_query($con, $insert);

						if ($run) {
							echo "<script>
			swal('Well Done,', 'Your Post updated a moment ago!', 'success')
            .then((value) => { 
			window.open('home.php', '_self')
            }); </script>";
							//echo "<script>alert('Your Post updated a moment ago!')</script>";
							//echo "<script>window.open('home.php', '_self')</script>";

							$update = "update artists set posts='yes' where artist_id='$artist_id'";
							$run_update = mysqli_query($con, $update);
						}
					}
				}
			}
		}
	}
}

function get_posts()
{
	global $con;
	$per_page = 10;

	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = 1;
	}

	$start_from = ($page - 1) * $per_page;

	$get_posts = "select * from posts ORDER by 1 DESC LIMIT $start_from, $per_page";

	$run_posts = mysqli_query($con, $get_posts);

	while ($row_posts = mysqli_fetch_array($run_posts)) {

		$post_id = $row_posts['post_id'];
		$artist_id = $row_posts['artist_id'];
	//	$content = substr($row_posts['post_content'], 0, 40);
	$content = $row_posts['post_content'];
		$upload_image = $row_posts['upload_image'];
		$post_date = $row_posts['post_date'];

		$artist = "select *from artists where artist_id='$artist_id' AND posts='yes'";
		$run_artist = mysqli_query($con, $artist);
		$row_artist = mysqli_fetch_array($run_artist);

		$artist_name = $row_artist['a_name'];
		$artist_fname = $row_artist['a_first_name'];
		$artist_lname = $row_artist['a_last_name'];
		$artist_image = $row_artist['a_image'];

		//now displaying posts from database

		if ($content == "No" && strlen($upload_image) >= 1) {
			echo "
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6' style='background: rgb(255, 248, 231); border: 5px solid goldenrod; '>
					<div class='row'>
						<div class='col-sm-2'>
						<p><img src='artists/$artist_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-12'>
							<h3><a style='text-decoration:none; cursor:pointer;color: #daa520 ;' href='artist_page.php?artist_id=$artist_id'>$artist_fname $artist_lname</a></h3>
							<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
						<center><img id='posts-img' src='imagepost/$upload_image' style=' height:100%; width:100%'></center>
						</div>
					</div><br>
					<a href='single_post.php?post_id=$post_id' style='float:right; '><button class='btn btn-warning' >Comment</button></a>
					
					
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		} else if (strlen($content) >= 1 && strlen($upload_image) >= 1) {
			echo "
			<div class='row'>
				<div class='col-sm-3' '>
				</div>
				<div id='posts' class='col-sm-6' style='background: rgb(255, 248, 231); border: 5px solid goldenrod;'>
					<div class='row' >
						<div class='col-sm-2'>
						<p><img src='artists/$artist_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						
						<div class='col-sm-12' >
							<h3><a style='text-decoration:none; cursor:pointer;color: #daa520 ;' href='artist_page.php?artist_id=$artist_id'>$artist_fname $artist_lname</a></h3>
							<h4><small style='color: #6b6866;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
					<div class='col-sm-4'>
					</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
						<h4><p>$content</p></h4>
							<center><img id='posts-img' src='imagepost/$upload_image' style='height:100%; width:100%;'></center>
						</div>
					</div><br>
					<br><br><br><a href='single_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-warning'>Comment</button></a><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}
		//artist_prifle<--u
		else {
			echo "
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6' style='background: rgb(255, 248, 231); border: 5px solid goldenrod;'>
					<div class='row'>
						<div class='col-sm-2'>
						<p><img src='artists/$artist_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-12'>
							<h3><a style='text-decoration:none; cursor:pointer;color: #daa520 ;' href='artist_page.php?artist_id=$artist_id'>$artist_fname $artist_lname</a></h3>
							<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-18'>
							<h4><p>$content <p></h4>
						</div>
					</div><br>
					<a href='single_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-warning'>Comment</button></a><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}
	}

	include("paginator.php");
}

function single_post()
{
	if (isset($_GET['post_id'])) {
		global $con;
		$get_id = $_GET['post_id'];
		$get_posts = "select * from posts where post_id='$get_id'";
		$run_post = mysqli_query($con, $get_posts);
		$row_posts = mysqli_fetch_array($run_post);
		$post_id = $row_posts['post_id'];
		$artist_id = $row_posts['artist_id'];
		$content = $row_posts['post_content'];
		$upload_image = $row_posts['upload_image'];
		$post_date = $row_posts['post_date'];


		$artist = "select * from artists where artist_id='$artist_id' and posts='yes'";

		$run_artist = mysqli_query($con, $artist);
		$row_artist = mysqli_fetch_array($run_artist);

		$artist_lastname = $row_artist['a_last_name'];
		$artist_firstname = $row_artist['a_first_name'];
		$artist_image = $row_artist['a_image'];



		$artist_com = $_SESSION['a_email'];
		$get_com = "select * from artists where a_email='$artist_com'";

		$run_com = mysqli_query($con, $get_com);
		$row_com = mysqli_fetch_array($run_com);

		$artist_com_id = $row_com['artist_id'];
		$artist_com_lastname = $row_com['a_last_name'];
		$artist_com_firstname = $row_com['a_first_name'];

		if (isset($_GET['post_id'])) {
			$post_id = $_GET['post_id'];
		}

		$get_posts = "select post_id from posts where post_id='$post_id'";
		$run_artist = mysqli_query($con, $get_posts);



		$post_id = $_GET['post_id'];

		$post = $_GET['post_id'];
		$get_artist = "select * from posts where post_id='$post'";
		$run_artist = mysqli_query($con, $get_artist);
		$row = mysqli_fetch_array($run_artist);

		$p_id = $row['post_id'];

		if ($p_id != $post_id) {
			echo "<script>alert('Error!')</script>";
			echo "<script>window.open('home.php','_self')</script>";
		} else {

			if ($content == "No" && strlen($upload_image) >= 1) {
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
						<h3  ><a style='text-decoration:none; cursor:pointer;color: black;' href='artist_page.php?artist_id=$artist_id'>$artist_firstname $artist_lastname</a></h3>
							<h4 style=' background-color: goldenrod;><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
							<center><img id='posts-img' src='imagepost/$upload_image' style=' border: 3px solid goldenrod ; border-radius: 4px; padding: 5px; height:100%; width:100%'></center>
						</div>
					</div><br>
					
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
			} else if (strlen($content) >= 1 && strlen($upload_image) >= 1) {
				echo "
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
					<div class='row'>
						<div class='col-sm-2'>
						<p><img src='artists/$artist_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-3'>
							<h3  ><a style='text-decoration:none; cursor:pointer;color: black;' href='artist_page.php?artist_id=$artist_id'>$artist_firstname $artist_lastname</a></h3>
							<h4 style=' background-color: goldenrod; ><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
						<h3 style=' background-color: goldenrod;'>$content</h3>
						<center><img id='posts-img' src='imagepost/$upload_image' style=' border: 3px solid goldenrod ; border-radius: 4px; padding: 5px; height:100%; width:100%'></center>
						</div>
					</div><br>
					
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
			}
			//artist_prifle<--u
			else {
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
						<h3  ><a style='text-decoration:none; cursor:pointer;color: black;' href='artist_page.php?artist_id=$artist_id'>$artist_firstname $artist_lastname</a></h3>
						<h4 style=' background-color: goldenrod; ><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
					</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
						<h3 style=' background-color: goldenrod;'>$content</h3>
						</div>
					</div><br>
					
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			";
			} //else condition ending
			if($artist_id==$artist_com_id)
			echo"<div class='row'>
			<div class='col-md-6 col-md-offset-3'>
				<a href='functions/delete_post.php?post_id=$post_id ' style='text-align: right;float: right;'><button class='btn btn-danger'>Delete</button></a><br>
				</div>
				</div>
				<br><br>	
				";

			include("comments.php");

			echo "
		<div class='row'>
		<div class='col-md-6 col-md-offset-3'>
		<div class='panel panel-warning'>
		<div class='panel-body'>
		<form action='' method='post' class='form-inline'>
		<textarea placeholder='Write your comment...' class='pb-cmnt-textarea' name='comment'></textarea>
		<button class='btn btn-warning pull-right' name='reply'>Comment</button>
		</form>
		</div>
		</div>
		</div>
		</div>
		";
			if (isset($_POST['reply'])) {
				$comment = htmlentities($_POST['comment']);

				if ($comment == "") {
					echo "<script>alert('enter your comment')</script>";
					echo "<script>window.open('single_post.php?post_id=$post_id', '_self')</script>";
				} else {
					if($artist_com_id == $artist_id)
					$insert = "insert into comments (post_id, artist_id, comment, comment_author, date, author, user_id) values ('$post_id','$artist_com_id','$comment','$artist_com_firstname $artist_com_lastname',NOW(), 'yes', '0')";
					else $insert = "insert into comments (post_id, artist_id, comment, comment_author, date, author, user_id) values ('$post_id','$artist_com_id','$comment','$artist_com_firstname $artist_com_lastname',NOW(), '-', '0')";
					$run = mysqli_query($con, $insert);

					if($run)
					echo "<script>alert('comment added')</script>";
					echo "<script>window.open('single_post.php?post_id=$post_id', '_self')</script>";
				}
			}
		}
	}
}


function search_artist(){
	global $con; 

	if(isset($_GET['search_artist_btn'])){
		$search_query=htmlentities($_GET['search_artist']);
		$get_artist="select * from artists where a_email!='admin@instaart' and a_first_name like '%$search_query%' or a_email!='admin@instaart' and a_last_name like '%$search_query%' ORDER BY a_first_name DESC";
	}
	else{
		$get_artist="select * from artists where a_email!='admin@instaart' and posts='yes' ORDER BY RAND() LIMIT 5";
	}
	$run_artist = mysqli_query($con, $get_artist);
	while ($row_artist=mysqli_fetch_array($run_artist)){
		$artist_id=$row_artist['artist_id'];
		$first_name=$row_artist['a_first_name'];
		$last_name=$row_artist['a_last_name'];
		$artist_image =$row_artist['a_image'];

		echo"
		<center>
		


	
	    <div class='row' id='find_artist' style='border: 40px solid #eadbc8;'>
		    <div class='col-sm-12'>
			       <div class='col-sm-4>
			       <a href='artist_page.php?artist_id=$artist_id'>
			       <img src='artists/$artist_image' width='150px' height='150ox' title='$first_name ' style='float:left'; margin:auto; '/>
                   </a>
				   
				   
				   <div class='col-sm-10'>
				   <a style='text-decoration: none; cursor: pointer; color: #987918
				   'href ='artist_page.php?artist_id=$artist_id'>
				   
				   <strong><h2>$first_name </h2><h2> $last_name</h2></strong>
				   </a>
				   </div> 
				
			</div>
		</div>
	
	
	</center>
<br><br>
		";
	}
}
 
function insertArt(){
   if (isset($_POST['subArt'])) {
                    global $con;
                    global $artist_id;
            
                    $title = htmlentities($_POST['title']);
                    $description = htmlentities($_POST['description']);
                    $art_date = htmlentities($_POST['art_date']);
                    $price = htmlentities($_POST['price']);
                    $currency = htmlentities($_POST['currency']);
                    
                    $image = $_FILES['image']['name']; 
                    $image_tmp = $_FILES['image']['tmp_name'];
                    $random_number = rand(1, 100);
            
            
                    
            
                    $artist_com = $_SESSION['a_email'];
                    $get_com = "select * from artists where a_email='$artist_com'";
            
                    $run_com = mysqli_query($con, $get_com);
                    $row_com = mysqli_fetch_array($run_com);
            
                    $artist_com_lastname = $row_com['a_last_name'];
					$artist_com_firstname = $row_com['a_first_name'];
					$artist_com_level = $row_com['a_studies'];
            
                    if (strlen($image) < 1){echo "<script>alert('image not taken!!!')</script>";}
                   // if (strlen($description) > 250 || strlen($title) > 250) {   // bun
                   //     echo "<script>alert('Please Use 250 or less than 250 words!')</script>";
           //             echo "<script>window.open('home.php', '_self')</script>";
               //s     } 
					else {
                        if (strlen($image) >= 1 && strlen($description) >= 1 && strlen($title) >= 1 && strlen($price) >= 1 && strlen($currency) >= 1) {
                            move_uploaded_file($image_tmp, "imageart/$image.$random_number");
                            $insert = "insert into art_pieces (artist_id, title, description, image, art_date, price, currency, author, status, level) values('$artist_id', '$title', '$description', '$image.$random_number','$art_date', '$price', '$currency', '$artist_com_firstname $artist_com_lastname', 'available', '$artist_com_level')";
            
                            $run = mysqli_query($con, $insert);
            
                            if ($run) {
                                echo "<script>alert('Your Work updated a moment ago 1!')</script>";
                                echo "<script>window.open('profile_art.php', '_self')</script>";
            
                                
                            } else{
                                echo "<script>alert('error1')</script>";
                            }
            
                            exit();
                        }
                        else{
                            echo "<script>alert('error3')</script>";
                        }
                    }  
                }

			}

			function insertUnavailableArt(){
				if (isset($_POST['subArt'])) {
								 global $con;
								 global $artist_id;
						 
								 $title = htmlentities($_POST['title']);
								 $description = htmlentities($_POST['description']);
								 $art_date = htmlentities($_POST['art_date']);
							//	 $price = htmlentities($_POST['price']);
							//	 $currency = htmlentities($_POST['currency']);
								 
								 $image = $_FILES['image']['name']; 
								 $image_tmp = $_FILES['image']['tmp_name'];
								 $random_number = rand(1, 100);
						 
						 
								 
						 
								 $artist_com = $_SESSION['a_email'];
								 $get_com = "select * from artists where a_email='$artist_com'";
						 
								 $run_com = mysqli_query($con, $get_com);
								 $row_com = mysqli_fetch_array($run_com);
						 
								 $artist_com_lastname = $row_com['a_last_name'];
								 $artist_com_level = $row_com['a_studies'];
						 
								 if (strlen($image) < 1){echo "<script>alert('image not taken!!!')</script>";}
								 if (strlen($description) > 250 || strlen($title) > 250) {   // bun
									 echo "<script>alert('Please Use 250 or less than 250 words!')</script>";
						//             echo "<script>window.open('home.php', '_self')</script>";
								 } else {
									 if (strlen($image) >= 1 && strlen($description) >= 1 && strlen($title) >= 1 ) {
										 move_uploaded_file($image_tmp, "imageart/$image.$random_number");
										 $insert = "insert into art_pieces (artist_id, title, description, image, art_date, price, currency, author, status, level) values('$artist_id', '$title', '$description', '$image.$random_number','$art_date', '0', ' ', '$artist_com_lastname', 'unavailable', '$artist_com_level')";
						 
										 $run = mysqli_query($con, $insert);
						 
										 if ($run) {
											 echo "<script>alert('Your Work updated a moment ago 1!')</script>";
											 echo "<script>window.open('profile_art.php', '_self')</script>";
						 
											 
										 } else{
											 echo "<script>alert('error1')</script>";
										 }
						 
										 exit();
									 }
									 
									 else{
										 echo "<script>alert('error3')</script>";
									 }
								 }  
							 }
			 
						 }



function single_art()
{
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
        $title = $row_art['title'];
        $description = $row_art['description'];
        $status = $row_art['status'];
        $price = $row_art['price'];
        $currency = $row_art['currency'];
        $art_date = $row_art['art_date'];


		$artist = "select * from artists where artist_id='$artist_id'";

		$run_artist = mysqli_query($con, $artist);
		$row_artist = mysqli_fetch_array($run_artist);

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
							<h3><a style='text-decoration:none; cursor:pointer;color: #996633;' href='artist_page.php?artist_id=$artist_id'>$artist_firstname $artist_lastname </a></h3>
							<h4><small style='color:black;'>finished on <strong>$art_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-14'>
							<center><img id='posts-img' src='imageart/$image' style='height:50%; width:50%'></center>
	
						</div>
					</div><br>
					
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>





			<div class='row'>
            <div class='col-sm-3'>

            </div>
            <div class='col-sm-6'>
    <form action='' method='post' enctype='multipart/form-data'>
                <table class='table table-bordered'>
                    <center><h3>Edit :</h3></center>
                  <tr>
                   <td tyle='font-weight: bold;'>Change the title</td>
                   <td>
                       <input class='form-control' type='text' name='title' required value=' $title'>
                   </td>
                  </tr>
                  <tr>
                   <td tyle='font-weight: bold;'>Change the descriprion</td>
                   <td>
                       <input class='form-control' type='text' name='description' required value=' $description'>
                   </td>
				   
				   
				   <div class='input-group'>
						<span class='input-group-addon'><i class='glyphicon glyphicon-chevron-down'></i></span>
						<select class='form-control' name='a_specialization' required='required'>
							<option disabled>STATUS:</option>
							<option>available</option>
                            <option>unavailable</option>
						</select>
					</div>
					<div id='form_div' class='input-group'>
                        <span class='input-group-addon'><i class='glyphicon glyphicon-pencil'></i></span>
                        <input id='price' type='number' class='form-control' placeholder='price' name='price' required value='$price' >

                    </div>


                    <div class='input-group'>
                        <span class='input-group-addon'><i class='glyphicon glyphicon-euro'></i></span>
                        <select id='currency' class='form-control input-md' placeholder='currency' name='currency'  required='required' >
                            <option disabled>Select your currency</option>
                            <option>RON</option>
                            <option>EURO</option>
                            <option>DOLLAR</option>
                        </select>

                    </div>
					<br>
                  </tr>
                  
                  
                 
                  <tr align='center'>
                  <td colspan='8'>
                  <input type='submit' class='btn btn-info' name='update' style='width:250px'; value='Update'>
                  </td>
                  </tr>
				  <tr align='center'>
                  <td colspan='8'>
                  <input type='submit' class='btn btn-danger' name='delete' style='width:250px'; value='Delete'>
                  </td>
                  </tr>
                    </table>

                </form>

                </div>
            <div class='col-sm-3'>

            </div>
        </div>



			";


			if(isset($_POST['update'])){
				$title = htmlentities($_POST['title']);
				$description = htmlentities($_POST['description']);
				$price = htmlentities($_POST['price']);
				$currency = htmlentities($_POST['currency']);
				$status = htmlentities($_POST['status']);
				
				
					
				$update ="update art_pieces set title='$title', description='$description',price='$price',currency='$currency',status='$status' where art_id='$art_id' ";
				$run=mysqli_query($con, $update);
			
				if($run){
					echo"<script>alert('Artwork updated')</script>";
					echo"<script>window.open('art.php?art_id=$art_id' , '_self')</script>";
				}
			}


if(isset($_POST['delete'])){

	   
	$delete_art = "delete from art_pieces where art_id='$art_id'";
	$delete = mysqli_query($con, $delete_art);
	
	if($delete){
		echo "<script>alert('deleted!')</script>";
		echo "<script>window.open('home.php','_self')</script>";
	}}
		//	} 
		}
	}
}





function single_post_for_users()
{
	if (isset($_GET['post_id'])) {
		global $con;
		$get_id = $_GET['post_id'];
		$get_posts = "select * from posts where post_id='$get_id'";
		$run_post = mysqli_query($con, $get_posts);
		$row_posts = mysqli_fetch_array($run_post);
		$post_id = $row_posts['post_id'];
		$artist_id = $row_posts['artist_id'];
		$content = $row_posts['post_content'];
		$upload_image = $row_posts['upload_image'];
		$post_date = $row_posts['post_date'];


		$artist = "select * from artists where artist_id='$artist_id' and posts='yes'";

		$run_artist = mysqli_query($con, $artist);
		$row_artist = mysqli_fetch_array($run_artist);

		$artist_lastname = $row_artist['a_last_name'];
		$artist_firstname = $row_artist['a_first_name'];
		$artist_image = $row_artist['a_image'];


/*
		$artist_com = $_SESSION['a_email'];
		$get_com = "select * from artists where a_email='$artist_com'";

		$run_com = mysqli_query($con, $get_com);
		$row_com = mysqli_fetch_array($run_com);

		$artist_com_id = $row_com['artist_id'];
		$artist_com_lastname = $row_com['a_last_name'];


*/



		$user_com = $_SESSION['u_email'];
		$get_com = "select * from users where u_email='$user_com'";

		$run_com = mysqli_query($con, $get_com);
		$row_com = mysqli_fetch_array($run_com);
		$user_com_id = $row_com['user_id'];
		$user_com_lastname = $row_com['u_last_name'];
		$user_com_firstname = $row_com['u_first_name'];

		if (isset($_GET['post_id'])) {
			$post_id = $_GET['post_id'];
		}

		$get_posts = "select post_id from posts where post_id='$post_id'";
		$run_artist = mysqli_query($con, $get_posts);

		$post_id = $_GET['post_id'];

		$post = $_GET['post_id'];
		$get_artist = "select * from posts where post_id='$post'";
		$run_artist = mysqli_query($con, $get_artist);
		$row = mysqli_fetch_array($run_artist);

		$p_id = $row['post_id'];

		if ($p_id != $post_id) {
			echo "<script>alert('Error!')</script>";
			echo "<script>window.open('home.php','_self')</script>";
		} else {

			if ($content == "No" && strlen($upload_image) >= 1) {
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
						  <h3  ><a style='text-decoration:none; cursor:pointer;color: black;' href='artist_page.php?artist_id=$artist_id'>$artist_firstname $artist_lastname</a></h3>
						  <h4 style=' background-color: goldenrod; ><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>

						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
						<center>	<img id='posts-img' src='imagepost/$upload_image' style=' border: 3px solid goldenrod ; border-radius: 4px; padding: 5px; height:100%; width:100%'></center>
						</div>
					</div><br>
					
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
			} else if (strlen($content) >= 1 && strlen($upload_image) >= 1) {
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
						<h3  ><a style='text-decoration:none; cursor:pointer;color: black;' href='artist_page.php?artist_id=$artist_id'>$artist_firstname $artist_lastname</a></h3>
						<h4 style=' background-color: goldenrod; ><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>

						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
							<h3 style=' background-color: goldenrod;'>$content</h3>
							<center><img id='posts-img' src='imagepost/$upload_image' style='border: 3px solid goldenrod ; border-radius: 4px; padding: 5px; height:100%; width:100%;'></center>
						</div>
					</div><br>
					
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
			}
			//artist_prifle<--u
			else {
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
						    <h3><a style='text-decoration:none; cursor:pointer;color: goldenrod;' href='artist_page.php?artist_id=$artist_id'>$artist_firstname $artist_lastname</a></h3>
							<h4><small style='color:black;'>Updated a post on $post_date</small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
							<h3 style=' background-color: goldenrod;'>$content</h3>
						</div>
					</div><br>
					
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>`
			";
			} //else condition ending

			include("comments.php");

			echo "
		<div class='row'>
		<div class='col-md-6 col-md-offset-3'>
		<div class='panel panel-warning'>
		<div class='panel-body'>
		<form action='' method='post' class='form-inline'>
		<textarea placeholder='Write your comment...' class='pb-cmnt-textarea' name='comment'></textarea>
		<button class='btn btn-warning pull-right' name='reply'>Comment</button>
		</form>
		</div>
		</div>
		</div>
		</div>
		";
			if (isset($_POST['reply'])) {
				$comment = htmlentities($_POST['comment']);

				if ($comment == "") {
					echo "<script>alert('enter your comment')</script>";
					echo "<script>window.open('single_post.php?post_id=$post_id', '_self')</script>";
				} else {
					$insert = "insert into comments (post_id, artist_id, comment, comment_author, date, author, user_id) values ('$post_id','0','$comment','$user_com_firstname $user_com_lastname',NOW(), '-', '$user_com_id')";
					$run = mysqli_query($con, $insert);

					echo "<script>alert('comment added')</script>";
					echo "<script>window.open('single_post.php?post_id=$post_id', '_self')</script>";
				}
			}
		}
	}
}






function insertDeal(){
	if (isset($_POST['submitDeal'])) {
					 global $con;
					 
			 
					 $title = htmlentities($_POST['title']);
					 $description = htmlentities($_POST['description']);
					 $month = htmlentities($_POST['month']);
					 $price = htmlentities($_POST['price']);
					 $currency = htmlentities($_POST['currency']);
					// $stock = htmlentities($_POST['stock']);
					 
					 $image = $_FILES['image']['name']; 
					 $image_tmp = $_FILES['image']['tmp_name'];
					 $random_number = rand(1, 100);
			 
			 
					 
					 
			 
					 if (strlen($image) < 1){echo "<script>alert('image not taken!!!')</script>";}
		//			 if (strlen($description) > 250 || strlen($title) > 250) {   // bun
		//				 echo "<script>alert('Please Use 250 or less than 250 words!')</script>";
			//             echo "<script>window.open('home.php', '_self')</script>";
		//			 }
		 else {
						 if (strlen($image) >= 1 && strlen($description) >= 1 && strlen($title) >= 1 && strlen($price) >= 1 && strlen($currency) >= 1) {
							 move_uploaded_file($image_tmp, "deals/$image.$random_number");
							 $insert = "insert into deals (title, description, image, month, price, currency, status) values('$title', '$description', '$image.$random_number','$month', '$price', '$currency', 'available')";
			 
							 $run = mysqli_query($con, $insert);
			 
							 if ($run) {
								 echo "<script>alert('A new deal has been updated a moment ago !')</script>";
								 echo "<script>window.open('admin.php')</script>";
			 
								 
							 } else{
								 echo "<script>alert('error1')</script>";
							 }
			 
							 exit();
						 }
						 else{
							 echo "<script>alert('error3')</script>";
						 }
					 }  
				 }
 
			 }


function get_deals()
{
				 global $con;
				// $per_page = 10;
			 
			
			 
				 $get_deals = "select * from deals ";
			 
				 $run_deals = mysqli_query($con, $get_deals);
			 echo"<div class='container py-5'>
			      <div class='row mt-4'>";
				 while ($row_deals = mysqli_fetch_array($run_deals)) {
			 
					 $deal_id = $row_deals['deal_id'];
					 $title = $row_deals['title'];
					 //$description = $row_deals['description'];
					 $description = substr($row_deals['description'], 0, 80);
					 $image = $row_deals['image'];
					 $price = $row_deals['price'];
					 $currency = $row_deals['currency'];
					 $month = $row_deals['month'];
					 $status = $row_deals['status'];
				//	 $stock = $row_deals['stock'];
			 
			 
					 
					 //now displaying posts from database



					 
		
			echo "
			<style>
			.card {
				box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
				width: 370px;
				height: 620px;
				margin: 5px;
				text-align: center;
				font-family: arial;
			  }
			.price {
				color: grey;
				font-size: 22px;
			  }
			  
			  .card button {
				border: none;
				outline: 0;
				padding: 12px;
				color: white;
				background-color: #000;
				text-align: center;
			
				width: 100%;
				font-size: 18px;
			  }
			  
			  .card button:hover {
				opacity: 0.7;
			  }
			</style>

                        <div class col-md-3>
						   <div class='card'>
						      <div class='card-body'>
							    <center> <img src='deals/$image' class='card-img-top' alt=' Image' style='height: 230px; width: auto; '>
								 <h2 class='card-title'>$title</h2> 
								 <h4> $status    </h4>
								 <p class='price'>
								 SALE:$price $currency
								<br>";
								// if($stock>0) echo"IN STOCK ($stock)";
								// if($stock==0) echo"NO LONGER AVAILABLE ($stock)";
								echo"
								 </p> </center>";

                                if(strlen($description)==80){
								 echo" <p class='card-text'> $description (...)  </p>
								 <br>

								 "; }

                                 else  {
								 echo" <p class='card-text'> $description   </p>
								 <br>
								 "; }
								 echo"
								 <a href='edit_deal.php?deal_id=$deal_id'><button>EDIT</button></a>
							  </div>
						   </div>
						</div>

						
						
			";
			 }

			}

			function search_art(){
				global $con; 
			
				if(isset($_GET['search_art_btn'])){
					$search_query=htmlentities($_GET['search_art']);
					$get_art="select * from art_pieces where description like '%$search_query%'  OR title like '%$search_query%' OR author like '%$search_query%'  ";
				}
			//	else{
			//		$get_art="select * from art_pieces";
			//	}
				$run_art = mysqli_query($con, $get_art);
				echo"
					
					<div class='container py-5'>
			      <div class='row mt-4'>";

				while ($row_art=mysqli_fetch_array($run_art)){
					$art_id=$row_art['art_id'];
					$artist_id=$row_art['artist_id'];
					$author=$row_art['author'];
					$title=$row_art['title'];
					$image=$row_art['image'];
					//$description =$row_art['description'];
					$description = substr($row_art['description'], 0, 50);
			
					echo"

					<style>
			.card {
				box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
				width: 370px;
				height: 520px;
				margin: auto;
				text-align: center;
				font-family: arial;
			  }

			  .author {
				color: grey;
				font-size: 22px;
			  }
			  
			  .card button {
				border: none;
				outline: 0;
				padding: 12px;
				color: white;
				background-color: #805500;
				text-align: center;
				cursor: pointer;
				width: 100%;
				font-size: 18px;
			  }
			  
			  .card button:hover {
				opacity: 0.7;
			  }

			  </style>
					<div class col-md-3>
					<div class='card'>
					   <div class='card-body'>
						 <center> 
						 <h2 class='card-title'>$title</h2> 
						 <img src='imageart/$image' class='card-img-top' alt='Images' style='height: 230px; width: auto; '>
						  
						
						  <p class='author'>
						  author: $author
						  </p>
						  <p class='card-text'>
						  ";

                                if(strlen($description)==50){
								 echo"  $description (...) 
								 

								 "; }

                                 else  {
								 echo"  $description  
								 
								 "; }
								 echo"
						
						  </p><br>
						
						  <a href='interest.php?art_id=$art_id'><button>interested?</button></a>
						  
						  </center>
						 
					   </div>
					</div>
				 </div>
					";
				}
			}




			function get_deals_market()
			{
							 global $con;
							
						 
						
						 
							 $get_deals = "select * from deals where status='available'";
						 
							 $run_deals = mysqli_query($con, $get_deals);
						    echo"<div class='container py-5'>
							  <div class='row mt-4'>";
							 while ($row_deals = mysqli_fetch_array($run_deals)) {
						 
								 $deal_id = $row_deals['deal_id'];
								 $title = $row_deals['title'];
								 //$description = $row_deals['description'];
								 $description = substr($row_deals['description'], 0, 100);
								 $image = $row_deals['image'];
								 $price = $row_deals['price'];
								 $currency = $row_deals['currency'];
								 $month = $row_deals['month'];
								 $status = $row_deals['status'];
							//	 $stock = $row_deals['stock'];
						 
						 
								 
								 //now displaying posts from database
			
			
			
								 
					
						echo "
						<style>
						.card {
							background-color: #a3a375;
							box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
							width: 370px;
							height: 550px;
							margin: 5px;
							text-align: center;
							font-family: arial;
							
						  }
						.price {
							color: #ffffb3;
							font-size: 22px;
						  }
						  
						  .card button {
							border: none;
							outline: 0;
							padding: 12px;
							color: white;
							background-color: #333300;
							text-align: center;
							cursor: pointer;
							width: 100%;
							font-size: 18px;
						  }
						  
						  .card button:hover {
							opacity: 0.7;
						  }
						</style>
			
									<div class col-md-3>
									   <div class='card '>
										  <div class='card-body'>
											<center> 
											<a href='edit_deal.php?deal_id=$deal_id'><img src='deals/$image' class='card-img-top' alt='Faculty Images' style='height: 230px; width: auto; '></a>
											 <h2 class='card-title'>$title</h2> 
											 <hr class='rounded'>
											 <p class='price'>
											 SALE:$price $currency
											<br>";
										//	 if($stock>0) echo"IN STOCK ($stock)";
										//	 if($stock==0) echo"NO LONGER AVAILABLE ($stock)";
											echo"
											 </p> </center>
											 <br>
											
											 <a href='buy.php?deal_id=$deal_id'><button>BUY</button></a>
										  </div>
									   </div>
									</div>
						<div>  </div>			
			
									
									
						";
						 }
			
						}

						


function get_posts_for_admin()
{
	global $con;
	$per_page = 10;

	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = 1;
	}

	$start_from = ($page - 1) * $per_page;

	$get_posts = "select * from posts ORDER by 1 DESC LIMIT $start_from, $per_page";

	$run_posts = mysqli_query($con, $get_posts);

	while ($row_posts = mysqli_fetch_array($run_posts)) {

		$post_id = $row_posts['post_id'];
		$artist_id = $row_posts['artist_id'];
	//	$content = substr($row_posts['post_content'], 0, 40);
	$content = $row_posts['post_content'];
		$upload_image = $row_posts['upload_image'];
		$post_date = $row_posts['post_date'];

		$artist = "select *from artists where artist_id='$artist_id' AND posts='yes'";
		$run_artist = mysqli_query($con, $artist);
		$row_artist = mysqli_fetch_array($run_artist);

		$artist_name = $row_artist['a_name'];
		$artist_fname = $row_artist['a_first_name'];
		$artist_lname = $row_artist['a_last_name'];
		$artist_image = $row_artist['a_image'];

		//now displaying posts from database

		if ($content == "No" && strlen($upload_image) >= 1) {
			echo "
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6' style='background: rgb(255, 248, 231); border: 5px solid goldenrod; '>
					<div class='row'>
						<div class='col-sm-2'>
						<p><img src='artists/$artist_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-12'>
							<h3 style='text-decoration:none; color: #daa520 ;'>$artist_fname $artist_lname</h3>
							<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
						<center><img id='posts-img' src='imagepost/$upload_image' style=' height:100%; width:100%'></center>
						</div>
					</div><br>
					<a href='functions/delete_post.php?post_id=$post_id ' style='text-align: right;float: right;'><button class='btn btn-danger'>Delete</button></a><br>
					
					
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		} else if (strlen($content) >= 1 && strlen($upload_image) >= 1) {
			echo "
			<div class='row'>
				<div class='col-sm-3' '>
				</div>
				<div id='posts' class='col-sm-6' style='background: rgb(255, 248, 231); border: 5px solid goldenrod;'>
					<div class='row' >
						<div class='col-sm-2'>
						<p><img src='artists/$artist_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						
						<div class='col-sm-12' >
						<h3 style='text-decoration:none; ;color: #daa520 ;' >$artist_fname $artist_lname</h3>
							<h4><small style='color: #6b6866;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
					<div class='col-sm-4'>
					</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
						<h4><p>$content</p></h4>
							<center><img id='posts-img' src='imagepost/$upload_image' style='height:100%; width:100%;'></center>
						</div>
					</div><br>
					<a href='functions/delete_post.php?post_id=$post_id ' style='text-align: right;float: right;'><button class='btn btn-danger'>Delete</button></a><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}

		else {
			echo "
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6' style='background: rgb(255, 248, 231); border: 5px solid goldenrod;'>
					<div class='row'>
						<div class='col-sm-2'>
						<p><img src='artists/$artist_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-12'>
						<h3 style='text-decoration:none;;color: #daa520 ;' >$artist_fname $artist_lname</h3>
							<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-18'>
							<h4><p>$content <p></h4>
						</div>
					</div><br>
					<a href='functions/delete_post.php?post_id=$post_id ' style='text-align: right;float: right;'><button class='btn btn-danger'>Delete</button></a><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}
	}

	include("paginator.php");
}
