<?php
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    if($email){
      include 'config.php';
	    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
      $email = mysqli_real_escape_string($db,$email);
      $nowdate = date('Y-m-d H:i:s');
      $sql = "INSERT INTO subscribe (email,submit_time) VALUES ('$email','$nowdate')";
      $result = mysqli_query($db,$sql);
      mysqli_free_result($result);
    }
    $pageidx = filter_input(INPUT_GET, 'page');
    define('PAGELIST',[
      ['HOME','index.php'],['MENU','menu.php'],['BOOK AN EVENT','booking.php'],['ABOUT','about.php']
    ]);
    $pageurl = PAGELIST[$pageidx][1];    
    header("location:$pageurl");
  }
  else{
    header('location:index.php');
  }
?>