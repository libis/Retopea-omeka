<?php
  $pageTitle = __('Browse Items');
  echo head(array('title'=>$pageTitle,'bodyclass' => 'items browse'));
  $lang = get_language();

  //only show featured records on featured page and with filter on
  $params = $_GET;
  $show_featured = false;$erfgoed = false;

  if(!isset($params['page'])):
    $params['page'] = "0";
  endif;

  if(isset($params['tags'])):
    if($params['tags']=="erfgoed in de kijker"):
        $erfgoed = true;
    endif;
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
          <?php if($erfgoed):?>
           > <span><?php echo __("Heritage in the spotlight");?></span>
          <?php else:?>
           > <span><?php echo __("Objects");?></span>
          <?php endif;?>
         </p>
     </div>
   </div>

   <?php if($erfgoed):?>
     <h1><?php echo __("Heritage in the spotlight");?></h1>
   <?php else:?>
     <h1><?php echo __("Browse objects");?></h1>
   <?php endif;?>

   <?php if ($total_results > 0): ?>

       <div id="sort-links">
         <span class="sort-label"><i class="material-icons">&#xE152;</i>
           <?php echo __('Filter:');?></span>
           <ul id="sort-links-list">
             <li><a href="<?php echo url('items/browse?tags=erfgoed+in+de+kijker');?>"><?php echo __("Show all");?></a></li>
              <?php if(!$show_featured):?>
                <li>
                  <a href="<?php echo url('items/browse?tags=erfgoed+in+de+kijker&featured=1');?>">
                    <?php echo __("Featured"); ?>
                  </a>
                </li>
              <?php endif;?>
            </ul>
       </div>
    <?php endif; ?>

    <?php if(!$erfgoed):?>
      <?php echo item_search_filters(); ?>
    <?php endif; ?>

    <?php
      $featured_items = array(); $normal_items = array();
      foreach($items as $item):
        if($item->featured):
          $featured_items[] = $item;
        else:
          $normal_items[] = $item;
        endif;
      endforeach;
      //stick to back
      foreach($normal_items as $item):
        $featured_items[] = $item;
      endforeach;
      $items = $featured_items;
    ?>

    <?php echo pagination_links(); ?>

      <div class="card-columns">

        <?php foreach (loop('items',$items) as $item): ?>
            <?php
              $class = "";
              if($item->featured):
                $class = 'featured';
              endif;
            ?>
            <div class="card <?php echo $class;?>">
              <?php if (metadata('item', 'has files')): ?>
                <div class="item-img">
                    <?php echo link_to_item(item_image('thumbnail')); ?>
                </div>
              <?php endif; ?>
              <hr>
              <div class="card-block">
                <div class="list-item">
                  <h3 class="star"><span><?php echo __('Featured');?></span></h3>
                  <!--<h3 class="star"><i class="material-icons">&#xE83A;</i><span><?php echo __('Featured');?></span></h3>-->
                  <?php if($erfgoed && $lang == "nl" && metadata('item', array('Item Type Metadata', 'Verhaal titel'))):?>
                    <h2><?php echo link_to_item(metadata('item', array('Item Type Metadata', 'Verhaal titel')), array('class'=>'permalink')); ?></h2>
                    <h3><?php echo metadata('item', array('Item Type Metadata', 'Verhaal ondertitel'));?></h3>
                  <?php elseif($erfgoed && $lang == "en" && metadata('item', array('Item Type Metadata', 'Story title'))): ?>
                    <h2><?php echo link_to_item(metadata('item', array('Item Type Metadata', 'Story title')), array('class'=>'permalink')); ?></h2>
                    <h3><?php echo metadata('item', array('Item Type Metadata', 'Story subtitle'));?></h3>
                  <?php elseif(metadata('item', array('Item Type Metadata', 'Title')) && $lang == "en"): ?>
                    <h3><?php echo link_to_item(metadata('item', array('Item Type Metadata', 'Title')), array('class'=>'permalink')); ?></h3>
                  <?php else:?>
                    <h3><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class'=>'permalink')); ?></h3>
                  <?php endif; ?>

                  <!--<?php if (metadata('item', 'has tags')): ?>
                    <div class="tags"></strong>
                        <?php echo tag_string('items'); ?>
                    </div>
                  <?php endif; ?>-->

                  <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' =>$item)); ?>
                </div>
              </div>
            </div>
        <?php endforeach; ?>
      </div>
  </div>
</div>

<?php fire_plugin_hook('public_items_browse', array('items'=>$items, 'view' => $this)); ?>

<?php echo foot(); ?>
