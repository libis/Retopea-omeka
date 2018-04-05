<?php
if(metadata('exhibit', 'subtitle')):
  $title = "<span>".metadata('exhibit', 'title')."</span><br>".metadata('exhibit', 'subtitle');
else:
  $title = metadata('exhibit', 'title');
endif;
echo head(array('title' => $title, 'bodyclass'=>'exhibits summary')); ?>
<style>
header {
    background: #F4F5F8 url("<?php echo WEB_PUBLIC_THEME.'/default/images/exhibits/banner_'.metadata('exhibit', 'slug').'.jpg';?>") no-repeat center center/cover;
}
</style>
<section class="exhibit-show-section">
  <div id="content" class='container' role="main" tabindex="-1">
      <div class='row'>
        <div class='col-md-7 col-lg-7 col-12'>
          <div class="summary-text">
            <h1><?php echo __("Introduction");?></h1>
            <?php if (($exhibitCredits = metadata('exhibit', 'credits'))): ?>
                <div class="exhibit-credits">
                      <h3><?php echo $exhibitCredits; ?></h3>
                </div>
            <?php endif; ?>

            <?php if ($exhibitDescription = metadata('exhibit', 'description', array('no_escape' => true))): ?>
                <div class="exhibit-description">
                    <?php echo $exhibitDescription; ?>
                </div>
            <?php endif; ?>
            <div class="start">
              <a href="<?php echo $exhibit->getFirstTopPage()->getRecordUrl();?>"><?php echo __("Start exhibit");?></a>
            </div>
          </div>
        </div>
        <div class='col-md-5 col-12'>
          <div class="side">
            <div class="side-nav">
              <h4><?php echo __("Table of contents");?></h4>
              <?php echo exhibit_builder_page_nav(); ?>
              <?php
              $pageTree = exhibit_builder_page_tree();
              if ($pageTree):
              ?>
              <nav id="exhibit-pages">
                  <?php echo $pageTree; ?>
              </nav>
            <?php endif; ?>
            </div>

          </div>
          <div class="plugins">
            <?php
              $url = absolute_url();
              $title = strip_formatting(metadata($exhibit, 'title'));
              $description = strip_formatting(metadata($exhibit, 'description', array('no_escape' => true)));
              echo social_bookmarking_toolbar($url, $title, $description);
            ?>
          </div>
        </div>
      </div>
  </div>
</section>
<?php echo foot(); ?>
