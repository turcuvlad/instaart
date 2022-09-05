

<?php
include("includes/connection.php");
include("functions/functions.php");
?>

<head>
<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
       
        <link rel="icon" type="image/x-icon" href="images/Logo.png" />
        
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
		<link href="style/style1.css" rel="stylesheet" />
    
<style>

	</style>
	
 <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark" id="mainNav">
            
			<div  class="container-fluid">
                <a class="navbar-brand js-scroll-trigger"  ><img src="images/Logo.png" alt="" style="width:30px;height:30px; float: left;"/></a>
              
                
					
                    <ul class="navbar-nav text-uppercase ml-auto">
                        

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

            <li class="nav-item"><a class="nav-link js-scroll-trigger" style=" font-size: 15px;font-weight: 900;" href='admin.php'>ADMIN</a></li>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" style ='font-size: 15px;font-weight: 900;' href='logout.php'>Logout</a></li>
         

                    </ul>
					
                
            </div>


        </nav> </head> <br><br><br><br><br>
    <body>
        <div class='row'>
            <div class="col-sm-3">

            </div>
            <div class="col-sm-6">
                <?php
             if(isset($_GET['invoice_id'])){
                $get_id = $_GET['invoice_id'];
              $get_invoice = "select * from invoices where invoice_id='$get_id'";
              $run_invoice = mysqli_query($con, $get_invoice);
              
               $row_invoice = mysqli_fetch_array($run_invoice);
          
                  //$invoice_id = $row_invoice['invoice_id'];
                  $firstName = $row_invoice['firstName'];
                  $lastName = $row_invoice['lastName'];
                  $city = $row_invoice['city'];
                  $address = $row_invoice['address'];
                  $price = $row_invoice['price'];
                  $currency = $row_invoice['currency'];
                  $title = $row_invoice['title'];
                  $date = $row_invoice['date'];
                  $status = $row_invoice['status'];
                  $phone = $row_invoice['phone'];
                  $courier = $row_invoice['courier'];
          }
                ?>




                 <form action="" method="post" enctype="multipart/form-data">
                <table class="table table-bordered">
                    <center><h2>Update the order:</h2><h3><?php echo $get_id ?></h3></p></center>
                    
                  
                  <tr>
                   <td tyle="font-weight: bold;">Change  the status </td>
                   <td>
                   <select class="form-control" name="status" >
							<option disabled><?php echo $status?></option>
                            <option>Dispatched</option>
							<option>Delivered</option>
							<option>Canceled</option>
                            
                           
						</select>
                       
                   </td>
                  </tr>
                 
                  <tr align="center">
                  <td colspan="8">
                  <input type="submit" class="btn btn-info" name="update" style="width:250px"; value="Update "
                  </td>
                  </tr>
                  
                    </table>

                </form>


                <?php
                if(isset($_POST['update'])){
                    $new_status = htmlentities($_POST['status']);
                   
                   
                    

                        
                    $update ="update invoices set status='$new_status' where invoice_id='$get_id'";
                    $run=mysqli_query($con, $update);

                    
                    if($run){
                        echo"<script>alert('Status updated')</script>";
                        echo"<script>window.location.href = 'admin.php';</script>";
                    }
                }

                
                ?>
            </div>
            <div class="col-sm-3">

            </div>
        </div>
    </body>
</html>