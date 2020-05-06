<!--=== Container Part ===-->
    <div class="container content">
		<div class="row">
				<div class="col-md-12">
				
					<!-- BEGIN VALIDATION STATES-->
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-user font-green-sharp"></i>
								<span class="caption-subject font-green-sharp bold uppercase">ABOUT US</span>
							</div>
							
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<?php
							
								 $attributes = array('class' => 'form-horizontal', 'id' => 'form_about_us');
								 $form_action = "admin/about_us";
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
									<label class="control-label col-md-2">About Us <span class="required">
									* </span>
									</label>
									<div class="col-md-10">        
										<input type="hidden" name="content_management_id" value="<?php if(set_value('content_management_id')){echo set_value('content_management_id');}elseif(isset($content_management)){echo $content_management[0]['content_management_id'];}?>">                                                                            
										<textarea class="ckeditor form-control" rows="6" name="about_us" id="about_us" data-error-container="#editor1_error"><?php if(set_value('about_us')){echo set_value('about_us');}elseif(isset($content_management)){echo $content_management[0]['about_us'];}?></textarea>
										<div id="editor2_error">
										</div>
									</div>
								</div>									
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-2 col-md-10">
											<button type="submit" class="btn green">Submit</button>
											<a href="<?php echo base_url(); ?>admin/index"><button type="button" class="btn default">Cancel</button></a>
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

<script type="text/javascript">
$(".remove_image").click(function(){

	if(confirm("Are you sure? You want to delete this image?"))
	{
		$('#AjaxLoaderDiv').fadeIn('slow');
		$.ajax({
		  type: 'post',
		  url : '<?php echo base_url(); ?>massage/removeImage',
		  data: {'imagePath' : '<?php echo "./".MASSAGE_TYPE_FILE_UPLOAD.$content_management[0]['massage_image']; ?>','id' : '<?php echo $this->uri->segment(5); ?>'},
		  success: function(data){
		  	$('#AjaxLoaderDiv').fadeOut('fast');
			location.reload();
		  },
		  error: function (e){
			alert (e)
		  }
		})
	}
})
</script>