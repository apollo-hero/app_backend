<!--=== Container Part ===-->

<div class="container content">

  <div class="col-md-12 col-sm-12">

    <!-- BEGIN EXAMPLE TABLE PORTLET-->

    <div class="portlet light">

      <div class="portlet-title">

          <div class="caption">

              <i class="fa fa-music font-green-sharp"></i>

              <span class="caption-subject font-green-sharp bold uppercase"><?php echo ucfirst($this->uri->segment(2)); ?></span>

          </div>

          <div class="actions btn-set">

            <a href="<?php echo base_url(); ?>admin/items/add" class="btn green">

              Add New Song <i class="fa fa-plus"></i>

            </a>

          </div>

      </div>

      <?php

      $this->load->view('includes/message_template');

      // $this->load->view('admin/includes/search_form');

      ?>	

      <div class="portlet-body">

        <?php

          $attributes = array('class' => 'form-horizontal', 'items_id' => 'form_delete_items');

          echo form_open('items/manage_item', $attributes);

          ?>

          <!-- <?php $this->load->view('admin/includes/pagination'); ?>	     -->

          <table class="dataTable table table-striped table-bordered table-hover"  id="list">

            <thead>

              <tr>

                <?php if($this->input->get_post('sort_by') == "u.item_id" && $this->input->get_post('sort_order') == "asc"):?>

                  <th class="sorting_desc" data-column="u.item_id" data-order="DESC">ID</th>

                <?php else:?>

                  <th class="sorting_asc" data-column="u.item_id" data-order="asc">ID</th>

                <?php endif;?>

                <th>Category Name</th>                  

                <?php if($this->input->get_post('sort_by') == "u.item_name" && $this->input->get_post('sort_order') == "asc"):?>

                    <th class="sorting_desc" data-column="u.item_name" data-order="DESC">Song Name</th>

                <?php else:?>

                    <th class="sorting_asc" data-column="u.item_name" data-order="asc">Song Name</th>

                 <?php endif;?>
                 
                 <!-- <?php ##if($this->input->get_post('sort_by') == "u.item_sort_order" && $this->input->get_post('sort_order') == "asc"):?>

                    <th class="sorting_desc" data-column="u.item_sort_order" data-order="DESC">Order</th>

                <?php ##else:?>

                    <th class="sorting_asc" data-column="u.item_sort_order" data-order="asc">Order</th>

                 <?php ##endif;?> -->
                 
                 <?php if($this->input->get_post('sort_by') == "u.number_of_play" && $this->input->get_post('sort_order') == "asc"):?>

                    <th class="sorting_desc" data-column="u.number_of_play" data-order="DESC">Number Of Play</th>

                <?php else:?>

                    <th class="sorting_asc" data-column="u.number_of_play" data-order="asc">Number Of Play</th>

                 <?php endif;?>
                 
                 <?php if($this->input->get_post('sort_by') == "u.number_of_download" && $this->input->get_post('sort_order') == "asc"):?>

                    <th class="sorting_desc" data-column="u.number_of_download" data-order="DESC">Number Of Download</th>

                <?php else:?>

                    <th class="sorting_asc" data-column="u.number_of_download" data-order="asc">Number Of Download</th>

                 <?php endif;?>

                <?php if($this->input->get_post('sort_by') == "u.item_status" && $this->input->get_post('sort_order') == "asc"):?>

                    <th class="sorting_desc" data-column="u.item_status" data-order="DESC">Status</th>

                <?php else:?>

                    <th class="sorting_asc" data-column="u.item_status" data-order="asc">Status</th>

                <?php endif;?>

                <?php if($this->input->get_post('sort_by') == "u.item_created_date" && $this->input->get_post('sort_order') == "asc"):?>

                    <th class="sorting_desc" data-column="u.item_created_date" data-order="DESC">Added Date</th>

                <?php else:?>

                  <th class="sorting_asc" data-column="u.item_created_date" data-order="asc">Added Date</th>

                <?php endif;?>

                  <th>Action</th>

              </tr>

            </thead>

            <tbody>

              <?php if(count($items) > 0):?>    

                <?php

                  foreach ($items as $row) {

                    $item_id = $row['item_id'];

                    $item_name = $row['item_name'];
                    
                   /* $video_name = $row['item_video']; */
                                        
                    $no_of_play = $row['number_of_play'];
                    
                    $no_of_download = $row['number_of_download'];

                    $category_id = $row['category_id'];

                    $category_name=$this->Mobile_api_model->getsinglecolumevalue_array(TABLE_CATEGORY,array('category_id'=>$category_id),'category_name');

                    $item_status = $row['item_status'];
                    
                    

                    if ($item_status==1) {

                      $item_status="Active";

                    }

                    else{

                      $item_status="InActive";

                    }

                    ?>

                    <tr class="odd gradeX">

                      <td><?php echo $item_id; ?></td>

                      <td><?php echo $category_name; ?></td>

                      
                      <?php if($row['item_file'] != ""):?> 
                      <td><?php echo '<a href="'.base_url().ITEM_FILE_UPLOAD.$row['item_file'].'"> '.$item_name.' </a>' ?></td>
                      </td>
                      <?php else:?>

                        <td><?php echo '<a href="'.$row['item_url'].'" > '.$item_name.' </a>' ?>
                      </td>

                     <?php endif;?>
                     	<!-- <td> -->
			                						
			<!-- <input type="text" id="pw"  name="txtvorderedit" class="txtvorderedit"  value="<?##=$row['sort_order'] != '100000' ? $row['sort_order'] : '' ;?>" style="background: transparent;" title="Click me to edit" data-old="<?##=$row['sort_order'];?>"  data-id="<?##=$row['item_id'];?>"> -->
				                				<!-- </td> -->
                                            
                      <td><?php echo $no_of_play; ?></td>
                      
                      <td><?php echo $no_of_download; ?></td>

                      <td class="hidden-sm"><?php echo $item_status; ?></td>

                      <td><?php echo date('d-m-Y', strtotime($row['item_created_date'])); ?></td>

                      <?php

                        echo '<td class="crud-actions">

                              <a href="' . site_url("admin") . '/items/update/' . $row['item_id'] . '" class="btn blue">view & edit <i class="fa fa-edit"></i></a>  

					                    <a href="' . site_url("admin") . '/items/delete/' . $row['item_id'] . '" class="btn red delete_item">delete <i class="fa fa-remove"></i></a>

					                  </td>';

                                ?>

                    </tr>

                    <?php } ?>  							

                    <?php else:?>    

                    <tr>

                        <td valign="top" colspan="15" class="dataTables_empty">

                            <h4>No Records Found.</h4>

                        </td>

                    </tr>

                  <?php endif;?>    

            </tbody>

          </table>

          <!-- <?php $this->load->view('admin/includes/pagination'); ?>	     -->

          <?php echo form_close(); ?>	

      </div>

    </div>

    <!-- END EXAMPLE TABLE PORTLET-->

  </div>		

</div><!--/container-->     

<!--=== End Container Part ===-->

<?php $this->load->view('admin/includes/pagination_js_script'); ?>

<script type="text/javascript">



    jQuery(".delete_item").click(function () {

        if (confirm("Are you sure you want to delete this item?"))

        {

          return true;

        }

        else

        {

          return false;

        }

    })
    
   

    
});

</script>

<script>
    $(document).ready(function() {
        $("#list").DataTable({
            "order": [[ 0, "desc" ]]
        }
        );
       
       $( "body" ).delegate( "#pw", "keyup", function(e) {  
    if (e.keyCode === 13) {    

   $.ajax({

		  type: 'post',

		  url : '<?php echo base_url(); ?>admin/items/updatevideoorder',

		  data: {'data-id' : $(this).attr('data-id') ,'value' : $(this).val()},

		  success: function(data){

		  	console.log(data);
		  	//alert(data);

		  	$('#AjaxLoaderDiv').fadeOut('fast');

			location.reload();

		  },

		  error: function (e){

			console.log(e.responseText)

		  }

		})
		}

});  
              
    });
</script>
