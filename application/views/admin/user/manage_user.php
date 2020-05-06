<!--=== Container Part ===-->

<div class="container content">

  <div class="col-md-12 col-sm-12">

    <!-- BEGIN EXAMPLE TABLE PORTLET-->

    <div class="portlet light">

      <div class="portlet-title">

          <div class="caption">

              <i class="fa fa-users font-green-sharp"></i>

              <span class="caption-subject font-green-sharp bold uppercase"><?php echo ucfirst($this->uri->segment(2)); ?></span>

          </div>

          <!--div class="actions btn-set">

            <a href="<?php //echo base_url(); ?>admin/user/add" class="btn green">

              Add New User  <i class="fa fa-plus"></i>

            </a>

          </div-->

      </div>

      <?php

      $this->load->view('includes/message_template');

      // $this->load->view('admin/includes/search_form');

      ?>	

      <div class="portlet-body">

        <?php

          $attributes = array('class' => 'form-horizontal', 'user_id' => 'form_delete_user');

          echo form_open('category/manage_category', $attributes);

          ?>

          <!-- <?php $this->load->view('admin/includes/pagination'); ?>	     -->

          <table class="dataTable table table-striped table-bordered table-hover"  id="list">

            <thead>

              <tr>

                <?php if($this->input->get_post('sort_by') == "u.gcm_user_id" && $this->input->get_post('sort_order') == "asc"):?>

                  <th class="sorting_desc" data-column="u.gcm_user_id" data-order="DESC">ID</th>

                <?php else:?>

                  <th class="sorting_asc" data-column="u.gcm_user_id" data-order="asc">ID</th>

                <?php endif;?>                      

                <?php if($this->input->get_post('sort_by') == "u.username" && $this->input->get_post('sort_order') == "asc"):?>

                    <th class="sorting_desc" data-column="u.username" data-order="DESC">Name</th>

                <?php else:?>

                    <th class="sorting_asc" data-column="u.username" data-order="asc">Name</th>

                <?php endif;?>

                <?php if($this->input->get_post('sort_by') == "u.email" && $this->input->get_post('sort_order') == "asc"):?>

                    <th class="sorting_desc" data-column="u.email" data-order="DESC">Email</th>

                <?php else:?>

                    <th class="sorting_asc" data-column="u.email" data-order="asc">Email</th>

                <?php endif;?>

                <?php if($this->input->get_post('sort_by') == "u.premium" && $this->input->get_post('sort_order') == "asc"):?>

                    <th class="sorting_desc" data-column="u.premium" data-order="DESC">Premium_Date</th>

                <?php else:?>

                     <th class="sorting_asc" data-column="u.premium" data-order="asc">Premium_Date</th>

                <?php endif;?>

                <?php if($this->input->get_post('sort_by') == "u.user_status" && $this->input->get_post('sort_order') == "asc"):?>

                    <th class="sorting_desc" data-column="u.user_status" data-order="DESC">Status</th>

                <?php else:?>

                    <th class="sorting_asc" data-column="u.user_status" data-order="asc">Status</th>

                <?php endif;?>

                <?php if($this->input->get_post('sort_by') == "u.user_created_date" && $this->input->get_post('sort_order') == "asc"):?>

                    <th class="sorting_desc" data-column="u.user_created_date" data-order="DESC">Added Date</th>

                <?php else:?>

                  <th class="sorting_asc" data-column="u.user_created_date" data-order="asc">Added Date</th>

                <?php endif;?>

                  <th>Action</th>

              </tr>

            </thead>

            <tbody>

              <?php if(count($user) > 0):?>    

                <?php

                  foreach ($user as $row) {

                    $user_id = $row['gcm_user_id'];

                    $username = $row['username'];

                    $email = $row['email'];

                    $premium_date = $row['premium'];

                    $user_status = $row['user_status'];

                    if ($user_status==1) {

                      $user_status="Active";

                    }

                    else{

                      $user_status="InActive";

                    }

                    ?>

                    <tr class="odd gradeX">

                      <td><?php echo $user_id; ?></td>

                      <td><?php echo $username; ?></td>

                      <td><?php echo $email; ?></td>

                      <td><?php echo $premium_date; ?></td>

                      <td class="hidden-sm"><?php echo $user_status; ?></td>

                      <td><?php echo date('d-m-Y', strtotime($row['user_created_date'])); ?></td>

                      <?php

                        echo '<td class="crud-actions">

					                    <a href="' . site_url("admin") . '/users/delete/' . $row['gcm_user_id'] . '" class="btn red delete_user">delete <i class="fa fa-remove"></i></a>

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



    jQuery(".delete_user").click(function () {

        if (confirm("Are you sure you want to delete this User?"))

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