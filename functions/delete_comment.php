<?php

$con = mysqli_connect("localhost","root","","instaart") or die("Connection was not established");


if(isset($_GET['com_id'])){

$com_id=$_GET['com_id'];   
$delete_com = "delete from comments where com_id='$com_id'";
$delete = mysqli_query($con, $delete_com);

if($delete){
    echo "<script>alert('deleted!')</script>";
    echo "<script>window.open('../home.php','_self')</script>";
}}
?>