<?php
/**
	 * Class DbManager
	 * Handles all users and posts queries CRUD (Create ReadOne ReadAll Update Delete)
	 */
class DbManager extends DbConnector {


     // method to add new user
     public function addUser(User $user) {
        $query=$this->db->prepare("INSERT INTO user (firstName,lastName,gender,age,email,userName,passWord,avatar) VALUES (?,?,?,?,?,?,?,?)");
        $query->execute(array(
            $user->getFirstName(),
            $user->getLastName(),
            $user->getGender(),
            $user->getAge(),
            $user->getEmail(),
            $user->getUserName(),
            $user->getPassWord(),
             $user->getAvatar(),
             
        ));
        
        $result = $query->fetchAll();
        return $result;
    }


    //method to update
    public function updateUser(User $user){
        $query1 = $this->db->prepare("UPDATE user SET firstName=?,lastName=?,gender=?,email=?,avatar=? WHERE userName=? ;") ;
        $query1->execute(array(
            $user->getFirstName(),
            $user->getLastName(),
            $user->getGender(),
            $user->getEmail(),
            $user->getAvatar(),
            $user->getUserName(),
             

        ));

        $result1 = $query1->fetchAll();
        return $result1;

    }

    //method to update password
    public function updateUserPass(string $pass, string $username){
        $query1 = $this->db->prepare("UPDATE user SET passWord=? WHERE userName=? ;") ;
        $query1->execute(array(
            $pass,
            $username,
        ));

        $result1 = $query1->fetchAll();
        return $result1;

    }




    ////////////////////////////////////////// VERY IMPORTANT////////////////////////////
    // //////////////////////////////TAKE CARE OF USING "query" or "prepare" IN QUERY SENTENCE ////////////////////////////

    //get all users
    public function getAllUser(){
        $user_obj = array();
        // query to get all users comments from posts db
        $query = $this->db->query("SELECT `id`,firstName,lastName,gender,age,email,userName,passWord,avatar,stat FROM `user` ;");
        $users = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ( $users as $obj ) {
            $user_obj[] = new User( $obj["id"],$obj["firstName"],$obj["lastName"],$obj["gender"],$obj["age"],$obj["email"],$obj["userName"],$obj["passWord"],$obj["avatar"],$obj["stat"]);
        }

        return $user_obj;
       

    }





    // GET USER BY USERNAME to check unique username
    public function getUserByUsername( $username) {
        $user_obj = array();
        $query =$this->db->prepare("SELECT * FROM user where userName=?;");
        $query->execute(array($username));
        $singleuser = $query->fetchAll( PDO::FETCH_ASSOC );//if we want to get the info of the query we can use this line
        
        // $row=$query->rowCount();
        // if($row>0){
            foreach ( $singleuser as $user ) {
               return $user_obj[] =new User($user['id'],$user['firstName'],$user['lastName'],$user['gender'],$user["age"],$user['email'],$user['userName'],$user['passWord'],$user['avatar'],$user['stat']);
            }
        // }else{
        //     return $row;
        // }
        
    }




    // GET USER BY email to check unique email
    public function getUserByEmail(string $email) {
        $query3 = $this->db->prepare("SELECT * FROM user where email=?;");
        $query3->execute(array($email));
        $query3->fetch( PDO::FETCH_ASSOC );//if we want to get the info of the query we can use this line
        return $query3->rowCount();
    }



    



    //send email (activation and confirmation) just we need to create msg_body in advance and in controller
    public function sendEmail(string $email, string $subject, string $msg_body,$header ) {
        try {
            mail($email, $subject, $msg_body, $header);
           return "1";
        
        }catch (Exception $e) {
            return "0";
        }
        
        
    }



    //write post
    public function sendPost(Post $post){
        $query=$this->db->prepare("INSERT INTO post (userName,title,body,image,date) VALUES (?,?,?,?,?)");
        $query->execute([$post->getUserName(),$post->getTitle(), $post->getBody(),$post->getImage(),$post->getDate()]);
        $result1 = $query->fetchAll();
        return $result1;

    }


    //get all posts
    public function getPost(){
        $comment_obj = array();
        // query to get all users comments from posts db
        $query = $this->db->query("SELECT `id`,`userName`, `title`, `body`,`image`,`date` FROM `post` ORDER BY `id` DESC LIMIT 7;");
        $user_comment = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ( $user_comment as $comment ) {
            $comment_obj[] = new Post( $comment["id"],$comment["userName"],$comment["title"],$comment["body"],$comment["image"],$comment["date"] );
        }

        return $comment_obj;
       

    }


    //get number of posts for a username
    public function getNumberPost(string $username1){
       
        // query to get all users comments from posts db
        $query = $this->db->prepare("SELECT COUNT(*) FROM `post` WHERE `userName`=?;");
        $query->execute(array($username1));
        $number_of_rows = $query->fetchColumn(); 
        return  $number_of_rows;

    }




    

    //log in process
    public function verifyLogin(string $username){
        $query = $this->db->prepare("SELECT firstName,lastName,gender,age,email,userName,passWord,avatar,stat FROM user WHERE userName=? ;");
        $query->execute(array($username));
         return $query->rowCount();

    }


    //activate user
    public function activateUser(string $username){
        //update status of the user in db to 1
     $query1 = $this->db->prepare("UPDATE user SET stat=1 WHERE userName=? ;");
     $query1->execute(array($username));
    //  then send another email to ask to log in
    //send email for activation
      $result2 = $query1->fetchAll();
      return $result2;

    }




















}