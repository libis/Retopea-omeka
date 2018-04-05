<?php
queue_css_file('geolocation-items-map');

$title = __('Browse Items on the Map') . ' ' . __('(%s total)', $totalItems);
echo head(array('title' => $title, 'bodyclass' => 'map browse'));
?>

<section class="browse-section">
  <div id="content" class='container' role="main" tabindex="-1">
    <div class='row breadcrumbs'>
      <div class="col-sm-12 col-xs-12">
        <p id="simple-pages-breadcrumbs">
          <span><a href="<?php echo url('/');?>"><?php echo __("Home");?></a></span>
           > <span><?php echo $title; ?></span>
         </p>
       </div>
    </div>
   <div class='row top'>
     <div class="col-md-10 col-xs-12">
       <h1><?php echo $title; ?></h1>
    </div>
   </div>
   <div class="row">
     <div class="col-sm-12">
      <?php
      echo item_search_filters();
      //echo pagination_links();
      ?>
      <div id="geolocation-browse">
          <?php echo $this->googleMap('map_browse', array('list' => 'map-links', 'params' => $params)); ?>
      </div>
    </div>
  </div>
</div>
</section>
<?php echo foot(); ?>
