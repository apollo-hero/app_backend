<!--=== Container Part ===-->

<div class="container content">

  <div class="col-md-12 col-sm-12">

    <!-- BEGIN EXAMPLE TABLE PORTLET-->

    <div class="portlet light">

      <div class="portlet-title">

          <div class="caption">

              <i class="fa fa-user font-green-sharp"></i>

              <span class="caption-subject font-green-sharp bold uppercase"><?php echo ucfirst($this->uri->segment(2)); ?></span>

          </div>

          <div class="actions btn-set">

            <a href="<?php echo base_url(); ?>admin/category/add" class="btn green">

              Add New Category <i class="fa fa-plus"></i>

            </a>

          </div>

      </div>

      <?php

      $this->load->view('includes/message_template');

      // $this->load->view('admin/includes/search_form');

      ?>	

      <div class="portlet-body">

        <?php

          $attributes = array('class' => 'form-horizontal', 'category_id' => 'form_delete_category');

          echo form_open('category/manage_category', $attributes);

          ?>

          <!-- <?php $this->load->view('admin/includes/pagination'); ?>	     -->

          <table class="dataTable table table-striped table-bordered table-hover"  id="list">

            <thead>

              <tr>

                <?php if($this->input->get_post('sort_by') == "u.category_id" && $this->input->get_post('sort_order') == "asc"):?>

                  <th class="sorting_desc" data-column="u.category_id" data-order="DESC">ID</th>

                <?php else:?>

                  <th class="sorting_asc" data-column="u.category_id" data-order="asc">ID</th>

                <?php endif;?>                      

                <?php if($this->input->get_post('sort_by') == "u.category_name" && $this->input->get_post('sort_order') == "asc"):?>

                    <th class="sorting_desc" data-column="u.category_name" data-order="DESC">Name</th>

                <?php else:?>

                    <th class="sorting_asc" data-column="u.category_name" data-order="asc">Name</th>

                <?php endif;?>

                <?php if($this->input->get_post('sort_by') == "u.category_status" && $this->input->get_post('sort_order') == "asc"):?>

                    <th class="sorting_desc" data-column="u.category_status" data-order="DESC">Status</th>

                <?php else:?>

                    <th class="sorting_asc" data-column="u.category_status" data-order="asc">Status</th>

                <?php endif;?>

                <?php if($this->input->get_post('sort_by') == "u.category_created_date" && $this->input->get_post('sort_order') == "asc"):?>

                    <th class="sorting_desc" data-column="u.category_created_date" data-order="DESC">Added Date</th>

                <?php else:?>

                  <th class="sorting_asc" data-column="u.category_created_date" data-order="asc">Added Date</th>

                <?php endif;?>

                  <th>Action</th>

              </tr>

            </thead>

            <tbody>

              <?php if(count($category) > 0):?>    

                <?php

                  foreach ($category as $row) {

                    $category_id = $row['category_id'];

                    $category_name = $row['category_name'];

                    $category_status = $row['category_status'];

                    if ($category_status==1) {

                      $category_status="Active";

                    }

                    else{

                      $category_status="InActive";

                    }

                    ?>

                    <tr class="odd gradeX">

                      <td><?php echo $category_id; ?></td>

                      <td><?php echo $category_name; ?></td>

                      <td class="hidden-sm"><?php echo $category_status; ?></td>

                      <td><?php echo date('d-m-Y', strtotime($row['category_created_date'])); ?></td>

                      <?php

                        echo '<td class="crud-actions">

                              <a href="' . site_url("admin") . '/category/update/' . $row['category_id'] . '" class="btn blue">view & edit <i class="fa fa-edit"></i></a>  

					                    <a href="' . site_url("admin") . '/category/delete/' . $row['category_id'] . '" class="btn red delete_category">delete <i class="fa fa-remove"></i></a>

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



    jQuery(".delete_category").click(function () {

        if (confirm("Are you sure you want to delete this Category?"))

        {

          return true;

        }

        else

        {

          return false;

        }

    })

</script>

<script>
    $(document).ready(function() {
        $("#list").DataTable({
            "order": [[ 0, "desc" ]]
        }
        );

    });
</script>