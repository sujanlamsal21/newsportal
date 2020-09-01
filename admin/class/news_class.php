<?php 

require_once("common_class.php");


class News extends Common
{
	public $id, $title, $category_id, $short_detail, $detail, $image, $featured, $breaking,$slider_key, $status, $created_by, $created_date, $modified_by, $modified_date;
	

 
    function save(){
    	
    	include("../Magzine/connection.php");
    	$query ="INSERT INTO `news`(`title`, `category_id`, `short_detail`, `detail`, `image`, `featured`, `breaking`,`slider_key`, `status`, `created_by`, `created_date`) VALUES ('".mysqli_real_escape_string($link,$this->title)."','$this->category_id','".mysqli_real_escape_string($link,$this->short_detail)."','".mysqli_real_escape_string($link, $this->detail)."','$this->image','$this->featured','$this->breaking','$this->slider_key','$this->status','$this->created_by','$this->created_date')";
    	return $this->insert($query);


    }
    function retrieve(){

    	$query ="SELECT * FROM `news`";

    	return $this->selectAll($query);

    }
    function destroy(){

    	$query = "DELETE FROM `news` WHERE `id` = '$this->id'";

       return $this->deleteNews($query);

    }
    function edit(){
        include("../Magzine/connection.php");
    	echo $query ="UPDATE `news` SET `title`='".mysqli_real_escape_string($link, $this->title)."',`category_id`='$this->id', `short_detail`='".mysqli_real_escape_string($link, $this->short_detail)."',`detail`='".mysqli_real_escape_string($link, $this->detail)."',`image`='$this->image',`featured`='$this->featured',`breaking`='$this->breaking',`slider_key`='$this->slider_key',`status`='$this->status',`modified_by`='$this->modified_by',`modified_date`='$this->modified_date' WHERE id=$this->id";

    	return $this->update($query);

    }

    function getNewsId(){

    	$query ="SELECT * FROM `news` WHERE `id`=$this->id";

    	return $this->getId($query);
    }

    function getAllLatestNews(){

        $query ="SELECT * FROM `news` WHERE `status` = 1 order by created_date desc limit 3";

        return $this->selectAll($query);
    }

    function getAllSliderKey(){

        $query ="SELECT * FROM `news` WHERE `status` = 1 and `slider_key` = 1 order by created_date desc limit 5";

        return $this->selectAll($query);
    }


    function getAllBreakingNews(){
        $query ="SELECT * FROM `news` WHERE `status` = 1 and `breaking` = 1 order by created_date desc limit 2";

        return $this->selectAll($query);

    }
	function getFeaturedNewsByCategory(){
        $query ="SELECT * FROM `news` WHERE `status` = 1 and `featured` = 1 and `category_id`='$this->category_id' order by created_date desc limit 1";

        return $this->selectAll($query);
    }

    function getAllCategoryNews(){
          $query ="select c.name as category_name, n.* from news as n join category as c on n.category_id=c.id where n.category_id='$this->category_id'";

        return $this->selectAll($query);
         
    }

    function getCategoryNewsByIdFromNews(){
           $query ="select c.name as category_name, n.* from news as n join category as c on n.category_id=c.id where n.id='$this->id'";

        return $this->selectAll($query);
    }

    function getFeaturedNews(){
        $query ="SELECT * FROM `news` WHERE `status` = 1 and `featured` = 1 order by created_date desc limit 3";

        return $this->selectAll($query);
    }
	
}


?>  