<!DOCTYPE html>

<html lang="en" class="no-js">
<head>
<?php 
$header		= 20;
$subheader	= "Items";
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
						<a href="items_list.php">List Items</a>
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
								<i class="fa fa fa-archive"></i> List Items
							</div>
							<ul class="nav nav-tabs">
								<li>
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
								<li class="active">
									<a href="#portlet_tab4" data-toggle="tab">
									Filter </a>
		
								</li>
							</ul>
						</div>
						<div class="portlet-body">
							<div class="tab-content">
								<div class="tab-pane" id="portlet_tab1">
									<p>
										<a class="btn green" href="items_add.php"><i class="fa fa-plus"></i> Add Items</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
										
											<table class="table table-striped table-bordered table-hover" id="all_items">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>Items Name</th>
												<th>Price</th>
												<th>Type Items</th>
												<th>Status</th>
												<th>Action</th>
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
										<a class="btn green" href="items_add.php"><i class="fa fa-plus"></i> Add Items</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
											<table class="table table-striped table-bordered table-hover" id="items_active">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>Items Name</th>
												<th>Price</th>
												<th>Type Items</th>
												<th>Status</th>
												<th>Action</th>
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
										<a class="btn green" href="items_add.php"><i class="fa fa-plus"></i> Add Items</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
											<table class="table table-striped table-bordered table-hover" id="items_block">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>Items Name</th>
												<th>Price</th>
												<th>Type Items</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
											</thead>
											<tbody>
											</tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="tab-pane active" id="portlet_tab4">
								<form class="form-horizontal" action="" method="post" role="form" id="form-items">
								 <div class="form-body">
									<div class="form-group">
										<div class="col-md-2">
											<label class="control-label" >Items Name</label>
										</div>
										<div class="col-md-3">
											<input name="items_name" type="text" value="<?php echo $_POST['items_name'] ?>" autocomplete="off" class="form-control">
										</div>
										<div class="col-md-2">
											<label class="control-label" >Type Items</label>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="type_items">
												<option value=""></option>
<?php	
	$get_items_type	= $conf->get_items_type($con,1);
	while ($row	= mysqli_fetch_assoc($get_items_type)){
	$selected	= "";
	if($_POST['type_items']==$row['id']){
		$selected	= "selected";
	}
?>
												<option value="<?php echo $row['id'] ?>" <?php echo $selected ?>><?php echo $row['name'] ?></option>
<?php	
	}
?>
											</select>
										</div>
										<div class="col-md-1">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-2">
											<label class="control-label" >Price</label>
										</div>
										<div class="col-md-3">
											<input name="price" type="text" value="<?php echo $_POST['price'] ?>" autocomplete="off" class="form-control">
										</div>
										<div class="col-md-2">
											<label class="control-label" >Status</label>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="status" >
												<option value=""></option>
<?php	
	$get_items_status	= $conf->get_items_status($con);
	while ($row	= mysqli_fetch_assoc($get_items_status)){
	$selected	= "";
	if($_POST['status']==$row['id']){
		$selected	= "selected";
	}
?>
												<option value="<?php echo $row['id'] ?>" <?php echo $selected ?>><?php echo $row['name'] ?></option>
<?php	
	}
?>	
											</select>
										</div>
										<div class="col-md-1">
											<button type="submit" name="submit" value="1" class="btn blue tombol-search">
											<i class="fa fa-search"></i> Search</button>
										</div>
									</div>
									</form>
																		<p>
										<a class="btn green" href="items_add.php"><i class="fa fa-plus"></i> Add Items</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
											<table class="table table-striped table-bordered table-hover " id="items_filter">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>Items Name</th>
												<th>Price</th>
												<th>Type Items</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
											</thead>
											<tbody>
											</tbody>
											</table>
										</div>
									</div>
								
								
								
								<!-- Buat FIlter-->


								</div>
							</div>
						</div>
					</div>
				</div>
					<!-- END TAB PORTLET-->
			</div>
		</div>

	<!-- END CONTENT -->


<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<script src="assets/admin/pages/scripts/items-ajax.js"></script>
<?php
include "desaign/copyright2.php";
include "desaign/script.php";
?>


</body>
<!-- END BODY -->
</html>