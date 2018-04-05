<?php
echo head(array('bodyclass' => 'contact'));
?>

	<div class="content-wrapper simple-page-section ">
	  <div class="container simple-page-container">
	    <!-- Content -->
      <div class="row">
				<div class="col-sm-9 col-xs-12 page">
					<div class='row breadcrumbs'>
						<div class="col-sm-12 col-xs-12">
							<p id="simple-pages-breadcrumbs">
								<span>
									<a href="<?php echo url("/");?>"><?php echo __("Home");?></a>
									> Contact
								</span></p>
						</div>
					</div>
					<div class='row content'>
						<div class="col-sm-12 col-xs-12">
										<div id="form-instructions">
											<?php echo __("Do you wish to contact KADOC about the content of this website, you can use this contact form. We will contact you as soon as possible."); ?>
										</div>
										<?php echo flash(); ?>
										<form name="contact_form" id="contact-form"  method="post" enctype="multipart/form-data" accept-charset="utf-8">
												<fieldset>
									        <div class="field">
														<h3><label><?php echo __("Name");?></label></h3>
														<?php echo $this->formText('name', $name, array('class'=>'textinput')); ?>
													</div>

									        <div class="field">
									            <h3><label><?php echo __("Email");?></label></h3>
											    		<?php echo $this->formText('email', $email, array('class'=>'textinput'));  ?>
									        </div>

													<div class="field">
													  	<h3><label><?php echo __("Message");?></label></h3>
													    <?php echo $this->formTextarea('message', $message, array('class'=>'textinput')); ?>
													</div>
											</fieldset>

											<fieldset>
													<div class="field">
													  <?php echo $captcha; ?>
													</div>

													<div class="field">
													  <?php echo $this->formSubmit('send', __("Send")); ?>
													</div>
									    </fieldset>
										</form>
								</div>
							</div>
						</div>
					</div>
				</div>
		</div>
<?php echo foot(); ?>
