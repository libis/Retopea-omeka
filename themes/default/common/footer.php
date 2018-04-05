    <footer role="contentinfo">
      <?php
        $lang = get_language();
        if($lang == "nl"):
          $english = "";
        else:
          $english = "english";
        endif;
      ?>
      <section class="home">
        <div class="container footer-container">
            <div id="footer-text">
              <div class="footer-row">
                <div class="col-content">
                  <a href="https://kadoc.kuleuven.be/<?php echo $english;?>"><img src="<?php echo img("kadoc.PNG");?>"></a>
                  <img src="<?php echo img("ErkendCultArch.jpg");?>">
                  <img src="<?php echo img("_erkendeerfbib.gif");?>">
                  <a href="http://www.ditisvlaanderen.be/"><img src="<?php echo img("vlaanderen.png");?>"></a>
                  <a href="http://libis.be/"><img src="<?php echo img("libis_gray.png");?>"></a>
                </div>
              </div>
            </div>
            <?php fire_plugin_hook('public_footer', array('view' => $this)); ?>
        </div>
      </section>
    </footer><!-- end footer -->

    <script>
      jQuery('.navbar-toggler').click(function(e) {
        e.preventDefault();
        jQuery('.navbar-toggler').toggleClass('toggled');
        if(jQuery('.navbar-toggler').hasClass('toggled')){
          jQuery('.navbar-toggler').html("<i class='material-icons'>&#xE5CD;</i>");
        }else{
          jQuery('.navbar-toggler').html("<i class='material-icons'>&#xE5D2;</i>");
        }
      });

      jQuery(function () {
        jQuery('a[href="#search"]').on('click', function(event) {
            event.preventDefault();
            jQuery('#search').addClass('open');
            jQuery('#search > form > input[type="search"]').focus();
        });

        jQuery('#search, #search button.close').on('click keyup', function(event) {
            if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
                $(this).removeClass('open');
            }
        });
    });

    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-3238091-18"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-3238091-18');
    </script>
</body>
</html>
