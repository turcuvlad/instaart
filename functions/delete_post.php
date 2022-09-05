<?php

$con = mysqli_connect("localhost","root","","instaart") or die("Connection was not established");


if(isset($_GET['post_id'])){

$post_id=$_GET['post_id'];   
$delete_post = "delete from posts where post_id='$post_id'";
$delete = mysqli_query($con, $delete_post);

if($delete){
    echo "<script>alert('deleted!')</script>";
    echo "<script>window.open('../home.php','_self')</script>";
}}
?>