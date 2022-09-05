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
	<?php
		$user = $_SESSION['u_email'];
		$get_user = "select * from users where u_email='$user'";
		$run_user = mysqli_query($con,$get_user);
		$row = mysqli_fetch_array($run_user);

		$user_name = $row['u_first_name'];
	?>
	<title><?php echo "$user_name"; ?></title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
    
</head>
<style>

.bg {
  animation:slide 3s ease-in-out infinite alternate;
  background-image: linear-gradient(-60deg, #adebeb 50%, #e6f2ff 50%);
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
  animation-duration:10s;
}

.bg3 {
  animation-duration:12s;
}



@keyframes slide {
  0% {
    transform:translateX(-25%);
  }
  100% {
    transform:translateX(25%);
  }
}

.table {background-color: white;}
</style>
    <body>

    <div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>


    <?php
                if(isset($_GET['deal_id'])){
                    $get_id = $_GET['deal_id'];
                    $get_deal = "select * from deals where deal_id='$get_id'";
                    $run_deal = mysqli_query($con, $get_deal);
                    $row = mysqli_fetch_array($run_deal);

                    $status= $row['status'];
                    $title= $row['title'];
                    $price=$row['price'];
                    $currency=$row['currency'];
                    $description= $row['description'];
                //    $stock= $row['stock'];

                    $image=$row['image'];
                    
                }
                ?>
                <br><br>
                <div class="col-sm-2"></div>
        <div class='row'>
            <div class="col-sm-6">
            <br><br><br>
<center><?php   echo"       <img src='deals/$image '  alt='$image' style='height: auto;  width: 500px; border: 1px solid #ddd;  border-radius: 4px; padding: 7px; background-color: white;'>  ";?></center>
            </div>
            <div class="col-sm-3">
               



                 <form action="" method="post" enctype="multipart/form-data">
                <table class="table table-bordered">
                    <center><h3><?php echo $title ?></h3></center>
                    
                    <tr>
                   <td tyle="font-weight: bold;">First Name: </td>
                   <td>
                       <input class="form-control" type="text" name="firstname" required value="<?php echo "$first_name " ?> ">
                   </td>
                  </tr>
                  <tr>
                   <td tyle="font-weight: bold;">Last Name: </td>
                   <td>
                       <input class="form-control" type="text" name="lastName" required value="<?php echo "$last_name" ?> ">
                   </td>
                  </tr>
                  <tr>
                   <td tyle="font-weight: bold;">City </td>
                   <td>
                       <input class="form-control" type="text" name="city" required  >
                   </td>
                  </tr>
                  <tr>
                   <td tyle="font-weight: bold;">Address </td>
                   <td>
                       <input class="form-control" type="text" name="address" required >
                   </td>
                  </tr>
                  <tr>
                   <td tyle="font-weight: bold;">Phone number </td>
                   <td>
                       <input class="form-control" type="text" name="phone" required >
                   </td>
                  </tr>
                  <tr>
                   <td tyle="font-weight: bold;">Courier </td>
                   <td>
                   <select class="form-control" name="courier" >
							
							<option>FEDEX</option>
							<option>DHL</option>
                            
                           
						</select>
                       
                   </td>
                  </tr>
                 <!--  <tr>
                 <td tyle="font-weight: bold;">IN STOCK: <?php // echo $stock?> </td> 
                   <td>
                       <input class="form-control" type="number" name="amount" required value="<?php echo 1?>">
                   </td>
                  </tr>-->
                  <tr align="center">
                  <td colspan="8">
                  <input type="submit" class="btn btn-info" name="buy" style="width:250px"; value="Buy "
                  </td>
                  </tr>
                  
                    </table>

                </form>
                <h1></h1>

                <br>
  <div class="card bg-info text-white">
  <div style="color: orange;"><?php 
  
  echo "
  <center><h3> $price $currency </h3></center> ";
  ?>
  </div>
    <div class="card-body" style="background-color: orange;">
    <?php echo" <p>$description</p>  ";?>
    </div>
  </div>
  <br>
                <?php
                if(isset($_POST['buy'])){
                    $firstName = htmlentities($_POST['firstname']);
                    $lastName = htmlentities($_POST['lastName']);
                    $address = htmlentities($_POST['address']);
                    $city = htmlentities($_POST['city']);
                    $phone = htmlentities($_POST['phone']);
                   // $status = htmlentities($_POST['status']);
                    $courier = htmlentities($_POST['courier']);
                 //   $amount = htmlentities($_POST['amount']);

                  //  $final_price=$price* $amount;
                   
                  if($status=="available" ) {

                    $insert = "INSERT into invoices (firstName,lastName,city,address,phone,courier,deal_id,title,price,date,status, currency, user_id)
                    values('$firstName','$lastName','$city','$address','$phone','$courier','$get_id','$title','$price',NOW(),'ongoing', '$currency', '$user_id')";
                        
/*
               // if($amount<=$stock && $amount>0) {        $insert = "INSERT into invoices (firstName,lastName,city,address,phone,courier,deal_id,title,price,date,status, currency, user_id)          values('$firstName','$lastName','$city','$address','$phone','$courier','$get_id','$title','$final_price',NOW(),'ongoing', '$currency', '$user_id')";
       /*                 
                    $new_stock=$stock-$amount;
                        $update ="update deals set  stock='$new_stock' where deal_id='$get_id'"; */
                    $run=mysqli_query($con, $insert);
                   // $run=mysqli_query($con, $update);

                    
                        $updateStatus ="update deals set  status='SOLD OUT' where deal_id='$get_id'";
                        $runStatus=mysqli_query($con, $updateStatus);
                       
                   
                        echo "<script>
                        swal('Purchase complete', 'Thank you for the purchase!', 'success')
                        .then((value) => { 
                        window.location.href = 'home_user.php'
                        }); </script>";
                        
                        //echo"<script>alert('Thank you for the purchase!')</script>";
                        //echo"<script>window.location.href = 'home_user.php';</script>";
                    

                }
                else{
                    echo"<script>alert('IT IS NO LONGER AVAILABLE')</script>";
                }
                }

                
                ?>
            </div>
            <div class="col-sm-6">
            
            </div>
           
            


        </div>
    </body>
</html>