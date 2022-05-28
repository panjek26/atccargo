<!DOCTYPE html>

<html lang="en" class="no-js">
<head>

<?php 
$header		= 30;
$subheader	= "Warehouse";
include "desaign/configuration.php";
include "desaign/databases.php";
include "desaign/title.php" ;
include "desaign/css.php" ;
include "desaign/session.php";
$keterangan	= "";

if(isset($_POST['submit'])){
	$warehouse 	= $_POST['warehouse'];
	$shipping	= $_POST['shipping'];
	$total		= count($warehouse);
	$keterangan	= "success";
	$data_id	= "";
	
	for($awal=0;$awal<$total;$awal++){
		$data_warehouse		= explode(" - ",$warehouse[$awal]);
		$receipt_number		= $data_warehouse[0];
		$urutan				= $data_warehouse[1];
		$update				= $conf->upd_warehouse_item_new($con, $receipt_number, $urutan, 2);
		$get_detail_item	= $conf->get_warehouse_item($con,"","","",$receipt_number,"",$urutan);
		$Row				= mysqli_fetch_assoc($get_detail_item);
		if($update){
			$keterangan	= "success";
			$data_id   .= $Row['id'].",";			
		} else {
			$keterangan	= "gagal";
		}
		
	}
	$data_id	= substr($data_id,0,-1);
	$conf->upd_warehouse_item_new($con, "", "", 1, 2, $shipping, $data_id);
	
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
						<a href="warehouse.php">Warehouse</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="portlet box green ">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-bank"></i> Warehouse
						</div>
					</div>
					<div class="portlet-body form">    
<?php if($keterangan == "success"){
?>
						<div class="alert alert-success display-show">
							<button class="close" data-close="alert"></button>
							<span>
							Your Data Has Been Updated, Thank You </span>
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
									<label class="control-label" >Shipping With</label>
								</div>
								<div class="col-md-8">
									<select class="form-control" name="shipping">
<?php	
$get_shipping	= $conf->get_shipping($con);
while ($row		= mysqli_fetch_assoc($get_shipping)){
	$selected	= "";
	if($_POST['shipping']==$row['id']){
		$selected	= "selected";
	}
?>
									<option value="<?php echo $row['id'] ?>" <?php echo $selected ?>><?php echo $row['name'] ?></option>
<?php	
}
?>
									</select>
								</div>
								<div class="col-md-1">
									<button type="submit" name="change" value="1" class="btn green">Change</button>
								</div>
							</div>
<?php 
	if($_POST['change']==1){
?>
							<div class="form-group last">
								<div class="col-md-2">
									<label class="control-label" >Shipping </label>
								</div>
								<div class="col-md-9">
									<select multiple="multiple" class="multi-select" id="my_multi_select2" name="warehouse[]">
<?php
	$get_warehouse_item	= $conf->get_warehouse_item($con,1,"",$_POST['shipping']);
	while($row	= mysqli_fetch_assoc($get_warehouse_item)){ ?>
										<optgroup label="<?php echo $row['receipt_number']; ?>">
<?php
	$get_detail_item	= $conf->get_warehouse_item($con,"",$row['id_shipping']);
	while($row_rd		= mysqli_fetch_assoc($get_detail_item)){ 
		$selected			= "";
		if($row_rd['warehouse_status']==2){
			$selected	= "selected";
		}
	?>
										<option <?php echo $selected ?>><?php echo $row_rd['receipt_number']." - ".$row_rd['urutan'];?></option>
<?php		
	}
?>
										</optgroup>
<?php		
	}
?>										
									</select>
								</div>
							</div> 
<?php
	}
?>
						</div>
<?php 
	if($_POST['change']==1){
?>
						<div class="form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" name="submit" value="1" class="btn green">Save</button>
								</div>
						</div>
<?php
	}
?>
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

?>
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="assets/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/index.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/components-dropdowns.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
        jQuery(document).ready(function() { 
		
           ComponentsDropdowns.init();
		       Metronic.init(); // init metronic core componets
    Layout.init(); // init layout
    QuickSidebar.init(); // init quick sidebar
        });   
    </script>

</body>
<!-- END BODY -->
</html>
<?php

?>