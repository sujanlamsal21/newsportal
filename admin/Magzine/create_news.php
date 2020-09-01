<?php
include("../HeaderFooter/header.php");

$errNews =""; 

$msg ="";

$msg1 ="";

require_once("../class/category_class.php");

$category = new Category();

$catelist = $category->retrieve();


require_once("../class/news_class.php");

$news = new News();



if (isset($_POST['btnsave'])) {


    if (isset($_POST['title']) && !empty($_POST['title'])) {

    }
    else{
        $errNews .="Enter Title.<br>";
    }
    if (isset($_POST['category_id']) && !empty($_POST['category_id'])) {

    }
    else{
        $errNews .="Enter Category Id.<br>";
    }
    if (isset($_POST['short_detail']) && !empty($_POST['short_detail'])) {

    }
    else{
        $errNews .="Enter Short Detail.<br>";
    }
    if (isset($_POST['detail']) && !empty($_POST['detail'])) {

    }
    else{
        $errNews .="Enter Detail News.<br>";
    }
   
    if ($errNews !="") {
        $errNews ='<div role="alert" class="alert alert-danger"><strong> Opps....! There Were Error In Your Form.<br>'.$errNews.'</strong></div>';
    }else{
        $news->set('title', $_POST['title']);
        $news->set('category_id', $_POST['category_id']);
        $news->set('short_detail', $_POST['short_detail']);
        $news->set('detail', $_POST['detail']);
        $news->set('featured', $_POST['featured']);
        $news->set('breaking', $_POST['breaking']);
        $news->set('slider_key', $_POST['slider_key']);
        $news->set('status', $_POST['status']);
        $news->set('created_by',$_SESSION['username']);
        $news->set('created_date',date('Y-m-d H:i:s'));
        if ($_FILES['image']['type'] == 'image/jpeg' OR $_FILES['image']['type'] == 'image/png' OR $_FILES['image']['type'] == 'image/jpg' ) {

            if ($_FILES['image']['size'] >= 1024) {
                move_uploaded_file($_FILES['image']['tmp_name'], "../images/".$_FILES['image']['name']);
                $news->set('image',$_FILES['image']['name'] );

              
            }else{
                $msg1 ='<div role="alert" class="alert alert-danger"><strong>Adjust your image size first <small>(Image size must be greater than 512kb and less than 2mb)</small></strong></div>';
            }
            
        }else{
            $msg1 ='<div role="alert" class="alert alert-danger"><strong> Sorry image type is wrong</strong></div>'; 
        }


        
        $statusNews = $news->save();

        if (is_integer($statusNews) AND $msg1 =="") {
             $msg ='<div role="alert" class="alert alert-success"><strong>News Created Successfully...</strong></div>';
        }else{
            $msg ='<div role="alert" class="alert alert-danger"><strong> Sorry News is not created. Try Again!</strong></div>';
        }
    }
}
?>
            

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Create News</h1>
                   
                
                
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            News Create Form
                        </div>
                        
                        <div class="panel-body">
                            <div class="row">
                                 
                                <div class="col-lg-12">
                                    <?php echo $errNews.$msg;

                            
                                    ?>
                                     
                                    <form role="form" action="" method="post" enctype="multipart/form-data" novalidate>
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" name="title" class="form-control" placeholder="Enter Title">
                                        </div>
                                        <div class="form-group">
                                            <label>Category Name</label>
                                            <select name="category_id" class="form-control">
                                                <option value="">Select Category</option>
                                                <?php foreach ($catelist as $value) {  ?>
                                                    <option value="<?php echo $value->id ?>"><?php echo $value->name; ?></option>

                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Short Detail</label>
                                            <textarea name="short_detail" class="form-control" placeholder="Enter Short Detail" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Detail</label>
                                            <textarea name="detail" class="form-control ckeditor" placeholder="Enter Name"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Image *</label>
                                            <input type="file" name="image" class="form-control">
                                            <?php echo $msg1; ?>
                                        </div>


                                        
                                        <div class="form-group">
                                            <label>Featured</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="featured" value="1">Yes
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="featured" value="0" checked>No
                                                </label>
                                            </div>
                                           
                                        </div>
                                        <div class="form-group">
                                            <label>Breaking</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="breaking" value="1" >Yes
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="breaking" value="0" checked>No
                                                </label>
                                            </div>
                                           
                                        </div>
                                              <div class="form-group">
                                            <label>Slider Key</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="slider_key" value="1" >Yes
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="slider_key" value="0" checked>No
                                                </label>
                                            </div>
                                           
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
                                                    <input type="radio" name="status" value="0">Deactive
                                                </label>
                                            </div>
                                           
                                        </div>
                                        
                                       
                                        <button type="submit" name="btnsave" class="btn btn-success">Save News</button>
                                        <button type="reset" class="btn btn-danger">Reset News </button>
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

    <script type="text/javascript" src="../js/ckeditor/ckeditor.js"></script>