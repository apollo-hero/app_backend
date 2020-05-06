<!--=== Container Part ===-->
<div class="container content">
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN VALIDATION STATES-->
			<div class="portlet light">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-user font-green-sharp"></i>
						<span class="caption-subject font-green-sharp bold uppercase"><?php echo ucfirst($this->uri->segment(3)." ".$this->uri->segment(2)); ?></span>
					</div>
				</div>

				<?php

				$this->load->view('includes/message_template');

				// $this->load->view('admin/includes/search_form');

				?>	

				<div class="portlet-body form skin skin-minimal">
					<!-- BEGIN FORM-->
					<?php 
						$form_action = "admin/category/add";
						$form_id = "form_add_category";
						if(isset($category)){
							$form_action = "admin/category/update/".$this->uri->segment(4);
							$form_id = "form_update_category";
						}
						$attributes = array('class' => 'form-horizontal', 'id' => $form_id);
						echo form_open_multipart($form_action, $attributes);
					?>
					<div class="form-body">
					<div class="alert alert-danger display-hide">
					<?php echo validation_errors('<div>', '</div>'); ?>

						<button class="close" data-close="alert"></button>
						You have some form errors. Please check below.
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">category Name <span class="required">
						* </span>
						</label>
						<div class="col-md-6">
							<div class="input-icon right">
								<i class="fa"></i>
								<input type="text" placeholder="category Name" id="category_name" name="category_name" class="form-control" value="<?php if(set_value('category_name')){echo set_value('category_name');}elseif(isset($category)){ echo $category['category_name'];} ?>" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">category Info <span class="required">
						* </span>
						</label>
						<div class="col-md-6">
							<div class="input-icon right">
								<i class="fa"></i>
								<textarea name="category_description" id="category_description" class="form-control" rows="5"><?php if(set_value('category_description')){echo set_value('category_description');}elseif(isset($category)){ echo $category['category_description'];} ?></textarea>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Image</label>
						<div class="col-md-9">                                                                                    
							<input type="file" name="image" id="image" />
							<span>Maximum upload file size 2MB.File must be gif|jpg|png format.</span>
						</div>
					</div>
					</div>
					<?php
						if(isset($category)){
							if($category['category_image']!="")
							{
								$imageWithPath = base_url().CATEGORY_IMG_UPLOAD.$category['category_image'];
								$imageHTML = $this->general_function->showImage($category['category_image'],$imageWithPath);
								echo $imageHTML;
							}
						}
					?>
					<div class="form-group">
						<label class="control-label col-md-3">Status</label>
						<div class="col-md-3">
							<select name="category_status" class="form-control" required/>
								<?php
									if(isset($category)){
										if ($category['category_status']==0) {
											?>
											<option value="0"> InActive </option>
											<option value="1"> Active </option>
											<?php
										}
										else{
											?>
											<option value="1"> Active </option>
											<option value="0"> InActive </option>
											<?php
										}
									}
									else{
										?>
										<option value="1"> Active </option>
										<option value="0"> InActive </option>
										<?php
									}
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="form-actions">
					<div class="row">
						<div class="col-md-offset-3 col-md-9">
							<button type="submit" class="btn green">Submit</button>
							<a href="<?php echo base_url();?>admin/category" class="btn red">Canel</a>
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
<?php
if (isset($category) && !empty($category)) {
	?>
	<script type="text/javascript">
	$(".remove_image").click(function(){
		if(confirm("Are you sure? You want to delete this image?"))
		{
			$('#AjaxLoaderDiv').fadeIn('slow');
			$.ajax({
			  type: 'post',
			  url : '<?php echo base_url(); ?>admin/category/removeCategoryImage',
			  data: {'imagePath' : '<?php echo "./".CATEGORY_IMG_UPLOAD.$category['category_image']; ?>','id' : '<?php echo $this->uri->segment(4); ?>'},
			  success: function(data){
			  	console.log(data);
			  	$('#AjaxLoaderDiv').fadeOut('fast');
				location.reload();
			  },
			  error: function (e){
				console.log(e.responseText)
			  }
			})
		}
	})
	</script>
	<?php
}
?>
