<?php
if(metadata('exhibit', 'subtitle')):
  $title = "<span>".metadata('exhibit', 'title')."</span><br>".metadata('exhibit', 'subtitle');
else:
  $title = metadata('exhibit', 'title');
endif;
echo head(array(
    'title' => metadata('exhibit_page', 'title').' &middot; '.$title,
    'bodyclass' => 'exhibits', ));
$last_page = false;
?>
<style>
header {
    background: #F4F5F8 url("<?php echo WEB_PUBLIC_THEME.'/default/images/exhibits/banner_'.metadata('exhibit', 'slug').'.jpg';?>") no-repeat center center/cover;
}
</style>
<section class="exhibit-show-section">
  <div id="content" class='container' role="main" tabindex="-1">
    <div class='breadcrumbs'>
        <strong><?php echo exhibit_builder_link_to_exhibit($exhibit); ?></strong> &#8250; <?php echo exhibit_builder_page_trail();?>
    </div>

    <div id="exhibit-blocks">
      <?php exhibit_builder_render_exhibit_page(); ?>
    </div>

    <?php if ($prevLink = exhibit_builder_link_to_previous_page('<i class="material-icons">&#xE314;</i>')): ?>
    <div id="abs-exhibit-nav-prev">
    <?php echo $prevLink; ?>
    </div>
    <?php endif; ?>
    <?php if ($nextLink = exhibit_builder_link_to_next_page('<i class="material-icons">&#xE315;</i>')): ?>
    <div id="abs-exhibit-nav-next">
    <?php echo $nextLink; ?>
    </div>
    <?php else:
      $last_page = true;
    endif; ?>

    <div id="exhibit-page-navigation">
        <?php if ($prevLink = exhibit_builder_link_to_previous_page()): ?>
        <div id="exhibit-nav-prev">
        <?php echo $prevLink; ?>
        </div>
        <?php endif; ?>
        <?php if ($nextLink = exhibit_builder_link_to_next_page()): ?>
        <div id="exhibit-nav-next">
        <?php echo $nextLink; ?>
        </div>
        <?php else:
          $last_page = true;
        endif; ?>
        <div id="exhibit-nav-up">
        <?php echo exhibit_builder_page_trail(); ?>
        </div>
    </div>
    <div class="plugins">
      <?php
        $url = absolute_url();
        $title = strip_formatting(metadata('exhibit_page', 'title'));
        $description = strip_formatting(metadata($exhibit, 'description', array('no_escape' => true)));
        echo social_bookmarking_toolbar($url, $title, $description);
      ?>
      <?php
        if($last_page):
          CommentingPlugin::showComments();
        endif;
      ?>
    </div>
  </div>
</section>
<?php echo foot(); ?>
