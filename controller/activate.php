<?php
// to start our session and include all classes
include "head.inc.php";

if (!empty($_GET["username"])) {
    
    //update status of the user in db to 1
    
   
    
    $DbMgra = new DbManager();
   $resultactive = $DbMgra->activateUser(trim($_GET["username"]));

    //  then send another email to ask to log in
    //send email for activation

    if (isset($resultactive)) {

        $actual_link = "https://nkhodapanah.herzingmontreal.ca/Shan_finalProjectB2M4/index.php";
        $email = $_GET["email"];
        $subject = "Congratulation, Your registration is done.";
        $content = "<h4>Click this link to log in your account.</h4>";
        $content .= " <p><a href='" . $actual_link . "'>" . $actual_link . "</a></p>";
        $headers = 'From:nkhodapanah@nkhodapanah.herzingmontreal.ca' . "\r\n";

        $sendemail1 = $DbMgra->sendEmail($email, $subject, $content, $headers);
        
        if ($sendemail1 == "1") {
            echo "<script>alert('Congratulation,you can log in now.');</script>";
            echo "<script>window.location.href='../index.php';</script>";
        } else {
            echo "<script>alert('something went wrong.');</script>";
            echo "<script>window.location.href='../index.php';</script>";
        }
    } else {
        echo "<script>alert('problem in activation.try again.');</script>";
        echo "<script>window.location.href='../index.php';</script>";
    }
}












?>