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

    <script>
    $(document).ready(function(){
      var date_input=$('input[name="a_birthday"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'yyyy/mm/dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
    //  date_input.datepicker(options);
    })
</script>
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
                       <input class="form-control" type="text" name="a_first_name" required value="<?php echo $first_name?>">
                   </td>
                  </tr>
                  <tr>
                   <td tyle="font-weight: bold;">Change your last name</td>
                   <td>
                       <input class="form-control" type="text" name="a_last_name" required value="<?php echo $last_name?>">
                   </td>
                  </tr>
                  <tr>
                   <td tyle="font-weight: bold;">Change your birthdate </td>
                   <td>
                   <input type="date" class="form-control datepicker" placeholder="birthday" name="a_birthday" required value="<?php echo $artist_birthday?>">
                   </td>
                  </tr>
                   <tr>
                   <td tyle="font-weight: bold;">Change your description </td>
                   <td>
                       <input class="form-control" type="text" name="describe_artist" required value="<?php echo $describe_artist?>">
                   </td>
                  </tr>
                  <tr>
                   <td tyle="font-weight: bold;">Change your Studies </td>
                   <td>
                   <select class="form-control input-md" name="a_studies" required value="<?php echo $first_name?>">
							<option ><?php echo $artist_studies?></option>
							<option>None</option>
							<option>Art Highschool</option>
							<option>Art University</option>
						</select>
                     
                   </td>
                  </tr>
                  <tr>
                   <td tyle="font-weight: bold;">Change your Main Specialization </td>
                   <td>
                   <select class="form-control" name="a_specialization" >
							<option ><?php echo $artist_specialization?></option>
							<option>Painter</option>
                            <option>Graphic Designer/ Illustrator</option>
                            <option>Sculptor</option>
						</select>
                       
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
    $a_first_name = htmlentities($_POST['a_first_name']);
    $a_last_name = htmlentities($_POST['a_last_name']);
    $describe_artist = htmlentities($_POST['describe_artist']);
    $a_birthday = htmlentities($_POST['a_birthday']);
    $a_studies = htmlentities($_POST['a_studies']);
    $a_specialization = htmlentities($_POST['a_specialization']);
		
    $update ="update artists set a_first_name='$a_first_name', a_last_name='$a_last_name', describe_artist='$describe_artist', a_birthday='$a_birthday', a_studies='$a_studies', a_specialization='$a_specialization' where artist_id='$artist_id'";
    $run=mysqli_query($con, $update);

    if($run){
        echo"<script>alert('Your profile updated')</script>";
        echo"<script>window.open('edit_account.php?artist_id=$artist_id' , '_self')</script>";
    }
}
?>