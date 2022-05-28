<!DOCTYPE html>

<html lang="en" class="no-js">
<head>
<?php 
$header		= 20;
$subheader	= "Items";
include "desaign/configuration.php";
include "desaign/databases.php";
include "desaign/title.php" ;
include "desaign/css.php";
include "desaign/session.php";
$keterangan	= "";

if(isset($_POST['submit'])){
	$items_name			= $_POST['items_name'];
	$price		= $_POST['price'];
	$type_items	= $_POST['type_items'];
	$status	= 1;
	$insert	= $conf->ins_items($con,$items_name,$price,$type_items,$status);
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
						<a href="dashboard.php">Dashboard</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="items_add.php">Add Items</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="portlet box green ">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-archive"></i> Add Items
						</div>
					</div>
					<div class="portlet-body form">
<?php if($keterangan == "success"){ ?>
						<div class="alert alert-success display-show">
							<button class="close" data-close="alert"></button>
							<span>
							Your Data Has Been Inserted, Thank You</span>
						</div>
<?php	echo "<script>window.setTimeout(function () {location.href='items_list.php';}, 700);</script>";
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
									<label class="control-label" >Items Name</label>
								</div>
								<div class="col-md-4">
									<input name="items_name" required type="text" autocomplete="off" class="form-control">
								</div>
							</div>
					<div class="form-group">
								<div class="col-md-2">
									<label class="control-label">Price</label>
								</div>
								<div class="col-md-3">
									<input name="price" required type="number" autocomplete="off" class="form-control">
								</div>
							
							</div>
							
					<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" name="price">Type Items</label>
								</div>
								<div class="col-md-2">
									<select required class="form-control" name="type_items">
										<option value=""></option>
<?php	
	$get_type_items	= $conf->get_items_type($con);
	while ($row	= mysqli_fetch_assoc($get_type_items)){
?>
										<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
<?php	
	}
?>
									</select>
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