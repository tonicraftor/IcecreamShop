
<?php
  $page_index = 1;
  include 'header.php';
  $sql = 'SELECT * FROM menus ORDER BY id';
	$result = mysqli_query($db,$sql);
	if (!$result) {
		die('Showing Data Error.');
	}
	$allmenus = mysqli_fetch_all($result,MYSQLI_ASSOC);
	mysqli_free_result($result);
  define("TYPELIST",array(array("Icecream","ICE CREAM FLAVORS"),array("DairyFree","DAIRY FREE FLAVORS"),
                          array("Waffle","WAFFLE"),array("Shake","SHAKE"),array("Other","OTHER")));
?>
<section>
  <div class="sec-logan menu-top-logan">
    <div class="sec-logan-txt1">OUR</div>
    <div class="sec-logan-txt2">FLAVORS</div>
  </div>
</section>
<?php
for($i=0;$i<2;$i++):
?>
<section>
  <div class="container pb-3">
    <div class="menu-type-title text-center mt-5 pt-5"><?php echo TYPELIST[$i][1];?></div>
    <hr class="separator-1">
    <div class="menu-type-price">
      1&nbsp;SCOOP&nbsp;$<?php echo number_format($allmenus[0]['price'],2);?>&nbsp;&nbsp;2&nbsp;SCOOPS&nbsp;
      $<?php echo number_format($allmenus[0]['price2'],2);?>&nbsp;&nbsp;3&nbsp;SCOOPS&nbsp;$<?php echo number_format($allmenus[0]['price3'],2);?>
    </div>
    <div class="row">
    <?php
      foreach($allmenus as $menu){
        if($menu['type']==TYPELIST[$i][0]){
    ?>
      <div class="col-lg-4 col-md-6 col-sm-12 text-center mt-5">
        <img src="photos/menu-<?php echo $menu['id'];?>.png" alt="menu-<?php echo $menu['id'];?>" onerror="this.onerror=null;this.src='img/placeholder.png';">
        <div class="menu_title"><?php echo $menu['name_en'];?></div>
        <hr class="separator-2">
        <div class="menu-type-price">
          1&nbsp;SCOOP&nbsp;$<?php echo number_format($menu['price'],2);?>&nbsp;&nbsp;2&nbsp;SCOOPS&nbsp;
      $<?php echo number_format($menu['price2'],2);?>&nbsp;&nbsp;3&nbsp;SCOOPS&nbsp;$<?php echo number_format($menu['price3'],2);?>
        </div>
        <div class="menu_title">$<?php echo $menu['price'];?></div>
      </div>
    <?php
        }
      }
    ?>
    </div>
  </div>
</section>
<?php endfor ?>
<?php
for($i=2;$i<5;$i++):
?>
<section>
  <div class="container pb-3">
    <div class="menu-type-title text-center mt-5 pt-5"><?php echo TYPELIST[$i][1];?></div>
    <hr class="separator-1">
    <div class="row">
    <?php
      foreach($allmenus as $menu){
        if($menu['type']==TYPELIST[$i][0]){
    ?>
      <div class="col-lg-4 col-md-6 col-sm-12 text-center mt-5">
        <img src="photos/menu-<?php echo $menu['id'];?>.png" alt="menu-<?php echo $menu['id'];?>" onerror="this.onerror=null;this.src='img/placeholder.png';">
        <div class="menu_title"><?php echo $menu['name_en'];?></div>
        <hr class="separator-2">
        <div class="menu-type-price">
          <?php echo $menu['feature'];?>
        </div>
        <div class="menu_title">$<?php echo $menu['price'];?></div>
      </div>
    <?php
        }
      }
    ?>
    </div>
  </div>
</section>
<?php endfor ?>
<section>
  <div class="py-5 my-4"></div>
</section>
<?php 
 include "footer.php";
?>
