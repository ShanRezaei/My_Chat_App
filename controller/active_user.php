<?php
// to start our session and include all classes
include "head.inc.php";

if (!empty($_GET["activation_code"]) && $_GET["activation_code"]== $_SESSION['random']) {
    $_SESSION['error_stat'] = "0";
    $_SESSION['attempt'] = 0;
    $_SESSION['msg'] = "enabled";
    echo "<script>alert('your username and password are activated again, log in now.');</script>";
    if ($_SESSION['page'] == "index") {
        echo "<script>window.location.href='../index.php';</script>";
    } else if ($_SESSION['page'] == "profile") {
        echo "<script>window.location.href='../user_profile.php';</script>";
    } else if ($_SESSION['page'] == "post") {
        echo "<script>window.location.href='../write_post.php';</script>";
    } else {
        echo "<script>window.location.href='../show_users.php';</script>";
    }

}else{
    echo "<script>alert('try again.');</script>";
    if ($_SESSION['page'] == "index") {
        echo "<script>window.location.href='../index.php';</script>";
    } else if ($_SESSION['page'] == "profile") {
        echo "<script>window.location.href='../user_profile.php';</script>";
    } else if ($_SESSION['page'] == "post") {
        echo "<script>window.location.href='../write_post.php';</script>";
    } else {
        echo "<script>window.location.href='../show_users.php';</script>";
    }


}


?>