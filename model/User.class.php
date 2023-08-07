<?php
	/**
	 * users Bean
	 * Class standardize our data ... to make sure that the same class is being passed everywhere
	 */
	class User {

        // properties
        private $id;
        private $gender;
        private $age;
        private $firstName;
        private $lastName;
		private $userName;
		private $passWord;
		private $email;
		private $avatar;
		private $stat;

        // constructor
        // here we will give attribute array to the constructor, for $_post is array and also whatever we will received during reading the table will be array.
		public function __construct($id,$firstName,$lastName,$gender,$age,$email, $userName,$passWord,$avatar,$stat) {
            //With doing this for id which is autoincrement , we wont give amount during insertion but can read it
			$this->id = $id ?? null;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->gender=$gender;
            $this->age=$age;
			$this->userName = $userName;
			$this->passWord = $passWord;
			$this->email = $email;
			$this->avatar = $avatar;
            //With doing this for status which has default value , we wont give amount during insertion but can read it and change it
			$this->stat = $stat ?? 0;
		}
		
        


    // getter and setter
    public function getId()
	{
		return $this->id;
	}

    /**
     * @param mixed $id
     */
    public function setId($id) : void
    {
    	$this->id = $id;

    }


    // getter and setter
    public function getAge()
	{
		return $this->age;
	}

    /**
     * @param mixed $age
     */
    public function setAge($age) : void
    {
    	$this->age = $age;

    }




    // getter and setter
    public function getGender()
	{
		return $this->gender;
	}

    /**
     * @param mixed $gender
     */
    public function setGender($gender) : void
    {
    	$this->gender = $gender;

    }




    // getter and setter
    public function getFirstName()
	{
		return $this->firstName;
	}

    /**
     * @param mixed $firstname
     */
    public function setFirstName($firstName) : void
    {
    	$this->firstName = $firstName;

    }



    // getter and setter
    public function getLastName()
	{
		return $this->lastName;
	}

    /**
     * @param mixed $lastname
     */
    public function setLastName($lastName) : void
    {
    	$this->lastName = $lastName;

    }




    public function getUserName()
    {
        return $this->userName;
    }

/**
 * @param mixed $username
 */
public function setUserName($userName) : void
{
    $this->userName = $userName;

}

public function getPassWord()
    {
        return $this->passWord;
    }

/**
 * @param mixed $password
 */
public function setPassWord($passWord) : void
{
    $this->passWord = $passWord;

}


public function getEmail()
    {
        return $this->email;
    }

/**
 * @param mixed $Email
 */
public function setEmail($email) : void
{
    $this->email = $email;

}


public function getAvatar()
    {
        return $this->avatar;
    }

/**
 * @param mixed $avatar
 */
public function setAvatar($avatar) : void
{
    $this->avatar = $avatar;

}

public function getStat()
    {
    	return $this->stat;
    }

    /**
     * @param mixed $status
     */
    public function setStat($stat) : void
    {
    	$this->stat= $stat;
    }







    }
