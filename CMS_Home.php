<?php
  include "CMS_SessionCheck.php";
  include "config.php";
  $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
  $sql = "SELECT COUNT(*) FROM photo_list";
  $result = mysqli_query($db,$sql);
  $photocount = 0;
	if ($result) {
		$photocount = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    $photocount = array_values($photocount)[0];
	}
  $sql = "SELECT COUNT(*) FROM menus";
  $result = mysqli_query($db,$sql);
  $menucount = 0;
	if ($result) {
		$menucount = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    $menucount = array_values($menucount)[0];
	}
?>
<?php
  $page_title = "Home";
  $page_index = 0;
  include("CMS_Header.php");
?>

<div class="container pt-5 my-5">
  <h3>
    Welcome,&nbsp;<?php echo "{$_SESSION['username']}(Level {$_SESSION['level']})" ?>!
    <a href="CMS_Login.php?action=logout">Click Here to Log Out</a>.
  </h3>
</div>
<div class="container pt-5 my-5">
  <a href="CMS_Photos.php"><h4>You have <?php echo $photocount; ?> photos.</h4></a>
  <a href="CMS_Menus.php"><h4>You have <?php echo $menucount; ?> menus.</h4></a>
</div>

<?php
  include("CMS_Footer.php");
?>