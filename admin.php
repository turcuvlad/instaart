<?php
session_start();


if (!isset($_SESSION['a_email'])) {
  header("location: index.php");
}

include("includes/header_admin.php");
?>

<style>
  body {
    background-color: #f2f2f2;
  }

  ;

  .container {
    width: 500px;
    clear: both;
  }

  .container input {
    width: 100%;
    clear: both;
  }
</style>

<body>
  <br><br><br><br><br>
  <div class="center">
    <center>
      <h2>insert an object</h2>
    </center>
    <div class="l-part">
      <div class="col-75">
        <div class="container">
          <form action=" " method="post" enctype="multipart/form-data">
            <h4>Title</h4>
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
              <input type="text" class="form-control" placeholder="Title" name="title" required="required">
            </div><br>
            <h4>Description:</h4>
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
              <input type="text" class="form-control" placeholder="Description: author, working methods, format, motivation etc." name="description" required="required">
            </div><br>
            <h4>Month </h4>
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
              <input type="month" class="form-control " placeholder="month" name="month" required="required">

            </div><br>
            <h4>Price</h4>
            <div id="form_div" class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
              <input id="price" type="number" class="form-control" placeholder="price" name="price" required="required">


              <span class="input-group-addon"><i class="glyphicon glyphicon-euro"></i></span>
              <select id="currency" class="form-control input-md" placeholder="currency" name="currency" required="required">
                <option disabled>Select your currency</option>
                <option>RON</option>
                <option>EURO</option>
                <option>DOLLAR</option>
              </select>

            </div><br>

            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-check"></i></span>

              <label class="btn btn-warning" style="text-align: center;color: white; width: 100%; text-align: center;">Select Image
                <input type="file" id="image" name="image" size="30" accept="image/png, image/jpeg">
              </label>
            </div>

            <br><br>
            <center> <button id="btn-post" class="btn btn-success" name="submitDeal">Post</button></center><br>

          </form>
        </div>
      </div>
      <?php


      insertDeal();
      ?>
      <hr class="solid">
      <?php
      get_deals(); ?>







    </div><br><br>

  </div>

  <?php
  $results_per_page = 5;


  // find out the number of results stored in database
  $sql = 'SELECT * FROM invoices';
  $result = mysqli_query($con, $sql);
  $number_of_results = mysqli_num_rows($result);

  // determine number of total pages available
  $number_of_pages = ceil($number_of_results / $results_per_page);

  // determine which page number visitor is currently on
  if (!isset($_GET['page'])) {
    $page = 1;
  } else {
    $page = $_GET['page'];
  }

  // determine the sql LIMIT starting number for the results on the displaying page
  $this_page_first_result = ($page - 1) * $results_per_page;

  // retrieve selected results from database and display them on page
  $sql = 'SELECT * FROM invoices ORDER BY invoice_id DESC LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
  $result = mysqli_query($con, $sql);

  ?>
  <div class="container" style="background-color: white;">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Address</th>
          <th scope="col">Price</th>
          <th scope="col">Phone</th>
          <th scope="col">Courier</th>
          <th scope="col">Date</th>
          <th scope="col">Status</th>
          <th scope="col">Invoice</th>
          <th scope="col">EDIT</th>
        </tr>
      </thead>
      <tbody>

        <?php
        // display the links to the pages

        while ($row = mysqli_fetch_array($result)) {
        ?>
          <tr>
            <?php $invoice_id = $row['invoice_id'] ?>
            <td><?php echo $invoice_id ?></td>
            <td><?php echo $row['firstName'], " ",  $row['lastName'] ?></td>
            <td><?php echo $row['city'], " ",  $row['address'] ?></td>
            <td><?php echo $row['price'] ?></td>
            <td><?php echo $row['phone'] ?></td>
            <td><?php echo $row['courier'] ?></td>
            <td><?php echo $row['date'] ?></td>
            <td><?php echo $row['status'] ?></td>
            <?php echo "<td> <a href='process.php?invoice_id=$invoice_id' >Invoice</a> </td>  " ?>
            <?php echo "<td> <a href='edit_order.php?invoice_id=$invoice_id' >Edit</a> </td>  " ?>

          </tr>

        <?php
          //  echo $row['invoice_id'] . ' ' . $row['price']. '<br>';
        }
        echo "
</tbody>

</table>
<center>
";
        // display the links to the pages
        for ($page = 1; $page <= $number_of_pages; $page++) {
          echo '<a href="admin.php?page=' . $page . '">' . $page . '</a> ';
        }

        ?>
        </center>
  </div>
  <br><br>
</body>