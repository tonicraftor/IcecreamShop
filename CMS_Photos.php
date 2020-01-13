<?php
include "CMS_SessionCheck.php";
include "config.php";
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
include "CMS_EditableTable.php";
//define AppendTitle($tablename) and AppendCol($tablename,$row,$rowidx) to add additional columns
function AppendTitle(&$tablename){
	if($tablename=='photo_list')echo "<th>File Management</th>";
}
function AppendCol(&$db,&$tablename,&$row,$rowidx){
	if($tablename=='photo_list'){
		echo "<td><a href='photos/photo-{$row['id']}.jpg?t=".time().
		"' target='_blank' class='btn btn-outline-dark'>Preview</a>&nbsp;<a href='javascript:onReplace($rowidx)' class='btn btn-outline-dark'>Replace</a></td>";
	}
}
function AppendUpdate(&$tablename,&$setstr){
  if($tablename=='photo_list'){
    $nowdate = date("Y-m-d H:i:s");
    if($setstr)$setstr.=",";
    $setstr.="last_update='$nowdate'";
  }
}
//check post
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$postarr = filter_input_array(INPUT_POST);
	if(isset($postarr["photo_id"])){
		// allowed file name and format
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$allowedTypes = array("image/gif","image/jpeg","image/jpg","image/pjpeg","image/x-png","image/png");
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = strtolower(end($temp));
		if(in_array($_FILES["file"]["type"],$allowedTypes)&& in_array($extension, $allowedExts)){
			if ($_FILES["file"]["error"] > 0){
				echo "<script>alert('Upload File Error:{$_FILES['file']['error']}!');</script>";
			}
			else{
        switch ($extension) {
          case 'jpg':
          case 'jpeg':
             $image = imagecreatefromjpeg($_FILES["file"]["tmp_name"]);
          break;
          case 'gif':
             $image = imagecreatefromgif($_FILES["file"]["tmp_name"]);
          break;
          case 'png':
             $image = imagecreatefrompng($_FILES["file"]["tmp_name"]);
          break;
        }
        imageinterlace($image,1);
				imagejpeg($image, "photos/photo-{$postarr['photo_id']}.jpg");
        imagedestroy($image);
				$nowdate = date("Y-m-d H:i:s");
				$sql = "UPDATE {$postarr['tblname']} SET last_update = '$nowdate' WHERE id='{$postarr['photo_id']}'";		
				$retval = mysqli_query( $db, $sql );
				if(!$retval){
					echo '<script>alert("Upload photo failed!");</script>';
				}
			}
		}
		else{
			echo "<script>alert('Invalid File format!Must be image file.');</script>";
		}
	}
	else{
		$ret = UpdateTable($db,$postarr);
		if($ret)echo "<script>alert('$ret');</script>";
	}
}
?>
<?php
  $page_title = "Home";
  $page_index = 1;
  include("CMS_Header.php");
?>
<script>
//function SetFieldEditor(obj,cells){
//}
function onReplace(index){
	var tbl = document.getElementById("photo_list");
	var fid = tbl.rows[index].cells[0].innerHTML;	
	tbl.rows[index].cells[4].innerHTML = "<label for='photof'>File name：</label><input type='file' id='photof' name='file'>\
	<button type='submit' name='photo_id' class='btn btn-outline-dark' value='"+fid+"'>Upload</button>\
	<button type='button' class='btn btn-outline-dark' onClick='onCancel("+index+")'>Cancel</button>";
}
function onCancel(index){
	var tbl = document.getElementById("photo_list");
	var fid = tbl.rows[index].cells[0].innerHTML;
	tbl.rows[index].cells[4].innerHTML = 
		"<a href='photos/photo-"+fid+".jpg?t="+ new Date().getTime()+"' target='_blank' class='btn btn-outline-dark'>Preview</a>&nbsp;\
     <a href='javascript:onReplace("+index+")' class='btn btn-outline-dark'>Replace</a>";
}
</script>
<div class="container text-center my-5 pt-5">
  <h1>Photo Management</h1>
</div>
<?php
ShowTable($db,"photo_list"); ?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php
  include("CMS_Footer.php");
  mysqli_close($db);
?>