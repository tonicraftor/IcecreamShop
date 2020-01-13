<?php
  $page_index = 0;
  include "header.php";
?>

<!-- Section -->
<section>
  <div class="section1">
    <div>
      <img src="photos/photo-1.jpg" alt="photo-1">
    </div>
    <div class="txt-container">
      <div class="txt-1-1">STACKED</div>
      <div class="txt-1-2">ICE CREAM</div>
      <a class="button-1" href="menu.php">MENU</a>
    </div>
  </div>
</section>
<section>
  <div class="row mx-0">
    <div class="col-md-6 col-sm-12 img-area">
      <img src="photos/photo-2.jpg" alt="photo-2">
    </div>
    <div class="col-md-6 col-sm-12">
      <div class=" desc-area">
        <div class="desc-title">OUR FLAVORS</div>
        <div class="desc-sub">Fresh n' Tasty!</div>
        <div class="desc-para">I'm a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font. </div>
        <a href="menu.php" class="button-1">MENU</a>
      </div>
    </div>
  </div>
</section>
<section>
  <div class="sec-logan">
    <div class="sec-logan-txt1">ENJOY</div>
    <div class="sec-logan-txt2">DAIRY FREE</div>
    <a href="menu.php" class="button-1">MENU</a>
  </div>
</section>
<section>
  <div class="row mx-0">
    <div class="col-md-6 col-sm-12 order-md-last img-area">
      <img src="photos/photo-3.jpg" alt="photo-3">
    </div>
    <div class="col-md-6 col-sm-12">
      <div class="desc-area desc-area-right">
        <div class="desc-title">OUR PLACE</div>
        <div class="desc-sub">Ice cream by the sea</div>
        <div class="desc-para">The ice cream sandwich industry is relatively is relatively new within the past 3 years. The future of the industry is long and just beginning. As the industry grows so will Stacked, not only in the size and popularity but also geographically expanding throughout the southern region of the United States. Our unique business model accompanied with the experience and dedication of its owners will be the key factor that will lead to the ultimate success of Stacked.</div>
        <a href="about.php" class="button-1">READ MORE</a>
      </div>
    </div>
    
  </div>
</section>
<section>
  <div class="sec-logan">
    <div class="sec-logan-txt1">CATERING & MORE</div>
    <div class="sec-logan-txt2">EVENTS</div>
    <a href="booking.php" class="button-1">MAKE A WISH</a>
  </div>
</section>
<section>
  <div class="row mx-0">
    <div class="col-md-6 col-sm-12 img-area">
      <img src="photos/photo-4.jpg" alt="photo-4">
    </div>
    <div class="col-md-6 col-sm-12">
      <div class=" desc-area">
        <div class="desc-title">DESSERTS</div>
        <div class="desc-sub">Ice cream goodies</div>
        <div class="desc-para">Stacked Ice Cream specializes in the Ice Cream Sandwich business, providing a new alternative in satisfying your sweet tooth. This combination of custom made donuts, fresh macaron cookies, and brownies combined with our small batch ice cream brings together an unforgettable experience that people from all walks of life can enjoy.</div>
        <a href="menu.php" class="button-1">MENU</a>
      </div>
    </div>
  </div>
</section>
<section>
  <div class="sec-fullimg">
    <img src="photos/photo-5.jpg" alt="photo-5">
  </div>
</section>
<div>
  <div class="row mx-0">
    <div id="carousel1" class="carousel slide w-100" data-ride="carousel">
      <div class="carousel-inner" role="listbox">
        <?php
          for($i=0;$i<8;$i++):
        ?>
        <div class="carousel-item<?php if($i==0)echo ' active'; ?>">
          <div class="col-lg-3 col-md-6 px-0 position-relative img-overlay-container">
            <img class="img-fluid w-100" src="img/list-<?php echo $i+1; ?>.jpg">
            <div class="img-overlay">
              <a href="#" class="icon-heart"><i class="fa fa-heart"></i><i class="fa fa-comment"></i></a>
            </div>
          </div>
        </div>
        <?php endfor; ?>
      </div>
      <a class="carousel-control-prev" href="#carousel1" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carousel1" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>  
</div>
<div>
  <div class="row mx-0">
    <div id="carousel2" class="carousel slide w-100" data-ride="carousel">
      <div class="carousel-inner" role="listbox">
        <?php
          for($i=0;$i<22;$i+=2):
        ?>
        <div class="carousel-item<?php if($i==0)echo ' active'; ?>">
          <div class="col-lg-2 col-md-3 col-sm-6 px-0">
            <div class="position-relative img-overlay-container">
              <img class="img-fluid w-100" src="img/minislide-<?php echo $i+1; ?>.jpg">
              <div class="img-overlay">
                <a href="#" class="icon-heart"><i class="fa fa-heart"></i></a>
              </div>
            </div>
            <div class="position-relative img-overlay-container">
              <img class="img-fluid w-100" src="img/minislide-<?php echo $i+2; ?>.jpg">
              <div class="img-overlay">
                <a href="#" class="icon-heart"><i class="fa fa-heart"></i></a>
              </div>
            </div>
          </div>
        </div>
        <?php endfor; ?>
      </div>
      <a class="carousel-control-prev" href="#carousel2" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carousel2" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>  
</div>
<?php 
 include "footer.php";
?>
