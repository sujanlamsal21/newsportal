<?php
@session_start();
if (isset($_SESSION['role']) && $_SESSION['role'] != 'admin') {
    header("location:permission.php");
}
$msg ="";
require_once("../class/category_class.php");
$category = new Category();


$category->set('id', $_GET['id']);





if (isset($_POST['btnedit'])) {

$category->set('name', $_POST['name']);
$category->set('rank', $_POST['rank']);
$category->set('status', $_POST['status']);
$category->set('modified_by', $_SESSION['username']);
$category->set('modified_date', date('Y-m-d H:m:s'));

$statusEdit = $category->edit();

if($statusEdit){
	$msg ='<div role="alert" class="alert alert-success"><strong>Data Updated Successfully...</strong></div>';
}else{
	$msg ='<div role="alert" class="alert alert-danger"><strong>Data Can Not Be Updated! Try Again..</strong></div>';
    }
}
$stausCategoryId = $category->GetCategoryById();
$stausCategoryId = $stausCategoryId[0]; 



include("../HeaderFooter/header.php"); 
   ?>
            

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Edit Category</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Category Edit Form
                        </div>
                        
                        <div class="panel-body">
                            <div class="row">
                                 
                                <div class="col-lg-6">
                                     <?php echo $msg;
                                      
                                           
                                      ?>
                                    <form role="form" action="" method="post" novalidate>
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Enter Name" value="<?php  echo($stausCategoryId->name); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Rank</label>
                                            <input type="number" name="rank" class="form-control" placeholder="Enter Rank" value="<?php  echo($stausCategoryId->rank); ?>">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Status</label>
                                            <div class="radio">
                                                <label>
                             <input type="radio" name="status" value="1" <?php if($stausCategoryId->status == 1){
                                                    	echo "checked"; } ?> >Active
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                            <input type="radio" name="status" value="2"<?php if($stausCategoryId->status == 0) {
                                                    	echo "checked"; } ?> >Deactive
                                                </label>
                                            </div>
                                           
                                        </div>
                                        
                                       
                                        <button type="submit" name="btnedit" class="btn btn-success">Update Category</button>
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