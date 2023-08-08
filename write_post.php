<?php
// to start our session and include all classes
include "head.inc.php";
$_SESSION['page'] = "post";

?>
<!-- to user info -->
<?php
if (isset($_SESSION['this_user_login_new']) && $_SESSION['this_user_login_new'] == "1") {
    //unset($_SESSION['this_user_login_new']);
    $showf = "none";
    $showg = "block";
}
?>
<!-- to show error -->
<?php
if (isset($_SESSION['error_stat']) && $_SESSION['error_stat'] == "1") {
    unset($_SESSION['error_stat']);
    $showe = "block";
}
?>
<!-- to disable a tag for log in -->
<?php
if (isset($_SESSION['msg']) &&  $_SESSION['msg'] == "disabled") {

    $disp = "none";
    $showe = "block";
} else if (isset($_SESSION['msg']) &&  $_SESSION['msg'] == "enabled") {
    $disp = "inline-block";
    $showe = "none";
}
?>
<!-- to show post writing -->
<?php
if (isset($_SESSION['this_user_write_post_new']) && $_SESSION['this_user_write_post_new'] == "1") {
    //unset($_SESSION['error_stat']);
    $showfpost = "block";
    $showpost = "none";
}
?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bootstrap link *****************but in real production it is better to download the file and have it in our machine to reference it***-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Document</title>
</head>

