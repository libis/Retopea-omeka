<?php
$pageTitle = __('Search') . ' ' . __('(%s)', $total_results);
echo head(array('title' => $pageTitle, 'bodyclass' => 'search'));
$searchRecordTypes = get_search_record_types();
$lang = get_language();
?>
<section class="browse-section">
  <div class="container">
    <!-- Content -->
    <div class='top'>
        <h1><?php echo $pageTitle; ?></h1>
    </div>
    <div class='content search-results'>
        <?php if ($total_results): ?>
            <?php echo pagination_links(); ?>
            <?php $filter = new Zend_Filter_Word_CamelCaseToDash; ?>
            <?php $i = 0; ?>
            <?php foreach (loop('search_texts') as $searchText): ?>
              <?php $i++; ?>
              <div class="search-row <?php if ($i%2==1) echo ' even'; else echo ' odd'; ?>">
                <div class="row align-items-center">
                  <?php $record = get_record_by_id($searchText['record_type'], $searchText['record_id']); ?>
                  <?php $recordType = $searchText['record_type']; ?>
                  <?php set_current_record($recordType, $record); ?>

                  <div class="col-12 col-md-2 col-lg-1 col-xl-1 d-none d-sm-none d-md-block">
                    <div class="img-place">
                      <?php if ($recordImage = record_image($recordType)): ?>
                          <?php echo link_to($record, 'show', $recordImage, array('class' => 'image')); ?>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <h3><a href="<?php echo record_url($record, 'show'); ?>">
                      <?php
                        if($searchRecordTypes[$recordType] == "Item" && $lang == "nl"):
                          $searchText['title'] = metadata($record, array('Dublin Core', 'Title'));
                        elseif($searchRecordTypes[$recordType] == "Item" && $lang == "en"):
                          $searchText['title'] = metadata($record, array('Item Type Metadata', 'Title'));
                        endif;
                        echo $searchText['title'] ? $searchText['title'] : '[Unknown]'; ?>
                    </a></h3>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="type">
                    <?php
                      if($searchRecordTypes[$recordType] == "Item"):
                        echo "Object";
                      elseif($searchRecordTypes[$recordType] == "Simple Page"):
                        echo "";
                      else:
                        echo $searchRecordTypes[$recordType];
                      endif;
                    ?>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
        </div>
        <?php echo pagination_links(); ?>
        <?php else: ?>
        <div id="no-results">
            <p><?php echo __('Your query returned no results.');?></p>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<?php echo foot(); ?>
