<!DOCTYPE html>

<html lang="en" class="no-js">
<head>
<?php 
$header		= 20;
$subheader	= "Transport";
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
						<a href="transport_list.php">List Transport</a>
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
								<i class="fa fa-truck"></i> List Transport
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
										<a class="btn green" href="transport_add.php"><i class="fa fa-plus"></i> Add Transport</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
										
											<table class="table table-striped table-bordered table-hover" id="list_transport">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>License Plat Number</th>
												<th>Transportation Type</th>
												<th>Production Year</th>
												<th>Period Of Validaty KIR</th>
												<th>Last Date Change The Oil</th>
												<th>Driver</th>
												<th>Country</th>
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
										<a class="btn green" href="transport_add.php"><i class="fa fa-plus"></i> Add Transport</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
											<table class="table table-striped table-bordered table-hover" id="transport_active">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>License Plat Number</th>
												<th>Transportation Type</th>
												<th>Production Year</th>
												<th>Period Of Validaty KIR</th>
												<th>Last Date Change The Oil</th>
												<th>Driver</th>
												<th>Country</th>
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
										<a class="btn green" href="transport_add.php"><i class="fa fa-plus"></i> Add Transport</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
											<table class="table table-striped table-bordered table-hover" id="transport_block">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>License Plat Number</th>
												<th>Transportation Type</th>
												<th>Production Year</th>
												<th>Period Of Validaty KIR</th>
												<th>Last Date Change The Oil</th>
												<th>Driver</th>
												<th>Country</th>
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
								<form class="form-horizontal" action="" method="post" role="form" id="form-transport">
								 <div class="form-body">
									<div class="form-group">
										<div class="col-md-2">
											<label class="control-label" >No Plate</label>
										</div>
										<div class="col-md-3">
											<input name="plate" type="text" value="<?php echo $_POST['plate'] ?>" autocomplete="off" class="form-control">
										</div>
										<div class="col-md-2">
											<label class="control-label" >Change Oil</label>
										</div>
										<div class="col-md-3">
											<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
												<input name="change_oil" type="text" value="<?php echo $_POST['change_oil'] ?>" class="form-control">
												<span class="input-group-btn">
												<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
												</span>
											</div>
										</div>
										<div class="col-md-1">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-2">
											<label class="control-label" >Trans Type</label>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="trans_type">
												<option value=""></option>
<?php	
	$get_type	= $conf->get_transport_type($con);
	while ($row	= mysqli_fetch_assoc($get_type)){
	$selected	= "";
	if($_POST['trans_type']==$row['id']){
		$selected	= "selected";
	}
?>
												<option value="<?php echo $row['id'] ?>" <?php echo $selected ?>><?php echo $row['name'] ?></option>
<?php	
	}
?>
											</select>
										</div>
										<div class="col-md-2">
											<label class="control-label" >Driver</label>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="driver">
												<option value=""></option>
<?php	
	$get_driver	= $conf->get_employee($con,4);
	while ($row	= mysqli_fetch_assoc($get_driver)){
	$selected	= "";
	if($_POST['driver']==$row['id']){
		$selected	= "selected";
	}
?>
												<option value="<?php echo $row['id'] ?>" <?php echo $selected ?>><?php echo $row['fullname'] ?></option>
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
											<label class="control-label" >Production</label>
										</div>
										<div class="col-md-3">
											<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
												<input name="production" type="text" value="<?php echo $_POST['production'] ?>" class="form-control">
												<span class="input-group-btn">
												<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
												</span>
											</div>
										</div>
										<div class="col-md-2">
											<label class="control-label" >Country</label>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="country" >
												<option value=""></option>
<?php	
	$get_country	= $conf->get_transport_country($con);
	while ($row	= mysqli_fetch_assoc($get_country)){
	$selected	= "";
	if($_POST['country']==$row['id']){
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
											<label class="control-label" >Kir</label>
										</div>
										<div class="col-md-3">
											<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
												<input name="kir" type="text" value="<?php echo $_POST['kir'] ?>" class="form-control">
												<span class="input-group-btn">
												<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
												</span>
											</div>
										</div>
										<div class="col-md-2">
											<label class="control-label" >Status</label>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="status" >
												<option value=""></option>
<?php	
	$get_status	= $conf->get_transport_status($con);
	while ($row	= mysqli_fetch_assoc($get_status)){
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
										<a class="btn green" href="transport_add.php"><i class="fa fa-plus"></i> Add Transport</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
											<table class="table table-striped table-bordered table-hover " id="transport_filter">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>License Plat Number</th>
												<th>Transportation Type</th>
												<th>Production Year</th>
												<th>Period Of Validaty KIR</th>
												<th>Last Date Change The Oil</th>
												<th>Driver</th>
												<th>Country</th>
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
<script src="assets/admin/pages/scripts/transport-ajax.js"></script>
<?php
include "desaign/copyright2.php";
include "desaign/script.php";
?>


</body>
<!-- END BODY -->
</html>