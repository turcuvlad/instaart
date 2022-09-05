<!DOCTYPE html>
<?php
session_start();
include("includes/header_user.php");

if(!isset($_SESSION['u_email'])){
	header("location: index.php");
}



?>
<html>
    <head>
        <title>Edit Account</title>
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



    <body>
        <div class='row'>
            <div class="col-sm-3">

            </div>
            <div class="col-sm-6">
               
                <form action="" method="post" enctype="multipart/form-data">
                <table class="table table-bordered">
                    <center><h2>Edit your profile:</h2></center>
                  <tr>
                   <td tyle="font-weight: bold;">Change your first name</td>
                   <td>
                       <input class="form-control" type="text" name="u_first_name" required value="<?php echo $first_name?>">
                   </td>
                  </tr>
                  <tr>
                   <td tyle="font-weight: bold;">Change your last name</td>
                   <td>
                       <input class="form-control" type="text" name="u_last_name" required value="<?php echo $last_name?>">
                   </td>
                  </tr>
                  
                   <tr>
                   <td tyle="font-weight: bold;">Change your phone number </td>
                   <td>
                       <input class="form-control" type="text" name="u_phone" required value="<?php echo $user_phone?>">
                   </td>
                  </tr>
                  
                  
               <!--   </table><table class="table table-bordered">
                  <center><h2>Change your password</h2></center>
                  <tr>
                   <td tyle="font-weight: bold;">New password </td>
                   <td>
                       <input class="form-control" type="password" name="a_pass" required="required"> 
                       <input type="checkbox" onclick="showPass()"><strong> Show hidden password</strong>
                   </td>
                  </tr>
                  <tr>
                   <td tyle="font-weight: bold;">Confirm your new password </td>
                   <td>
                       <input class="form-control" type="password" name="a_pass_confirm" required="required"> 
                       <input type="checkbox" onclick="showPass()"><strong> Show hidden password</strong>
                   </td>
                  </tr>
                  <tr align="center">
                  <td colspan="8">
                  <input type="submit" class="btn btn-info" name="UpdatePassword" style="width:250px"; value="Update Password"
                  </td>
                  </tr>   -->
                  <tr align="center">
                  <td colspan="8">
                  <input type="submit" class="btn btn-info" name="update" style="width:250px"; value="Update "
                  </td>
                  </tr>
                    </table>

                </form>

                
            </div>
            <div class="col-sm-3">

            </div>
        </div>
    </body>
</html>


<?php
if(isset($_POST['update'])){
    $u_first_name = htmlentities($_POST['u_first_name']);
    $u_last_name = htmlentities($_POST['u_last_name']);
    
    $u_phone= htmlentities($_POST['u_phone']);
    
		
    $update ="update users set u_first_name='$u_first_name', u_last_name='$u_last_name', u_phone='$u_phone' where user_id='$user_id'";
    $run=mysqli_query($con, $update);

    if($run){
        echo"<script>alert('Your profile updated')</script>";
        echo"<script>window.open('edit_account_user.php?user_id=$user_id' , '_self')</script>";
    }
}
?>