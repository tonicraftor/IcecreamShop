<!doctype html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Content Management System|<?php echo $page_title; ?></title>
  <!-- stylesheet -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/font-awesome.css">
  <link rel="stylesheet" href="css/CMS_styles.css">
  <script src="js/CMS_TableEditor.js"></script>
</head>

<body>
<header>
  <nav class="navbar navbar-expand-md fixed-top bg-secondary navbar-dark" role="navigation">
    <div class="navbar-brand">Content Management System</div>
    <div class="container">
      <ul class="navbar-nav mr-auto" id="mainmenu">
        <li class="nav-item"><a href="CMS_Home.php" class="nav-link">HOME</a></li>
        <li class="nav-item"><a href="CMS_Photos.php" class="nav-link">PHOTOS</a></li>
        <li class="nav-item"><a href="CMS_Menus.php" class="nav-link">MENUS</a></li>
        <li class="nav-item"><a href="CMS_Links.php" class="nav-link">LINKS</a></li>
        <li class="nav-item"><a href="CMS_Accounts.php" class="nav-link">ACCOUNTS</a></li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="CMS_Login.php?action=logout" class="nav-link">LOGOUT</a></li>
      </ul>
    </div><!-- container -->
  </nav>
  <div style="height:50px"></div>
</header>
<!-- set active page -->
<script>
  var mainmenu = document.getElementById("mainmenu");
  var child = mainmenu.children[<?php echo $page_index; ?>];
  child.classList.add("active");
</script>