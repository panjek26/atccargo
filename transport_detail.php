<!DOCTYPE html>
<?php if(isset($_POST['detail']) or isset($_POST['submit']) or isset($_POST['change_data'])){  ?>
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
$id			= $_POST['id'];
$transport	= $conf->get_transport($con,1,$id);
$list_trans	= mysqli_fetch_assoc($transport);
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
	$plate_number	= $_POST['plate_number'];
	$production		= $_POST['production'];
	$kir			= $_POST['kir'];
	$change_oil		= $_POST['change_oil'];
	$driver			= $_POST['driver'];
	$country		= $_POST['country'];
	$type_trans		= $_POST['type_trans'];
	$status			= $_POST['status'];
	$id_transport	= $_POST['id'];
	
	$update			= $conf->upd_transport($con, $id_transport, $plate_number, $production, $kir, $change_oil, $driver, $country, $type_trans, $status);
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
						<a href="index.php">Dashboard</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="transport_list.php">Transport Detail</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="portlet box green ">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-truck"></i> Transport Detail
						</div>
					</div>
					<div class="portlet-body form">
<?php if($keterangan == "success"){ ?>
						<div class="alert alert-success display-show">
							<button class="close" data-close="alert"></button>
							<span>
							Your Data Has Been Update, Thank You</span>
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
									<input name="plate_number" type="text" autocomplete="off" class="form-control" <?php  echo $readonly ?> value="<?php echo $list_trans['plate_number'] ?>" >
									<?php echo $id_hidden; ?>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >Transport Type</label>
								</div>
								<div class="col-md-9">
									<select class="form-control" <?php  echo $readonly ?> name="type_trans">
<?php
	$get_type	= $conf->get_transport_type($con);
	while ($row	= mysqli_fetch_assoc($get_type)){
		$selected	= "";
	if($list_trans['type']==$row['id']){
		$selected	= "selected";
	}
?>
										<option value="<?php echo $row['id'] ?>"  <?php echo $selected ?> ><?php echo $row['name'] ?></option>
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
										<input name="production" type="text" class="form-control" <?php  echo $readonly ?> value="<?php echo $list_trans['production'] ?>">
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
										<input name="kir" type="text" class="form-control" <?php  echo $readonly ?> value="<?php echo $list_trans['kir'] ?>">
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
										<input name="change_oil" type="text" class="form-control" <?php  echo $readonly ?> value="<?php echo $list_trans['oil'] ?>">
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
									<select class="form-control"  <?php  echo $readonly ?> name="driver">
<?php
	$get_driver	= $conf->get_employee($con,4);
	while ($row	= mysqli_fetch_assoc($get_driver)){
	$selected	= "";
	if($list_trans['driver']==$row['id']){
		$selected	= "selected";
	}
?>
										<option value="<?php echo $row['id'] ?>" <?php echo $selected ?> > <?php echo $row['fullname'] ?></option>
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
									<select class="form-control"  <?php  echo $readonly ?> name="country">
<?php
	$get_country	= $conf->get_transport_country($con);
	while ($row	= mysqli_fetch_assoc($get_country)){
	$selected	= "";
	if($list_trans['country']==$row['id']){
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
									<label class="control-label">Status</label>
								</div>
								<div class="col-md-9">
									<select class="form-control" <?php  echo $readonly ?> name="status" >
<?php	
	$get_stat	= $conf->get_transport_status($con);
	while ($row	= mysqli_fetch_assoc($get_stat)){
	$selected	= "";
	if($list_trans['status']==$row['id']){
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
<script type="text/javascript">

function myDistrict() {
    var coupro = document.getElementById("mydistrict").value;
		if(coupro){
			$.ajax({
				type: 'POST',
				url: 'desaign/location_detail.php',
				data: {id : coupro, type : "coupro"},
				success: function(dataString){
					$('.coupro').html(dataString);;
				}
			});
			$.ajax({
				type: 'POST',
				url: 'desaign/location_detail.php',
				data: {id : coupro, type : "city"},
				success: function(dataString){
					$('.city').html(dataString);;
				}
			});
		}
}
</script>

<?php } ?>