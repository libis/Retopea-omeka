<?php echo head(array('bodyid'=>'home', 'bodyclass' =>'two-col')); ?>

<section class="home">
    <div id="content" class='container' role="main" tabindex="-1">
      <div class="row">
        <div class="co col-md-6 col-sm-6 col-lg-4">
            <div class="col-content">
              <a class="block-link" href="<?php echo url("exhibits");?>"><img src="<?php echo img('placeholder1.jpg');?>"></a>
            </div>
            <h2><a class="block-link" href="<?php echo url("exhibits");?>"><?php echo __('Stories');?></a></h2>
        </div>
        <div class="co col-sm-6 col-md-6 col-lg-4">
          <div class="col-content">
              <a class="block-link" href="<?php echo url("collections");?>"><img src="<?php echo img('placeholder2.jpg');?>"></a>
            </div>
            <h2><a class="block-link" href="<?php echo url("collections");?>"><?php echo __('Collections');?></a></h2>

        </div>
        <div class="co col-md-6 col-sm-6 col-lg-4">
          <div class="col-content">
            <a class="block-link" href="<?php echo url("items/browse?sort_field=Dublin+Core%2CTitle");?>"><img src="<?php echo img('placeholder3.jpg');?>"></a>
          </div>
          <h2><a class="block-link" href="<?php echo url("items/browse?sort_field=Dublin+Core%2CTitle");?>"><?php echo __('Items');?></a></h2>
        </div>
      </div>
      <div class="row">
        <div class="co col-md-6 col-sm-6 col-lg-4">
          <div class="col-content">
              <a class="block-link" href="<?php echo url("items/browse?tags=maps&sort_field=Dublin+Core%2CTitle");?>"><img src="<?php echo img('placeholder4.jpg');?>"></a>
            </div>
            <h2><a class="block-link" href="<?php echo url("items/browse?tags=maps&sort_field=Dublin+Core%2CTitle");?>"><?php echo __('Maps');?></a></h2>
        </div>
        <div class="co col-sm-6 col-md-6 col-lg-4">
          <div class="col-content">
              <a class="block-link" href="<?php echo url("items/browse?tags=peace+treaties&sort_field=Dublin+Core%2CTitle");?>"><img src="<?php echo img('placeholder5.jpg');?>"></a>
            </div>
            <h2><a class="block-link" href="<?php echo url("items/browse?tags=peace+treaties&sort_field=Dublin+Core%2CTitle");?>"><?php echo __('Peace treaties');?></a></h2>
        </div>
        <div class="co col-md-6 col-sm-6 col-lg-4">
            <!--<div class="col-content">
              <a class="block-link" href=""><img src="<?php echo img('placeholder6.jpg');?>"></a>
            </div>-->
          </div>
      </div>
    </div>
</section>

<?php echo foot(); ?>
