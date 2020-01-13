<!-- footer -->
<footer>
<div class="footer-frame">
  <div class="container">
    <div class="row mb-5">
      <div class="col-lg-2 col-md-4">
        <h3>ADDRESS</h3>
        <h5>1226 Museum Square Dr #600, Sugar Land, TX 77479</h5>
      </div>
      <div class="col-lg-2 col-md-4">
        <h3>CONTACT</h3>
        <h5><a class="text-decoration-none text-white" href="mailto:info@mysite.com">info@mysite.com</a><br>
        Tel: (346) 309-4101
        </h5>
      </div>
      <div class="col-lg-2 col-md-4">
        <h3>HOURS</h3>
        <h5>OPEN DAILY<br>12AM-11PM</h5>
      </div>
      <div class="col-lg-6 col-md-12">
        <h3>MAILING LIST</h3>
        <form id="subscribeForm" method="post" action="subscribe.php?page=<?php echo $page_index; ?>">
          <input class="subscribe-box" type="email" name="email" placeholder="Enter your email here*" required>
          <input type="submit" class="subscribe-box subscribe-btn" value="SUBSCRIBE">
        </form>
      </div>
    </div>
    <div class="row mb-2">
      <div class="col-lg-6 col-md-12">
        <span>©2019 by stacked. Proudly created with newbendesign.com</span>
      </div>
      <div class="col-lg-6 col-md-12">
        <div class="social-list">
          <a href="<?php if(isset($alllinks[0]['url']))echo $alllinks[0]['url'];?>"><i class="fa fa-lg fa-facebook"></i></a>
          <a href="<?php if(isset($alllinks[1]['url']))echo $alllinks[1]['url'];?>"><i class="fa fa-lg fa-twitter"></i></a>
          <a href="<?php if(isset($alllinks[2]['url']))echo $alllinks[2]['url'];?>"><i class="fa fa-lg fa-foursquare"></i></a>
          <a href="<?php if(isset($alllinks[3]['url']))echo $alllinks[3]['url'];?>"><i class="fa fa-lg fa-instagram"></i></a>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- SCIPTS -->
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/multi-item-carousel.js"></script>
<script src="js/stickybar.js"></script>
<script>
  $(function() {
    $("#subscribeForm").validate();
  });
</script>
</body>
</html>
