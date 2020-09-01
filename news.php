<?php include('header.php'); 

$news->set('id', $_GET['id']);

require_once('admin/class/comment_class.php');

$nnnews = $news->getCategoryNewsByIdFromNews();

$nnnews = $nnnews[0];

$bbnews = $news->getAllBreakingNews();


$ffnews = $news->getFeaturedNews();

$usercomment = new Comment();

$Error="";

$usercomment->set('news_id', $_GET['id']);




if (array_key_exists('submit', $_POST)) {

  if (isset($_POST['name']) && !empty($_POST['name'])) {
    
  }else{
    $Error .="enter name"."<br>";
  }
 if (isset($_POST['email']) && !empty($_POST['email'])) {
    
  }else{
    $Error .="enter Email"."<br>";
  } if (isset($_POST['comment']) && !empty($_POST['comment'])) {
    
  }else{
    $Error .="enter comment"."<br>";
  }
  if ($Error !="") {
    $Error ='<div style="color:red;"">There were error<br>'.$Error.'</div>';
  }else{
    $usercomment->set('news_id', $_GET['id']);
    $usercomment->set('name', $_POST['name']);

    $usercomment->set('email', $_POST['email']);

    $usercomment->set('comment', $_POST['comment']);
    $usercomment->set('commented_date', date('Y-m-d H:i:s'));

    $usercomment->save();
  }
}

$rcomment = $usercomment->getCommentByNewsId();
 

?>
<!-- ####################################################################################################### -->
<div class="wrapper">
  <div id="breadcrumb">
    <ul>
      <li class="first">You Are Here</li>
      <li>&#187;</li>
      <li><a href="#">Home</a></li>
      <li>&#187;</li>
      <li><a href="category.php?category_id=<?php echo $nnnews->category_id; ?>"><?php echo $nnnews->category_name; ?></a></li>
      <li>&#187;</li>
      <li class="current"><a href="">News</a></li>
    </ul>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper">
  <div class="container">
    <div class="content">
      <h1> <strong><?php echo $nnnews->title; ?></strong> </h1>
      <img class="imgr" src="<?php echo "admin/images/".$nnnews->image; ?>" alt="" width="125" height="125" />
      <p><?php echo substr($nnnews->detail,0,500); ?></p>
      <img class="imgl" src="<?php echo "admin/images/".$nnnews->image; ?>" alt="" width="125" height="125" />
      <p><?php echo substr($nnnews->detail,500,100); ?></p>
      <p><?php echo substr($nnnews->detail,1000,2500); ?></p>
      <p><?php echo substr($nnnews->detail,2500,5500); ?></p>
     <br><br>
      <div id="comments">
        <h2>Comments</h2>
        <ul class="commentlist">
          <?php foreach ($rcomment as $key=>$value) { ?>
          <li class="<?php echo $key%2 == 0?'comment_odd':'comment_even'; ?>">
            <div class="author"><img class="avatar" src="../images/demo/avatar.gif" width="32" height="32" alt="" /><span class="name"><a href="#"><?php echo $value->name; ?></a></span> <span class="wrote"></span></div>
            <div class="submitdate"><a href="#"><?php echo $value->commented_date; ?></a></div>
            <p><?php echo $value->comment; ?></p>
          </li>
          <?php } ?>
        </ul>
      </div>
      <h2>Write A Comment</h2>
      <?php echo $Error; ?>
      <div id="respond">
        <form method="post">
          <p>
            <input type="text" name="name" size="22" /><br>
            <label for="name"><small>Name (required)</small></label>
          </p>
          <p>
            <input type="email" name="email" size="22" /><br>
            <label for="email"><small>Mail (required)</small></label>
          </p>
          <p>
            <textarea name="comment" id="comment" cols="100%" rows="10"></textarea>
            <label for="comment" style="display:none;"><small>Comment (required)</small></label>
          </p>
          <p>
            <button name="submit" type="submit" class="btn btn-success" >Submit</button>
            &nbsp;
            <button type="reset" class="btn btn-danger">Reset Form </button>
          </p>
        </form>
      </div>
    </div>
    <div class="column">
      <div class="subnav">
        <h2>Breaking News</h2>
        <ul>
          <?php foreach ($bbnews as $value) { ?>
          <li><a href="news.php?id=<?php echo $value->id; ?>"><?php echo $value->title; ?></a></li>
         <?php } ?>
            
          
          
        </ul>
      </div>
      <div class="holder">
        <h1>Featured News</h1>
      </div>
      <div id="featured">
        <ul>
          <?php foreach ($ffnews as $value) { ?>
          <li>
            <h2><?php echo $value->title; ?></h2>
            <p class="imgholder"><img src="<?php echo "admin/images/".$value->image ?>" height="100" width="240" alt="" /></p>
            <p><?php echo $value->short_detail; ?></p>
            <p class="readmore"><a href="news.php?id=<?php echo $value->id; ?>">Continue Reading &raquo;</a></p>
          </li>
        <?php } ?>
        </ul>
      </div>
     
    </div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper">
  <div id="adblock">
    <?php foreach ($gAd as $value) { 
     if ($value->rank == 1) {
      ?>
    <div class="fl_left"><a href="<?php echo $value->linkforAd; ?>"><img src="<?php echo "admin/images/".$value->image; ?>" alt="" /></a></div><?php } } ?>
    <div class="fl_right"><a href="#"><img src="../images/demo/468x60.gif" alt="" /></a></div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<?php 
include('footer.php');
?>