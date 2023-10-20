<footer class="py-5">
  <div class="container">
    <div class="row align-items-end">
      <div class="col-md text-center text-md-start d-flex flex-column">
        <a href="<?php echo site_url() ?>"><img src="<?php echo get_theme_file_uri('images/lorem-ipsum-white-logo.png') ?>" class="mb-1"></a>
        <div class="d-flex flex-row mb-1 justify-content-center justify-content-md-start">
          <a class="nav-link pe-2" href="<?php echo site_url(); ?>">Home</a> | 
          <a class="nav-link px-2" href="<?php echo site_url('/about-us'); ?>">About Us</a> | 
          <a class="nav-link ps-2" href="<?php echo site_url('/services'); ?>">Services</a>
        </div>
        &copy; 2023 Lorem Ipsum.
      </div>
      <div class="col-md text-center text-md-end d-flex flex-column mt-1">
        <a class="nav-link mb-1" href="tel:11235555555">+1(123)555-5555</a>
        <a class="nav-link mb-1" href="mailto:mail@loremipsum.com">mail@loremipsum.com</a>
        <div class="footer-social d-flex flex-row justify-content-center justify-content-md-end">
          <a class="nav-link pe-2" href="#"><i class="fa-brands fa-square-facebook"></i></a>
          <a class="nav-link pe-2" href="#"><i class="fa-brands fa-square-instagram"></i></a>
          <a class="nav-link" href="#"><i class="fa-brands fa-square-x-twitter"></i></a>
        </div>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>