<?php
include "CMS_SessionCheck.php";
include "config.php";
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
include "CMS_EditableTable.php";
//define AppendTitle($tablename) and AppendCol($tablename,$row,$rowidx) to add additional columns

function AppendUpdate(&$tablename,&$setstr){
  if($tablename=='links'){
    $nowdate = date("Y-m-d H:i:s");
    if($setstr)$setstr.=",";
    $setstr.="last_update='$nowdate'";
  }
}
//check post
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$postarr = filter_input_array(INPUT_POST);
	$ret = UpdateTable($db,$postarr);
}
?>
<?php
  $page_title = "Links";
  $page_index = 3;
  include("CMS_Header.php");
?>
<div class="container text-center my-5 pt-5">
  <h1>Links Management</h1>
</div>
<?php
ShowTable($db,"links"); ?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php
  include("CMS_Footer.php");
  mysqli_close($db);
?>