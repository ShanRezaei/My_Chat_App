<?php
// to include classes and start session
include "../head.inc.php";
// to have date and time
date_default_timezone_set('America/Montreal');
//Creating a DateTime object
$date_time_Obj = date_create();
//formatting the date to print it
$date = (date_format($date_time_Obj, "F d, Y h:i:s A"));


/////////////////// define our variables for registration///////////////
$info = "";
$ageErr = $genderErr = $firstErr = $lastErr = $usernameErr = $passErr = $repeatErr = $emailErr = $cpassErr = $avatarErr = "";
$myusername = $mypass = $mycpass = $myemail = $img = $myfirst = $mylast = $mygender = $myage = "";
$isvalidate = true;
$_SESSION['myusererror'] = $_SESSION['myageerror'] = $_SESSION['mypasserror'] = $_SESSION['myfirsterror'] = $_SESSION['mygendererror'] = $_SESSION['mylasterror'] = $_SESSION['mycpasserror'] = $_SESSION['myemailerror'] = $_SESSION['myavatarerror'] = $_SESSION['mycerror'] = $_SESSION['msg_error'] = "";
$_SESSION['error_stat'] = "0";

$_SESSION['msg'] = "";



// define variables for update info
$genderErr1 = $firstErr1 = $lastErr1 = $emailErr1 = $avatarErr1 = "";
$isvalidate1 = true;
$_SESSION['myfirsterror1'] = $_SESSION['mygendererror1'] = $_SESSION['mylasterror1'] = $_SESSION['myemailerror1'] = $_SESSION['myavatarerror1'] = "";
$_SESSION['error_statup'] = "0";


// define variables for change password
$newpassErr = $newcpassErr = $newrErr = "";
$isvalidate2 = true;
$_SESSION['newpasserror'] = $_SESSION['newcpasserror'] = $_SESSION['newrerror'] = "";


//define variables for send post
$titleErr = $postErr = $imgErr = "";
$isvalidate3 = true;
$_SESSION['titleerror'] = $_SESSION['posterror'] = $_SESSION['imgerror'] = "";






// image characters
$accepted_format = array("image/png", "image/jpg", "image/jpeg");
$php_file_error = [];
$php_file_error[0] = 'There is no error, the file uploaded with success';
$php_file_error[1] = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
$php_file_error[2] = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
$php_file_error[3] = 'The uploaded file was only partially uploaded';
$php_file_error[4] = 'No file was uploaded';
$php_file_error[6] = 'Missing a temporary folder';
$php_file_error[7] = 'Failed to write file to disk.';
$php_file_error[8] = 'A PHP extension stopped the file upload.';



// create object of dbmanager to access functions
$DbMgr = new DbManager();
$action = $_REQUEST['action'];


