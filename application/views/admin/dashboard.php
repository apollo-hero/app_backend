<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
    <!-- BEGIN PAGE HEAD -->
    <div class="page-head">
        <div class="container">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1></h1>
            </div>
            <!-- END PAGE TITLE -->
        </div>
    </div>
    <!-- END PAGE HEAD -->
    <!-- BEGIN PAGE CONTENT -->
    <div class="page-content">
        <div class="container">


            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            Widget settings form goes here
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn blue">Save changes</button>
                            <button type="button" class="btn default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <!-- BEGIN PAGE BREADCRUMB -->
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="<?php echo site_url("admin"); ?>">
                        <?php echo ucfirst($this->uri->segment(1)); ?>
                    </a> 
                    <span class="divider">/</span>
                </li>
                <li class="active">
                    <?php echo ucfirst($this->uri->segment(2)); ?>
                </li>
            </ul>
            <!-- END PAGE BREADCRUMB -->
            <!-- BEGIN PAGE CONTENT INNER -->
            <div class="row">

                <div class="row">

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="dashboard-stat blue-madison">
                            <div class="visual">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <?php echo $total_category; ?>
                                </div>
                                <div class="desc">
                                    Total Category
                                </div>
                            </div>
                            <a href="<?php echo base_url(); ?>admin/category" class="more">
                                View More <i class="m-icon-swapright m-icon-white"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="dashboard-stat red-intense">
                            <div class="visual">
                                <i class="fa fa-music"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <?php echo $total_item; ?>
                                </div>
                                <div class="desc">
                                    Total Song
                                </div>
                            </div>
                            <a href="<?php echo base_url(); ?>admin/items" class="more">
                                View More <i class="m-icon-swapright m-icon-white"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="dashboard-stat green-haze">
                            <div class="visual">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <?php echo $total_user; ?>
                                </div>
                                <div class="desc">
                                    Total User
                                </div>
                            </div>
                            <a href="<?php echo base_url();  ?>admin/users" class="more">
                               View More<i class="m-icon-swapright m-icon-white"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="dashboard-stat purple-intense">
                            <div class="visual">
                                <i class="fa fa-list"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <?php echo $total_session; ?>
                                </div>
                                <div class="desc">
                                    Total Session
                                </div>
                            </div>
                            <a href="<?php echo base_url();  ?>admin/sessions" class="more">
                               View More<i class="m-icon-swapright m-icon-white"></i>
                            </a>
                        </div>
                    </div>

                    <div class="row">
                    <div class="col-md-6">
                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-users font-green-sharp"></i>
                                    <span class="caption-subject font-green-sharp bold uppercase"> Category</span>
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="remove">
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-scrollable">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>
                                                    ID
                                                </th>
                                                <th>
                                                    Name
                                                </th>
                                                <th>
                                                    Status
                                                </th>
                                                <th>
                                                    Action
                                                </th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($latest_category) && count($latest_category) > 0):?>
                                            <?php foreach($latest_category as $row):?>
                                            <?php
                                                $category_id = $row['category_id'];
                                                $category_name = $row['category_name'];
                                                $category_status = $row['category_status'];
                                                if ($category_status==1) {
                                                   $category_status='Active';
                                                }
                                                else{
                                                   $category_status='InActive';
                                                }
                                                ?>
                                                <tr>
                                                    <td><?php echo $category_id; ?></td>
                                                    <td><?php echo $category_name; ?></td>
                                                    <td><?php echo $category_status; ?></td>
                                                    <?php
                                                    echo '<td class="crud-actions">
                                                      <a href="'.site_url("admin").'/category/update/'.$row['category_id'].'" class="btn green btn-xs"><i class="fa fa-edit"></i></a>  
                                                      <a href="'.site_url("admin").'/category/delete/'.$row['category_id'].'" class="btn btn-xs red delete_therapist action-sure"><i class="fa fa-remove"></i></a>
                                                    </td>';
                                                    ?>
                                               </tr>
                                            
                                                  <?php endforeach;?>
                                            <?php else:?>
                                            <tr>
                                                <td colspan="6">
                                                    <h6>No Data Found</h6>
                                                </td> 
                                            </tr>
                                            <?php endif;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- END SAMPLE TABLE PORTLET-->
                    </div>
                    
                    <div class="col-md-6">
                        <!-- BEGIN BORDERED TABLE PORTLET-->
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-music font-green-sharp"></i>
                                    <span class="caption-subject font-green-sharp bold uppercase">Latest Item</span>
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="remove">
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-scrollable">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>
                                                    ID
                                                </th>
                                                <th>
                                                    Item Title
                                                </th>
                                                <th>
                                                    Item Status
                                                </th>
                                                <th>
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($latest_items) && count($latest_items) > 0):?>
                                                  <?php foreach($latest_items as $row):?>
                                                    <?php            
                                                    $item_id = $row['item_id'];
                                                    $item_name = $row['item_name'];
                                                    $item_status = $row['item_status'];
                                                    if ($item_status==1) {
                                                       $item_status='Active';
                                                    }
                                                    else{
                                                       $item_status='InActive';
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $item_id; ?></td>
                                                        <td><?php echo $item_name; ?></td>
                                                        <td class="hidden-sm"><?php echo $item_status; ?></td>

                                                        <?php
                                                        echo '<td class="crud-actions">
                                                          <a href="'.site_url("admin").'/items/update/'.$row['item_id'].'" class="btn green btn-xs"><i class="fa fa-edit"></i></a>  
                                                          <a href="'.site_url("admin").'/items/delete/'.$row['item_id'].'" class="action-sure btn btn-xs red delete_consumer"><i class="fa fa-remove"></i></a>
                                                        </td>';
                                                        ?>
                                                    </tr>                                            
                                                  <?php endforeach;?>
                                            <?php else:?>
                                            <tr>
                                                <td colspan="6">
                                                    <h6>No Data Found</h6>
                                                </td> 
                                            </tr>                                                    
                                            <?php endif;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- END BORDERED TABLE PORTLET-->
                    </div>
                </div>

                </div>           

                <div class="row">
                    <div class="col-md-6">
                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <!-- END SAMPLE TABLE PORTLET-->
                    </div>
                    
                </div>


            </div>

        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>
    <!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->

<script type="text/javascript">    
    jQuery(document).ready(function(){        
        jQuery('.action-sure').click(function(){
           if(confirm("Are you sure ?")) {
               return true;
           }
           return false;
        });
    })
</script>    