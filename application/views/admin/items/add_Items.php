<!--=== Container Part ===-->

<div class="container content">

	<div class="row">

		<div class="col-md-12">

			<!-- BEGIN VALIDATION STATES-->

			<div class="portlet light">

				<div class="portlet-title">

					<div class="caption">

						<i class="fa fa-music font-green-sharp"></i>

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

						$form_action = "admin/items/add";

						$form_id = "form_add_items";

						if(isset($items)){

							$form_action = "admin/items/update/".$this->uri->segment(4);

							$form_id = "form_update_items";

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

							<label class="control-label col-md-3">Category Name<span class="required">

							* </span>

							</label>

							<div class="col-md-6">

								<div class="input-icon right">

									<i class="fa"></i>

									<?php

									if(count($category) > 0){

										// Fetch product type IDS from DB..............................

										$can_perform_array = array();

										if(isset($items)){ 

											$can_perform =  $items['category_id'];

											if($can_perform!="")

											{

												$can_perform_array = explode(",",$can_perform);

											}

										}

										?>

										<select name="category_id" id="category_id" class="form-control">

										<?php

										foreach($category as $row){

											$type_id = $row['category_id'];

											$type_name = $row['category_name'];

		                                    $selected = '';

		                                    if(isset($can_perform_array) && count($can_perform_array) > 0){

		                                        if(in_array($type_id,$can_perform_array)){

	                                           		$selected = 'selected=selected';

		                                        }

			                                }

		                                    else{

		                                        $selected = '';

		                                    }

		                                    ?>

										<option <?php echo $selected; ?> value="<?php echo $type_id;?>"><?Php echo $type_name; ?></option>

										<?php } ?>

									</select>

									<?php } ?>

								</div>

							</div>

						</div>

					<div class="form-group">

						<label class="control-label col-md-3">Song Name <span class="required">

						* </span>

						</label>

						<div class="col-md-6">

							<div class="input-icon right">

								<i class="fa"></i>

								<input type="text" placeholder="Item Name" id="item_name" name="item_name" class="form-control" value="<?php if(set_value('item_name')){echo set_value('item_name');}elseif(isset($items)){ echo $items['item_name'];} ?>">

							</div>

						</div>

					</div>

					<div class="form-group">

						<label class="control-label col-md-3">Song Info <span class="required">

						* </span>

						</label>

						<div class="col-md-6">

							<div class="input-icon right">

								<i class="fa"></i>

								<textarea name="item_description" id="item_description" class="form-control" rows="5"><?php if(set_value('item_description')){echo set_value('item_description');}elseif(isset($items)){ echo $items['item_description'];} ?></textarea>

							</div>

						</div>

					</div>
					
					<!-- <div class="form-group">

						<label class="control-label col-md-3">Item URL 
						</label>

						<div class="col-md-6">

							<div class="input-icon right">

								<i class="fa"></i>

								<input type="text" placeholder="Item URL" id="item_url" name="item_url" class="form-control" value="<?php if(set_value('item_url')){echo set_value('item_url');}elseif(isset($items)){ echo $items['item_url'];} ?>">
<span>If You Add URL Then Below Audio File Is Not Consider At Application Side.</span>
							</div>

						</div>

					</div> -->

					<div class="form-group">

						<label class="control-label col-md-3">Audio File<span class="required">* </span></label>

						<input type="file" name="item_file" id="item_file" accept="audio/*" />

						<span>File must be MP3 format.</span>

					</div>

					<?php
						if(isset($items)){
							if($items['item_file']!="")
							{
								if($items['item_file']=="no_file.png")
								{
									$imageWithPath = base_url().ITEM_FILE_UPLOAD.$items['item_file'];
									$imageHTML = $this->general_function->showImage12($items['item_file'],$imageWithPath);
									echo $imageHTML;
								}							
								else
								{
									$imageWithPath1 = base_url().ITEM_FILE_UPLOAD.$items['item_file'];
									$imageHTML1 = $this->general_function->showImage1($items['item_file'],$imageWithPath1);
									echo $imageHTML1;
								}
							}
						}
					?>
					
				<!-- <div class="form-group">

						<label class="control-label col-md-3">Video File</label>

						<input type="file" name="item_video" id="item_video"  />

						<span>File must be MP4|MOV|FLV|MKV format.</span>

					</div> -->
					
                   <!--   <?php
						if(isset($items)){
							if($items['item_video']!="")
							{
								if($items['item_video']=="no_file.png")
								{
									$imageWithPath = base_url().ITEM_VIDEO_UPLOAD.$items['item_video'];
									$imageHTML = $this->general_function->showImage12($items['item_video'],$imageWithPath);
									echo $imageHTML;
								}							
								else
								{
									$imageWithPath1 = base_url().ITEM_VIDEO_UPLOAD.$items['item_video'];
									$imageHTML1 = $this->general_function->showImage1($items['item_video'],$imageWithPath1);
									echo $imageHTML1;
								}
							}
						}
					?> -->

					<div class="form-group">

						<label class="control-label col-md-3">Image<span class="required">* </span></label>

						<input type="file" name="image" id="image" accept="image/*"/>

						<span>Maximum upload file size 2MB.File must be gif|jpg|png format.</span>

					</div>

					</div>

					<?php

						if(isset($items)){

							if($items['item_image']!="")

							{

								$imageWithPath = base_url().ITEM_IMG_UPLOAD.$items['item_image'];

								$imageHTML = $this->general_function->showImage($items['item_image'],$imageWithPath);

								echo $imageHTML;

							}

						}

					?>

					<div class="form-group">

						<label class="control-label col-md-3">Status</label>

						<div class="col-md-3">

							<select name="item_status" class="form-control">

								<?php

									if(isset($items)){

										if ($items['item_status']==0) {

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

							<button type="submit" class="btn green">Save & Add New Song</button>

							<a href="<?php echo base_url();?>admin/items" class="btn red">Canel</a>

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

if (isset($items) && !empty($items)) {

	?>

<script type="text/javascript">

$(".remove_image").click(function(){

	if(confirm("Are you sure? You want to delete this image?"))

	{

		$('#AjaxLoaderDiv').fadeIn('slow');

		$.ajax({

		  type: 'post',

		  url : '<?php echo base_url(); ?>admin/items/removeItemImage',

		  data: {'imagePath' : '<?php echo "./".ITEM_IMG_UPLOAD.$items['item_image']; ?>','id' : '<?php echo $this->uri->segment(4); ?>'},

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

