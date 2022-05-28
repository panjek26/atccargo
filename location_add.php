<!DOCTYPE html>

<html lang="en" class="no-js">
<head>
<?php 
$header		= 20;
$subheader	= "Location";
include "desaign/configuration.php";
include "desaign/databases.php";
include "desaign/title.php" ;
include "desaign/css.php";
include "desaign/session.php";
$keterangan	= "";

if(isset($_POST['submit'])){
	$type			= $_POST['type'];
	$loc_name		= $_POST['loc_name'];
	$link_name		= $_POST['link_name'];
	$status=1;
	
	$insert	= $conf->ins_location($con,$type,$loc_name,$link_name,$status);
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
						<a href="location_add.php">Add Location</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="portlet box green ">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-map-marker"></i> Add Location
						</div>
					</div>
					<div class="portlet-body form">
<?php if($keterangan == "success"){ ?>
						<div class="alert alert-success display-show">
							<button class="close" data-close="alert"></button>
							<span>
							Your Data Has Been Inserted, Thank You</span>
						</div>
<?php	echo "<script>window.setTimeout(function () {location.href='location_list.php';}, 700);</script>";
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
									<label class="control-label" >Type</label>
								</div>
								<div class="col-md-3">
									<select required class="form-control" name="type">
										<option value=""></option>
<?php	
	$get_type	= $conf->get_type($con,1,1);
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
									<label class="control-label" name="district">Location Names</label>
								</div>
									<div class="col-md-4">
									<input name="loc_name" required type="text" autocomplete="off" class="form-control">
								</div>
								</div>
							
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >Link Name</label>
								</div>
								<div class="col-md-3">
									<select class="form-control" name="link_name">
										<option value=""></option>
<?php	
	$get_location_link	= $conf->get_location_link($con,1);
	while ($row	= mysqli_fetch_assoc($get_location_link)){
?>
										<option value="<?php echo $row['id'] ?>"><?php echo $row['location_name'] ?></option>
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