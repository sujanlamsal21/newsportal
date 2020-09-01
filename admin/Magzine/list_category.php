<?php
@session_start();
if (isset($_SESSION['role']) && $_SESSION['role'] != 'admin') {
    header("location:permission.php");
}

include("../HeaderFooter/header.php"); 

require_once('../class/category_class.php');

$category = new Category();

$statusList = $category->retrieve();
   ?>
      
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">      

        
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">List Category</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Category Listing Tables
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Name</th>
                                        <th>Rank</th>
                                        <th>Status</th>
                                        <th>Created By</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($statusList as $key => $value) { ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $key+1; ?></td>
                                        <td><?php echo $value->name; ?></td>
                                        <td><?php echo $value->rank; ?></td>
                                        <td class="center"><?php 
                                        if ($value->status == 1){
                                            echo '<label style="color: green;">Active</label>';
                                        } else
                                        echo '<label style="color: red;">Deactive</label>';
                                         ?></td>
                                        <td class="center"><?php echo $value->created_by; ?></td>
                                        <td><?php echo $value->created_date; ?></td>
                                        <td class="center"><a href="edit_category.php?id=<?php echo $value->id ?>" class="btn btn-success"><i class="fa  fa-pencil"></i> Edit </a><a href="delete_category.php?id=<?php echo $value->id ?>" class="btn btn-danger" onclick='return confirm("Are You Sure To Delete")'><i class="fa  fa-trash-o"></i> Delete</a></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                
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

     <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

     <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>