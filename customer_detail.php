<!DOCTYPE html>
<?php if(isset($_POST['detail']) or isset($_POST['submit']) or isset($_POST['change_data'])){  ?>
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
$keterangan	= "";
$id			= $_POST['id'];
$customer	= $conf->get_customer($con,1,$id);
$list_cus	= mysqli_fetch_assoc($customer);
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
	$name			= $_POST['name'];
	$district		= $_POST['district'];
	$mobile_phone	= $_POST['mobile_phone'];
	$address		= $_POST['address'];
	$id_customer	= $_POST['id'];
	$status			= $_POST['status'];
	
	$update			= $conf->upd_customer($con, $id_customer, $name, $district, $mobile_phone, $address, $status);
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
						<a href="customer_list.php">Customer Detail</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="portlet box green ">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-users"></i> Customer Detail
						</div>
					</div>
					<div class="portlet-body form">
<?php if($keterangan == "success"){ ?>
						<div class="alert alert-success display-show">
							<button class="close" data-close="alert"></button>
							<span>
							Your Data Has Been Update, Thank You</span>
						</div>
<?php	echo "<script>window.setTimeout(function () {location.href='customer_list.php';}, 700);</script>";
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
									<label class="control-label" >Name</label>
								</div>
								<div class="col-md-9">
									<input name="name" <?php  echo $readonly ?> value="<?php echo $list_cus['name'] ?>" type="text" autocomplete="off" class="form-control">
									<?php echo $id_hidden; ?>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" name="district">District</label>
								</div>
								<div class="col-md-3">
									<select class="form-control" <?php  echo $readonly ?> name="district" id="mydistrict" onchange="myDistrict()">
<?php	
	$get_dis	= $conf->get_location($con,1);
	while ($row	= mysqli_fetch_assoc($get_dis)){
	$selected	= "";
	if($list_cus['district']==$row['id']){
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
								<div class="city"></div>
								
							</div>
							<div class="coupro"></div>
							
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >Mobile Phone</label>
								</div>
								<div class="col-md-9">
									<input name="mobile_phone" <?php  echo $readonly ?> value="<?php echo $list_cus['mobile_phone'] ?>" type="text" autocomplete="off" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >Detail Address</label>
								</div>
								<div class="col-md-9">
									<textarea <?php  echo $readonly ?> name="address" class="form-control" autocomplete="off"><?php echo $list_cus['detail_address'] ?></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label">Status</label>
								</div>
								<div class="col-md-9">
									<select class="form-control" <?php  echo $readonly ?> name="status" >
<?php	
	$get_stat	= $conf->get_customer_status($con);
	while ($row	= mysqli_fetch_assoc($get_stat)){
	$selected	= "";
	if($list_cus['status']==$row['id']){
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