<body>

    <!-- -------------------------------header ----------------------- -->
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Chat_APP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user_profile.php">Profile</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="write_post.php">Post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="show_users.php">Active_users</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <div class="container">

        <!-- ------------------------Title ------------------ -->
        <div class="card cards card-2 text-center" id="card1">



            <div class="card-body">

                <h2 class="card-title">Welcome to our Chat_App</h2>
                <h6 class="card-text">Here in this App you can post news and also <br>you can see your friends posts.</h6>
                <h4 class="card-text" style="font-weight: 600;">To send post, Log in or Register.</h4>
                <br>
                <br>

            </div>



        </div>
        <!-- ------------------------sidebar  card and show post card------------------- -->
        <div class="container">
            <div class="row" class="main">


                <!------ sidebar to register or login------- -->
                <div class="col-12  col-lg-4 ">

                    <div class="card cards card-2 text-center" id="card2">
                        <!-- show there is error -->
                        <div class="alert alert-danger" role="alert" style="display:<?php echo isset($showe) ? $showe : "none"; ?>">
                            <?php echo isset($_SESSION['msg_error']) ? $_SESSION['msg_error'] : ""; ?>
                        </div>

                        <div class="card-body" style="display:<?php echo isset($showf) ? $showf : "block"; ?>">



                            <!-- add modal by two tags -->
                            <a href="#" class="btn btn-success" id="login" data-bs-toggle="modal" data-bs-target="#loginModal" style="display:<?php echo isset($disp) ? $disp : "inline-block"; ?>">Log-in</a>
                            <!-- add modal by two tags -->
                            <a href="#" class="btn btn-primary" id="register" data-bs-toggle="modal" data-bs-target="#addModal">Register</a>



                        </div>


                        <!-- after login this part will be shown -->
                        <div class="card-body" style="display:<?php echo isset($showg) ? $showg : "none"; ?>">
                            <img src="<?php echo isset($_SESSION['this_user_avatar_new']) ? $_SESSION['this_user_avatar_new'] : ""; ?>" alt="my image" width="100px" height="95px">
                            <!-- first and last name -->
                            <p><span><?php echo isset($_SESSION['this_user_fname_new']) ? $_SESSION['this_user_fname_new'] : ""; ?></span> <?php echo isset($_SESSION['this_user_lname_new']) ? $_SESSION['this_user_lname_new'] : ""; ?> </p>

                            <p>Username: <?php echo isset($_SESSION['this_user_username_new']) ? $_SESSION['this_user_username_new'] : ""; ?></p>
                            <p>number of posts: <?php echo isset($_SESSION['this_user_num_post_new']) ? $_SESSION['this_user_num_post_new'] : "0"; ?></p>

                            <!-- log out process -->
                            <form action="controller/control.php" method="post" style="display:inline-block;width: 24%;">
                                <input type="hidden" name="action" value="logout">

                                <input type="submit" name="logout" value="Log out" class="btn btn-warning" style="font-weight: 600;">
                            </form>

                        </div>






                    </div>
                </div>

                <!-------- posts------- -->
                <div class="col-12  col-lg-8 ">
                    <div class="card cards card-2 text-center" id="card2">
                        <div class="card-body">

                            <div class="alert alert-warning" role="alert" style="display:<?php echo isset($showpost) ? $showpost : "block"; ?>">
                                Log in to Write Your Post!
                            </div>


                            <!------------------------------------ writing post part------------------------------- -->

                            <div class="container" style="display:<?php echo isset($showfpost) ? $showfpost : "none"; ?>">



                                <h4 style="border-bottom: 2px solid #999;">Shout out:</h4>
                                <!-- writing post part -->

                                <form method="POST" action="controller/control.php" enctype="multipart/form-data" id="form_post">
                                    <!-- hidden input -->
                                    <input type="hidden" name="action" value="writepost">

                                    <input name="post_title" type="text" id="post_title" placeholder="Title" class="form-control" style=" margin-top: 2%;" />
                                    <!-- error text to show -->
                                    <span style="display: block;color:chocolate"><?php echo isset($_SESSION['titleerror']) ? $_SESSION['titleerror'] : ""; ?></span>


                                    <textarea class="form-control" id="description" name="description" rows="4" cols="50" style="display: block;margin-top: 1%;" placeholder="write your post.">
                                         </textarea>
                                    <span style="display: block;color:chocolate"><?php echo isset($_SESSION['posterror']) ? $_SESSION['posterror'] : ""; ?></span>
                                    <label for="post_img" class="form-label mystyle" style="font-weight: 600; margin-top: 2%;">Image:</label>
                                    <input type="file" class="form-control myinput" id="post_img" name="post_img" />
                                    <!-- error text to show -->
                                    <span style="display: block;color:chocolate"><?php echo isset($_SESSION['imgerror']) ? $_SESSION['imgerror'] : ""; ?></span>

                                    <input type="submit" name="submit_post" id="submit_post" value="Send" class=" btn btn-warning form-control" style="font-weight: 600;margin-top: 2%;margin-bottom:6%" />
                                </form>





                            </div> <!-- end of content -->








                        </div>





                    </div>


                </div>




            </div>





        </div>






    </div>

    <!-- ----------------footer-------------------- -->
    <footer class="bg-light text-center text-lg-start footer">
        <!-- Copyright -->
        <div class="text-center p-3">
            © 2023 Copyright Shan.Rezaei:
            <a class="text-dark" href="#">Chat_APP.com</a>
        </div>
        <!-- Copyright -->
    </footer>




    <!---------------------------------------- modals--------------------------------- -->
    <!-- registration modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Registration Form</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- create our form to do the registration -->
                    <!-- --------------------main body of the form---------------- -->
                    <div class="container" id="mymain">



                        <form id="form1" method="POST" action="controller/control.php" enctype="multipart/form-data">
                            <!-- hidden input -->
                            <input type="hidden" name="action" value="adduser">

                            <!-----------------radio buttons for gender------- -->
                            
                            <div class="form-check" style="text-align: left;">
                                <input class="form-check-input" type="radio" name="G" id="female" value="Female" />

                                <label class="form-check-label" for="female"> Female </label>
                            </div>
                            <div class="form-check" style="text-align: left;">
                                <input class="form-check-input" type="radio" name="G" id="male" value="Male" />
                                <label class="form-check-label" for="male"> Male </label>
                            </div>
                            <div><span id="radiospan" style="color:chocolate"><?php echo isset($_SESSION['mygendererror']) ? $_SESSION['mygendererror'] : ""; ?></span></div>
                            <!----------------- general inputs--------------------------- -->
                            <div class="mb-3">

                                <input type="text" class="form-control myinput" name="fname" id="fname" placeholder="First name" min="2" />
                                <!-- error text to show -->
                                <span style="color:chocolate"><?php echo isset($_SESSION['myfirsterror']) ? $_SESSION['myfirsterror'] : ""; ?></span>
                            </div>
                            <div class="mb-3">

                                <input type="text" class="form-control myinput" name="lname" id="lname" placeholder="Last name" min="2" />
                                <!-- error text to show -->
                                <span style="color:chocolate"><?php echo isset($_SESSION['mylasterror']) ? $_SESSION['mylasterror'] : ""; ?></span>
                            </div>
                            <div class="mb-3">

                                <input type="number" class="form-control myinput" name="age" id="age" placeholder="Age" min="5" max="150" />
                                <!-- error text to show -->
                                <span style="color:chocolate"><?php echo isset($_SESSION['myageerror']) ? $_SESSION['myageerror'] : ""; ?></span>
                            </div>

                            <div class="mb-3">

                                <input type="email" class="form-control myinput" name="email" id="email" placeholder="Email" />
                                <!-- error text to show -->
                                <span style="color:chocolate"><?php echo isset($_SESSION['myemailerror']) ? $_SESSION['myemailerror'] : ""; ?></span>
                            </div>

                            <div class="mb-3">

                                <input type="text" class="form-control myinput" id="username" name="userName" placeholder="Username" min="5" />
                                <!-- error text to show -->
                                <span style="color:chocolate"><?php echo isset($_SESSION['myusererror']) ? $_SESSION['myusererror'] : ""; ?></span>
                            </div>
                            <div class="mb-3">

                                <input type="password" class="form-control myinput" id="password" name="password" placeholder="Password" min="6" />
                                <!-- error text to show -->
                                <span style="color:chocolate"><?php echo isset($_SESSION['mypasserror']) ? $_SESSION['mypasserror'] : ""; ?></span>
                            </div>
                            <div class="mb-3">

                                <input type="password" class="form-control myinput" id="confirmation" name="confirmation" placeholder="Password(Confirmation)" min="6" />
                                <!-- error text to show -->
                                <span style="color:chocolate"><?php echo isset($_SESSION['mycpasserror']) ? $_SESSION['mycpasserror'] : ""; ?></span>
                                <span style="color:chocolate"><?php echo isset($_SESSION['mycerror']) ? $_SESSION['mycerror'] : ""; ?></span>
                            </div>
                            <div class="mb-3">

                                <input type="file" class="form-control myinput" id="avatar" name="avatar" />
                                <!-- error text to show -->
                                <span style="color:chocolate"><span style="color:chocolate"><?php echo isset($_SESSION['myavatarerror']) ? $_SESSION['myavatarerror'] : ""; ?></span></span>
                            </div>



                            <!------------------------- buttons--------------------------- -->
                            <div>
                                <input type="submit" value="Submit" name="submit2" class="btn btn-success mystyle2" />

                            </div>
                        </form>
                    </div>



                </div>
            </div>
        </div>

    </div>


    <!------------------ login modal----------------- -->


    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Log in</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- create our form to do the registration -->
                    <!-- --------------------main body of the form---------------- -->
                    <form action="controller/control.php" method="post" id="form_login">
                        <!-- hidden input -->
                        <input type="hidden" name="action" value="loginuser">
                        <div class="form-group mb-3">

                            <input type="text" name="username1" class="form-control" placeholder="Enter username" id="username1">
                            <!-- error text to show -->
                            <span style="color:chocolate"></span>
                        </div>



                        <div class="form-group mb-3">

                            <input type="password" name="password1" class="form-control" placeholder="Enter Password" id="password1">
                            <!-- error text to show -->
                            <span style="color:chocolate"></span>
                        </div>





                        <div class="form-group mb-3">
                            <input type="submit" name="login" value="Log in" class="form-control btn btn-success">
                        </div>
                    </form>



                </div>
            </div>
        </div>

    </div>




















    <!-- with this line of code , it can prevent of resubmiting of info inside the form from cashe.
         add it to your code. -->
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <!--------------------------------------------- javascript for bootstrap --------------------------------------------------->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <!-- jquery link -->
    <script src="js-folder/jquery.js"></script>
    <!-- my js file -->
    <script type="text/javascript" src="js-folder/app.js"></script>
</body>

</html>