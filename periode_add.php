<!DOCTYPE html>

<html lang="en" class="no-js">
<head>
<?php 
$header		= 20;
$subheader	= "Periode";
include "desaign/configuration.php";
include "desaign/databases.php";
include "desaign/title.php" ;
include "desaign/css.php";
include "desaign/session.php";
$keterangan	= "";

if(isset($_POST['submit'])){
	$periode_tgl	= $_POST['periode_tgl'];
	$from_periode	= $_POST['from_periode'];
	$to_periode		= $_POST['to_periode'];
	$status_per		= $_POST['status_per'];
	
	$insert	= $conf->ins_per($con,$periode_tgl,$from_periode,$to_periode,$status_per);
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
						<a href="periode_add.php">Add Periode</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="portlet box green ">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-calendar-o"></i> Add Periode
						</div>
					</div>
					<div class="portlet-body form">
<?php if($keterangan == "success"){ ?>
						<div class="alert alert-success display-show">
							<button class="close" data-close="alert"></button>
							<span>
							Your Data Has Been Inserted, Thank You</span>
						</div>
<?php	echo "<script>window.setTimeout(function () {location.href='periode_list.php';}, 700);</script>";
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
									<label class="control-label" >Periode</label>
								</div>
								<div class="col-md-9">
									<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm">
										<input name="periode_tgl" type="text" class="form-control">
										<span class="input-group-btn">
										<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
										</span>
									</div>
								</div>
							</div>
										<div class="form-group">
										<div class="col-md-2">
											<label class="control-label" >From </label>
										</div>
										<div class="col-md-3">
											<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
										<input name="from_periode" type="text" class="form-control">
										<span class="input-group-btn">
										<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
										</span>
									</div>
									</div>
										<div class="col-md-1">
											<label class="control-label" >To</label>
										</div>
										<div class="col-md-2">
										<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
										<input name="to_periode" type="text" class="form-control">
										<span class="input-group-btn">
										<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
										</span>
									</div>
										</div>
										<div class="col-md-1">
										</div>
									</div>

							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >Status</label>
								</div>
								<div class="col-md-2">
									<select class="form-control" name="status_per">
<?php
	$get_periode_status	= $conf->get_periode_status($con);
	while ($row	= mysqli_fetch_assoc($get_periode_status)){
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