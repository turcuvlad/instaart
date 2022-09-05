<?php
 
 session_start();
 
 
 if(isset($_SESSION['a_email']))
  $artist = $_SESSION['a_email'];

  if($artist=='admin@instaart')
  include("includes/header_admin.php");
  else
  if(isset($_SESSION['u_email'])){
      include("includes/header_user.php");
      }
      else header("location: index.php");
?>
 <head>
        <title>Edit activity</title>
        <meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">

    </head>

    <?php
     
    if(isset($_GET['invoice_id'])){
      $get_id = $_GET['invoice_id'];
    $get_invoice = "select * from invoices where invoice_id='$get_id'";
    $run_invoice = mysqli_query($con, $get_invoice);
    
     $row_invoice = mysqli_fetch_array($run_invoice);

        $invoice_id = $row_invoice['invoice_id'];
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
<html>
  
<script >
    window.onload = function () {
    
    
    const form = this.document.getElementById("form");
    
    console.log(form);
    console.log(window);
    var opt = {
        margin: 1,    
        filename: '<?php echo "invoice_$firstName$lastName.pdf"?>',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
    };
    html2pdf().from(form).set(opt).save();

}



</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

    <head>
        <title> INVOICE </title>
        <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
    </head>

    <body >
        <br>
        
        <div class="card" id="form">
        <img src="images/Logo.png" alt="logo" width="50px" height="50px">
        
        <h2 style="text-align:center;">INVOICE </h2>

        <p><strong>Provider:</strong> InstaArt</p>
        <p><strong>Address:</strong> Romania, Brasov</p>
        <p><strong>Capitol:</strong> xx Lei</p>
        <br>
        <p><strong>Bank:</strong> xx Bank</p>
        <p><strong>Phone number:</strong> 0745.062.226</p>
        <hr>
        
        <table>
  <tr>
    <th>Name</th>
    <th>Address</th>
    <th>PhoneNumber</th>
    <th>Item</th>
    <th>Total</th>
    <th>Courier</th>
    
  </tr>
  <tr>
   <?php echo" <td>$firstName $lastName</td>   ";?>
   <?php echo" <td>$city - $address</td>   ";?>
   <?php echo" <td>$phone</td>  ";?>
   <?php echo" <td>$title </td> ";?>
   <?php echo" <td>$price $currency </td> ";?>
   <?php echo" <td>$courier </td> ";?>
  </tr>
  
</table>
<div style="text-align: right;">

<?php echo"
<p><strong>Order with the id:</strong>  $invoice_id     </p>
<p><strong>Order from:</strong>  $date</p>     " ?>



    </body>

</html>