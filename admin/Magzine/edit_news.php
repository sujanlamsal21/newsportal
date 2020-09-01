<?php
include("../HeaderFooter/header.php"); 

$msg ="";

$msg1 ="";

require_once("../class/category_class.php");

$category = new Category();

$catelist = $category->retrieve();

require_once("../class/news_class.php");

$news = new News();

$news->set('id', $_GET['id']);

if (isset($_POST['btnedit'])){
        $news->set('title', $_POST['title']);
        $news->set('category_id', $_POST['category_id']);
        $news->set('short_detail', $_POST['short_detail']);
        $news->set('detail', $_POST['detail']);
        $news->set('featured', $_POST['featured']);
        $news->set('breaking', $_POST['breaking']);
        $news->set('slider_key', $_POST['slider_key']);
        $news->set('status', $_POST['status']);
        $news->set('modified_by',$_SESSION['username']);
        $news->set('modified_date',date('Y-m-d H:i:s'));
        if (!empty($_FILES['image']['name'])) {
        if ($_FILES['image']['error'] == 0) {
        if ($_FILES['image']['type'] == 'image/jpeg' OR $_FILES['image']['type'] == 'image/png' OR $_FILES['image']['type'] == 'image/jpg' ) {

            if ($_FILES['image']['size'] <= 4*1024*1024 ) {
                move_uploaded_file($_FILES['image']['tmp_name'], "../images/".$_FILES['image']['name']);
                $news->set('image',$_FILES['image']['name'] );

              
            }else{
                $msg1 ='<div role="alert" class="alert alert-danger"><strong>Adjust your image size first <small>(Image size must be greater than 512kb and less than 4mb)</small></strong></div>';
            }
            
        }else{
            $msg1 ='<div role="alert" class="alert alert-danger"><strong> Sorry image type is wrong</strong></div>'; 
        }
    }
}else{

    $news->set('image', $_POST['old_image']);

}

       $statusNews = $news->edit();

        if($statusNews){
            $msg ='<div role="alert" class="alert alert-success"><strong>Data Updated Successfully...</strong></div>';
        }else{
            $msg ='<div role="alert" class="alert alert-danger"><strong>Data Can Not Be Updated! Try Again..</strong></div>';
        }
    
            
}
        $statusNewsId = $news->getNewsId();
        $statusNewsId = $statusNewsId[0];

        $category->set('id', $statusNewsId->id);

        $statusCatId = $category->GetCategoryById(); 

?>
            

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Edit News</h1>
                   
                
                
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            News Edit Form
                        </div>
                        
                        <div class="panel-body">
                            <div class="row">
                                 
                                <div class="col-lg-12">
                                    <?php echo $msg;

                            
                                    ?>
                                     
                                    <form role="form" action="" method="post" enctype="multipart/form-data" novalidate>
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" name="title" class="form-control" placeholder="Enter Title" value="<?php echo $statusNewsId->title; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Category Name</label>
                                            <select name="category_id" class="form-control">
                                                <option value="">Select Category</option>
                                                <?php foreach ($catelist as $value) {  ?>
                                                    <option value="<?php echo $value->id ?>" <?php if ($value->id == $statusNewsId->category_id) {
                                                        echo "selected";
                                                    }  ?> ><?php echo $value->name; ?></option>

                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Short Detail</label>
                                            <textarea name="short_detail" class="form-control" placeholder="Enter Short Detail" rows="3" value=""><?php echo $statusNewsId->short_detail ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Detail</label>
                                            <textarea name="detail" class="form-control ckeditor" placeholder="Enter Name"><?php echo $statusNewsId->detail; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="old_image" value="<?php echo $statusNewsId->image; ?>">
                                            <label>Image *</label><br>
                                            <img src="<?php echo '../images/'.$statusNewsId->image;?>" height="200" width="200">
                                            
                                            <input type="file" name="image">
                                            <?php echo $msg1; ?>
                                        </div>


                                        
                                        <div class="form-group">
                                            <label>Featured</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="featured" value="1" <?php if ($statusNewsId->featured == 1) {
                                                        echo "checked";
                                                    } ?> >Yes
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="featured" value="0" <?php if ($statusNewsId->featured == 0) {
                                                        echo "checked";
                                                    } ?>>No
                                                </label>
                                            </div>
                                           
                                        </div>
                                        <div class="form-group">
                                            <label>Breaking</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="breaking" value="1" <?php if ($statusNewsId->breaking == 1) {
                                                        echo "checked";
                                                    } ?>>Yes
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="breaking" value="0" <?php if ($statusNewsId->breaking == 0) {
                                                        echo "checked";
                                                    } ?>>No
                                                </label>
                                            </div>
                                           
                                        </div>
                                        <div class="form-group">
                                            <label>Slider Key</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="slider_key" value="1" <?php if ($statusNewsId->slider_key == 1) {
                                                        echo "checked";
                                                    } ?>>Yes
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="slider_key" value="0" <?php if ($statusNewsId->slider_key == 0) {
                                                        echo "checked";
                                                    } ?>>No
                                                </label>
                                            </div>
                                           
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status" value="1" <?php if ($statusNewsId->status == 1) {
                                                        echo "checked";
                                                    } ?> >Active
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status" value="0" <?php if ($statusNewsId->status == 0) {
                                                        echo "checked";
                                                    } ?> >Deactive
                                                </label>
                                            </div>
                                           
                                        </div>
                                        
                                       
                                        <button type="submit" name="btnedit" class="btn btn-success">Update News</button>
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