<?php
   include "CMS_SessionCheck.php";
   include "config.php";
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   include "CMS_EditableTable.php";
?>
<?php
  $page_title = "Accounts";
  $page_index = 4;
  include("CMS_Header.php");
?>
<script>
function SetFieldEditor(obj,cells){
	var i;
	var celllen = cells.length-1;
	for (i = 0; i < celllen; i++) {
		if(obj.editables[i]){
			if(obj.fieldnames[i]=='level'){
				var tstr="<select name='level'>";
				var level = cells[i].innerHTML;
				var j;
				for(j=1;j<4;j++){
					tstr += "<option value='"+j+"'";
					if(level==j)tstr += " selected ";
					tstr += ">"+j+"</option>";
				}
				tstr += "</select>";
				cells[i].innerHTML = tstr;
			}
			else{
				cells[i].innerHTML="<input type='text' name='"+obj.fieldnames[i]+"' value='"+escapeHtml(cells[i].innerHTML)+"'/>";
			}
		}
	}
}
</script>

<p><br />
<p>&nbsp;</p>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$postarr = filter_input_array(INPUT_POST);
	UpdateTable($db,$postarr);
}
?>
<div class="container text-center my-5">
	<h1>Administrator Account Management</h1>
</div>
<?php
ShowTable($db,"admin"); ?>

<?php
  include("CMS_Footer.php");
  mysqli_close($db);
?>