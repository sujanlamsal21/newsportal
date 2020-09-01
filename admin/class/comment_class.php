<?php  

require_once("common_class.php");

class Comment extends Common {
	public $id, $news_id, $name,$email, $comment, $commented_date;
	
	 function save(){

	 	$link = mysqli_connect('localhost', 'root', '', 'newsmagzine');

	    $query = "INSERT INTO `comment`(`news_id`,`name`,`email`,`comment`,`commented_date`) VALUES('$this->news_id', '$this->name', '$this->email', '$this->comment', '$this->commented_date')";
	    
        mysqli_query($link, $query);

    	if ($link->affected_rows == 1 &&  $link->insert_id > 0) {
	    	return $link->insert_id;
	    }else{
	    	return false;
	    }

	}
	 function retrieve(){
	 	
	 	$query = "SELECT * FROM `comment` order by commented_date desc limit 6";

	 	return $this->selectAll($query);

	}
	 function destroy(){
	 	
       
       $query = "DELETE FROM `comment` WHERE `id` = '$this->id'";

       return $this->deleteNews($query);


	}
     function edit(){

     
	}

	function getCommentByNewsId(){
		$query = "SELECT * FROM `comment` where news_id=$this->news_id order by commented_date desc limit 6";

	 	return $this->selectAll($query);
	}
	// function GetCategoryById(){
	// 	$query = "SELECT * FROM `category` WHERE `id`='$this->id'";

	// 	return $this->getId($query);
	// }

	// function getAllActiveCategory(){
	// 	$query = "SELECT * FROM `category` WHERE `status` = 1 order by rank";

	// 	return $this->selectAll($query);
	// }
}


?>