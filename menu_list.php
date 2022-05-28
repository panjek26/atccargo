<!DOCTYPE html>

<html lang="en" class="no-js">
<head>
<?php 
$header		= 20;
$subheader	= "Menu";
include "desaign/configuration.php";
include "desaign/databases.php";
include "desaign/title.php" ;
include "desaign/css.php";
include "desaign/session.php";
?>

</head>
<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-container-bg-solid">
<?php
include "desaign/nav_header.php";
?>
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
<?php
include "desaign/menu.php";
?>
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="icon-settings"></i>
						<a href="">Master Data</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="menu_list.php">List Menu</a>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN DASHBOARD STATS -->
			<div class="row">
			<!-- BEGIN TAB PORTLET-->
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-th-list"></i> List Menu
							</div>
							<ul class="nav nav-tabs">
								<li class="active">
									<a href="#portlet_tab1" data-toggle="tab">
									All </a>
								</li>
								<li>
									<a href="#portlet_tab2" data-toggle="tab">
									Active </a>
								</li>
								<li>
									<a href="#portlet_tab3" data-toggle="tab">
									Block </a>
								</li>
								
							</ul>
						</div>
						<div class="portlet-body">
							<div class="tab-content">
								<div class="tab-pane active" id="portlet_tab1">
									<p>
										<a class="btn green" href="menu_add.php"><i class="fa fa-plus"></i> Add Menu</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
										
											<table class="table table-striped table-bordered table-hover" id="list_menu">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>Name</th>
												<th>List Menu</th>
												<th>Status</th>
												<th>Detail</th>
											</tr>
											</thead>
											<tbody>
											</tbody>
											</table>
										</div>
									</div>
								</div>
							
							<div class="tab-pane" id="portlet_tab2">
									<p>
										<a class="btn green" href="menu_add.php"><i class="fa fa-plus"></i> Add Menu</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
											<table class="table table-striped table-bordered table-hover" id="menu_active">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>Name</th>
												<th>List Menu</th>
												<th>Status</th>
												<th>Detail</th>
											</tr>
											</thead>
											<tbody>
											</tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="portlet_tab3">
									<p>
										<a class="btn green" href="Menu_add.php"><i class="fa fa-plus"></i> Add Menu</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
											<table class="table table-striped table-bordered table-hover" id="menu_block">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>Name</th>
												<th>List Menu</th>
												<th>Status</th>
												<th>Detail</th>
											</tr>
											</thead>
											<tbody>
											</tbody>
											</table>
										</div>
									</div>
								</div>
								
							</div>
						</div>
					</div>
					<!-- END TAB PORTLET-->
			</div>
		</div>
	</div>
	<!-- END CONTENT -->

</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<script src="assets/admin/pages/scripts/menu-ajax.js"></script>
<?php
include "desaign/copyright2.php";
include "desaign/script.php";
?>


</body>
<!-- END BODY -->
</html>