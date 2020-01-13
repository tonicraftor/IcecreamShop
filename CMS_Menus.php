<?php
	include "CMS_SessionCheck.php";
	include "config.php";
	$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	include "CMS_EditableTable.php";
  //define AppendTitle($tablename) and AppendCol($tablename,$row,$rowidx) to add additional columns
  function AppendTitle(&$tablename){
    if($tablename=='menus')echo "<th>Image Management</th>";
  }
  function AppendCol(&$db,&$tablename,&$row,$rowidx){
    if($tablename=='menus'){
      echo "<td><a href='photos/menu-{$row['id']}.png?t=".time().
      "' target='_blank' class='btn btn-outline-dark'>Preview</a>&nbsp;<a href='javascript:onReplace($rowidx)' class='btn btn-outline-dark'>Replace</a></td>";
    }
  }
	function AppendUpdate(&$tablename,&$setstr){
		$nowdate = date("Y-m-d H:i:s");
		if($setstr)$setstr.=",";
		$setstr.="last_update='$nowdate'";
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
          imagesavealpha($image,true);
          imagepng($image, "photos/menu-{$postarr['photo_id']}.png");
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
  $page_title = "Menus";
  $page_index = 2;
  include("CMS_Header.php");
?>
<script>
  var item_types = ['Icecream','DairyFree','Waffle','Shake','Other'];
  var item_features = ['SUGAR-FREE','GLUTEN-FREE'];
  var feature_set = [false,false];
  function SetFeature(index,isChecked){
    feature_set[index]=isChecked;
    var tstr="";
    var i;
    for(i=0;i<feature_set.length;i++){
      if(feature_set[i]){
        if(tstr){
          tstr += ", ";
        }
        tstr += item_features[i];
      }
    }
    var fobj = document.getElementsByName('feature');
    fobj[0].value = tstr;
  }
  function SetFieldEditor(obj,cells){
    var i;
    var celllen = cells.length-1;
    for (i = 0; i < celllen; i++) {
      if(obj.editables[i]){
        if(obj.fieldnames[i]=='type'){
          var tstr="<select name='type'>";
          var typestr = cells[i].innerHTML;
          var j;
          for(j=0;j<item_types.length;j++){
            tstr += "<option value='"+item_types[j]+"'";
            if(typestr==item_types[j])tstr += " selected ";
            tstr += ">"+item_types[j]+"</option>";
          }
          tstr += "</select>";
          cells[i].innerHTML = tstr;
        }
        /*else if(obj.fieldnames[i]=='feature'){
          var tstr="";
          var fstr = cells[i].innerHTML;
          var j;
          for(j=0;j<item_features.length;j++){
            tstr += "<input type='checkbox' onClick='SetFeature("+j+",this.checked)'";
            if(fstr.indexOf(item_features[j])!=-1){
              tstr += " checked ";
              feature_set[j]=true;
            }
            else feature_set[j]=false;
            tstr += ">"+item_features[j]+"&nbsp;";
          }
          tstr += "<input type='hidden' name='feature' value='"+fstr+"'>";
          cells[i].innerHTML = tstr;
        }*/
        else{
          cells[i].innerHTML="<input type='text' name='"+obj.fieldnames[i]+"' value='"+escapeHtml(cells[i].innerHTML)+"'/>";
        }
      }
    }
  }

  function onReplace(index){
    var tbl = document.getElementById("menus");
    var fid = tbl.rows[index].cells[0].innerHTML;	
    tbl.rows[index].cells[10].innerHTML = "<label for='photof'>File name：</label><input type='file' id='photof' name='file'>\
    <button type='submit' name='photo_id' class='btn btn-outline-dark' value='"+fid+"'>Upload</button>\
    <button type='button' class='btn btn-outline-dark' onClick='onCancel("+index+")'>Cancel</button>";
  }
  function onCancel(index){
    var tbl = document.getElementById("menus");
    var fid = tbl.rows[index].cells[0].innerHTML;
    tbl.rows[index].cells[10].innerHTML = 
      "<a href='photos/menu-"+fid+".png?t="+ new Date().getTime()+"' target='_blank' class='btn btn-outline-dark'>Preview</a>&nbsp;\
       <a href='javascript:onReplace("+index+")' class='btn btn-outline-dark'>Replace</a>";
  }
</script>

<p><br />
<p>&nbsp;</p>

<div class="container text-center my-5">
  <h1>Menu Management</h1>
</div>
<?php
ShowTable($db,"menus"); ?>

<?php
  include("CMS_Footer.php");
  mysqli_close($db);
?>