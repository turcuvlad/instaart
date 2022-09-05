<?php
$get_id = $_GET['post_id'];

$get_artist_id = "select * from posts where post_id='$get_id'";
$run_artist_id = mysqli_query($con, $get_artist_id);
$row_id = mysqli_fetch_array($run_artist_id);
$post_artist_id = $row_id['artist_id'];


$get_com = "select * from comments where post_id='$get_id' ORDER by 1 DESC";
$run_com = mysqli_query($con, $get_com);



while($row = mysqli_fetch_array($run_com)){
    $com = $row['comment'];
    $com_id = $row['com_id'];
    $com_name=$row['comment_author'];
    $com_artist_id=$row['artist_id'];
    $com_user_id=$row['user_id'];
    $date=$row['date'];
    $status=$row['author'];

    echo"
    <div class='row'>
    <div class='col-md-6 col-md-offset-3'>
    <div class='panel panel-warning'>
    <div class='panel-body'>
        <div> "; 
        if($status=='yes')echo"
        <h4 align='right' class='glyphicon glyphicon-ok' style='color:gold'> </h4>
      
        <h4 ><strong> $com_name</strong></h4><h5><i> commented</i> on $date </h5>";
        else echo"
        <h4>$com_name</h4><h5><i> commented</i> on $date</h5>"; 
        echo"
        <h4> <strong> <p class='text-primary' style='margin-left:5px; font: size 25px;'>$com  </p></strong></h4>
        
        
        ";

        //as artist
        if($artist_com_id==$post_artist_id)echo"
        <a href='functions/delete_comment.php?com_id=$com_id' style='float: right;''><button class='btn btn-light'>Delete</button></a><br>";
        else //indiviudal
        if($com_artist_id==$artist_com_id) echo"
        <a href='functions/delete_comment.php?com_id=$com_id' style='float: right;''><button class='btn btn-light'>Delete</button></a><br>";
        else
        //user_com_id from functions
        if($user_com_id==$com_user_id) echo"
        <a href='functions/delete_comment_user.php?com_id=$com_id' style='float: right;''><button class='btn btn-light'>Delete</button></a><br>";
        




        echo"


        </div>
    </div>
    </div>
    </div>
    </div>
    ";
}
?>