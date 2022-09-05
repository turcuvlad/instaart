<?php
//include("main.php");
include("includes/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Welcome </title>
        <link rel="icon" type="image/x-icon" href="images/Logo.png" />
        
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="style/style1.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="images/Logo.png" alt="" /></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ml-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ml-auto">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#services"> Instaart</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">About Art</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="signin.php">Login as Artist</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="signup.php">SignUp as Artist</a></li>
                        
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">Welcome !</div>
                <div class="masthead-heading text-uppercase">See what's new in the art world</div>
                <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Tell Me More</a>
            </div>
        </header>
        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">About InstaArt</h2>
                   
                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Find diffrent artists</h4>
                        <p class="text-muted">Discover new artists and see their latest activities!</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Find diffrent artworks</h4>
                        <p class="text-muted">Don't miss our latest deals! Every month we got diffrent artworks in store waiting to be bought!</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Explore</h4>
                        <p class="text-muted">Even though you are not looking for something specific, there is here something for you!</p>
                    </div>
                </div>
            </div>
            <div class="form" style="text-align:center">
       
        <h2><strong>If you are an art lover Sign Up now  <br> and explore for yourself</strong></h2><br><br>
        <h4><strong>Join now!</strong></h4>
        <form method="post" action="">
            <button id="signup" class="btn btn-info btn-lg" name="signup" style="font-size: 20px;">Sign up </button><br><br>
            <?php
            if(isset($_POST['signup'])){
                echo "<script> window.open('signup_user.php','_self') </script>";
            }
            ?>
            <button id="login" class="btn btn-info btn-lg" name="login" style="font-size: 20px;">login </button><br><br>
            <?php
            if(isset($_POST['login'])){
                echo "<script> window.open('signin_user.php','_self') </script>";
            }
            ?>
        </form>
        </div>

        </section>
        <!-- Portfolio Grid-->
        <section class="page-section bg-light" id="about">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">What can you find here</h2>
                    <h3 class="section-subheading text-muted">Find diffrent artists from diffrent areas.</h3>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-toggle="modal" href="#portfolioModal1">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="images/1.jpg" alt="" />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Painting</div>
                                <div class="portfolio-caption-subheading text-muted">and its plasticity</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-toggle="modal" href="#portfolioModal2">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="images/2.jpg" alt="" />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Graphic Art and Design</div>
                                <div class="portfolio-caption-subheading text-muted">and its expression</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-toggle="modal" href="#portfolioModal3">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="images/3.jpg" alt="" />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Sculpture</div>
                                <div class="portfolio-caption-subheading text-muted">and its dimensions</div>
                            </div>
                        </div>
                    </div> 

<?php

$art = "select * from art_pieces where level='none' order by rand()  limit 1";
$run_art = mysqli_query($con, $art);
$row_artist = mysqli_fetch_array($run_art);

$image = $row_artist['image'];
$title = $row_artist['title'];
$author = $row_artist['author'];
$level = $row_artist['level'];


$art2 = "select * from art_pieces where level='Art Highschool' order by rand()  limit 1";
$run_art2 = mysqli_query($con, $art2);
$row_artist2 = mysqli_fetch_array($run_art2);

$image2 = $row_artist2['image'];
$title2 = $row_artist2['title'];
$author2 = $row_artist2['author'];
$level2 = $row_artist2['level'];

$art3 = "select * from art_pieces where level='Art University' order by rand()  limit 1";
$run_art3 = mysqli_query($con, $art3);
$row_artist3 = mysqli_fetch_array($run_art3);

$image3 = $row_artist3['image'];
$title3 = $row_artist3['title'];
$author3 = $row_artist3['author'];
$level3 = $row_artist3['level'];
?>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-toggle="modal" href="#portfolioModalI">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                
                        <?php      echo"  <img class='img-fluid' src='imageart/$image' alt='' style='height: 180px; width: 450px; object-fit: cover;' /> " ?>
                            </a>
                            <div class="portfolio-caption">
                            <?php      echo"            <div class='portfolio-caption-heading'>'$title' by $author</div>
                                <div class='portfolio-caption-subheading text-muted'>level: $level </div>"  ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 mb-4">
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-toggle="modal" href="#portfolioModalII">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                               
                        <?php      echo"  <img class='img-fluid' src='imageart/$image2' alt='' style='height: 180px; width: 450px; object-fit: cover;'/> " ?>
                            </a>
                            <div class="portfolio-caption">
                            <?php      echo"            <div class='portfolio-caption-heading'>'$title2' by $author2</div>
                                <div class='portfolio-caption-subheading text-muted'>level: $level2 </div>"  ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 mb-4">
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-toggle="modal" href="#portfolioModalIII">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                               
                        <?php      echo"  <img class='img-fluid' src='imageart/$image3' alt='' style='height: 180px; width: 450px; object-fit: cover;' /> " ?>
                            </a>
                            <div class="portfolio-caption">
                            <?php      echo"            <div class='portfolio-caption-heading'>'$title3' by $author3</div>
                                <div class='portfolio-caption-subheading text-muted'>level: $level3 </div>"  ?>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
   
    
        <!-- Footer-->
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-left">Copyright © Turcu Vlad</div>
                   
                </div>
            </div>
        </footer>
        <!-- Portfolio Modals-->
        <!-- Modal 1-->
        <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project Details Go Here-->
                                    <h2 class="text-uppercase">Painting</h2>
                                    <p class="item-intro text-muted">and its plasticity.</p>
                                    <img class="img-fluid d-block mx-auto" src="images/1.jpg" alt="" />
                                    <p>“Whoever wants to know something about me, they should look attentively at my pictures and there seek to recognise what I am and what I want.”</p>
                                    <ul class="list-inline">
                                    <strong> <li>Title: Portrait of Adele Bloch-Bauer I</li></strong>
                                        <strong><li>Artist: Gustav Klimt</li></strong>
                                        <li>Birth Date: 1862</li>
                                    </ul>
                                    <button class="btn btn-primary" data-dismiss="modal" type="button">
                                        <i class="fas fa-times mr-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal 2-->
        <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
            
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project Details Go Here-->
                                    <h2 class="text-uppercase">Graphic Art and Design</h2>
                                    <p class="item-intro text-muted">and its expression.</p>
                                    <img class="img-fluid d-block mx-auto" src="images/2.jpg"alt="" />
                                    <p>"If a man devotes himself to art, much evil is avoided that happens otherwise if one is idle."</p>
                                    <ul class="list-inline">
                                    <strong> <li> Title: St Jerome In His Study Acrylic Print</li></strong>
                                    <strong> <li>Artist: Albrecht Dürer</li></strong>
                                    <li>Birth Date: 1471</li>
                                    </ul>
                                    <button class="btn btn-primary" data-dismiss="modal" type="button">
                                        <i class="fas fa-times mr-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal 3-->
        <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project Details Go Here-->
                                    <h2 class="text-uppercase">Sculpture</h2>
                                    <p class="item-intro text-muted">and its dimensions</p>
                                    <img class="img-fluid d-block mx-auto" src="images/3.jpg" alt="" />
                                    <p>"Lord, grant that I may always desire more than I can accomplish."</p>
                                    <ul class="list-inline">
                                    <strong><li>Title: Pieta</li></strong>
                                        <strong><li>Artist: Michelangelo Buonarroti</li></strong>
                                        <li>Birth Date: 1475</li>
                                    </ul>
                                    <button class="btn btn-primary" data-dismiss="modal" type="button">
                                        <i class="fas fa-times mr-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        




        <div class="portfolio-modal modal fade" id="portfolioModalI" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project Details Go Here-->
                                    <?php  echo"  <h2 class='text-uppercase'>$title </h2>  
                                    <p class='item-intro text-muted'>by $author</p>
                                    <img class='img-fluid d-block mx-auto' src='imageart/$image' alt='' />      "?>
                                    
                                    <button class="btn btn-primary" data-dismiss="modal" type="button">
                                        <i class="fas fa-times mr-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="portfolio-modal modal fade" id="portfolioModalII" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project Details Go Here-->
                                    <?php  echo"  <h2 class='text-uppercase'>$title2 </h2>  
                                    <p class='item-intro text-muted'>by $author2</p>
                                    <img class='img-fluid d-block mx-auto' src='imageart/$image2' alt='' />      "?>
                                    <button class="btn btn-primary" data-dismiss="modal" type="button">
                                        <i class="fas fa-times mr-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="portfolio-modal modal fade" id="portfolioModalIII" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project Details Go Here-->
                                    <?php  echo"  <h2 class='text-uppercase'>$title3 </h2>  
                                    <p class='item-intro text-muted'>by $author3</p>
                                    <img class='img-fluid d-block mx-auto' src='imageart/$image3' alt='' />      "?>
                                    <button class="btn btn-primary" data-dismiss="modal" type="button">
                                        <i class="fas fa-times mr-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Core theme JS-->
        <script src="functions/script_index.js"></script>
    </body>
</html>
