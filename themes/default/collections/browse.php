<?php
  $pageTitle = __('Browse Collections');
  echo head(array('title'=>$pageTitle,'bodyclass' => 'collections browse'));

  //only show featured records on featured page and with filter on
  $params = $_GET;
  $show_featured = false;

  if(!isset($params['page'])):
    $params['page'] = "0";
  endif;

  if(isset($params['featured'])):
    if($params['featured']=="1"):
        $show_featured = true;
    endif;
  endif;
 ?>

<section class="browse-section">
  <div id="content" class='container' role="main" tabindex="-1">
    <div class='row breadcrumbs'>
      <div class="col-sm-12 col-xs-12">
        <p id="simple-pages-breadcrumbs">
          <span><a href="<?php echo url('/');?>"><?php echo __("Home");?></a></span>
           > <span><?php echo __('Collections');?></a></span>
         </p>
     </div>
   </div>
   <div class='row top'>
     <div class="col-sm-12 col-xs-12">
        <h1><?php echo $pageTitle; ?></h1>
         <?php if ($total_results > 0): ?>
           <div id="sort-links">
                 <span class="sort-label"><i class="material-icons">&#xE152;</i>
                    <?php echo __('Filter: '); ?></span>
                    <?php if($show_featured):?>
                      <a href="<?php echo url('collections/browse');?>">
                        <?php echo __("Show all"); ?>
                      </a>
                    <?php else:?>
                      <a href="<?php echo url('collections/browse?featured=1');?>">
                        <?php echo __("Featured"); ?>
                      </a>
                    <?php endif;?>
             </div>
         <?php endif; ?>
     </div>
   </div>

   <?php echo pagination_links(); ?>

   <div class="row">
     <?php foreach (loop('collections') as $collection): ?>
       <div class="col-sm-3">
          <?php
             $class = "";
             if($collection->featured):
               $class = 'featured';
             endif;
          ?>
          <div class="list-row <?php echo $class;?>">
            <?php if ($collectionImage = record_image('collection','square_thumbnail')): ?>
                <?php echo link_to_collection($collectionImage, array('class' => 'image')); ?>
            <?php else: ?>
                  <div class="dummy-box"><div class="dummy"></div></div>
            <?php endif; ?>
            <div class="list-item">
              <h3 class="star"><span><?php echo __('Featured');?></span></h3>
              <h2><i class="material-icons">&#xE3B6;</i><?php echo link_to_collection(); ?></h2>
              <?php echo metadata($collection, array('Dublin Core', 'Description'), array('snippet'=>80));?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <?php fire_plugin_hook('public_collections_browse', array('collections'=>$collections, 'view' => $this)); ?>

  </div>
</section>


<?php echo foot(); ?>
