<?php 

require_once("common_class.php");

class Advertisement extends Common 
{

	public $id, $title, $rank, $linkforAd,$image, $created_by, $created_date, $modified_by, $modified_date;
	
	function save()
	{
		
		$query = "insert into `advertisement`(`title`,`rank`,`linkforAd`,`image`,`created_by`,`created_date`) values('$this->title','$this->rank','$this->linkforAd','$this->image','$this->created_by','$this->created_date')";

		return $this->insert($query);
	}

	function retrieve()
	{
		$query ="SELECT * FROM `advertisement`";

		return $this->selectAll($query);
	}

	function destroy()
	{
		$query ="DELETE FROM `advertisement` WHERE `id`='$this->id'";

		return $this->deleteNews($query);
	}

	function edit()
	{
		include("../Magzine/connection.php");
		$query= "UPDATE `advertisement` SET `title` = '".mysqli_real_escape_string($link, $this->title)."',`rank` ='$this->rank',`linkforAd` =  '".mysqli_real_escape_string($link, $this->linkforAd)."',`image` = '$this->image',`modified_by` = '$this->modified_by',`modified_date`='$this->modified_date' WHERE `id`=$this->id";

		return $this->update($query);
	}


	function getAdId()
	{
		$query = "SELECT * FROM `advertisement` WHERE `id` = $this->id";

		return $this->getId($query);
	}

	function getAllAdvertiseMent(){

		$query = "SELECT * FROM `advertisement`";

		return $this->selectAll($query);

	}


}


?>