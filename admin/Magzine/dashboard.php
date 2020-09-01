
<?php

include("../HeaderFooter/header.php"); 

require_once('../class/news_class.php');

$news = new News();

$fnews = $news->getFeaturedNews();

$bnews = $news->getAllBreakingNews();
   ?>

          

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Dashboard</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                 <div class="row">
                  <h1>Most Featured News</h1>
                  <ol start="1">
                    <?php foreach ($fnews as $value) { ?>
                      <h3><li><strong><?php echo $value->title; ?></strong></li></h3>
                     <?php } ?> 
                  </ol>
                
                 </div>
                 <div class="row">
                  <h1>Breaking News</h1>
                  <ol start="1">
                    <?php foreach ($bnews as $value) { ?>
                      <h3><li><strong><?php echo $value->title; ?></strong></li></h3>
                     <?php } ?> 
                  </ol>
                
                 </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->



    <?php include("../HeaderFooter/footer.php"); ?>