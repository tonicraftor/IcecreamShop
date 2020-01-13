<?php
//define AppendTitle($tablename) and AppendCol($tablename,$row,$rowidx) to add additional columns
function ShowTable($db,$tablename){
	//get table column titles
	$sql = "SELECT * FROM describe_table WHERE table_name='$tablename' ORDER BY id";
	$result = mysqli_query($db,$sql);
	if (!$result) {
		echo 'Show Table Failed.';
		return;
	}
	$fields = mysqli_fetch_all($result,MYSQLI_ASSOC);
	mysqli_free_result($result);
	//get table content
	$fieldnames = "";
	$fieldstr = "";
	$editablestr = "";
	foreach($fields as $prop){
		if($prop["auth_view"]>=$_SESSION['level']){
			if($fieldnames){
				$fieldnames.=",";
				$fieldstr.=",";
				$editablestr .= ",";
			}
			$fieldnames.="'".$prop["col_name"]."'";
			$fieldstr.=$prop["col_name"];
			$editablestr .= ($prop["auth_edit"]>=$_SESSION['level']?1:0);
		}
	}
	if(!$fieldstr)return;
	$sql = "SELECT $fieldstr FROM $tablename";
	$result = mysqli_query($db,$sql);
	if (!$result) {
		echo 'Show Table Failed.';
		return;
	}
	$allrows = mysqli_fetch_all($result,MYSQLI_ASSOC);
	mysqli_free_result($result);
?>
<script>
editables = [<?php echo $editablestr; ?>];
fieldnames = [<?php echo $fieldnames; ?>];
var tblEdtor_<?php echo $tablename; ?> = new TableEditor("<?php echo $tablename; ?>");
</script>
<form action="" method="post" id="tbl_form"  enctype="multipart/form-data">
  <div class="container-fluid">
    <div class="mb-2">
      <button type="submit" name="newrow" class="btn btn-light btn-outline-dark text-green edttbl-add">
        <i class="fa fa-plus-circle mr-1"></i>Add New</button>
      <input type="hidden" name="tblname" value="<?php echo $tablename; ?>">
    </div>
    <table id="<?php echo $tablename; ?>"  class="table table-bordered table-hover text-center">
      <thead>
        <tr>
        <?php foreach ($fields as $row) { ?>
          <th><?php echo $row["col_title"]; ?></th>
      <?php }
        if(function_exists("AppendTitle"))AppendTitle($tablename);
      ?>
          <th width="200px">Action</th>
        </tr>
      </thead>
      <tbody>
      <?php $rowidx = 1;	
      foreach ($allrows as $row) { ?>
        <tr>
            <?php foreach($row as $col) { ?>
            <td><?php echo $col; ?></td>
            <?php }
          if(function_exists("AppendCol"))AppendCol($db,$tablename,$row,$rowidx);
        ?>
            <td>
              <button type="button" onclick="tblEdtor_<?php echo $tablename; ?>.onEdit(<?php echo $rowidx; ?>,this);"
                class="btn btn-outline-info edttbl-act-btn"><i class="fa fa-pencil"></i></button>
              <button type="submit" name="update" value="<?php echo $row["id"]; ?>" class="btn btn-outline-info edttbl-act-btn" >
                <i class="fa fa-cloud-upload"></i>
              </button>
              <button type="submit" name="del" value="<?php echo $row["id"]; ?>" class="btn btn-outline-info edttbl-act-btn" onclick="return onDel()">
                <i class="fa fa-trash"></i>
              </button>
            </td>
        </tr>
        <?php $rowidx++;} ?>
      </tbody>
    </table>
  </div>
</form>
<?php
}

//define VerifyUpdate($postarray) to verify input data
//define AppendUpdate($tablename,$setstr) to add more Update data
//return 0-success other-error information
function UpdateTable(&$db,&$postarr){
  $tablename = mysqli_real_escape_string($db,$postarr['tblname']);
	if(isset($postarr["newrow"])){
		$sql = "SELECT col_name,default_val FROM describe_table WHERE table_name='$tablename'";
		$result = mysqli_query($db,$sql);
		if (!$result) {
			return 'Add New Row Failed.';
		}
		$colprops = mysqli_fetch_all($result,MYSQLI_ASSOC);
		mysqli_free_result($result);
		$colstr = "";
		$valstr = "";
		foreach($colprops as $prop){
			if($prop["default_val"]!=NULL){
				if($colstr){
					$colstr.=",";
					$valstr.=",";
				}
				$colstr.=$prop["col_name"];
				$valstr.="'".$prop["default_val"]."'";
			}
		}
		//echo "<br>".$valstr;
		$sql = "INSERT INTO $tablename ($colstr) VALUES ($valstr)";
		$retval = mysqli_query( $db, $sql );
		if(!$retval){
			return 'Insert New Row Failed.';
		}
	}
	else if(isset($postarr["del"])){
    $id = mysqli_real_escape_string($db,$postarr['del']);
		$sql = "DELETE FROM $tablename WHERE id=$id";
		$retval = mysqli_query( $db, $sql );
		if(!$retval){
			return 'Delete row failed.';
		}
		$sql = "SELECT MAX(id) FROM $tablename";
		$retval = mysqli_query( $db, $sql );
		if(!$retval){
			return 'Delete row failed.';
		}
		$maxidarr = mysqli_fetch_assoc($retval);
		mysqli_free_result($retval);
		$maxid = $maxidarr["MAX(id)"]+1;
		if($maxid){
			$sql = "ALTER TABLE $tablename  AUTO_INCREMENT = $maxid";
			$retval = mysqli_query( $db, $sql );
			if(!$retval){
				return 'Delete row failed.';
			}
		}
	}
	else if(isset($postarr["update"])){
		//var_dump($postarr);
		//return 0;
		if(function_exists("VerifyUpdate")){
			$verinfo = VerifyUpdate($postarr);
			if($verinfo)return $verinfo;
		}
		$rowid = mysqli_real_escape_string($db,$postarr['update']);
		unset($postarr['tblname']);
		unset($postarr['update']);
		$setstr="";
		foreach($postarr as $key => $val){
			$key = mysqli_real_escape_string($db,$key);
      $sql = "SELECT id FROM describe_table WHERE table_name='$tablename' AND col_name='$key' AND auth_edit>={$_SESSION['level']}";
			$retval = mysqli_query( $db, $sql );
			if($retval&&mysqli_num_rows($retval)==1){
				if($setstr)$setstr.=",";
				$setstr .= "$key='".mysqli_real_escape_string($db, htmlspecialchars($val,ENT_QUOTES|ENT_HTML401))."'";
				mysqli_free_result($retval);
			}
		}
		if(function_exists("AppendUpdate"))AppendUpdate($tablename,$setstr);
		if($setstr){
			$sql = "UPDATE $tablename SET $setstr WHERE id=$rowid";		
			$retval = mysqli_query( $db, $sql );
			if(!$retval){
				return 'Update data failed.';
			}
		}
	}
	return 0;
}
?>
