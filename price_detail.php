<!DOCTYPE html>
<?php if(isset($_POST['detail']) or isset($_POST['submit']) or isset($_POST['change_data'])){  ?>
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
$keterangan	= "";
$id			= $_POST['id'];
$price		= $conf->get_price($con,1,$id);
$list_price	= mysqli_fetch_assoc($price);
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
	$city_send 	= $_POST['city_send'];
	$city_recv	= $_POST['city_recv'];
	$price_kg	= $_POST['price_kg'];
	$ship_w		= $_POST['ship_w'];
	$status   	= $_POST['status'];
	
	$update			= $conf->upd_price($con, $id, $city_send, $city_recv, $price_kg, $ship_w, $status);
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
						<a href="price_list.php">Price Detail</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="portlet box green ">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-dollar"></i> Price Detail
						</div>
					</div>
					<div class="portlet-body form">
<?php if($keterangan == "success"){ ?>
						<div class="alert alert-success display-show">
							<button class="close" data-close="alert"></button>
							<span>
							Your Data Has Been Update, Thank You</span>
						</div>
<?php	echo "<script>window.setTimeout(function () {location.href='price_list.php';}, 700);</script>";
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
<label class="control-label" ><u>Sender's Location</u></label>
</div>
</div>
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >City</label>
								</div>
								<div class="col-md-3">
									<select required class="form-control" <?php  echo $readonly ?> name="city_send" id="mycity" onchange="cityku()">
										<option value=""></option>
										
<?php	
	$get_loc_send	= $conf->get_location($con,3,1);
	while ($row	= mysqli_fetch_assoc($get_loc_send)){
	$selected	= "";
	if($list_price['sender']==$row['id']){
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
							<div class="coupro"></div>
														<div class="form-group">
<div class="col-md-2">
<label class="control-label" ><u>Receiver's Location</u></label>
</div>
</div>
								<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >City</label>
								</div>
								<div class="col-md-3">
								<select required class="form-control" <?php  echo $readonly ?> name="city_recv" id="mycityy" onchange="citykuu()">
										<option value=""></option>
										
<?php	
	$get_loc_recv	= $conf->get_location($con,3,1);
	while ($row	= mysqli_fetch_assoc($get_loc_recv)){
	$selected	= "";
	if($list_price['receiver']==$row['id']){
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
							<div class="city"></div>
								<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" name="price">Price/KG</label>
								</div>
											<div class="col-md-2">
								<input name="price_kg" required <?php  echo $readonly ?> value="<?php echo $list_price['price'] ?>" type="number" autocomplete="off" class="form-control">
									<?php echo $id_hidden; ?>
								</div>
							
							</div>
							
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label">Shipping With</label>
								</div>
								<div class="col-md-2">
									<select class="form-control" required <?php  echo $readonly ?> name="ship_w" >
<?php	
	$get_shipping	= $conf->get_shipping($con);
	while ($row	= mysqli_fetch_assoc($get_shipping)){
	$selected	= "";
	if($list_price['shipping']==$row['id']){
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
								<div class="col-md-2">
									<select class="form-control" required <?php  echo $readonly ?> name="status" >
<?php	
	$get_price_stats	= $conf->get_price_status($con);
	while ($row	= mysqli_fetch_assoc($get_price_stats)){
	$selected	= "";
	if($list_price['status']==$row['id']){
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
function cityku() {
    var coupro = document.getElementById("mycity").value;
		if(coupro){
			$.ajax({
				type: 'POST',
				url: 'desaign/loc_test.php',
				data: {id : coupro, type : "coupro"},
				success: function(dataString){
					$('.coupro').html(dataString);;
				}
			});
		}
}


function citykuu() {
    var city = document.getElementById("mycityy").value;
		if(city){
			$.ajax({
				type: 'POST',
				url: 'desaign/loc_test2.php',
				data: {id : city, type : "city"},
				success: function(dataString){
					$('.city').html(dataString);;
				}
			});
		}
}
</script>

<?php } ?>