<!DOCTYPE html>
<html lang="en">
    <head>  
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php print WEBSITE_TITLE; ?></title>
        <link rel="shortcut icon" href="<?php print WEBSITE_ICON; ?>" /> 
		<script src="js/jquery-3.2.1.min.js"></script>
		<link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="plugins/bootstrap-extension.css" rel="stylesheet">
		<!-- Menu CSS -->
		<link href="plugins/sidebar-nav.css" rel="stylesheet">
		<!-- Animation CSS -->
		<link href="css/animate.css" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="css/style.css" rel="stylesheet">
		<!-- color CSS you can use different color css from css/colors folder -->
		<link href="css/colors/blue.css" id="theme" rel="stylesheet">
        <!-- Loading Page --> 
        <style> 
            div#load_screen{
                background: #000; 
                opacity: 0.9;
                position: fixed;
                z-index:1055;
                top: 0px;
                width: 100%;
                height: 100%;
                text-align: center; 
            }
            div#load_screen > div#modal_content{
                vertical-align: middle;
                color:#FFF;
                width:120px;
                height:24px;
                margin: 0 auto;
            } 
			.errorBorder{
				border: 1px solid red;
			}
        </style>
    </head>
    <body>
    <section id="container" >
	  <div id="loading_screen" style="display:hidden"></div>
	  <!-- Preloader -->
	  <div class="preloader">
		<div class="cssload-speeding-wheel"></div>
	  </div>
      <!--main content start-->
      <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
                <div class="top-left-part"><a class="logo" href="?loc=main"><b><img src="images/logo.png" alt="home" height="60" width="60"/></b><span class="hidden-xs"><strong>Dizaz</strong> Alert</span></a></div>
                <ul class="nav navbar-top-links navbar-left hidden-xs">
                    <li>
                        <a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a>
                    </li>
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> 
						<i class="ti-settings"></i>
						</a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li><a href="javascript:void(0)"><i class="ti-user"></i>  My Profile</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-email"></i>  Inbox</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-settings"></i>  Change Password</a></li>
                            <li><a href="" onclick="logout(<?php echo $admin_id; ?>)"><i class="fa fa-power-off"></i>  Logout</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <ul class="nav" id="side-menu">
                    <li class="user-pro">
                        <a href="#" class="waves-effect"><span class="hide-menu">Welcome, <?php echo $admin_name; ?><span class="fa arrow"></span></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a href="javascript:void(0)"><i class="ti-user"></i> My Profile</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-email"></i> Inbox</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-settings"></i> Change Password</a></li>
                            <li><a href="javascript:void(0)"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                    </li>
                    <li class="nav-small-cap m-t-10">--- Quick Link</li>
                    <li> <a href="?loc=dashboard" class="waves-effect"><i class="ti-dashboard p-r-10"></i> <span class="hide-menu">Dashboard</span></a> </li>
                    <!--<li class="nav-small-cap m-t-10">--- Management</li>
                    <li> <a href="property-list.html" class="waves-effect"><i class="ti-home fa-fw"></i> <span class="hide-menu">Property List</span></a> </li>
                    <li> <a href="property-3-column.html" class="waves-effect"><i class="ti-menu-alt fa-fw"></i> <span class="hide-menu">Property 3 Column</span></a> </li>-->
					<?php 
					if($admin_type == 1){
					?>
					<li class="nav-small-cap m-t-10">--- Administrator</li>
                    <li> <a href="?loc=mngclient" class="waves-effect"><i class="ti-home fa-fw"></i> <span class="hide-menu">Client</span></a> </li>
                    <li> <a href="?loc=mngaccount" class="waves-effect"><i class="ti-home fa-fw"></i> <span class="hide-menu">Account</span></a> </li>
					<?php } ?>
                </ul>
            </div>
        </div>
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
			<?php 
				include_once("content.php");
			?>
            <footer class="footer text-center"> 2018 &copy; Dizaz Administrator verifiying center. </footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    </section>
    <script src="plugins/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/tether.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="plugins//bootstrap-extension.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="plugins/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    <script src="js/public.js"></script>
	</body>
</html>
