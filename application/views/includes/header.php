<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>

<title><?php echo PROJECT_NAME; ?>  | <?php echo $page_title; ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
<!-- END GLOBAL MANDATORY STYLES -->

<link href="<?php echo base_url(); ?>assets/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url(); ?>assets/global/plugins/icheck/icheck.min.js" type="text/javascript"></script>


<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url(); ?>assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/global/css/plugins.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/admin/layout3/css/layout.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/admin/layout3/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color">
<link href="<?php echo base_url(); ?>assets/admin/layout3/css/custom.css" rel="stylesheet" type="text/css">
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>

<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url(); ?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->

<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->


</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->

<body>
	
	<div id="AjaxLoaderDiv" style="display: none;">
		<div style="width:100%; height:100%; left:0px; top:0px; position:fixed; opacity:0.4; filter:alpha(opacity=40); background:#fff;">
		</div>
		<div style="float:left;width:100%; left:0px; top:50%; text-align:center; position:fixed; padding:0px; z-index:556">
			<img src="<?php echo base_url(); ?>assets/admin/layout3/img/loading-spinner-blue.gif">
		</div>
	</div>
	
<!-- BEGIN HEADER -->
<div class="page-header" style="display: block!important;">
	<!-- BEGIN HEADER TOP -->
	<div class="page-header-top">
		<div class="container">
			<!-- BEGIN LOGO -->
			<div class="page-logo">
				<h1><?php echo PROJECT_NAME; ?></h1>
			</div>
			<!-- END LOGO -->
			
	   <?php if($this->session->userdata('is_logged_in')){ ?>				
			<!-- BEGIN TOP NAVIGATION MENU -->
			<div class="top-menu" style="margin-top: 2%;">
				</i><a href="<?php echo base_url(); ?>admin/logout">
				<!-- <i class="icon-key"></i> --> Log Out </a>
			</div>
			<!-- END TOP NAVIGATION MENU -->
		<?php } ?>
		
		</div>
	</div>
	<!-- END HEADER TOP -->
	<!-- BEGIN HEADER MENU -->
	<div class="page-header-menu" style="display: block!important;">
		<div class="container">
			<!-- BEGIN MEGA MENU -->
			<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
			<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
			<div class="hor-menu ">
				<ul class="nav navbar-nav">
					<li  <?php if($this->uri->segment(2)=="dashboard"){echo 'class="active"';} ?>>
						<a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a>
					</li>
					<li>
						<a href="<?php echo base_url(); ?>admin/users" >Users</a>                                            
                        <!--ul class="dropdown-menu">
                            <li class="active">
                                <a href="<?php //echo base_url(); ?>admin/user/add">    
                                    Add User
                                </a>
                            </li>
                            <li class="active">
                                <a href="<?php //echo base_url(); ?>admin/users">    
                                    Manage User
                                </a>
                            </li>
                        </ul-->
					</li>
					
					<li>
						<a href="<?php echo base_url(); ?>admin/sessions">Sessions</a>
					</li>

					<li class="menu-dropdown classic-menu-dropdown">
						<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;">
						Category<i class="fa fa-angle-down"></i>
						</a>                                            
                        <ul class="dropdown-menu">
                            <li class="active">
                                <a href="<?php echo base_url(); ?>admin/category/add">    
                                    Add Category
                                </a>
                            </li>
                            <li class="active">
                                <a href="<?php echo base_url(); ?>admin/category">    
                                    Manage Category
                                </a>
                            </li>
                        </ul>
                    </li>

					<li class="menu-dropdown classic-menu-dropdown">
						<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;">
						Songs<i class="fa fa-angle-down"></i>
						</a>                                            
                        <ul class="dropdown-menu">
                            <li class="active">
                                <a href="<?php echo base_url(); ?>admin/items/add">    
                                    Add Song
                                </a>
                            </li>
                            <li class="active">
                                <a href="<?php echo base_url(); ?>admin/items">    
                                    Manage Songs
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- <li  <?php if($this->uri->segment(2)=="send_notifications"){echo 'class="active"';} ?>>
						<a href="<?php echo base_url(); ?>admin/send_notifications">Send Notification</a>
					</li> -->
                    <li>
						<a href="<?php echo base_url(); ?>admin/about_us">Aboutus</a>
					</li>

					<li>
						<a href="<?php echo base_url(); ?>admin/terms_and_conditions">Terms</a>
					</li>
				</ul>
			</div>
			<!-- END MEGA MENU -->
		</div>
	</div>
	<!-- END HEADER MENU -->
</div>
<!-- END HEADER -->
	