// start action reading
switch ($action) {

        // add user
    case 'adduser':

        if (!empty($_POST['G']) || !empty($_POST['fname']) || !empty($_POST['lname']) || !empty($_POST['age']) || !empty($_POST['userName']) || !empty($_POST['password']) || !empty($_POST['confirmation']) || !empty($_POST['email']) || !empty($_FILES['avatar'])) {


            ////////////////// validation of inputs////////////////////


            //validate gender
            if (!empty(($_POST["G"]))) {
                $mygender = trim($_POST["G"]);
                $isvalidate = true;
            } else {
                $genderErr = "choose the gender.";
                $_SESSION['mygendererror'] = "choose the gender.";

                $isvalidate = false;
            }



            // validate first name

            if (!empty(trim($_POST["fname"]))) {
                if (ctype_alpha(trim($_POST["fname"]))) {
                    if (strlen(trim($_POST["fname"])) >= 2) {
                        $myfirst = trim($_POST["fname"]);
                        $isvalidate = true;
                    } else {
                        $firstErr = "your first name should be more than 2 character.";
                        $_SESSION['myfirsterror'] = "your first name should be more than 2 character.";

                        $isvalidate = false;
                    }
                } else {
                    $firstErr = "Enter only character.";
                    $_SESSION['myfirsterror'] = "Enter only character.";

                    $isvalidate = false;
                }
            } else {
                $firstErr = "Enter your first name.";
                $_SESSION['myfirsterror'] = "Enter your first name.";

                $isvalidate = false;
            }




            // validate last name

            if (!empty(trim($_POST["lname"]))) {
                if (ctype_alpha(trim($_POST["lname"]))) {
                    if (strlen(trim($_POST["lname"])) >= 2) {
                        $mylast = trim($_POST["lname"]);
                        $isvalidate = true;
                    } else {
                        $lastErr = "your last name should be more than 2 character.";
                        $_SESSION['mylasterror'] = "your last name should be more than 2 character.";

                        $isvalidate = false;
                    }
                } else {
                    $lastErr = "Enter only character.";
                    $_SESSION['mylasterror'] = "Enter only character.";

                    $isvalidate = false;
                }
            } else {
                $lastErr = "Enter your last name.";
                $_SESSION['mylasterror'] = "Enter your last name.";

                $isvalidate = false;
            }




            // validate age

            if (!empty(trim($_POST["age"]))) {

                if (intval(trim($_POST["age"])) >= 18 && intval(trim($_POST["age"])) <= 80) {
                    $myage = trim($_POST["age"]);
                    $isvalidate = true;
                } else {
                    $ageErr = "your age should be between 18 and 80.";
                    $_SESSION['myageerror'] = "your age should be between 18 and 80.";

                    $isvalidate = false;
                }
            } else {
                $ageErr = "Enter your age.";
                $_SESSION['myageerror'] = "Enter your age.";

                $isvalidate = false;
            }



            //email validation

            if (!empty($_POST["email"])) {
                //check the format of the email
                $email = trim($_POST['email']);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = 'enter valid email address';
                    $_SESSION['myemailerror'] = $emailErr;

                    $isvalidate = false;
                } else {
                    $myemail = trim($_POST['email']);
                    $isvalidate = true;
                }
            } else {
                $emailErr = 'enter your email address';
                $_SESSION['myemailerror'] = $emailErr;

                $isvalidate = false;
            }


            // validate the length of username
            if (!empty(trim($_POST["userName"]))) {

                if (strlen(trim($_POST["userName"])) >= 5) {
                    $myusername = trim($_POST["userName"]);
                    $isvalidate = true;
                } else {
                    $usernameErr = 'your username could not be less than 5 character';

                    $_SESSION['myusererror'] = $usernameErr;
                    $isvalidate = false;
                }
            } else {
                $usernameErr = 'your username is empty.';

                $_SESSION['myusererror'] = $usernameErr;
                $isvalidate = false;
            }


            //validate password
            if (!empty($_POST["password"])) {
                // password strength validation

                $password = trim($_POST["password"]);

                // Validate password strength
                $uppercase = preg_match('@[A-Z]@', $password);
                $lowercase = preg_match('@[a-z]@', $password);
                $number    = preg_match('@[0-9]@', $password);
                $specialChars = preg_match('@[^\w]@', $password);

                if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 6) {

                    $passErr = 'your password should consist of a capital letter,special character,a number and more than 6 letters.';
                    $_SESSION['mypasserror'] = $passErr;


                    $isvalidate = false;
                } else {
                    $isvalidate = true;
                    $mypass = trim($_POST["password"]);
                }
            } else {
                $passErr = 'enter Password .';
                $_SESSION['mypasserror'] = $passErr;


                $isvalidate = false;
            }


            //validate  confirm password
            if (!empty($_POST["confirmation"])) {
                // password strength validation

                $cpassword = trim($_POST["confirmation"]);

                // Validate password strength
                $uppercase = preg_match('@[A-Z]@', $cpassword);
                $lowercase = preg_match('@[a-z]@', $cpassword);
                $number    = preg_match('@[0-9]@', $cpassword);
                $specialChars = preg_match('@[^\w]@', $cpassword);

                if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($cpassword) < 6) {

                    $cpassErr = 'your password should consist of a capital letter,special character,a number and more than 6 letters.';
                    $_SESSION['mycpasserror'] = $cpassErr;


                    $isvalidate = false;
                } else {
                    $isvalidate = true;
                    $mycpass = trim($_POST["confirmation"]);
                }
            } else {
                $cpassErr = 'enter Password .';
                $_SESSION['mycpasserror'] = $cpassErr;


                $isvalidate = false;
            }


            //   check if confirm pass and pass are the same
            if (trim($_POST['password']) != trim($_POST['confirmation'])) {
                $repeatErr = 'your password should be the same as your confirm.';

                $isvalidate = false;

                $_SESSION['mycerror'] = $repeatErr;
            }


            //validate avatar
            if (($_FILES["avatar"]) == "") {
                $isvalidate = false;
                $avatarErr = "choose your avatar.";
                $_SESSION['myavatarerror'] =  $avatarErr;
            }


            // var_dump($_POST);
            // var_dump($_SESSION);
            // echo $cpassErr;
            // echo $repeatErr;
            // echo $emailErr;
            // echo $firstErr;
            // echo $lastErr;
            // echo $ageErr;
            // echo $usernameErr;
            // echo $genderErr;
            // echo $passErr;
            // echo $avatarErr;
            // echo $isvalidate;


            ///////////////////////// on submit if there is no error///////////////////////////////////////

            if ($isvalidate === true  &&  $repeatErr == "" && $emailErr == "" && $cpassErr == "" && $passErr == "" && $usernameErr == "" &&  $avatarErr == "" && $firstErr == "" && $lastErr == "" && $ageErr == "" && $genderErr == "") {

                // //make the path of the avatar and check other character of image to be correct
                $image_name = $_FILES['avatar']['name'];
                $image_type = $_FILES['avatar']['type'];
                $image_size = $_FILES['avatar']['size'];
                $image_temp_name = $_FILES['avatar']['tmp_name'];
                $array_name = explode(".", $image_name);
                $image_format = end($array_name); //get last index of array
                //make an address for saving avatar
                $image_address = "user_image/" . $myusername . "." . $image_format;

                //check for general errors
                if (!$_FILES['avatar']['error']) {
                    // check the size of the image
                    if ($image_size < 1024000) {
                        //check for type of the image
                        if (in_array($image_type, $accepted_format)) {

                            /////////////////check for unique username////////////////
                            // here we used the object of dbmanager to get the function

                            $rowcount = $DbMgr->getUserByUsername($myusername);
                            if (isset($rowcount)) {
                                echo "<script>alert('this user name already registered.Try with different username!');</script>";

                                if ($_SESSION['page'] == "index") {
                                    echo "<script>window.location.href='../index.php';</script>";
                                } else if ($_SESSION['page'] == "profile") {
                                    echo "<script>window.location.href='../user_profile.php';</script>";
                                } else if ($_SESSION['page'] == "post") {
                                    echo "<script>window.location.href='../write_post.php';</script>";
                                } else {
                                    echo "<script>window.location.href='../show_users.php';</script>";
                                }
                            } else {
                                // check for email uniqueness
                                $emailrowcount = $DbMgr->getUserByEmail($myemail);
                                if ($emailrowcount > 0) {
                                    echo "<script>alert('this email already registered.Try with different email!');</script>";

                                    if ($_SESSION['page'] == "index") {
                                        echo "<script>window.location.href='../index.php';</script>";
                                    } else if ($_SESSION['page'] == "profile") {
                                        echo "<script>window.location.href='../user_profile.php';</script>";
                                    } else if ($_SESSION['page'] == "post") {
                                        echo "<script>window.location.href='../write_post.php';</script>";
                                    } else {
                                        echo "<script>window.location.href='../show_users.php';</script>";
                                    }
                                } else {
                                    //uploade img in the folder in project root
                                    move_uploaded_file($image_temp_name, "../" . $image_address);

                                    // write inside the database
                                    //  hash the password
                                    $hashedpassword = password_hash(($mypass), PASSWORD_DEFAULT);

                                    //create user object
                                    $user = new User($id, $myfirst, $mylast, $mygender, $myage, $myemail, $myusername, $hashedpassword, $image_address, $stat);

                                    $adduser = $DbMgr->addUser($user);

                                    if (isset($adduser)) {

                                        $actual_link = "https://nkhodapanah.herzingmontreal.ca/Shan_finalProjectB2M4/" . "activate.php?username=" . ($myusername) . "&email=" . ($myemail);
                                        $header = 'From:nkhodapanah@nkhodapanah.herzingmontreal.ca' . "\r\n";
                                        $email = $myemail;
                                        $subject = "User Registration Activation Email";
                                        $content = "Click this link to activate your account. <a href='" . $actual_link . "'>" . $actual_link . "</a>";

                                        $sendemail = $DbMgr->sendEmail($email, $subject, $content, $header);

                                        if ($sendemail == 1) {
                                            echo "<script>alert('You Registered successfully,check your email and activate your account.');</script>";
                                            if ($_SESSION['page'] == "index") {
                                                echo "<script>window.location.href='../index.php';</script>";
                                            } else if ($_SESSION['page'] == "profile") {
                                                echo "<script>window.location.href='../user_profile.php';</script>";
                                            } else if ($_SESSION['page'] == "post") {
                                                echo "<script>window.location.href='../write_post.php';</script>";
                                            } else {
                                                echo "<script>window.location.href='../show_users.php';</script>";
                                            }
                                        } else {
                                            echo "<script>alert('something went wrong.try again.');</script>";
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
                                    } else {
                                        echo "<script>alert('problem in registration.try again.');</script>";
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
                                }
                            }
                        } else {
                            echo "<script>alert('invalid image format.Choose the new one.');</script>";
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
                    } else {
                        echo "<script>alert('the size of the image is big.Choose the new one.');</script>";
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
                } else {
                    echo "<script>alert('there is an error for image, choose another one!');</script>";
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
            } else {
                $_SESSION['msg_error'] = "fill out fields correctly based on errors!";
                $_SESSION['error_stat'] = "1";
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
        } else {
            $_SESSION['msg_error'] = "fill out All fields correctly!";
            $_SESSION['error_stat'] = "1";
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

        break;




        // update user info
    case 'updateuser':
        if (!empty($_POST['G1']) && !empty($_POST['firstname1']) && !empty($_POST['lastname1'])  && !empty($_POST['email1'])) {
            ////////////////// validation of inputs////////////////////


            //validate gender
            if (!empty(($_POST["G1"]))) {
                $mygender1 = trim($_POST["G1"]);
                $isvalidate1 = true;
            } else {
                $genderErr1 = "choose the gender.";
                $_SESSION['mygendererror1'] = "choose the gender.";

                $isvalidate1 = false;
            }



            // validate first name

            if (!empty(trim($_POST["firstname1"]))) {
                if (ctype_alpha(trim($_POST["firstname1"]))) {
                    if (strlen(trim($_POST["firstname1"])) >= 2) {
                        $myfirst1 = trim($_POST["firstname1"]);
                        $isvalidate1 = true;
                    } else {
                        $firstErr1 = "your first name should be more than 2 character.";
                        $_SESSION['myfirsterror1'] = "your first name should be more than 2 character.";

                        $isvalidate1 = false;
                    }
                } else {
                    $firstErr1 = "Enter only character.";
                    $_SESSION['myfirsterror1'] = "Enter only character.";

                    $isvalidate1 = false;
                }
            } else {
                $firstErr1 = "Enter your first name.";
                $_SESSION['myfirsterror1'] = "Enter your first name.";

                $isvalidate1 = false;
            }




            // validate last name

            if (!empty(trim($_POST["lastname1"]))) {
                if (ctype_alpha(trim($_POST["lastname1"]))) {
                    if (strlen(trim($_POST["lastname1"])) >= 2) {
                        $mylast1 = trim($_POST["lastname1"]);
                        $isvalidate1 = true;
                    } else {
                        $lastErr1 = "your last name should be more than 2 character.";
                        $_SESSION['mylasterror1'] = "your last name should be more than 2 character.";

                        $isvalidate1 = false;
                    }
                } else {
                    $lastErr1 = "Enter only character.";
                    $_SESSION['mylasterror1'] = "Enter only character.";

                    $isvalidate1 = false;
                }
            } else {
                $lastErr1 = "Enter your last name.";
                $_SESSION['mylasterror1'] = "Enter your last name.";

                $isvalidate1 = false;
            }



            //email validation

            if (!empty($_POST["email1"])) {
                //check the format of the email
                $email1 = trim($_POST['email1']);
                if (!filter_var($email1, FILTER_VALIDATE_EMAIL)) {
                    $emailErr1 = 'enter valid email address';
                    $_SESSION['myemailerror1'] = $emailErr;

                    $isvalidate1 = false;
                } else {
                    $myemail1 = trim($_POST['email1']);
                    $isvalidate1 = true;
                }
            } else {
                $emailErr1 = 'enter your email address';
                $_SESSION['myemailerror1'] = $emailErr1;

                $isvalidate1 = false;
            }


            //validate avatar
            // if (empty($_FILES["avatar1"])) {
            //     $isvalidate1 = false;
            //     $avatarErr1 = "choose your avatar.";
            //     $_SESSION['myavatarerror1'] =  $avatarErr1;
            // }


            ///////////////////////// on submit if there is no error///////////////////////////////////////

            if ($isvalidate1 === true  &&   $emailErr1 == ""   && $firstErr1 == "" && $lastErr1 == ""  && $genderErr1 == "") {


                if (empty($_FILES["avatar1"]) == false) {

                    // check for email uniqueness
                    if ($myemail1 == $_SESSION['this_user_email_new']) {

                        //     // first remove the old img and save the new one
                        //     if (file_exists("../".$_SESSION['this_user_avatar_new'])) {
                        //        unlink("../".$_SESSION['this_user_avatar_new']);
                        //    } else {
                        //        echo "img File does not exists to edit.";
                        //    }

                        //    // save the new img
                        //    move_uploaded_file($image_temp_name, $_SESSION['this_user_avatar_new']);
                        //create user object
                        echo $myfirst1;
                        echo $mygender1;
                        echo $_SESSION['this_user_id_new'];
                        $user1 = new User($_SESSION['this_user_id_new'], $myfirst1, $mylast1, $mygender1, $_SESSION['this_user_age_new'], $_SESSION['this_user_email_new'], $_SESSION['this_user_username_new'], $_SESSION['this_user_password_new'], $_SESSION['this_user_avatar_new'], "1");

                        $updateuser = $DbMgr->updateUser($user1);
                        if (isset($updateuser)) {
                            $resultsearch1 = $DbMgr->getUserByUsername($_SESSION['this_user_username_new']);
                            if (isset($resultsearch1)) {



                                $_SESSION['this_user_email_new'] = $resultsearch1->getEmail();
                                $_SESSION['this_user_avatar_new'] = $resultsearch1->getAvatar();
                                $_SESSION['this_user_fname_new'] = $resultsearch1->getFirstName();
                                $_SESSION['this_user_lname_new'] = $resultsearch1->getLastName();
                                $_SESSION['this_user_gender_new'] = $resultsearch1->getGender();

                                echo "<script>alert('your info updated successfully.');</script>";
                                echo "<script>window.location.href='../user_profile.php';</script>";
                            } else {
                                echo "<script>alert('something went wrong,try again.');</script>";
                                echo "<script>window.location.href='../user_profile.php';</script>";
                            }
                        } else {
                            echo "<script>alert('something went wrong,try again.');</script>";
                            echo "<script>window.location.href='../user_profile.php';</script>";
                        }
                    } else {
                        $emailrowcount1 = $DbMgr->getUserByEmail($myemail1);
                        if ($emailrowcount1 > 0) {
                            echo "<script>alert('this email already registered.Try with different email!');</script>";
                            echo "<script>window.location.href='../user_profile.php';</script>";
                        } else {

                            //    // first remove the old img and save the new one
                            //    if (file_exists($_SESSION['this_user_avatar_new'])) {
                            //        unlink($_SESSION['this_user_avatar_new']);
                            //    } else {
                            //        echo "img File does not exists to edit.";
                            //    }

                            //    // save the new img
                            //    move_uploaded_file($image_temp_name, $image_address1);
                            //create user object
                            $user = new User($_SESSION['this_user_id_new'], $myfirst1, $mylast1, $mygender1, $_SESSION['this_user_age_new'], $myemail1, $_SESSION['this_user_username_new'], $_SESSION['this_user_password_new'], $_SESSION['this_user_avatar_new'], "1");

                            $updateuser = $DbMgr->updateUser($user);
                            if (isset($updateuser)) {
                                $resultsearch1 = $DbMgr->getUserByUsername($_SESSION['this_user_username_new']);
                                if (isset($resultsearch1)) {



                                    $_SESSION['this_user_email_new'] = $resultsearch1->getEmail();
                                    $_SESSION['this_user_avatar_new'] = $resultsearch1->getAvatar();
                                    $_SESSION['this_user_fname_new'] = $resultsearch1->getFirstName();
                                    $_SESSION['this_user_lname_new'] = $resultsearch1->getLastName();
                                    $_SESSION['this_user_gender_new'] = $resultsearch1->getGender();

                                    echo "<script>alert('your info updated successfully.');</script>";
                                    //echo "<script>window.location.href='../user_profile.php';</script>";



                                } else {
                                    echo "<script>alert('something went wrong,try again.');</script>";
                                    echo "<script>window.location.href='../user_profile.php';</script>";
                                }
                            } else {
                                echo "<script>alert('something went wrong,try again.');</script>";
                                echo "<script>window.location.href='../user_profile.php';</script>";
                            }
                        }
                    }
                } else {


                    // //make the path of the avatar and check other character of image to be correct
                    $image_name = $_FILES['avatar1']['name'];
                    $image_type = $_FILES['avatar1']['type'];
                    $image_size = $_FILES['avatar1']['size'];
                    $image_temp_name = $_FILES['avatar1']['tmp_name'];
                    $array_name = explode(".", $image_name);
                    $image_format = end($array_name); //get last index of array
                    //make an address for saving avatar
                    $image_address1 = "user_image/" . $_SESSION['this_user_username_new'] . "." . $image_format;


                    //check for general errors
                    if (!$_FILES['avatar1']['error']) {
                        // check the size of the image
                        if ($image_size < 1024000) {
                            //check for type of the image
                            if (in_array($image_type, $accepted_format)) {

                                // check for email uniqueness
                                if ($myemail1 == $_SESSION['this_user_email_new']) {

                                    // first remove the old img and save the new one
                                    if (file_exists("../" . $_SESSION['this_user_avatar_new'])) {
                                        unlink("../" . $_SESSION['this_user_avatar_new']);
                                    } else {
                                        echo "img File does not exists to edit.";
                                    }

                                    // save the new img
                                    move_uploaded_file($image_temp_name, "../" . $image_address1);
                                    //create user object
                                    $user = new User($_SESSION['this_user_id_new'], $myfirst1, $mylast1, $mygender1, $_SESSION['this_user_age_new'], $myemail1, $_SESSION['this_user_username_new'], $_SESSION['this_user_password_new'], $image_address1, "1");

                                    $updateuser = $DbMgr->updateUser($user);
                                    if (isset($updateuser)) {
                                        $resultsearch1 = $DbMgr->getUserByUsername($_SESSION['this_user_username_new']);
                                        if (isset($resultsearch1)) {



                                            $_SESSION['this_user_email_new'] = $resultsearch1->getEmail();
                                            $_SESSION['this_user_avatar_new'] = $resultsearch1->getAvatar();
                                            $_SESSION['this_user_fname_new'] = $resultsearch1->getFirstName();
                                            $_SESSION['this_user_lname_new'] = $resultsearch1->getLastName();
                                            $_SESSION['this_user_gender_new'] = $resultsearch1->getGender();

                                            echo "<script>alert('your info updated successfully.');</script>";
                                            echo "<script>window.location.href='../user_profile.php';</script>";
                                        } else {
                                            echo "<script>alert('something went wrong,try again.');</script>";
                                            echo "<script>window.location.href='../user_profile.php';</script>";
                                        }
                                    } else {
                                        echo "<script>alert('something went wrong,try again.');</script>";
                                        echo "<script>window.location.href='../user_profile.php';</script>";
                                    }
                                } else {
                                    $emailrowcount1 = $DbMgr->getUserByEmail($myemail1);
                                    if ($emailrowcount1 > 0) {
                                        echo "<script>alert('this email already registered.Try with different email!');</script>";
                                        echo "<script>window.location.href='../user_profile.php';</script>";
                                    } else {

                                        // first remove the old img and save the new one
                                        if (file_exists($_SESSION['this_user_avatar_new'])) {
                                            unlink($_SESSION['this_user_avatar_new']);
                                        } else {
                                            echo "img File does not exists to edit.";
                                        }

                                        // save the new img
                                        move_uploaded_file($image_temp_name, $image_address1);
                                        //create user object
                                        $user = new User($_SESSION['this_user_id_new'], $myfirst1, $mylast1, $mygender1, $_SESSION['this_user_age_new'], $myemail1, $_SESSION['this_user_username_new'], $_SESSION['this_user_password_new'], $image_address1, "1");

                                        $updateuser = $DbMgr->updateUser($user);
                                        if (isset($updateuser)) {
                                            $resultsearch1 = $DbMgr->getUserByUsername($_SESSION['this_user_username_new']);
                                            if (isset($resultsearch1)) {



                                                $_SESSION['this_user_email_new'] = $resultsearch1->getEmail();
                                                $_SESSION['this_user_avatar_new'] = $resultsearch1->getAvatar();
                                                $_SESSION['this_user_fname_new'] = $resultsearch1->getFirstName();
                                                $_SESSION['this_user_lname_new'] = $resultsearch1->getLastName();
                                                $_SESSION['this_user_gender_new'] = $resultsearch1->getGender();

                                                echo "<script>alert('your info updated successfully.');</script>";
                                                echo "<script>window.location.href='../user_profile.php';</script>";



                                            } else {
                                                echo "<script>alert('something went wrong,try again.');</script>";
                                                echo "<script>window.location.href='../user_profile.php';</script>";
                                            }
                                        } else {
                                            echo "<script>alert('something went wrong,try again.');</script>";
                                            echo "<script>window.location.href='../user_profile.php';</script>";
                                        }
                                    }
                                }
                            } else {
                                echo "<script>alert('invalid image format.Choose the new one.');</script>";
                                echo "<script>window.location.href='../user_profile.php';</script>";
                            }
                        } else {
                            echo "<script>alert('the size of the image is big.Choose the new one.');</script>";
                            echo "<script>window.location.href='../user_profile.php';</script>";
                        }
                    } else {
                        echo "<script>alert('there is an error for image, choose another one!');</script>";
                        echo "<script>window.location.href='../user_profile.php';</script>";
                    }
                }
            } else {

                $_SESSION['msg_errorup'] = "fill out All fields correctly based on errors!";
                $_SESSION['error_statup'] = "1";
                echo "<script>window.location.href='../user_profile.php';</script>";
            }
        } else {

            $_SESSION['msg_errorup'] = "fill out All fields correctly!";
            $_SESSION['error_statup'] = "1";
            echo "<script>window.location.href='../user_profile.php';</script>";
        }

        break;


        // log in
    case 'loginuser':


        $_SESSION['this_user_id_new'] = "";
        $_SESSION['this_user_username_new'] = "";
        $_SESSION['this_user_fname_new'] = "";
        $_SESSION['this_user_lname_new'] = "";
        $_SESSION['this_user_avatar_new'] = "";
        $_SESSION['this_user_num_post_new'] = "";
        $_SESSION['this_user_gender_new'] = "";
        $_SESSION['this_user_age_new'] = "";
        // show user info
        $_SESSION['this_user_login_new'] = "0";
        // show update part
        $_SESSION['this_user_update_new'] = "0";
        // show write post part
        $_SESSION['this_user_write_post_new'] = "0";


        if (!empty($_POST['username1']) && !empty($_POST['password1'])) {
            //do the query in db
            $resultsearch = $DbMgr->getUserByUsername(trim($_POST['username1']));

            if (isset($resultsearch)) {
                $_SESSION['this_user_id_new'] = $resultsearch->getId();
                $_SESSION['this_user_username_new'] = $resultsearch->getUserName();
                $_SESSION['this_user_password_new'] = $resultsearch->getPassWord();
                $_SESSION['this_user_email_new'] = $resultsearch->getEmail();
                $_SESSION['this_user_avatar_new'] = $resultsearch->getAvatar();
                $_SESSION['this_user_fname_new'] = $resultsearch->getFirstName();
                $_SESSION['this_user_lname_new'] = $resultsearch->getLastName();
                $_SESSION['this_user_gender_new'] = $resultsearch->getGender();
                $_SESSION['this_user_age_new'] = $resultsearch->getAge();
                $status = $resultsearch->getStat();

                // we verifiesd password
                $verifiedpass = password_verify(trim($_POST['password1']),  $_SESSION['this_user_password_new']);
                if ($verifiedpass) {

                    if ($status == 1) {
                        //change log in status
                        $_SESSION['this_user_login_new'] = "1";
                        $_SESSION['this_user_update_new'] = "1";
                        $_SESSION['this_user_write_post_new'] = "1";

                        // count number of the posts
                        $numberp = $DbMgr->getNumberPost(trim($_POST['username1']));

                        if (isset($numberp)) {
                            $_SESSION['this_user_num_post_new'] = ($numberp);
                        } else {
                            $_SESSION['this_user_num_post_new'] = "0";
                        }



                        $_SESSION['attempt'] = 0;
                        echo "<script>alert('Welcome to our Chat_App');</script>";

                        // based on where we are
                        if ($_SESSION['page'] == "index") {
                            echo "<script>window.location.href='../index.php';</script>";
                        } else if ($_SESSION['page'] == "profile") {
                            echo "<script>window.location.href='../user_profile.php';</script>";
                        } else if ($_SESSION['page'] == "post") {
                            echo "<script>window.location.href='../write_post.php';</script>";
                        } else {
                            echo "<script>window.location.href='../show_users.php';</script>";
                        }
                    } else {
                        $_SESSION['this_user_login_new'] = "0";
                        $_SESSION['this_user_update_new'] = "0";
                        $_SESSION['this_user_write_post_new'] = "0";
                        echo "<script>alert('Please check your Email and activate your account');</script>";
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
                } else {

                    if (!isset($_SESSION['attempt'])) {
                        $_SESSION['attempt'] = 0;
                    }
                    $_SESSION['attempt'] += 1;

                    if ($_SESSION['attempt'] === 3) {
                        $_SESSION['msg'] = "disabled";

                        // make a random number and email it
                        $random_num = rand();
                        $_SESSION['random'] = $random_num;


                        $actual_link = "https://nkhodapanah.herzingmontreal.ca/Shan_finalProjectB2M4/" . "active_user.php?activation_code=" . ($random_num) . "&email=" . $_SESSION['this_user_email_new'];
                        $header = 'From:nkhodapanah@nkhodapanah.herzingmontreal.ca' . "\r\n";
                        $email = $_SESSION['this_user_email_new'];
                        $subject = " Activation Username and Password Email";
                        $content = "Click this link to activate your username and password. <a href='" . $actual_link . "'>" . $actual_link . "</a>";

                        $sendemail = $DbMgr->sendEmail($email, $subject, $content, $header);


                        $_SESSION['msg_error'] = " you are deactivated, check your email to activate your username and password.";
                        $_SESSION['error_stat'] = "1";
                        $_SESSION['attempt'] = 0;

                        if ($_SESSION['page'] == "index") {
                            echo "<script>window.location.href='../index.php';</script>";
                        } else if ($_SESSION['page'] == "profile") {
                            echo "<script>window.location.href='../user_profile.php';</script>";
                        } else if ($_SESSION['page'] == "post") {
                            echo "<script>window.location.href='../write_post.php';</script>";
                        } else {
                            echo "<script>window.location.href='../show_users.php';</script>";
                        }
                    } else if ($_SESSION['attempt'] < 3) {
                        $_SESSION['msg_error'] = " your password  is wrong,try again!";
                        $_SESSION['error_stat'] = "1";

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
                }
            } else {

                if (!isset($_SESSION['attempt'])) {
                    $_SESSION['attempt'] = 0;
                }
                $_SESSION['attempt'] += 1;

                if ($_SESSION['attempt'] === 3) {
                    $_SESSION['msg'] = "disabled";

                    // make a random number and email it
                    $random_num = rand();
                    $_SESSION['random'] = $random_num;


                    $actual_link = "https://nkhodapanah.herzingmontreal.ca/Shan_finalProjectB2M4/" . "active_user.php?activation_code=" . ($random_num) . "&email=" .  $_SESSION['this_user_email_new'];
                    $header = 'From:nkhodapanah@nkhodapanah.herzingmontreal.ca' . "\r\n";
                    $email =  $_SESSION['this_user_email_new'];
                    $subject = " Activation Username and Password Email";
                    $content = "Click this link to activate your username and password
                     . <a href='" . $actual_link . "'>" . $actual_link . "</a>";

                    $sendemail = $DbMgr->sendEmail($email, $subject, $content, $header);



                    $_SESSION['msg_error'] = " you are deactivated, check your email to activate your username and password.";
                    $_SESSION['error_stat'] = "1";
                    $_SESSION['attempt'] = 0;
                    if ($_SESSION['page'] == "index") {
                        echo "<script>window.location.href='../index.php';</script>";
                    } else if ($_SESSION['page'] == "profile") {
                        echo "<script>window.location.href='../user_profile.php';</script>";
                    } else if ($_SESSION['page'] == "post") {
                        echo "<script>window.location.href='../write_post.php';</script>";
                    } else {
                        echo "<script>window.location.href='../show_users.php';</script>";
                    }
                } else if ($_SESSION['attempt'] < 3) {
                    $_SESSION['msg_error'] = " your username  is wrong,try again!";
                    $_SESSION['error_stat'] = "1";
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
            }
        } else {
            $_SESSION['msg_error'] = "Enter your username and password!";
            $_SESSION['error_stat'] = "1";
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
        break;


        // change password
    case 'passchange':
        if (!empty($_POST['old_pass']) && !empty($_POST['new_pass']) && !empty($_POST['conform_new_pass'])) {

            $verifiedpass1 = password_verify(trim($_POST['old_pass']),  $_SESSION['this_user_password_new']);
            if ($verifiedpass1) {
                // validate the new pass and confirm 


                //validate password
                if (!empty($_POST['new_pass'])) {
                    // password strength validation

                    $password2 = trim($_POST['new_pass']);

                    // Validate password strength
                    $uppercase = preg_match('@[A-Z]@', $password2);
                    $lowercase = preg_match('@[a-z]@', $password2);
                    $number    = preg_match('@[0-9]@', $password2);
                    $specialChars = preg_match('@[^\w]@', $password2);

                    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password2) < 6) {

                        $newpassErr = 'your password should consist of a capital letter,special character,a number and more than 6 letters.';
                        $_SESSION['newpasserror'] = $newpassErr;


                        $isvalidate2 = false;
                    } else {
                        $isvalidate2 = true;
                        $newpass = trim($_POST['new_pass']);
                    }
                } else {
                    $newpassErr = 'enter Password .';
                    $_SESSION['newpasserror'] = $newpassErr;


                    $isvalidate2 = false;
                }


                //validate  confirm password
                if (!empty($_POST['conform_new_pass'])) {
                    // password strength validation

                    $cpassword1 = trim($_POST['conform_new_pass']);

                    // Validate password strength
                    $uppercase = preg_match('@[A-Z]@', $cpassword1);
                    $lowercase = preg_match('@[a-z]@', $cpassword1);
                    $number    = preg_match('@[0-9]@', $cpassword1);
                    $specialChars = preg_match('@[^\w]@', $cpassword1);

                    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($cpassword1) < 6) {

                        $newcpassErr = 'your password should consist of a capital letter,special character,a number and more than 6 letters.';
                        $_SESSION['newcpasserror'] = $newcpassErr;


                        $isvalidate2 = false;
                    } else {
                        $isvalidate2 = true;
                        $newcpass = trim($_POST['conform_new_pass']);
                    }
                } else {
                    $newcpassErr = 'enter Password .';
                    $_SESSION['newcpasserror'] = $newcpassErr;


                    $isvalidate2 = false;
                }


                //   check if confirm pass and pass are the same
                if (trim($_POST['new_pass']) != trim($_POST['conform_new_pass'])) {
                    $newrErr = 'your password should be the same as your confirm.';

                    $isvalidate2 = false;

                    $_SESSION['newrerror'] = $newrErr;
                }

                if ($isvalidate2 === true  &&  $newrErr == "" && $newcpassErr == "" && $newpassErr == "") {

                    //  hash the password
                    $hashedpassword1 = password_hash(($newpass), PASSWORD_DEFAULT);
                    $updateuserpass = $DbMgr->updateUserPass($hashedpassword1, $_SESSION['this_user_username_new']);
                    if (isset($updateuserpass)) {

                        $_SESSION['this_user_login_new'] = "0";
                        $_SESSION['this_user_update_new'] = "0";
                        $_SESSION['this_user_write_post_new'] = "0";
                        echo "<script>alert('your password is changed successfully, log in again.');</script>";
                        echo "<script>window.location.href='../user_profile.php';</script>";
                    } else {
                        echo "<script>alert('something went wrong,try again!');</script>";
                        echo "<script>window.location.href='../user_profile.php';</script>";
                    }
                } else {
                    echo "<script>alert('fill out fields based on errors!');</script>";
                    echo "<script>window.location.href='../user_profile.php';</script>";
                }
            } else {
                echo "<script>alert('your old password is not correct,try again!');</script>";
                echo "<script>window.location.href='../user_profile.php';</script>";
            }
        } else {
            echo "<script>alert('fill out all filds correctly!');</script>";
            echo "<script>window.location.href='../user_profile.php';</script>";
        }

        break;


        // write post
    case 'writepost':
        if (!empty($_POST['post_title']) && !empty($_POST['description']) && !empty($_FILES['post_img'])) {

            // do validation
            if (!empty(trim($_POST["post_title"]))) {

                if (strlen(trim($_POST["post_title"])) >= 2) {
                    $title = trim($_POST["post_title"]);
                    $isvalidate3 = true;
                } else {
                    $titleErr = "your title should be more than 2 characters!";
                    $_SESSION['titleerror'] = "your title should be more than 2 characters!";

                    $isvalidate3 = false;
                }
            } else {
                $titleErr = "Enter your title.";
                $_SESSION['titleerror'] = "Enter your title.";

                $isvalidate3 = false;
            }

            if (!empty(trim($_POST['description']))) {

                if (strlen(trim($_POST['description'])) >= 4) {
                    $post = trim($_POST['description']);
                    $isvalidate3 = true;
                } else {
                    $postErr = "your description should be more than 4 characters!";
                    $_SESSION['posterror'] = "your description should be more than 4 characters!";

                    $isvalidate3 = false;
                }
            } else {
                $postErr = "Enter your description.";
                $_SESSION['posterror'] = "Enter your description.";

                $isvalidate3 = false;
            }


            //validate avatar
            if (($_FILES["post_img"]) == "") {
                $isvalidate3 = false;
                $imgErr = "choose your image.";
                $_SESSION['imgerror'] =  $imgErr;
            }



            if ($isvalidate3 === true  &&   $titleErr == ""   && $postErr == "" && $imgErr == "") {

                // //make the path of the avatar and check other character of image to be correct
                $image_name = $_FILES['post_img']['name'];
                $image_type = $_FILES['post_img']['type'];
                $image_size = $_FILES['post_img']['size'];
                $image_temp_name = $_FILES['post_img']['tmp_name'];
                $array_name = explode(".", $image_name);
                $image_format = end($array_name); //get last index of array
                //make an address for saving avatar
                $image_address3 = "post_image/" . $_SESSION['this_user_username_new'] . "_" . ($_SESSION['this_user_num_post_new'] + 1) . "." . $image_format;


                //check for general errors
                if (!$_FILES['post_img']['error']) {
                    // check the size of the image
                    if ($image_size < 1024000) {
                        //check for type of the image
                        if (in_array($image_type, $accepted_format)) {

                            //uploade img in the folder in project root
                            move_uploaded_file($image_temp_name, "../" . $image_address3);

                            // write post inside db
                            $mypost = new Post($id, $_SESSION['this_user_username_new'], trim($_POST["post_title"]), trim($_POST['description']), $image_address3, $date);

                            $sendpost = $DbMgr->sendPost($mypost);

                            if (isset($sendpost)) {
                                // update for $_SESSION['this_user_num_post_new']

                                // count number of the posts
                                $numberp1 = $DbMgr->getNumberPost(trim($_SESSION['this_user_username_new']));

                                if (isset($numberp1)) {
                                    $_SESSION['this_user_num_post_new'] = ($numberp1);
                                } else {
                                    $_SESSION['this_user_num_post_new'] = "0";
                                }

                                echo "<script>alert('you sent new post successfully.');</script>";
                                echo "<script>window.location.href='../write_post.php';</script>";
                            } else {
                                echo "<script>alert('try again!');</script>";
                                echo "<script>window.location.href='../write_post.php';</script>";
                            }
                        } else {
                            echo "<script>alert('the image's format is invalid, choose another one!');</script>";
                            echo "<script>window.location.href='../write_post.php';</script>";
                        }
                    } else {
                        echo "<script>alert('the image is too big, choose another one!');</script>";
                        echo "<script>window.location.href='../write_post.php';</script>";
                    }
                } else {
                    echo "<script>alert('there is an error for image, choose another one!');</script>";
                    echo "<script>window.location.href='../write_post.php';</script>";
                }
            } else {
                echo "<script>alert('fill out all filds correctly based on errors!');</script>";
                echo "<script>window.location.href='../write_post.php';</script>";
            }
        } else {
            echo "<script>alert('fill out all filds correctly!');</script>";
            echo "<script>window.location.href='../write_post.php';</script>";
        }

        break;


        // logout
    case 'logout':

        $_SESSION['this_user_login_new'] = "0";
        $_SESSION['this_user_update_new'] = "0";
        $_SESSION['this_user_write_post_new'] = "0";

        if ($_SESSION['page'] == "index") {
            echo "<script>window.location.href='../index.php';</script>";
        } else if ($_SESSION['page'] == "profile") {
            echo "<script>window.location.href='../user_profile.php';</script>";
        } else if ($_SESSION['page'] == "post") {
            echo "<script>window.location.href='../write_post.php';</script>";
        } else {
            echo "<script>window.location.href='../show_users.php';</script>";
        }




        break;
}
