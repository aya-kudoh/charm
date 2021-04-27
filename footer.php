<footer>
      <div class="footer">
        <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/footer-logo.png" alt=""></a>
        <ul>
          <li><a href="http://wp1.local/">Home</a></li>
          <li><a href="http://wp1.local/author/wp1/">Mypage</a></li>
          <li><a href="http://wp1.local/post-all/">Blog</a></li>
          <li><a href="http://wp1.local/tag">Tags</a></li>
        </ul>
      </div>
      <div class="copyright">
        <span>© 2021 Charm</span>
      </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
          slidesPerView: 'auto',
          spaceBetween: 30,
      		loop: true,
      		centeredSlides: true,
      		pagination: '.swiper-pagination',
      		autoplay: 1500,
          disableOnInteraction: false,
        });
    </script>
  </body>
</html>
