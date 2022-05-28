<!DOCTYPE html>

<html lang="en" class="no-js">
<head>
<?php 
$header		= 20;
$subheader	= "Cost";
include "desaign/configuration.php";
include "desaign/databases.php";
include "desaign/title.php" ;
include "desaign/css.php";
include "desaign/session.php";
$keterangan	= "";

if(isset($_POST['submit'])){
	$type_cost	= $_POST['type_cost'];
	$cost		= $_POST['cost'];
	$status		= 1;
	$insert		= $conf->ins_cost($con,$type_cost,$cost,$status);
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
						<a href="cost_add.php">Add Cost</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="portlet box green ">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-money"></i> Add Cost
						</div>
					</div>
					<div class="portlet-body form">
<?php if($keterangan == "success"){ ?>
						<div class="alert alert-success display-show">
							<button class="close" data-close="alert"></button>
							<span>
							Your Data Has Been Inserted, Thank You</span>
						</div>
<?php	echo "<script>window.setTimeout(function () {location.href='cost_list.php';}, 700);</script>";
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
									<label class="control-label" >Type Cost</label>
								</div>
								<div class="col-md-2">
									<select required class="form-control" name="type_cost">
										<option value=""></option>
<?php	
	$get_type_cost	= $conf->get_type_cost($con);
	while ($row	= mysqli_fetch_assoc($get_type_cost)){
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
									<label class="control-label">Cost</label>
								</div>
								<div class="col-md-3">
									<input name="cost" required type="number" autocomplete="off" class="form-control">
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