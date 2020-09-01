<?php
@session_start();
if (isset($_SESSION['role']) && $_SESSION['role'] != 'admin') {
    header("location:permission.php");
}

require_once("../class/category_class.php");
$category = new Category();

$categoryError ="";

$msg ="";


 
if (isset($_POST['btnsave'])) {
   if (isset($_POST['name']) && !empty($_POST['name'])) {
       
   }else{
     $categoryError .="Enter Name.<br>";
   }
   if (isset($_POST['rank']) && !empty($_POST['rank'])) {
       
   }else{
      $categoryError .="Enter Rank.<br>";
   }

   if ($categoryError !="") {
       $categoryError ='<div role="alert" class="alert alert-danger"><strong> Opps....! There Were Error In Your Form.<br>'.$categoryError.'</strong></div>'; 
   }else{

    
    $category->set('name', $_POST['name']);
    $category->set('rank', $_POST['rank']);
    $category->set('status', $_POST['status']);
    $category->set('created_by', $_SESSION['username']);
    $category->set('created_date', date('Y-m-d H:m:s'));

    $status = $category->save();

    if(is_integer($status)){
         $msg ='<div role="alert" class="alert alert-success"><strong>Data Saved Successfully...</strong></div>';
        
       }else{
          $msg ='<div role="alert" class="alert alert-danger"><strong> Sorry Data is not saved. Try Again!</strong></div>';
       }

    
    

   }

}



include("../HeaderFooter/header.php"); 
   ?>
            

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Create Category</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Category Create Form
                        </div>
                        
                        <div class="panel-body">
                            <div class="row">
                                 
                                <div class="col-lg-6">
                                     <?php echo $categoryError.$msg;
                                           
                                      ?>
                                    <form role="form" action="" method="post" novalidate>
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Enter Name">
                                        </div>
                                        <div class="form-group">
                                            <label>Rank</label>
                                            <input type="number" name="rank" class="form-control" placeholder="Enter Rank">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Status</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status" value="1" checked>Active
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status" value="2">Deactive
                                                </label>
                                            </div>
                                           
                                        </div>
                                        
                                       
                                        <button type="submit" name="btnsave" class="btn btn-success">Save Category</button>
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