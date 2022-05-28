<!DOCTYPE html>
<?php if(isset($_POST['detail']) or isset($_POST['submit']) or isset($_POST['change_data'])){  ?>
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
$id			= $_POST['id'];
$items	= $conf->get_items($con,1,$id);
$list_items	= mysqli_fetch_assoc($items);
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
	$items_name			= $_POST['items_name'];
	$price		= $_POST['price'];
	$type_items	= $_POST['type_items'];
	$status		= $_POST['status'];
	
	$update			= $conf->upd_items($con, $items_name, $price, $type_items, $status,$id);
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
						<a href="items_list.php">Items Detail</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="portlet box green ">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-archive"></i> Items Detail
						</div>
					</div>
					<div class="portlet-body form">
<?php if($keterangan == "success"){ ?>
						<div class="alert alert-success display-show">
							<button class="close" data-close="alert"></button>
							<span>
							Your Data Has Been Update, Thank You</span>
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
								<div class="col-md-9">
									<input name="items_name" required <?php  echo $readonly ?> value="<?php echo $list_items['name'] ?>" type="text" autocomplete="off" class="form-control">
									<?php echo $id_hidden; ?>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >Price</label>
								</div>
								<div class="col-md-9">
									<input name="price" required <?php  echo $readonly ?> value="<?php echo $list_items['price'] ?>" type="number" autocomplete="off" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label">Type Items</label>
								</div>
								<div class="col-md-9">
									<select class="form-control" required <?php  echo $readonly ?> name="type_items" >
<?php	
	$get_type_items	= $conf->get_items_type($con);
	while ($row	= mysqli_fetch_assoc($get_type_items)){
	$selected	= "";
	if($list_items['type']==$row['id']){
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
	$get_items_status	= $conf->get_items_status($con);
	while ($row	= mysqli_fetch_assoc($get_items_status)){
	$selected	= "";
	if($list_items['status']==$row['id']){
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