<!DOCTYPE html>
<?php if(isset($_POST['detail']) or isset($_POST['submit']) or isset($_POST['change_data'])){  ?>
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
$id			= $_POST['id'];
$per		= $conf->get_periode($con,1,$id);
$list_per	= mysqli_fetch_assoc($per);
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
	$periode_d	= $_POST['periode_d'];
	$from_d		= $_POST['from_d'];
	$to_d		= $_POST['to_d'];
	$status		= $_POST['status'];
	$id_per		= $_POST['id'];
	
	
	$update			= $conf->upd_per($con, $id_per, $periode_d, $from_d,$to_d,$status);
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
						<a href="periode_list.php">Periode Detail</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="portlet box green ">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-calendar-o"></i> Periode Detail
						</div>
					</div>
					<div class="portlet-body form">
<?php if($keterangan == "success"){ ?>
						<div class="alert alert-success display-show">
							<button class="close" data-close="alert"></button>
							<span>
							Your Data Has Been Update, Thank You</span>
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
										<input name="periode_d" type="text" class="form-control" <?php  echo $readonly ?> value="<?php echo $list_per['periode'] ?>">
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
										<input name="from_d" type="text" class="form-control" <?php  echo $readonly ?> value="<?php echo $list_per['from'] ?>">
										
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
										<input name="to_d" type="text" class="form-control" <?php  echo $readonly ?> value="<?php echo $list_per['to'] ?>">
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
									<label class="control-label">Status</label>
								</div>
								<div class="col-md-2">
									<select class="form-control" <?php  echo $readonly ?> name="status" >
<?php	
	$get_periode_status	= $conf->get_periode_status($con);
	while ($row	= mysqli_fetch_assoc($get_periode_status)){
	$selected	= "";
	if($list_per['status']==$row['id']){
		$selected	= "selected";
	}
?>
										<option value="<?php echo $row['id'] ?>" <?php echo $selected ?>><?php echo $row['name'] ?></option>
<?php	
	}
?>
<?php echo $id_hidden; ?>
									</select>
								</div>
								
							</div>
						</div>
												<div class="form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" name="<?php echo $name_input ?>" value="1" class="btn green"><?php echo $Input ?></button>
								</div>
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