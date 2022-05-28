<!DOCTYPE html>

<html lang="en" class="no-js">
<head>
<?php 
$header		= 30;
$subheader	= "Shipping By Sales";
include "desaign/configuration.php";
include "desaign/databases.php";
include "desaign/title.php" ;
include "desaign/css.php";
include "desaign/session.php";
$keterangan	= "";

if(isset($_POST['submit'])){
	$resi		= $_POST['resi'];
	$foto 		= basename($_FILES["foto"]["name"]);
	$driver 	= $_POST['driver'];
	$district 	= $_POST['district'];
	$total_qty	= $_POST['total_qty'];
	$value 		= $_POST['value'];
	$shipping	= $_POST['shipping'];
	$tgl		= date('Y-m-d H:i:s');
	$totime		= strtotime($tgl);
	$wkt		= date('YmdHis', $totime); 
	$sales		= $_SESSION['id'];
	
	$allowedExts 	= array("jpeg","jpg","png");
    $extension 		= end(explode(".", $_FILES["foto"]["name"]));
	
	if (in_array($extension, $allowedExts) or empty($foto)) {
	
	$insert		= $conf->ins_shipping_sales($con,$resi,base64_encode($foto),$driver,$district,$shipping,$total_qty,$value,$sales,$tgl);
		if($insert == "sukses"){
		
			if(!empty($foto)){
			$folder	= "assets/global/img/foto/";
			move_uploaded_file($_FILES["foto"]["tmp_name"], $folder.$wkt.$foto);
			chmod($folder.$wkt.$foto, 0755);
			}
			
			$keterangan	= "success";
			
		} else {
			$keterangan = "gagal";
		
		}
	
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
						<a href="shipping_by_sales.php">Shipping By Sales</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="portlet box green ">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-car"></i> Shipping By Sales
						</div>
					</div>
					<div class="portlet-body form">    
<?php if($keterangan == "success"){ 
?>
						<div class="alert alert-success display-show">
							<button class="close" data-close="alert"></button>
							<span>
							Your Data Has Been Inserted, Thank You </span>
						</div>
<?php
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
						
					<form class="form-horizontal" action="" method="post" role="form" enctype="multipart/form-data">
						<div class="form-body">
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >Receipt Number</label>
								</div>
								<div class="col-md-9">
									<input name="resi" type="text" autocomplete="off" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >Foto</label>
								</div>
								<div class="col-md-9">
									<input name="foto" type="file" autocomplete="off" >
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
									<label class="control-label" name="district">District</label>
								</div>
								<div class="col-md-3">
									<select class="form-control" name="district" id="mydistrict" onchange="myDistrict()">
										<option value=""></option>
<?php	
	$get_dis	= $conf->get_location($con,1);
	while ($row	= mysqli_fetch_assoc($get_dis)){
?>
										<option value="<?php echo $row['id'] ?>"><?php echo $row['location_name'] ?></option>
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
									<label class="control-label" >Shipping With</label>
								</div>
								<div class="col-md-9">
									<select class="form-control" name="shipping">
<?php	
	$get_shipping	= $conf->get_shipping($con);
	while ($row	= mysqli_fetch_assoc($get_shipping)){
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
									<label class="control-label" >Total Qty Of Goods</label>
								</div>
								<div class="col-md-9">
									<input name="total_qty" type="text" autocomplete="off" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >Value Of Goods</label>
								</div>
								<div class="col-md-9">
									<input name="value" type="text" autocomplete="off" class="form-control numeric">
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
  <script>
    $(".numeric").lazzynumeric();
  </script>





