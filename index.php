 <?php require_once("header.php"); 

$lnews = $news->getAllLatestNews();

$fnews = $news->getAllSliderKey();

$bnews = $news->getAllBreakingNews();

?> 



<!-- ####################################################################################################### -->
<div class="wrapper">
  <div class="container">
    <div class="content">
      <div id="featured_slide">
        <ul id="featurednews">
          <?php foreach ($fnews as $value) { ?>
          <li><img src="<?php echo "admin/images/".$value->image; ?>" alt="" />
            <div class="panel-overlay">
              <h2><?php echo $value->title; ?></h2>
              <p><?php  echo $value->short_detail; ?><br />
                <a href="news.php?id=<?php echo $value->id; ?>">Continue Reading &raquo;</a></p>
            </div>
          </li>
          <?php } ?>
         
        
        </ul>
      </div>
    </div>
    <div class="column">
      <ul class="latestnews">
        <?php foreach ($lnews as $value) { ?>
          
        <li><img src="<?php echo "admin/images/".$value->image; ?>" height="100" width="100" alt="" />
          <p><strong><a href="news.php?id=<?php echo $value->id; ?>"><?php echo $value->title; ?></a><br></strong><?php echo $value->short_detail; ?></p>
        </li>
      <?php } ?>
      </ul>
    </div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper">
  
 <div id="adblock">
    
    <?php foreach ($gAd as $value) { 
     if ($value->rank == 2) {
      echo "<h1>sujan lamsal</h1>";
      ?>
      
    <div class="fl_left"><a href="<?php echo $value->linkforAd; ?>"><img src="<?php echo "admin/images/".$value->image; ?>" alt="" /></a></div><?php } } ?>
    <div class="fl_right"><a href="#"><img src="images/demo/468x60.gif" alt="" /></a></div>
    <br class="clear" />
 

</div>
  <div id="hpage_cats">
    <?php $i=0 ;
    foreach ($acat as $value) { 
       if ( $i%2 == 0) {
         $method = "fl_left";
       }else{
         $method = "fl_right";
       }

       $news->set('category_id', $value->id);

       $featuredN = $news->getFeaturedNewsByCategory();

       $featuredN = $featuredN[0];
      ?>

    <div class="<?php echo $method; ?>">
       
      <h2><a href="category.php?category_id=<?php echo $featuredN->category_id; ?>"><?php echo $value->name; ?> &raquo;</a></h2>
      <img src="<?php echo "admin/images/".$featuredN->image ?>" height="100" width="100" alt="" />
      <p><strong><a href="news.php?id=<?php echo $featuredN->id; ?>"><?php echo $featuredN->title;  ?></a></strong></p>
      <p><?php echo $featuredN->short_detail; ?></p>
    </div>
        <?php $i++; } ?>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper">
  <div class="container">
    <div class="content">
      
      <div id="hpage_latest">
        
        <h2>Breaking News</h2>
        <?php foreach ($bnews as $value) { ?>
        <ul>
            <li><img src="<?php echo "admin/images/".$value->image; ?>" height="130" width="190" alt="" />
            <p><?php echo $value->short_detail; ?></p>
            <p><?php echo substr($value->detail, 0, 100); ?></p>
            <p class="readmore"><a href="news.php?id=<?php echo $value->id; ?>">Continue Reading &raquo;</a></p>
          </li>
     
        </ul>
        <?php } ?>
        <br class="clear" />
      </div>

    
    </div>
    <div class="column">
      <?php foreach ($gAd as $value) { 
     if ($value->rank == 4) {
      ?>
      <div class="holder"><a href="<?php echo $value->linkforAd; ?>"><img src="<?php echo "admin/images/".$value->image; ?>" height="250" width="300" alt="" /></a></div><?php } } ?>
      <?php foreach ($gAd as $value) { 
     if ($value->rank == 5) {
      ?>
      <div class="holder"><a href="<?php echo $value->linkforAd; ?>"><img src="<?php echo "admin/images/".$value->image; ?>" height="80" width="300" alt="" /></a></div><?php } } ?>
    
    </div>
    <br class="clear" />
  </div>
</div>

 <?php require_once("footer.php");  ?> 
<!-- ####################################################################################################### -->
