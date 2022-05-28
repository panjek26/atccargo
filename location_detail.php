<!DOCTYPE html>
<?php if(isset($_POST['detail']) or isset($_POST['submit']) or isset($_POST['change_data'])){  ?>
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


$id			= $_POST['id'];
$loc		= $conf->get_list_loc($con,1,$id);
$list_loc	= mysqli_fetch_assoc($loc);
$readonly	= "disabled";
$name_input	= "change_data";
$Input		= "Change Data";
$id_hidden	= "<input type='hidden' name='id' value='$id'/>";

if(isset($_POST['change_data'])){
$readonly	= "";
$name_input	= "submit";
$Input		= "Save Data";
}


if(isset($_POST['submit'])){
	$type			= $_POST['type'];
	$loc_name		= $_POST['loc_name'];
	$link_name		= $_POST['link_name'];
	$status			= $_POST['status'];

	
	$update			= $conf->upd_loc_list($con, $id, $type, $loc_name, $link_name, $status);
	if(update){
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
						<a href="dashboard.php">Dashboard</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="Location_list.php">Location Detail</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="portlet box green ">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-map-marker"></i> Location Detail
						</div>
					</div>
					<div class="portlet-body form">
<?php if($keterangan == "success"){ ?>
						<div class="alert alert-success display-show">
							<button class="close" data-close="alert"></button>
							<span>
							Your Data Has Been Update, Thank You</span>
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
								<div class="col-md-2">
									<select class="form-control" <?php  echo $readonly ?> name="type" >

<?php	
	$get_type	= $conf->get_type($con);
	while ($row	= mysqli_fetch_assoc($get_type)){
	$selected	= "";
	if($list_loc['location_type']==$row['id']){
		$selected	= "selected";
	}
?>
										<option value="<?php echo $row['id'] ?>" <?php echo $selected ?>><?php echo $row['name'] ?></option>
<?php	
	}
?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label">Location Name</label>
								</div>
									<div class="col-md-3">
									<input name="loc_name" required <?php  echo $readonly ?> value="<?php echo $list_loc['location_name'] ?>" type="text" autocomplete="off" class="form-control">
								<?php echo $id_hidden; ?>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label">Link Name</label>
								</div>
									<div class="col-md-4">
										<option value=""></option>
									<select class="form-control" <?php  echo $readonly ?> name="link_name" >
<?php	
	$get_location_link	= $conf->get_location_link($con);
	while ($row	= mysqli_fetch_assoc($get_location_link)){
	$selected	= "";
	if($list_loc['location_link']==$row['id']){
		$selected	= "selected";
	}
?>
										<option value="<?php echo $row['id'] ?>" <?php echo $selected ?>><?php echo $row['location_name'] ?></option>
<?php	
	}
?>
									</select>
								</div>

							</div>
														<div class="form-group">
								<div class="col-md-2">
									<label class="control-label">Status</label>
								</div>
									<div class="col-md-4">
										<option value=""></option>
									<select class="form-control" <?php  echo $readonly ?> name="status" >
<?php	
	$get_status_location	= $conf->get_status_location($con);
	while ($row	= mysqli_fetch_assoc($get_status_location)){
	$selected	= "";
	if($list_loc['id_status']==$row['id']){
		$selected	= "selected";
	}
?>
										<option value="<?php echo $row['id'] ?>" <?php echo $selected ?>><?php echo $row['name'] ?></option>
<?php	
	}
?>
									</select>
								</div>

							</div>
						</div>
						<div class="form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" name="<?php echo $name_input ?>" value="1" class="btn green"><?php echo $Input ?></button>
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
<?php } ?>