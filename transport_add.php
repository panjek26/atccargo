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
$keterangan	= "";

if(isset($_POST['submit'])){
	$plate_number	= $_POST['plate_number'];
	$type_trans		= $_POST['type_trans'];
	$production		= $_POST['production'];
	$kir			= $_POST['kir'];
	$change_oil		= $_POST['change_oil'];
	$driver			= $_POST['driver'];
	$country		= $_POST['country'];
	$status			= 1;
	
	$insert	= $conf->ins_transport($con,$plate_number,$type_trans,$production,$kir,$change_oil,$driver,$country,$status);
	if($insert){
		$keterangan	= "success";
	} else {
		$keterangan = "gagal";
	}
}
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
						<i class="fa fa-home"></i>
						<a href="index.php">Dashboard</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="user_add.php">Add User</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="portlet box green ">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-truck"></i> Add Transport
						</div>
					</div>
					<div class="portlet-body form">
<?php if($keterangan == "success"){ ?>
						<div class="alert alert-success display-show">
							<button class="close" data-close="alert"></button>
							<span>
							Your Data Has Been Inserted, Thank You</span>
						</div>
<?php	echo "<script>window.setTimeout(function () {location.href='transport_list.php';}, 700);</script>";
} else if($keterangan == "gagal"){ 
?>
						<div class="alert alert-danger display-show">
							<button class="close" data-close="alert"></button>
							<span>
							Oooppss, data not match, please cek again</span>
						</div>
<?php
} else {
	
}
?>
						
					<form class="form-horizontal" action="" method="post" role="form">
						<div class="form-body">
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >Plate Number</label>
								</div>
								<div class="col-md-9">
									<input name="plate_number" type="text" autocomplete="off" class="form-control">
								</div>
							</div>							
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >Transport Type</label>
								</div>
								<div class="col-md-9">
									<select class="form-control" name="type_trans">
<?php
	$get_type	= $conf->get_transport_type($con);
	while ($row	= mysqli_fetch_assoc($get_type)){
?>
										<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
<?php	
	}
?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >Production</label>
								</div>
								<div class="col-md-9">
									<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
										<input name="production" type="text" class="form-control">
										<span class="input-group-btn">
										<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
										</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >KIR</label>
								</div>
								<div class="col-md-9">
									<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
										<input name="kir" type="text" class="form-control">
										<span class="input-group-btn">
										<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
										</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >Change Oil</label>
								</div>
								<div class="col-md-9">
									<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
										<input name="change_oil" type="text" class="form-control">
										<span class="input-group-btn">
										<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
										</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >Driver</label>
								</div>
								<div class="col-md-9">
									<select class="form-control" name="driver">
<?php
	$get_driver	= $conf->get_employee($con,4);
	while ($row	= mysqli_fetch_assoc($get_driver)){
?>
										<option value="<?php echo $row['id'] ?>"><?php echo $row['fullname'] ?></option>
<?php	
	}
?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >Country</label>
								</div>
								<div class="col-md-9">
									<select class="form-control" name="country">
<?php
	$get_country	= $conf->get_transport_country($con);
	while ($row	= mysqli_fetch_assoc($get_country)){
?>
										<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
<?php	
	}
?>
									</select>
								</div>
							</div>
						</div>
						<div class="form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" name="submit" value="1" class="btn green">Save</button>
								</div>
						</div>
					</form>
					</div>
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN DASHBOARD STATS -->
			<div class="row">
			
			</div>
		</div>
	</div>
	<!-- END CONTENT -->

</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->

<?php
include "desaign/copyright2.php";
include "desaign/script.php";
?>


</body>
<!-- END BODY -->
</html>