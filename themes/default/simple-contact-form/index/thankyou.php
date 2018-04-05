<?php echo head(); ?>
	<div class="content-wrapper simple-page-section ">
	  <div class="container simple-page-container">
	    <!-- Content -->
      <div class="row">
				<div class="col-sm-9 col-xs-12 page">
					<div class='row breadcrumbs'>
						<div class="col-sm-12 col-xs-12">
							<p id="simple-pages-breadcrumbs">
								<span>
									<a href="http://libis.be/">Startpagina</a>
									> Contact
									</p>
								</span></p>
						</div>
					</div>
					<div class='row content'>
						<div class="col-sm-12 col-xs-12">
<h1><?php echo htmlspecialchars(get_option('simple_contact_form_thankyou_page_title')); // Not HTML ?></h1>

<?php echo get_option('simple_contact_form_thankyou_page_message'); // HTML ?>
</div>
</div>
</div>
</div>
</div>
</div>

<?php echo foot(); ?>
