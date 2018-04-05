<?php
$position = isset($options['file-position'])
    ? html_escape($options['file-position'])
    : 'left';
$size = isset($options['file-size'])
    ? html_escape($options['file-size'])
    : 'fullsize';
$captionPosition = isset($options['captions-position'])
    ? html_escape($options['captions-position'])
    : 'center';
?>
<div class='row content'>
  <?php if($position == "right"):?>
    <div class="col-12 col-md-6">
      <hr align="left">
      <h1><span class="exhibit-page"><?php echo metadata('exhibit_page', 'title'); ?></h1>
      <?php echo $text; ?>
    </div>
    <div class="col-12 col-md-6">
      <div class="exhibit-items <?php echo $position; ?> <?php echo $size; ?> captions-<?php echo $captionPosition; ?>">
        <?php foreach ($attachments as $attachment):?>
            <?php echo $this->exhibitAttachment($attachment, array('imageSize' => $size),array("target" => "_blank")); ?>
        <?php endforeach; ?>
      </div>
    </div>
  <?php else: ?>
    <div class="col-12 col-md-6">
      <div class="exhibit-items <?php echo $position; ?> <?php echo $size; ?> captions-<?php echo $captionPosition; ?>">
          <?php foreach ($attachments as $attachment):?>
              <?php echo $this->exhibitAttachment($attachment, array('imageSize' => $size),array("target" => "_blank")); ?>
          <?php endforeach; ?>
      </div>
    </div>
    <div class="col-12 col-md-6">
      <hr align="left">
      <h1><span class="exhibit-page"><?php echo metadata('exhibit_page', 'title'); ?></h1>
      <?php echo $text; ?>
    </div>
  <?php endif;?>
</div>
