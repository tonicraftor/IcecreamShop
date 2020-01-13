<?php
  define("PAGELISTLEN",4);
  define("PAGELIST",[
    ["HOME","index.php"],["MENU","menu.php"],["BOOK AN EVENT","booking.php"],["ABOUT","about.php"]
  ]);
  include "config.php";
	$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
  $sql = 'SELECT * FROM links ORDER BY id';
	$result = mysqli_query($db,$sql);
	if ($result) {
		$alllinks = mysqli_fetch_all($result,MYSQLI_ASSOC);
	  mysqli_free_result($result);
	}
?>
<!doctype html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>IcecreamShop|<?php echo PAGELIST[$page_index][0]; ?></title>
  <!-- stylesheet -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/font-awesome.css">
  <link rel="stylesheet" href="css/stylesheet.css">
  <link rel="stylesheet" href="css/multi-item-carousel.css">  
</head>

<body>
<!-- header -->
<header>
  <div class="position-relative">
    <div class="topinfo">
      <span>1226 Museum Square Dr #600, Sugar Land, TX 77479  |  Daily 12AM-11PM</span>
    </div>
    <nav class="navbar navbar-dark sticky-top navbar-expand-md mainmenu" role="navigation" id="mainmenu">
      <div class="container">
        <button class="navbar-toggler menu-toggle" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav menu-list" id="menu-list">
            <?php
              for($i=0;$i<PAGELISTLEN;$i++):
            ?>
            <li class="nav-item<?php if($page_index==$i)echo ' active'; ?>"><a href="<?php echo PAGELIST[$i][1] ?>" class="nav-link menu-link"><?php echo PAGELIST[$i][0] ?></a></li>
            <?php endfor;?>
          </ul>
        </div>
        <div class="navba-right social-list">
          <a href="<?php if(isset($alllinks[0]['url']))echo $alllinks[0]['url'];?>"><i class="fa fa-lg fa-facebook"></i></a>
          <a href="<?php if(isset($alllinks[1]['url']))echo $alllinks[1]['url'];?>"><i class="fa fa-lg fa-twitter"></i></a>
          <a href="<?php if(isset($alllinks[2]['url']))echo $alllinks[2]['url'];?>"><i class="fa fa-lg fa-foursquare"></i></a>
          <a href="<?php if(isset($alllinks[3]['url']))echo $alllinks[3]['url'];?>"><i class="fa fa-lg fa-instagram"></i></a>
        </div>
      </div><!-- container -->
    </nav>
  </div>
</header>