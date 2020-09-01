<?php  

abstract class Common {
	
	
	abstract function save();
	abstract function retrieve();
	abstract function destroy();
	abstract function edit();

	public function set($key, $value){
		$this->$key = $value;
	}

	public function insert($query){
		include("../Magzine/connection.php");

        mysqli_query($link, $query);

    	if ($link->affected_rows == 1 &&  $link->insert_id > 0) {
	    	return $link->insert_id;
	    }else{
	    	return false;
	    }

	}

	public function update($query){
		include("../Magzine/connection.php");

	   if(mysqli_query($link, $query)){
	   	return true;
	   }else{
	   	return false;
	   }

	}

	public function selectAll($query){
		$link = mysqli_connect('localhost', 'root', '', 'newsmagzine');


			 if (mysqli_connect_error($link) > 0) {
				die("database connection error");
			 }


	    $res = mysqli_query($link,$query);
        $arr =[];

	    if ($res->num_rows>0) {
	    	while($row = mysqli_fetch_object($res)){
	    		$arr[] = $row;

	    	}
	    }
	    return $arr;
	}

	public function deleteNews($query){
		include("../Magzine/connection.php");

	    if(mysqli_query($link, $query)){
            return true;
        }else{
        	return false;
        }
	}

	public function getId($query){
		include("../Magzine/connection.php");

		
        $arr1 =[];
		$ress = mysqli_query($link, $query);
        if($ress->num_rows>0){
		while($rows = mysqli_fetch_object($ress)) {
		    $arr1[] = $rows;
		}

	  }
	  return $arr1;

	}
	

}


?>