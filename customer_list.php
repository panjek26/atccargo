<!DOCTYPE html>

<html lang="en" class="no-js">
<head>
<?php 
$header		= 20;
$subheader	= "Customer";
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
						<a href="user_list.php">List Customer</a>
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
								<i class="fa fa-user"></i> List Customer
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
										<a class="btn green" href="customer_add.php"><i class="fa fa-plus"></i> Add Customer</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
										
											<table class="table table-striped table-bordered table-hover" id="list_customer">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>Customer Name</th>
												<th>Country</th>
												<th>Provience</th>
												<th>City</th>
												<th>District</th>
												<th>Detail Address</th>
												<th>Mobile Phone</th>
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
										<a class="btn green" href="customer_add.php"><i class="fa fa-plus"></i> Add Customer</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
											<table class="table table-striped table-bordered table-hover" id="customer_active">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>Customer Name</th>
												<th>Country</th>
												<th>Provience</th>
												<th>City</th>
												<th>District</th>
												<th>Detail Address</th>
												<th>Mobile Phone</th>
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
										<a class="btn green" href="customer_add.php"><i class="fa fa-plus"></i> Add Customer</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
											<table class="table table-striped table-bordered table-hover" id="customer_block">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>Customer Name</th>
												<th>Country</th>
												<th>Provience</th>
												<th>City</th>
												<th>District</th>
												<th>Detail Address</th>
												<th>Mobile Phone</th>
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
								<div class="tab-pane active" id="portlet_tab4">
								<form class="form-horizontal" action="" method="post" role="form" id="form-user">
								 <div class="form-body">
									<div class="form-group">
										<div class="col-md-2">
											<label class="control-label" >Cus Name</label>
										</div>
										<div class="col-md-3">
											<input name="customer" type="text" value="<?php echo $_POST['customer'] ?>" autocomplete="off" class="form-control">
										</div>
										<div class="col-md-2">
											<label class="control-label" >District</label>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="district">
												<option value=""></option>
<?php	
	$get_dis	= $conf->get_location($con,1);
	while ($row	= mysqli_fetch_assoc($get_dis)){
	$selected	= "";
	if($_POST['district']==$row['id']){
		$selected	= "selected";
	}
?>
												<option value="<?php echo $row['id'] ?>" <?php echo $selected ?>><?php echo $row['location_name'] ?></option>
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
											<label class="control-label" >Country</label>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="country">
												<option value=""></option>
<?php	
	$get_dis	= $conf->get_location($con,2);
	while ($row	= mysqli_fetch_assoc($get_dis)){
	$selected	= "";
	if($_POST['country']==$row['id']){
		$selected	= "selected";
	}
?>
												<option value="<?php echo $row['id'] ?>" <?php echo $selected ?>><?php echo $row['location_name'] ?></option>
<?php	
	}
?>
											</select>
										</div>
										<div class="col-md-2">
											<label class="control-label" >Provience</label>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="provience">
												<option value=""></option>
<?php	
	$get_dis	= $conf->get_location($con,4);
	while ($row	= mysqli_fetch_assoc($get_dis)){
	$selected	= "";
	if($_POST['provience']==$row['id']){
		$selected	= "selected";
	}
?>
												<option value="<?php echo $row['id'] ?>" <?php echo $selected ?>><?php echo $row['location_name'] ?></option>
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
											<label class="control-label" >City</label>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="city">
												<option value=""></option>
<?php	
	$get_dis	= $conf->get_location($con,3);
	while ($row	= mysqli_fetch_assoc($get_dis)){
	$selected	= "";
	if($_POST['city']==$row['id']){
		$selected	= "selected";
	}
?>
												<option value="<?php echo $row['id'] ?>" <?php echo $selected ?>><?php echo $row['location_name'] ?></option>
<?php	
	}
?>
											</select>
										</div>
										<div class="col-md-2">
											<label class="control-label" >Status</label>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="status" >
												<option value=""></option>
<?php	
	$get_stat	= $conf->get_customer_status($con);
	while ($row	= mysqli_fetch_assoc($get_stat)){
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
								 </div>
								</form>
									<p>
										<a class="btn green" href="customer_add.php"><i class="fa fa-plus"></i> Add Customer</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
											<table class="table table-striped table-bordered table-hover " id="customer_filter">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>Customer Name</th>
												<th>Country</th>
												<th>Provience</th>
												<th>City</th>
												<th>District</th>
												<th>Detail Address</th>
												<th>Mobile Phone</th>
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
<script src="assets/admin/pages/scripts/customer-ajax.js"></script>
<?php
include "desaign/copyright2.php";
include "desaign/script.php";
?>


</body>
<!-- END BODY -->
</html>