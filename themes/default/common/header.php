<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ($description = option('description')) :?>
    <meta name="description" content="<?php echo $description; ?>" />
    <?php endif; ?>
    <?php
    if (isset($title)) {
        $titleParts[] = strip_formatting($title);
    }
    $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>

    <?php echo auto_discovery_link_tags(); ?>

    <!-- Plugin Stuff -->
    <?php fire_plugin_hook('public_head', array('view' => $this)); ?>

    <!-- Stylesheets -->
    <?php
      queue_css_file(array('iconfonts', 'app','lightbox'));echo head_css();
      echo theme_header_background();
    ?>
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,400i|Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
    <!-- JavaScripts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <script
			  src="https://code.jquery.com/jquery-3.2.1.min.js"
			  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
			  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="<?php echo WEB_PUBLIC_THEME;?>/default/javascripts/bootstrap.min.js"></script>
    <?php queue_js_file("map");?>
    <?php queue_js_file("lightbox");?>
    <?php echo head_js(false);?>

</head>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <header role="banner">
      <section class="nav-section">
        <div class='container'>
          <nav class="navbar navbar-expand-lg navbar-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <i class='material-icons'>&#xE5D2;</i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <?php echo public_nav_main_bootstrap();?>
              <span class="navbar-text">
                <?php echo multi_language_nav();?>
              </span>
              <form class="form-inline my-2 my-lg-0" action="<?php echo url("search");?>">
                <input id="query" name="query" class="form-control" type="search" placeholder="Search" aria-label="Search">
                <input name="query_type" value="keyword" id="query_type" type="hidden">
                <button class="btn my-2 my-sm-0" type="submit"><i class="material-icons">search</i></button>
              </form>

            </div>
          </nav>
        </div>
      </section>

      <div class="jumbotron">
        <div class='container' role="main" tabindex="-1">
          <section class="jumbo-section">
            <div class="row">
              <div class="co-slogan col-md-7 col-lg-6">
                <div class="slogan">
                  <?php if ( $bodyclass == 'exhibits'): ?>
                      <?php $title_exhibit = explode(' &middot; ', $title);?>
                      <p><span class="exhibit-title"><?php echo $title_exhibit[1]; ?></span></p>
                  <?php elseif ( $bodyclass == 'exhibits summary'): ?>
                      <p><span class="exhibit-title"><?php echo $title; ?></span></p>
                  <?php else:?>
                      <p><?php echo __("Religion, culture and society<br><span>Heritage online</span>"); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </header>
