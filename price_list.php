<!DOCTYPE html>

<html lang="en" class="no-js">
<head>
<?php 
$header		= 20;
$subheader	= "Price";
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
						<a href="user_list.php">List Price</a>
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
								<i class="fa fa-dollar"></i> List Price
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
										<a class="btn green" href="price_add.php"><i class="fa fa-plus"></i> Add Price</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
										
											<table class="table table-striped table-bordered table-hover" id="list_price">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>Sender's Country</th>
												<th>Sender's Provience</th>
												<th>Sender's City</th>
												<th>Receiver's Country</th>
												<th>Receiver's Provience</th>
												<th>Receiver's City</th>
												<th>Price/KG</th>
												<th>Shipping With</th>
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
										<a class="btn green" href="price_add.php"><i class="fa fa-plus"></i> Add Price</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
										
											<table class="table table-striped table-bordered table-hover" id="active_price">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>Sender's Country</th>
												<th>Sender's Provience</th>
												<th>Sender's City</th>
												<th>Receiver's Country</th>
												<th>Receiver's Provience</th>
												<th>Receiver's City</th>
												<th>Price/KG</th>
												<th>Shipping With</th>
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
										<a class="btn green" href="price_add.php"><i class="fa fa-plus"></i> Add Price</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
										
											<table class="table table-striped table-bordered table-hover" id="block_price">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>Sender's Country</th>
												<th>Sender's Provience</th>
												<th>Sender's City</th>
												<th>Receiver's Country</th>
												<th>Receiver's Provience</th>
												<th>Receiver's City</th>
												<th>Price/KG</th>
												<th>Shipping With</th>
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
								<form class="form-horizontal" action="" method="post" role="form" id="form-price">
								 <div class="form-body">
									<div class="form-group">
										<div class="col-md-2">
											<label class="control-label" >Sender's Country</label>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="sender_con">
												<option value=""></option>
<?php	
	$get_send_con	= $conf->get_location($con,2,1);
	while ($row	= mysqli_fetch_assoc($get_send_con)){
	$selected	= "";
	if($_POST['sender_con']==$row['id']){
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
											<label class="control-label" >Receiver's Country</label>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="receive_con">
												<option value=""></option>
<?php	
	$get_recv_con	= $conf->get_location($con,2,1);
	while ($row	= mysqli_fetch_assoc($get_recv_con)){
	$selected	= "";
	if($_POST['receive_con']==$row['id']){
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
											<label class="control-label" >Sender's Provience</label>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="send_prov">
												<option value=""></option>
<?php	
	$get_send_prov	= $conf->get_location($con,4,1);
	while ($row	= mysqli_fetch_assoc($get_send_prov)){
	$selected	= "";
	if($_POST['send_prov']==$row['id']){
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
											<label class="control-label" >Receiver's Provience</label>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="recv_prov">
												<option value=""></option>
<?php	
	$get_recv_prov	= $conf->get_location($con,4,1);
	while ($row	= mysqli_fetch_assoc($get_recv_prov)){
	$selected	= "";
	if($_POST['recv_prov']==$row['id']){
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
											<label class="control-label" >Sender's City</label>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="send_cit">
												<option value=""></option>
<?php	
	$get_send_cit	= $conf->get_location($con,3,1);
	while ($row	= mysqli_fetch_assoc($get_send_cit)){
	$selected	= "";
	if($_POST['send_cit']==$row['id']){
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
											<label class="control-label" >Receiver's City</label>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="recv_city">
												<option value=""></option>
<?php	
	$get_recv_city= $conf->get_location($con,3,1);
	while ($row	= mysqli_fetch_assoc($get_recv_city)){
	$selected	= "";
	if($_POST['recv_city']==$row['id']){
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
											<label class="control-label" >Shipping With</label>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="ship">
												<option value=""></option>
<?php	
	$get_ship	= $conf->get_shipping($con);
	while ($row	= mysqli_fetch_assoc($get_ship)){
	$selected	= "";
	if($_POST['ship']==$row['id']){
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
											<label class="control-label" >Status</label>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="status" >
												<option value=""></option>
<?php	
	$get_stat	= $conf->get_price_status($con);
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
										<a class="btn green" href="price_add.php"><i class="fa fa-plus"></i> Add Price</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
											<table class="table table-striped table-bordered table-hover " id="price_filter">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>Sender's Country</th>
												<th>Sender's Provience</th>
												<th>Sender's City</th>
												<th>Receiver's Country</th>
												<th>Receiver's Provience</th>
												<th>Receiver's City</th>
												<th>Price/KG</th>
												<th>Shipping With</th>
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
<script src="assets/admin/pages/scripts/price-ajax.js"></script>
<?php
include "desaign/copyright2.php";
include "desaign/script.php";
?>


</body>
<!-- END BODY -->
</html>