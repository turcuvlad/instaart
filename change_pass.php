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
        <title>Edit Post</title>
        <meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">

    </head>

    <script>
function visible() {
  var x = document.getElementById("pass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
function visible_confirm() {
  var y = document.getElementById("pass_confirm");
  if (y.type === "password") {
    y.type = "text";
  } else {
    y.type = "password";
  }
}
</script>
    <body>
        <div class='row'>
            <div class="col-sm-3">

            </div>
            <div class="col-sm-6">
               
                <form action="" method="post" enctype="multipart/form-data">
   <table class="table table-bordered">
                  <center><h2>Change your password</h2></center>
                  <tr>
                   <td tyle="font-weight: bold;">New password </td>
                   <td>
                       <input class="form-control" type="password" name="a_pass" id="pass" required="required"> 
                       <input type="checkbox" onclick="visible()"><strong>  Show Password</strong>
                   </td>
                  </tr>
                  <tr>
                   <td tyle="font-weight: bold;">Confirm your new password </td>
                   <td>
                       <input class="form-control" type="password" name="a_pass_confirm" id="pass_confirm" required="required"> 
                       <input type="checkbox" onclick="visible_confirm()"><strong>  Show Password </strong>
                   </td>
                  </tr>
                  <tr align="center">
                  <td colspan="8">
                  <input type="submit" class="btn btn-info" name="updatePass" style="width:250px"; value="Update Password"
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
if(isset($_POST['updatePass'])){
    $a_pass = htmlentities(mysqli_real_escape_string($con,$_POST['a_pass']));
    $a_pass_confirm = htmlentities(mysqli_real_escape_string($con,$_POST['a_pass_confirm']));
		

    if($a_pass != $a_pass_confirm){
        echo"<script>alert('Passwords don`t match!')</script>";
        exit();
    }
    if(strlen($a_pass) <4 ){
        echo"<script>alert('Password should be minimum 4 characters!')</script>";
        exit();
    }else {
        $update ="update artists set a_pass='".md5($a_pass)."' where artist_id='$artist_id'";
        $run=mysqli_query($con, $update);
    }


    if($run){
        echo"<script>alert('Your password updated')</script>";
        echo"<script>window.open('edit_account.php?artist_id=$artist_id' , '_self')</script>";
    }
}
?>