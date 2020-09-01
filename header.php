<?php    

include("config.php");

// print_r($category);

$acat = $category->getAllActiveCategory();


$gAd = $advertisement->getAllAdvertiseMent();



// print_r($acat);






?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
Template Name: News Magazine
Author: <a href="http://www.os-templates.com/">OS Templates</a>
Author URI: http://www.os-templates.com/
Licence: Free to use under our free template licence terms
Licence URI: http://www.os-templates.com/template-terms
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>News Magazine</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="layout/styles/layout.css" type="text/css" />
<script type="text/javascript" src="layout/scripts/jquery.min.js"></script>
<!-- Homepage Specific -->
<script type="text/javascript" src="layout/scripts/galleryviewthemes/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="layout/scripts/galleryviewthemes/jquery.timers.1.2.js"></script>
<script type="text/javascript" src="layout/scripts/galleryviewthemes/jquery.galleryview.2.1.1.min.js"></script>
<script type="text/javascript" src="layout/scripts/galleryviewthemes/jquery.galleryview.setup.js"></script>
<!-- / Homepage Specific -->
</head>
<body id="top">
<div class="wrapper col0">
  <div id="topline">
    <p>Tel: 014235645 | Mail: info@newsnepal.com</p>
    <ul>
      <li><a href="#">About</a></li>
      <li><a href="#">Help</a></li>
      <li><a href="#">Terms</a></li>
      <li class="last"><a href="#">Contact</a></li>
    </ul>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper">
  <div id="header">
    <div class="fl_left">
      <h1><a href="index.php"><strong>N</strong>ews <strong>N</strong>epal</a></h1>
      <p>Khabar Afnai Desh Ko </p>
    </div>
    <?php foreach ($gAd as $value) { 
     if ($value->rank == 1) {
      ?>
    <div class="fl_right"><a href="<?php echo $value->linkforAd; ?>"><img src="<?php echo "admin/images/".$value->image; ?>"alt="" /></a></div> <?php } } ?>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col2">
  <div id="topbar">
    <div id="topnav">
      <ul>
        <li class="active"><a href="index.php">Home</a></li>
        <?php foreach ($acat as $value) {  ?>
        <li><a href="category.php?category_id=<?php echo $value->id; ?>"><?php echo $value->name ?></a></li>
      <?php  }  ?>
      </ul>
    </div>
    <div id="search">
      <form action="#" method="post">
        <fieldset>
          <legend>Search</legend>
          <input type="text" value="Search Our Website&hellip;"  onfocus="this.value=(this.value=='Search Our Website&hellip;')? '' : this.value ;" />
          <input type="submit" name="go" id="go" value="Search" />
        </fieldset>
      </form>
    </div>
    <br class="clear" />
  </div>
</div>