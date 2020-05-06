<!--=== Container Part ===-->

<div class="container content">

  <div class="col-md-12 col-sm-12">

    <!-- BEGIN EXAMPLE TABLE PORTLET-->

    <div class="portlet light">

      <div class="portlet-title">

          <div class="caption">

              <i class="fa fa-file font-green-sharp"></i>

              <span class="caption-subject font-green-sharp bold uppercase">Audio Played Data</span>

          </div>

      </div>

      <?php

      $this->load->view('includes/message_template');

      // $this->load->view('admin/includes/search_form');

      ?>	

      <div class="portlet-body">

        <?php

          $attributes = array('class' => 'form-horizontal', 'session_id' => 'form_delete_session');

          echo form_open('session/manage_session', $attributes);

          ?>

          <!-- <?php $this->load->view('admin/includes/pagination'); ?>	     -->

          <table class="dataTable table table-striped table-bordered table-hover"  id="list">

            <thead>

              <tr>

                <?php if($this->input->get_post('sort_by') == "u.session_id" && $this->input->get_post('sort_order') == "asc"):?>

                  <th class="sorting_desc" data-column="u.session_id" data-order="DESC">Session_ID</th>

                <?php else:?>

                  <th class="sorting_asc" data-column="u.session_id" data-order="asc">Session_ID</th>

                <?php endif;?>                      

                <?php if($this->input->get_post('sort_by') == "u.user_id" && $this->input->get_post('sort_order') == "asc"):?>

                    <th class="sorting_desc" data-column="u.user_id" data-order="DESC">User_ID</th>

                <?php else:?>

                    <th class="sorting_asc" data-column="u.user_id" data-order="asc">User_ID</th>

                <?php endif;?>

                <?php if($this->input->get_post('sort_by') == "u.item_id" && $this->input->get_post('sort_order') == "asc"):?>

                    <th class="sorting_desc" data-column="u.item_id" data-order="DESC">Song_ID</th>

                <?php else:?>

                    <th class="sorting_asc" data-column="u.item_id" data-order="asc">Song_ID</th>

                <?php endif;?>

                <?php if($this->input->get_post('sort_by') == "u.item_name" && $this->input->get_post('sort_order') == "asc"):?>

                    <th class="sorting_desc" data-column="u.item_name" data-order="DESC">Song_Name</th>

                <?php else:?>

                    <th class="sorting_asc" data-column="u.item_name" data-order="asc">song_Name</th>

                <?php endif;?>

                <?php if($this->input->get_post('sort_by') == "u.playing_time" && $this->input->get_post('sort_order') == "asc"):?>

                    <th class="sorting_desc" data-column="u.playing_time" data-order="DESC">Playing_Time</th>

                <?php else:?>

                  <th class="sorting_asc" data-column="u.playing_time" data-order="asc">Playing_Time</th>

                <?php endif;?>

                <?php if($this->input->get_post('sort_by') == "u.timestamp" && $this->input->get_post('sort_order') == "asc"):?>

                    <th class="sorting_desc" data-column="u.timestamp" data-order="DESC">TimeStamp</th>

                <?php else:?>

                    <th class="sorting_asc" data-column="u.timestamp" data-order="asc">TimeStamp</th>

                <?php endif;?>

                  <th>Action</th>

              </tr>

            </thead>

            <tbody>

              <?php if(count($session) > 0):?>    

                <?php

                  foreach ($session as $row) {

                    $session_id = $row['session_id'];

                    $user_id = $row['user_id'];

                    $item_id = $row['item_id'];

                    $playing_time = $row['playing_time'];

                    $timestamp = $row['timestamp'];

                    $song_name = $row['item_name'];

                    ?>

                    <tr class="odd gradeX">

                      <td><?php echo $session_id; ?></td>

                      <td><?php echo $user_id; ?></td>

                      <td class="hidden-sm"><?php echo $item_id; ?></td>

                      <td><?php echo $song_name; ?></td>

                      <td><?php echo gmdate("i:s", $playing_time); ?></td>

                      <td><?php echo $timestamp; ?></td>

                      <?php

                        echo '<td class="crud-actions">

                                    <a href="' . site_url("admin") . '/session/delete/' . $row['session_id'] . '" class="btn red delete_session">delete <i class="fa fa-remove"></i></a>

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



    jQuery(".delete_session").click(function () {

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