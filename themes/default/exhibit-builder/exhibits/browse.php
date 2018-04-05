<?php
$title = __('Browse Exhibits');
echo head(array('title' => $title, 'bodyclass' => 'exhibits browse'));
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
<section class="exhibit-show-section">
  <div id="content" class='container' role="main" tabindex="-1">
    <div class='breadcrumbs'>
        <p id="simple-pages-breadcrumbs">
          <span><a href="<?php echo url('/');?>"><?php echo __("Home");?></a></span>
           > <span><?php echo __("Exhibits");?></span>
        </p>
    </div>
    <div class='top'>
       <h1><?php echo $title; ?></h1>
       <div id="sort-links">
          <span class="sort-label"><i class="material-icons">&#xE152;</i>
              <?php echo __('Filter: '); ?></span>
              <?php if($show_featured):?>
                <a href="<?php echo url('exhibits/browse');?>">
                  <?php echo __("Show all"); ?>
                </a>
              <?php else:?>
                <a href="<?php echo url('exhibits/browse?featured=1');?>">
                  <?php echo __("Featured"); ?>
                </a>
              <?php endif;?>
       </div>
    </div>

    <?php
      $featured_exhibits = array(); $normal_exhibits = array();
      foreach($exhibits as $exhibit):
        if($exhibit->featured):
          $featured_exhibits[] = $exhibit;
        else:
          $normal_exhibits[] = $exhibit;
        endif;
      endforeach;
    ?>

    <?php if (count($exhibits) > 0): ?>
      <?php echo pagination_links();?>
      <?php foreach($featured_exhibits as $exhibit):?>
        <div class="feat-row exhibits-feat">
          <div class="row">
            <div class="col-md-12 col-lg-3">
              <?php if ($exhibitImage = record_image($exhibit, 'thumbnail')): ?>
                  <?php echo exhibit_builder_link_to_exhibit($exhibit, $exhibitImage, array('class' => 'image')); ?>
              <?php endif; ?>
            </div>
            <div class="col-md-12 col-lg-8">
              <div class="list-item">
                <h3><span><?php echo __('Featured');?></span></h3>
                <h2><?php echo exhibit_builder_link_to_exhibit($exhibit,metadata($exhibit, 'title')); ?>
                  <?php if(metadata($exhibit, 'subtitle')):?>
                  <br><span class="subtitle"><?php echo metadata($exhibit, 'subtitle')?></span>
                  <?php endif;?>
                </h2>
                <?php if ($exhibitCredits = metadata($exhibit, 'credits')): ?>
                <div class="credits"><p><?php echo $exhibitCredits; ?></p></div>
                <?php endif; ?>
                <?php if ($exhibitDescription = metadata($exhibit, 'description', array('no_escape' => true,'snippet'=>'300'))): ?>
                <div class="description"><p><?php echo $exhibitDescription; ?></p></div>
                <?php endif; ?>
                <?php if ($exhibitTags = tag_string($exhibit, 'exhibits')): ?>
                <p class="tags"><?php echo $exhibitTags; ?></p>
                <?php endif; ?>
              </div>
              <div class="list-footer">
                <?php echo exhibit_builder_link_to_exhibit($exhibit, __("Start exhibit")); ?>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach;?>

      <div class="row">
        <?php foreach ($normal_exhibits as $exhibit): ?>
          <?php
            $class = "";
            if($exhibit->featured):
              $class = 'featured';
            endif;
          ?>
          <div class="col-md-3">
            <div class="list-row <?php echo $class;?>">
              <?php if ($exhibitImage = record_image($exhibit, 'square_thumbnail')): ?>
                  <?php echo exhibit_builder_link_to_exhibit($exhibit, $exhibitImage, array('class' => 'image')); ?>
              <?php endif; ?>
              <div class="list-item">
                  <h3 class="star"><span><?php echo __('Featured');?></span></h3>
                  <h2><?php echo exhibit_builder_link_to_exhibit($exhibit,metadata($exhibit, 'title')); ?></h2>
                  <?php if ($exhibitCredits = metadata($exhibit, 'credits')): ?>
                  <div class="credits"><p><?php echo $exhibitCredits; ?></p></div>
                  <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <p><?php echo __('There are no exhibits available yet.'); ?></p>
    <?php endif; ?>
  </div>
</section>
<?php echo foot(); ?>
