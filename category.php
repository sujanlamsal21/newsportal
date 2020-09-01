<?php  

include('header.php');


$news->set('category_id', $_GET['category_id']);

$catNews = $news->getAllCategoryNews();

?>

<div class="wrapper">
  <div id="breadcrumb">
    <ul>
      <li class="first">You Are Here</li>
      <li>&#187;</li>
      <li><a href="index.php">Home</a></li>
      <li>&#187;</li>
      
      <li class="current"><a href=""><?php echo $catNews[0]->category_name; ?></a></li>
    </ul>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper">
  <div class="container">
   <?php 
   foreach ($catNews as $c) { 
   ?>
    <ol start="1"><a href="news.php?id=<?php echo $c->id; ?>"><strong><h3>
      <?php 
         echo $c->title;
      ?></strong></h3></a>
      <h5><?php echo $c->short_detail; ?></h5>
    </ol>
   <?php } ?>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper">
  <div id="adblock">
    <div class="fl_left"><a href="#"><img src="../images/demo/468x60.gif" alt="" /></a></div>
    <div class="fl_right"><a href="#"><img src="../images/demo/468x60.gif" alt="" /></a></div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<?php  

include('footer.php');

?>