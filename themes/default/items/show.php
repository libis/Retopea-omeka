<?php echo head(array('title' => metadata('item', array('Dublin Core', 'Title')),'bodyclass' => 'item show')); ?>
<?php $type = metadata('item','item_type_name');?>
<?php $lang = get_language();?>
<?php if (metadata('item', 'has files')): ?>
  <section class="item-section">
      <div class="container">
        <div class='row breadcrumbs'>
            <div class="col-12">
                <p id="simple-pages-breadcrumbs">
                   <span><a href="<?php echo url('/');?>"><?php echo __("Home");?></a></span>
                   <?php if (metadata('item', array('Item Type Metadata','Verhaal'))): ?>
                   > <span><a href="<?php echo url('items/browse?tags=erfgoed+in+de+kijker&sort_field=Item+Type+Metadata%2CVerhaal%20titel');?>"><?php echo __("Heritage in the spotlight");?></a></span>
                   <?php elseif(metadata('item', 'Collection Name')):?>
                   > <span><a href="<?php echo url('items/browse');?>"><?php echo link_to_collection_for_item(); ?></a></span>
                   <?php endif; ?>

                   <?php if($lang=="nl" && metadata('item', array('Item Type Metadata','Verhaal'))):?>
                   > <?php echo metadata('item', array('Item Type Metadata', 'Verhaal titel')); ?>
                 <?php elseif($lang=="en" && metadata('item', array('Item Type Metadata','Story title'))):?>
                   > <?php echo metadata('item', array('Item Type Metadata', 'Story title')); ?>
                 <?php elseif($lang=="en" && metadata('item', array('Item Type Metadata','Title'))):?>
                   > <?php echo metadata('item', array('Item Type Metadata', 'Title')); ?>
                   <?php else:?>
                   > <?php echo metadata('item', array('Dublin Core', 'Title')); ?>
                   <?php endif;?>
                 </p>
             </div>
        </div>
      </div>
  </section>
