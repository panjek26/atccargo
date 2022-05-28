<!DOCTYPE html>

<html lang="en" class="no-js">
<head>
<?php 
$header		= 20;
$subheader	= "Cost";
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
						<a href="cost_list.php">List Cost Master</a>
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
								<i class="fa fa-money"></i> List Cost Master
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
										<a class="btn green" href="cost_add.php"><i class="fa fa-plus"></i> Add Cost</a>
									</p>		
									<div class="portlet-body">
										<div class="table-container">
										
											<table class="table table-striped table-bordered table-hover" id="all_cost">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>Type Cost</th>
												<th>Cost</th>
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
										<a class="btn green" href="cost_add.php"><i class="fa fa-plus"></i> Add Cost</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
										
											<table class="table table-striped table-bordered table-hover" id="cost_active">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>Type Cost</th>
												<th>Cost</th>
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
										<a class="btn green" href="cost_add.php"><i class="fa fa-plus"></i> Add Cost</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
										
											<table class="table table-striped table-bordered table-hover" id="cost_block">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>Type Cost</th>
												<th>Cost</th>
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
								<form class="form-horizontal" action="" method="post" role="form" id="form-cost">
								 <div class="form-body">
									<div class="form-group">
										<div class="col-md-2">
											<label class="control-label" >Type Cost</label>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="type_cost">
												<option value=""></option>
<?php	
	$get_type_cost	= $conf->get_type_cost($con,1);
	while ($row	= mysqli_fetch_assoc($get_type_cost)){
	$selected	= "";
	if($_POST['type_cost']==$row['id']){
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
											<label class="control-label" >Status</label>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="status" >
												<option value=""></option>
<?php	
	$get_status_cost	= $conf->get_status_cost($con);
	while ($row	= mysqli_fetch_assoc($get_status_cost)){
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
										<a class="btn green" href="cost_add.php"><i class="fa fa-plus"></i> Add Cost</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
											<table class="table table-striped table-bordered table-hover " id="cost_filter">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>Type Cost</th>
												<th>Cost</th>
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
<script src="assets/admin/pages/scripts/cost-ajax.js"></script>

<?php
include "desaign/copyright2.php";
include "desaign/script.php";
?>


</body>
<!-- END BODY -->
</html>