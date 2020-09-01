
<?php
@session_start();
if (isset($_SESSION['role']) && $_SESSION['role'] != 'admin') {
    header("location:permission.php");
}

require_once("../class/category_class.php");
$category = new Category();


require_once("../class/ad_class.php");

$advertisement = new Advertisement();

$advertisement->set('id', $_GET['id']);

$st1 = $advertisement->retrieve();
$st1 = $st1[0];

$msg ="";

$msg1 ="";



if (isset($_POST['btnsave'])){

    
    $advertisement->set('title', $_POST['title']);
    $advertisement->set('rank', $_POST['rank']);
    $advertisement->set('linkforAd', $_POST['linkforAd']);
if (!empty($_FILES['image']['name'])) {
  if ($_FILES['image']['error'] == 0) {
    // echo "you have done it!";
    if ($_FILES['image']['size'] >= 1024) {
      //echo "image size is absolately right";
      if ($_FILES['image']['type'] == 'image/jpeg' || $_FILES['image']['type'] == 'image/png' ) {

        move_uploaded_file($_FILES['image']['tmp_name'], "../images/".$_FILES['image']['name']);

        $advertisement->set('image',$_FILES['image']['name'] );
      }
      else{
        echo "sorry boss";
      }
    }
    else
    {
      echo "sorry image size is not correct";
    }
  }

}else{

      $advertisement->set('image', $_POST['oldimage']);
}
  

    $advertisement->set('modified_by', $_SESSION['username']);
    $advertisement->set('modified_date', date('Y-m-d H:m:s'));

    $status = $advertisement->edit();

    if($status){
         $msg ='<div role="alert" class="alert alert-success"><strong>Advertisement Updated Successfully...</strong></div>';
        
       }else{
          $msg ='<div role="alert" class="alert alert-danger"><strong> Sorry Advertisement is not Updated. Try Again!</strong></div>';
       }
}

    


?>

<?php

include("../HeaderFooter/header.php"); 
   ?>
            

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Edit Ad</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Advertisement Edit Form
                        </div>
                        
                        <div class="panel-body">
                            <div class="row">
                                 
                                <div class="col-lg-6">
                                     <?php echo $msg;
                                           
                                      ?>
                                <form role="form" action="" method="post" enctype="multipart/form-data" novalidate>
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" name="title" class="form-control" placeholder="Enter Title" value="<?php echo $st1->title; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Rank</label>
                                            <input type="number" name="rank" class="form-control" placeholder="Enter Rank" value="<?php echo $st1->rank; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>link</label>
                                            <input type="text" name="linkforAd" class="form-control" placeholder="Enter link" value="<?php echo $st1->linkforAd; ?>">
                                        </div>
                                         <div class="form-group">
                                          <input type="hidden" name="oldimage" value="<?php echo $st1->image;  ?>">
                                            <label>Image</label><br>
                                            <img src="<?php echo "../images/".$st1->image;   ?>" height="200" width="200">
                                            <input type="file" name="image">
                                            <?php echo $msg1; ?>
                                        </div>
                                       
                                        <button type="submit" name="btnsave" class="btn btn-success">Edit Ad</button>
                                        <button type="reset" class="btn btn-danger">Reset Form </button>
                                    </form>

                                </div>
                                <!-- /.col-lg-6 (nested) -->
                               
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
              </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

     

    <?php include("../HeaderFooter/footer.php"); ?>