<?php endif; ?>
<section class="metadata-section">
    <div id="content" class='container' role="main" tabindex="-1">
        <div class="row content">
            <!-- The following returns all of the files associated with an item. -->
            <?php if(metadata($item,'has_files')):?>
              <div class="col-lg-6 col-md-12 col-12">
                <div class="item-files">
                  <div class="row file-row">
                    <?php
                      $files = $item->getFiles();
                      foreach($files as $file):
                        if($file->hasFullsize()):?>
                          <div class="col-12 file-col">
                            <div class="item-file">
                              <a data-lightbox="lightbox" href="<?php echo $file->getWebPath("fullsize");?>">
                                <img src="<?php echo $file->getWebPath("thumbnail");?>">
                              </a>
                            </div>
                          </div>
                        <?php else:?>
                          <div class="col-12 file-col">
                            <?php echo file_markup($file, array('imageSize' => 'thumbnail',"width" => "100%","height"=>"auto"));?>
                          </div>
                        <?php endif;?>
                      <?php endforeach;?>
                  </div>
                </div>
            <?php endif;?>
            <?php if(!metadata('item', array('Item Type Metadata','Verhaal'))):?>
                </div>
                <div class="col-md-6 col-12">
                <?php if($lang == 'nl'):?>
                  <h1 class="section-title projecten-title"><span><?php echo metadata($item, array('Dublin Core', 'Title')); ?></span></h1>
                <?php else:?>
                  <h1 class="section-title projecten-title"><span><?php echo metadata($item, array('Item Type Metadata', 'Title')); ?></span></h1>
                <?php endif;?>
            <?php endif; ?>
                <div class="element-set">
                  <!-- creators -->
                  <?php if($lang== "nl" && $text = metadata('item', array('Dublin Core','Creator'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3><?php echo __('Creator');?></h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <!-- creators english -->
                  <?php if($lang== "en" && $text = metadata('item', array('Item Type Metadata','Creator'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3><?php echo __('Creator');?></h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <!-- description -->
                  <?php if($lang== "nl" && $text = metadata('item', array('Dublin Core','Description'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3><?php echo __('Description');?></h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <!-- description english -->
                  <?php if($lang== "en" && $text = metadata('item', array('Item Type Metadata','Description'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3><?php echo __('Description');?></h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <?php if($lang== "en" && $text = metadata('item', array('Item Type Metadata','Origin'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3>Origin</h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <!-- herkomst -->
                  <?php if($lang== "nl" && $text = metadata('item', array('Item Type Metadata','Herkomst'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3>Herkomst</h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <!-- Copyright -->
                  <?php if($lang== "en" && $text = metadata('item', array('Item Type Metadata','Copyright'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3>Copyright</h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <!-- jaar -->
                  <?php if($text = metadata('item', array('Item Type Metadata','Jaar'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3><?php echo __('Date');?></h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <!-- signatuur -->
                  <?php if($text = metadata('item', array('Item Type Metadata','Signatuur'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3><?php echo __('Reference code');?></h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <!-- If the item belongs to a collection, the following creates a link to that collection. -->
                  <?php if (metadata('item', 'Collection Name')): ?>
                  <div id="collection" class="element">
                      <h3><?php echo __('Collection'); ?></h3>
                      <div class="element-text"><?php echo link_to_collection_for_item(); ?></div>
                  </div>
                  <?php endif; ?>

                  <!-- The following prints a list of all tags associated with the item -->
                  <?php if (metadata('item', 'has tags')): ?>
                  <div id="item-tags" class="element">
                      <h3><?php echo __('Tags'); ?></h3>
                      <div class="element-text"><?php echo tag_string('item'); ?></div>
                  </div>
                  <?php endif;?>

                  <?php echo libis_link_to_related_exhibits($item);?>

                  <ul>
                    <?php if ($text = metadata('item', array('Item Type Metadata','LIMO'))): ?>
                    <li>
                      <a target="_blank" href="<?php echo $text;?>"><?php echo __('Link naar LIMO');?></a>
                    </li>
                    <?php endif; ?>

                    <?php if ($text = metadata('item', array('Item Type Metadata','Teneo'))): ?>
                    <li>
                      <a target="_blank" href="<?php echo $text;?>"><?php echo __('Link naar Teneo');?></a>
                    </li>
                    <?php endif; ?>

                    <?php if ($text = metadata('item', array('Item Type Metadata','ScopeArchiv'))): ?>
                    <li>
                      <a target="_blank" href="<?php echo $text;?>"><?php echo __('Link naar ScopeArchiv');?></a>
                    </li>
                    <?php endif; ?>
                  </ul>
                </div>
              </div>
              <?php if($verhaal = metadata('item', array('Item Type Metadata','Verhaal'))):?>
                  <div class="col-md-6 col-12 verhaal">
                    <?php if($lang == "nl" && metadata('item', array('Item Type Metadata', 'Verhaal titel'))):?>
                      <h1><?php echo metadata('item', array('Item Type Metadata', 'Verhaal titel')); ?></h2>
                      <h2><?php echo metadata('item', array('Item Type Metadata', 'Verhaal ondertitel'));?></h3>
                    <?php elseif($lang == "en" && metadata('item', array('Item Type Metadata', 'Story title'))): ?>
                      <h1><?php echo metadata('item', array('Item Type Metadata', 'Story title')); ?></h2>
                      <h2><?php echo metadata('item', array('Item Type Metadata', 'Story subtitle'));?></h3>
                    <?php endif; ?>
                    <?php if($lang == "nl" && $text = metadata('item', array('Item Type Metadata', 'Verhaal'))):?>
                      <?php echo $text;?>
                    <?php endif;?>
                    <?php if($lang == "en" && $text = metadata('item', array('Item Type Metadata', 'Story'))):?>
                      <?php echo $text;?>
                    <?php endif;?>
                  </div>
              <?php endif; ?>
        </div>
        <div class="row content">
            <div class="col-12">
                <?php echo get_specific_plugin_hook_output('Geolocation', 'public_items_show', array('view' => $this, 'item' => $item)); ?>

              <ul class="item-pagination navigation">
                  <li id="previous-item" class="previous"><?php echo link_to_previous_item_show("&#8249; ".__("Previous")); ?></li>
                  <li id="next-item" class="next"><?php echo link_to_next_item_show(__("Next")." &#8250;"); ?></li>
              </ul>
            </div>
        </div>
        <div class="plugins">
          <?php echo get_specific_plugin_hook_output('SocialBookmarking', 'public_items_show', array('view' => $this, 'item' => $item)); ?>

          <?php echo get_specific_plugin_hook_output('Commenting', 'public_items_show', array('view' => $this, 'item' => $item)); ?>

        </div>
    </div>
</section>
<?php echo foot(); ?>
