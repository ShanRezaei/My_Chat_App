
<?php
// to start our session and include all classes
include "head.inc.php";
$DbMngIndex1 = new DbManager();

?>


<!-- GET USER INFO BASED ON USERNAME -->
<?php
$_SESSION["this_user_img1"]=$_SESSION["this_user_info1"]=$_SESSION["this_user_infolast1"]=$_SESSION["this_user_gender1"]=$_SESSION["this_user_username1"]=$_SESSION["this_user_age1"]="";
if (isset($_GET['subject']) && !empty($_GET['subject'])) {

    $resultsearchu = $DbMngIndex1->getUserByUsername(trim($_GET['subject']));
    if (isset($resultsearchu)) {
        $_SESSION["this_user_img1"]=$resultsearchu->getAvatar();
        $_SESSION["this_user_info1"]=$resultsearchu->getFirstName();
        $_SESSION["this_user_infolast1"]=$resultsearchu->getLastName();
        $_SESSION["this_user_gender1"]=$resultsearchu->getGender();
        $_SESSION["this_user_age1"]=$resultsearchu->getAge();
        $_SESSION["this_user_username1"]=$resultsearchu->getUserName();


    }else{
        echo "<script>alert('something went wrong,try again!');</script>";
        echo "<script>window.location.href='show_users.php';</script>";
    }



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
    <link href='http://fonts.googleapis.com/css?family=Press+Start+2P' rel='stylesheet' type='text/css'>
</head>

<body>
    <!-- modal for a tags -->


    <div class="modal fade" id="exampleModal2" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 60%;text-align:center">
                <div class="modal-header">
                    <h2 class="modal-title">User's info</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close"></button>
                </div>
                <div class="modal-body">
                    <img src="<?php echo (isset($_SESSION["this_user_img1"]) && !empty($_SESSION["this_user_img1"])) ?    $_SESSION["this_user_img1"]  : ''; ?>" alt="my_image" width="120" height="110" id="user_img">

                    <p style="text-align:center ;margin-top:3%;font-weight: 600;font-size:110%">First name: <?php echo (isset($_SESSION["this_user_info1"]) && !empty($_SESSION["this_user_info1"])) ?    $_SESSION["this_user_info1"] : ''; ?></p>
                    <p style="text-align:center ;margin-top:1%;font-weight: 600;font-size:110%">Last name: <?php echo (isset($_SESSION["this_user_infolast1"]) && !empty($_SESSION["this_user_infolast1"])) ?    $_SESSION["this_user_infolast1"] : ''; ?></p>
                    <p style="text-align:center;font-weight: 500;font-size:110%">Age: <?php echo (isset($_SESSION["this_user_age1"]) && !empty($_SESSION["this_user_age1"])) ?    $_SESSION["this_user_age1"] : ''; ?></p>
                    <p style="text-align:center ;margin-top:1%;font-weight: 500;font-size:110%">Gender: <?php echo (isset($_SESSION["this_user_gender1"]) && !empty($_SESSION["this_user_gender1"])) ?     $_SESSION["this_user_gender1"] : ''; ?></p>
                    <p style="text-align:center ;margin-top:1%;font-weight: 500;font-size:110%">Username: <?php echo (isset($_SESSION["this_user_username1"]) && !empty($_SESSION["this_user_username1"])) ?     $_SESSION["this_user_username1"] : ''; ?></p>




                </div>
            </div>
        </div>
    </div>


    <!------------------ --------------------------javascript file-------------------------------------- -->
    <!--------------------------------------------- javascript for bootstrap --------------------------------------------------->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <!-- jquery link -->
    <script src="js-folder/jquery.js"></script>
    <!-- my js file -->
    <script src="js-folder/app.js"></script>

    <!-- -----IMPORTANT:****** to run the modal with below code it must be after the js links----- -->
    <?php
    if (isset($_GET['subject']) && !empty($_GET['subject'])) {
        echo "<script type='text/javascript'>
            $(document).ready(function(){
            $('#exampleModal2').modal('show');
            });
            </script>";
    }
    ?>

    <!-- to redirect to the main page after closing the modal -->
    <script type='text/javascript'>
        $(document).ready(function() {
            $("#close").click(function() {
                window.location.replace("show_users.php");
            });
        });
    </script>


</body>

</html>