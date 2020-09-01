
<?php
@session_start();
if (isset($_SESSION['role']) && $_SESSION['role'] != 'admin') {
    header("location:permission.php");
}

require_once("../class/category_class.php");
$category = new Category();


require_once("../class/ad_class.php");

$advertisement = new Advertisement();

$categoryError ="";

$msg ="";

$msg1 ="";



if (isset($_POST['btnsave'])) {
   if (isset($_POST['title']) && !empty($_POST['title'])) {
       
   }else{
     $categoryError .="Enter Title.<br>";
   }
   if (isset($_POST['rank']) && !empty($_POST['rank'])) {
       
   }else{
      $categoryError .="Enter Rank.<br>";
   }
   if (isset($_POST['linkforAd']) && !empty($_POST['linkforAd'])) {
       
   }else{
      $categoryError .="Enter link.<br>";
   }
  

   if ($categoryError !="") {
       $categoryError ='<div role="alert" class="alert alert-danger"><strong> Opps....! There Were Error In Your Form.<br>'.$categoryError.'</strong></div>'; 
   }else{

    
    $advertisement->set('title', $_POST['title']);
    $advertisement->set('rank', $_POST['rank']);
    $advertisement->set('linkforAd', $_POST['linkforAd']);

  if ($_FILES['image']['error'] == 0) {
    // echo "you have done it!";
    
      if ($_FILES['image']['type'] == 'image/jpeg' || $_FILES['image']['type'] == 'image/png' ) {
        //echo "hurry";

        move_uploaded_file($_FILES['image']['tmp_name'], "../images/".$_FILES['image']['name']);

        $advertisement->set('image',$_FILES['image']['name'] );
      }
      else{
        echo "sorry boss";
      }
    
  }
  

    $advertisement->set('created_by', $_SESSION['username']);
    $advertisement->set('created_date', date('Y-m-d H:m:s'));

    $status = $advertisement->save();

    if(is_integer($status)){
         $msg ='<div role="alert" class="alert alert-success"><strong>Advertisement Saved Successfully...</strong></div>';
        
       }else{
          $msg ='<div role="alert" class="alert alert-danger"><strong> Sorry Advertisement is not saved. Try Again!</strong></div>';
       }

    
    

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
                        <h1 class="page-header">Create Ad</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Advertisement Create Form
                        </div>
                        
                        <div class="panel-body">
                            <div class="row">
                                 
                                <div class="col-lg-6">
                                     <?php echo $categoryError.$msg;
                                           
                                      ?>
                                <form role="form" action="" method="post" enctype="multipart/form-data" novalidate>
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" name="title" class="form-control" placeholder="Enter Title">
                                        </div>
                                        <div class="form-group">
                                            <label>Rank</label>
                                            <input type="number" name="rank" class="form-control" placeholder="Enter Rank">
                                        </div>
                                        <div class="form-group">
                                            <label>link</label>
                                            <input type="text" name="linkforAd" class="form-control" placeholder="Enter link">
                                        </div>
                                         <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="image">
                                            <?php echo $msg1; ?>
                                        </div>
                                       
                                        <button type="submit" name="btnsave" class="btn btn-success">Save Ad</button>
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