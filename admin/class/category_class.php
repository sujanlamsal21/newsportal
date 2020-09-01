<?php  

require_once("common_class.php");

class Category extends Common {
	public $SN, $name,$rank, $status, $created_by, $created_date, $modified_by, $modified_date;
	
	 function save(){
	 	

	    $query = "INSERT INTO `category`(`name`,`rank`,`status`,`created_by`,`created_date`) VALUES('$this->name', '$this->rank', '$this->status', '$this->created_by', '$this->created_date')";
	    
        return $this->insert($query);

	}
	 function retrieve(){
	 	
	 	$query = "SELECT * FROM `category`";

	 	return $this->selectAll($query);

	}
	 function destroy(){
	 	
       
       $query = "DELETE FROM `category` WHERE `id` = '$this->id'";

       return $this->deleteNews($query);


	}
     function edit(){

     $query = "UPDATE `category` SET `name`='$this->name',`rank`='$this->rank',`status`='$this->status',`modified_by`='$this->modified_by',`modified_date`='$this->modified_date' WHERE `id`='$this->id'";

     return $this->update($query);

	}
	function GetCategoryById(){
		$query = "SELECT * FROM `category` WHERE `id`='$this->id'";

		return $this->getId($query);
	}

	function getAllActiveCategory(){
		$query = "SELECT * FROM `category` WHERE `status` = 1 order by rank";

		return $this->selectAll($query);
	}
}


?>