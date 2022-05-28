<!DOCTYPE html>

<html lang="en" class="no-js">
<head>
<?php 
$header		= 20;
$subheader	= "User";
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
						<a href="user_list.php">List User</a>
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
								<i class="fa fa-user"></i> List User
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
										<a class="btn green" href="user_add.php"><i class="fa fa-plus"></i> Add User</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
										<form action="edit_user.php" method="POST"><input type="hidden" name="id" value="<?php echo $row['username'] ?>"/>
											<table class="table table-striped table-bordered table-hover" id="datatable_ajax">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>Username</th>
												<th>Name</th>
												<th>Division</th>
												<th>Country</th>
												<th>Provience</th>
												<th>City</th>
												<th>District</th>
												<th>Level</th>
												<th>Grop Menu</th>
												<th>Mobile No</th>
												<th>Email</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
											</thead>
											<tbody>
											</tbody>
											</table>
											</form>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="portlet_tab2">
									<p>
										<a class="btn green" href="user_add.php"><i class="fa fa-plus"></i> Add User</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
											<table class="table table-striped table-bordered table-hover" id="user_ajax_active">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>Username</th>
												<th>Name</th>
												<th>Division</th>
												<th>Country</th>
												<th>Provience</th>
												<th>City</th>
												<th>District</th>
												<th>Level</th>
												<th>Grop Menu</th>
												<th>Mobile No</th>
												<th>Email</th>
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
										<a class="btn green" href="user_add.php"><i class="fa fa-plus"></i> Add User</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
											<table class="table table-striped table-bordered table-hover" id="user_ajax_block">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>Username</th>
												<th>Name</th>
												<th>Division</th>
												<th>Country</th>
												<th>Provience</th>
												<th>City</th>
												<th>District</th>
												<th>Level</th>
												<th>Grop Menu</th>
												<th>Mobile No</th>
												<th>Email</th>
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
								<form class="form-horizontal" action="" method="post" role="form" id="form-user">
								 <div class="form-body">
									<div class="form-group">
										<div class="col-md-2">
											<label class="control-label" >City</label>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="city">
												<option value=""></option>
<?php	
	$get_city	= $conf->get_location($con,3,1);
	while ($row	= mysqli_fetch_assoc($get_city)){
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
											<label class="control-label" >District</label>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="district">
												<option value=""></option>
<?php	
	$get_dis	= $conf->get_location($con,1,1);
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
											<label class="control-label" >Division</label>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="division">
												<option value=""></option>
<?php	
	$get_division	= $conf->get_division($con);
	while ($row	= mysqli_fetch_assoc($get_division)){
	$selected	= "";
	if($_POST['division']==$row['id']){
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
											<label class="control-label" >Level</label>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="level">
												<option value=""></option>
<?php	
	$get_lvl	= $conf->get_level($con);
	while ($row	= mysqli_fetch_assoc($get_lvl)){
	$selected	= "";
	if($_POST['level']==$row['id']){
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
											<label class="control-label" >Country</label>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="country">
												<option value=""></option>
<?php	
	$get_dcntr	= $conf->get_location($con,2,1);
	while ($row	= mysqli_fetch_assoc($get_dcntr)){
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
											<label class="control-label" >Group Menu</label>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="grp_menu">
												<option value=""></option>
<?php	
	$get_group_menus	= $conf->get_group_menu($con);
	while ($row	= mysqli_fetch_assoc($get_group_menus)){
	$selected	= "";
	if($_POST['grp_menu']==$row['id']){
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
											<label class="control-label" >Provience</label>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="provience">
												<option value=""></option>
<?php	
	$get_provinsi	= $conf->get_location($con,4,1);
	while ($row	= mysqli_fetch_assoc($get_provinsi)){
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
										<div class="col-md-2">
											<label class="control-label" >Status</label>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="status_usr">
												<option value=""></option>
<?php	
	$status_usr	= $conf->get_status($con);
	while ($row	= mysqli_fetch_assoc($status_usr)){
	$selected	= "";
	if($_POST['status_usr']==$row['id']){
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
										<a class="btn green" href="user_add.php"><i class="fa fa-plus"></i> Add User</a>
									</p>			
									<div class="portlet-body">
										<div class="table-container">
											<table class="table table-striped table-bordered table-hover " id="user_ajax_filter">
											<thead>
											<tr role="row" class="heading">
												<th>No</th>
												<th>Username</th>
												<th>Name</th>
												<th>Division</th>
												<th>Country</th>
												<th>Provience</th>
												<th>City</th>
												<th>District</th>
												<th>Level</th>
												<th>Grop Menu</th>
												<th>Mobile No</th>
												<th>Email</th>
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
<script src="assets/admin/pages/scripts/user-ajax.js"></script>
<?php
include "desaign/copyright2.php";
include "desaign/script.php";
?>


</body>
<!-- END BODY -->
</html>