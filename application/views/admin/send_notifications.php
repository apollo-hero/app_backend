<!--=== Container Part ===-->
    <div class="container content">
		<div class="row">
				<div class="col-md-12">
					<!-- BEGIN VALIDATION STATES-->
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-user font-green-sharp"></i>
								<span class="caption-subject font-green-sharp bold uppercase">Notification</span>
							</div>
							
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<?php
								$attributes = array('class' => 'form-horizontal', 'id' => 'from_notification');
								$form_action = "admin/send_notifications";
								echo form_open_multipart($form_action, $attributes);
							?>
								<div class="form-body">
									<?php									 
									  $this->load->view('includes/message_template');
									?>	
									<div class="alert alert-danger display-hide">
										<button class="close" data-close="alert"></button>
										You have some form errors. Please check below.
									</div>
								<div class="form-group">
									<label class="control-label col-md-2">Message<span class="required">
									* </span>
									</label>
									<div class="col-md-10">   
										<textarea class="form-control" rows="6" name="send_notifications" id="send_notifications" ></textarea>
									</div>
								</div>
								</div>	
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-2 col-md-15">
											<button type="submit" class="btn green">Send</button>
											<button type="button" class="btn default">Cancel</button>
										</div>
									</div>
								</div>
								<?php echo form_close(); ?>	
							<!-- END FORM-->
						</div>
						<!-- END VALIDATION STATES-->
					</div>
			</div>
	</div>
</div>
