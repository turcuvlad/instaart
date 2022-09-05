<!DOCTYPE html>
<?php
session_start();
include("includes/header_user.php");

if (!isset($_SESSION['u_email'])) {
    header("location: index.php");
}



?>
<style>
    @media only screen and (max-width: 760px),
    (min-device-width: 768px) and (max-device-width: 1024px) {

        /* Force table to not be like tables anymore */
        table,
        thead,
        tbody,
        th,
        td,
        tr {
            display: block;
        }
    }

    table {

        border-collapse: collapse;
        width: 100%;
        color: #cc9900;
        font-family: monospace;
        font-size: 24px;
        text-align: left;
    }

    th {
        background-color: #cc9900;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #ededed;
    }
</style>

<head>
    <title>Interests</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/home_style2.css">

</head>


<body>
    <center>
        <h2 style="font-family: Copperplate, Copperplate Gothic Light, fantasy; font-size: 40px; "><strong>Buying Interests</strong></h2><br>
    </center>
    <?php
    echo "
<div class='col-sm-12'>      
<table>
<tr>

<th></th>
<th>Title</th>

<th>Phone</th>
<th>E-Mail</th>
<th>Price</th>
<th>Currency</th>
<th>Date</th>
<th>Status</th>
<th>Edit</th>
</tr>

";
    $get_interest = "select * from activity where user_id='$user_id'";
    $run_interest = mysqli_query($con, $get_interest);

    while ($row_interest = mysqli_fetch_array($run_interest)) {

        $activity_id = $row_interest['activity_id'];
        $artist_id = $row_interest['artist_id'];
        $art_id = $row_interest['art_id'];
        $status = $row_interest['status'];
        $price = $row_interest['price'];
        $currency = $row_interest['currency'];
        $date = $row_interest['date'];
        $title = $row_interest['title'];
        $phone = $row_interest['phone_user'];
        $email = $row_interest['email_user'];

        echo "

<tr>
";

        if ($status == 'Dispatched' || $status == 'Delivered') {
            echo "
    <td> <span class='glyphicon glyphicon-ok-circle' ></span>  </td>
    ";
        } else
    if ($status == 'Canceled by Artist' || $status == 'Canceled because the artist has changed his mind' || $status == 'Canceled because the client could not be contacted' || $status == 'Canceled due to misunderstandings') {
            echo "<td><span class='glyphicon glyphicon-remove-circle' ></td> ";
        } else {
            echo "<td><span class='glyphicon glyphicon-time' ></td> ";
        }
        echo "
<td> <a href='interest.php?art_id=$art_id' >$title</a> </td><td> $phone </td><td> $email </td><td> $price </td><td>$currency </td><td>$date </td><td>$status </td>
";
        if ($status == 'pending') echo "
<td> <a href='edit_interest_user.php?activity_id=$activity_id' >Edit</a> </td></tr>
";

        else
            echo "
<td> </td></tr>
";
    }
    echo "
        
    </table> </div>";





    ?>


    <br><br>
    <center>
        <h2 style="font-family: Copperplate, Copperplate Gothic Light, fantasy; font-size: 40px; "><strong>Orders</strong></h2><br>
    </center>
    <?php
    echo "
<div class='col-sm-12'>      
<table>
<tr>


<th>Title</th>

<th>Price</th>
<th>Name</th>
<th>City</th>
<th>Address</th>
<th>Phone</th>
<th>Courier</th>
<th>Date</th>
<th>Status</th>
<th>Download</th>
</tr>

";
    $get_invoice = "select * from invoices where user_id='$user_id'";
    $run_invoice = mysqli_query($con, $get_invoice);

    while ($row_invoice = mysqli_fetch_array($run_invoice)) {

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

        echo "

<tr><td>$title</td><td> $price-$currency </td><td> $firstName $lastName </td><td> $city </td><td>$address </td><td>$phone </td><td>$courier </td><td>$date </td><td>$status </td><td> <a href='process.php?invoice_id=$invoice_id' >Invoice</a> </td></tr>
";
    }
    echo "
        
    </table> </div>
    <br><br>";





    ?>
</body>

</html>