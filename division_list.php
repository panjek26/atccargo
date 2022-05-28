<!DOCTYPE html>

<html lang="en" class="no-js">
<head>
<?php 
$header		= 20;
$subheader	= "Division";
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
						<a href="cost_list.php">List Division Master</a>
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
								<i class="fa fa-briefcase"></i> List Division Master
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
										<a class="btn green" href="division_add.php"><i class="fa fa-plus"></i> Add Division</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
										
											<table class="table table-striped table-bordered table-hover" id="all_division">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>Division Name</th>
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
										<a class="btn green" href="division_add.php"><i class="fa fa-plus"></i> Add Division</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
										
											<table class="table table-striped table-bordered table-hover" id="active_division">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>Division Name</th>
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
										<a class="btn green" href="division_add.php"><i class="fa fa-plus"></i> Add Division</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
										
											<table class="table table-striped table-bordered table-hover" id="block_division">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>Division Name</th>
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
								<form class="form-horizontal" action="" method="post" role="form" id="form-division">
								 <div class="form-body">
									<div class="form-group">
										<div class="col-md-2">
											<label class="control-label" >Division Name</label>
										</div>
										<div class="col-md-3">
											<input name="div_name" type="text" value="<?php echo $_POST['div_name'] ?>" autocomplete="off" class="form-control">
										</div>

										<div class="col-md-1">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-2">
											<label class="control-label" >Status</label>
										</div>
										<div class="col-md-2">
											<select class="form-control" name="status" >
												<option value=""></option>
<?php	
	$get_status_division	= $conf->get_status_division($con);
	while ($row	= mysqli_fetch_assoc($get_status_division)){
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
										<a class="btn green" href="division_add.php"><i class="fa fa-plus"></i> Add Division</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
											<table class="table table-striped table-bordered table-hover " id="division_filter">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>Division Name</th>
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
						<!-- end tab body -->
					</div>
					<!-- END TAB PORTLET-->
			</div>
		</div>
	</div>
	<!-- END CONTENT -->

</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->		
<script src="assets/admin/pages/scripts/division-ajax.js"></script>
<?php
include "desaign/copyright2.php";
include "desaign/script.php";
?>


</body>
<!-- END BODY -->
</html>