<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");

if(!isset($_SESSION['a_email'])){
	header("location: index.php");
}
?>
<html>
    <head>
        <title>Change Status</title>
        <meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">

    </head>
    <body>
        <div class='row'>
            <div class="col-sm-3">

            </div>
            <div class="col-sm-6">
                <?php
                if(isset($_GET['activity_id'])){
                    $get_id = $_GET['activity_id'];
                    $get_activity = "select * from activity where activity_id='$get_id'";
                    $run_activity = mysqli_query($con, $get_activity);
                    $row = mysqli_fetch_array($run_activity);

                    $status= $row['status'];
                    $phone= $row['phone_user'];
                    $email= $row['email_user'];

                    $art_id=$row['art_id'];
                }
                ?>




                 <form action="" method="post" enctype="multipart/form-data">
                <table class="table table-bordered">
                    <center><h2>Edit your activity:</h2></center>
                    
                  
                  <tr>
                   <td tyle="font-weight: bold;">Change  the status </td>
                   <td>
                   <select class="form-control" name="status" >
							<option ><?php echo $status?></option>
							<option>Canceled by Artist</option>
                            <option>Canceled because the artist has changed his mind</option>
                            <option>Canceled because the client could not be contacted</option>
                            <option>Canceled due to misunderstandings</option>
                            <option>Dispatched</option>
                            <option>Delivered</option>
                            
                           
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
                   
                    

                        
                    

                    if($new_status=='Dispatched' || $new_status=='Delivered'){
                        $updateArt ="update art_pieces set status='unavailable' where art_id='$art_id'";
                        $updateActivity ="update activity set status='NO LONGER AVAILABLE' where art_id='$art_id'";
                        $runUpdate=mysqli_query($con, $updateArt);
                        $runUpdate=mysqli_query($con, $updateActivity);

                    }
                
                    $update ="update activity set status='$new_status' where activity_id='$get_id'";
                    $run=mysqli_query($con, $update);
                    
                    if($run){
                        echo"<script>alert('Activity updated')</script>";
                        echo"<script>window.open('interests_artist.php?artist_id=$artist_id' , '_self')</script>";
                    }
                }
                ?>
            </div>
            <div class="col-sm-3">

            </div>
        </div>
    </body>
</html>