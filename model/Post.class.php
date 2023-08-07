<?php
	/**
	 * posts Bean
	 * Class standardize our data ... to make sure that the same class is being passed everywhere
	 */
	class Post  {

        // properties
        private $id1;
		private $body;
        private $title;
        private $date;
        private $userName;
        private $image;
        private $userimg;

        // constructor
        // here we will give attribute array to the constructor, for $_post is array and also whatever we will received during reading the table will be array.
		public function __construct($id1,$userName,$title,$body,$image,$date,$userimg) {
            //With doing this for id which is autoincrement , we wont give amount during insertion but can read it
			$this->id1 = $id1 ?? null;
			$this->body = $body;
			$this->image=$image;
            $this->userName=$userName;
            $this->title=$title;
            $this->date=$date;
            $this->userimg=$userimg;


		}


        // getter and setter
    public function getId()
	{
		return $this->id1;
	}

    /**
     * @param mixed $id
     */
    public function setId($id1) : void
    {
    	$this->id1 = $id1;

    }

    public function getTitle()
	{
		return $this->title;
	}

    /**
     * @param mixed $title
     */
    public function setTitle($title) : void
    {
    	$this->title = $title;

    }

    public function getDate()
	{
		return $this->date;
	}

    /**
     * @param mixed $date
     */
    public function setDate($date) : void
    {
    	$this->date = $date;

    }




    public function getBody()
    {
        return $this->body;
    }

/**
 * @param mixed $comment
 */
public function setBody($body) : void
{
    $this->body = $body;

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


public function getImage()
    {
        return $this->image;
    }

/**
 * @param mixed $avatar
 */
public function setImage($image) : void
{
    $this->image = $image;

}

public function getUserimg()
    {
        return $this->userimg;
    }

/**
 * @param mixed $avatar
 */
public function setUserimg($userimg) : void
{
    $this->userimg = $userimg;

}







    }

    ?>