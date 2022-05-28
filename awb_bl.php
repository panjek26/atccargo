<!DOCTYPE html>

<html lang="en" class="no-js">
<head>

<?php 
$header		= 30;
$subheader	= "AWB / BL";
include "desaign/configuration.php";
include "desaign/databases.php";
include "desaign/title.php" ;
include "desaign/css.php" ;
include "desaign/session.php";
$keterangan	= "";
$option	="<option></option>";
if(isset($_POST['submit'])){
	$type_form			= $_POST['type_form'];
	$awb_number			= $_POST['awb_number'];
	$delivery_number	= $_POST['delivery_number'];
	$loading_date		= $_POST['loading_date'];
	$shipping_method	= $_POST['shipping_method'];
	$sum_early			= $_POST['sum_early'];
	$combined			= $_POST['combined'];
	$result_join		= $_POST['result_join'];
	$pcs				= $_POST['pcs'];
	$sum_weight			= $_POST['sum_weight'];
	$passport_number	= $_POST['passport_number'];
	$passport_name		= $_POST['passport_name'];
	$passport_address	= $_POST['passport_address'];
	$airline			= $_POST['airline'];
	$status				= 4;
	$awb_bl				= $_POST['awb_bl'];
	$total				= count($awb_bl);
	
	if($type_form == 1){
		$insert_awb_bl	= $conf->ins_awb_bl($con,$awb_number, $delivery_number, $loading_date, $sum_early, $combined, 
	$result_join, $pcs, $sum_weight, $passport_number, $passport_name, $passport_address, $airline, $status);
		if($insert_awb_bl){
			for($awal=0;$awal<$total;$awal++){
				$data_awb_bl		= explode(" - ",$awb_bl[$awal]);
				$receipt_number		= $data_awb_bl[0];
				$data_nomor			= explode(".",$data_awb_bl[1]);
				$urutan				= $data_nomor[0];
				
				$conf->upd_warehouse_item_for_awb($con, $receipt_number, $urutan, 3, $shipping_method, $insert_awb_bl);
						
				
			}
			$keterangan	= "success";
		} else {
			$keterangan	= "gagal";
		}
	} else if ($type_form == 2){
		$id_awb_bl			= $_POST['data_id'];
		$update_data		= $conf->upd_awb_bl($con, $id_awb_bl, $loading_date, $sum_early, $combined, $result_join, $pcs, $sum_weight, 
						  $passport_number, $passport_name, $passport_address, $airline, $awb_number, $delivery_number);
		if($update_data){
			for($awal=0;$awal<$total;$awal++){
				$data_awb_bl		= explode(" - ",$awb_bl[$awal]);
				$receipt_number		= $data_awb_bl[0];
				$data_nomor			= explode(".",$data_awb_bl[1]);
				$urutan				= $data_nomor[0];
				
				$update_warehouse 	= $conf->upd_warehouse_item_for_awb($con, $receipt_number, $urutan, 3, $shipping_method, $id_awb_bl);
				$get_detail_item	= $conf->get_warehouse_item_awb_bl($con,"","","",$receipt_number,"",$urutan);
				$Row				= mysqli_fetch_assoc($get_detail_item);
				if($update_warehouse){
					$id_warehouse   .= $Row['id'].",";		
				}
			}
			$id_warehouse	= substr($id_warehouse,0,-1);
			$conf->upd_warehouse_item_new($con, "", "", 2, "", "", $id_warehouse,$id_awb_bl,1);
			$keterangan	= "update";
			
		} else {
			$keterangan	= "gagal";
		}
		
	}
	
} else if(isset($_POST['show_data'])){
	$option				= "";
	$awb_number_id		= $_POST['awb_number_id'];
	$type_form_data		= $_POST['type_form'];
	$awb_number			= $_POST['awb_number'];
	$delivery_number	= $_POST['delivery_number'];
	$get_data_awb_bl	= $conf->get_awb_bl($con,$awb_number_id);
	$Show_data			= mysqli_fetch_assoc($get_data_awb_bl); 	
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
						<a href="awb_bl.php">AWB / BL</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="portlet box green ">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-ticket"></i> AWB / BL
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
} else if($keterangan == "update"){ 
?>
						<div class="alert alert-success display-show">
							<button class="close" data-close="alert"></button>
							<span>
							Your Data Has Been Updated, Thank You </span>
						</div>
<?php
} else {
	
}
?>
						
					<form class="form-horizontal" action="" method="post" id="form_data" role="form" enctype="multipart/form-data">
						<div class="form-body">
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >Type Form</label>
								</div>
								<div class="col-md-9">
									<select class="form-control" required name="type_form" id="type_form" onchange="TypeForm()">
										<?php echo $option; ?>
<?php
$get_tertiary	= $conf->get_tertiary($con,1,$type_form_data);
while($row		= mysqli_fetch_assoc($get_tertiary)){
	$selected	= "";
	if($row['id']==$type_form_data){
		$selected	= "selected";
	}?>
	
										<option value="<?php echo $row['id'] ?>" <?php echo $selected ?>><?php echo $row['name'] ?></option>
<?php	
}
?>
									</select>
								</div>
							</div>
							<div class="datas"></div>
							<div class="form-group tampil" >
								<div class="col-md-2">
									<label class="control-label">AWB / BL DATA</label>
								</div>
								<div class="col-md-5">
									<select name="awb_number_id" class="form-control select2me" data-placeholder="Select..." >
										<option></option>
<?php
$get_awb_bl	= $conf->get_awb_bl($con);
while ($row	= mysqli_fetch_assoc($get_awb_bl)){
		$selected	= "";
	if($row['id']==$Show_data['id']){
		$selected	= "selected";
	}
?>
									<option value="<?php echo $row['id']?>" <?php echo $selected ?>><?php echo $row['awb_bl_number']." - ".$row['delivery_number'] ?></option>
							<?php	
							}
							?>
									</select>
								</div>
								<div class="col-md-1">
									
								</div>
								<div class="col-md-3">
									<button type="submit" name="show_data" value="1" class="btn green">Show Data</button>
								</div>	
								
							</div>
<?php if(isset($_POST['show_data'])){ ?>
							<div class="form-group" >
								<div class="col-md-2">
									<label class="control-label">AWB / BL DATA</label>
								</div>
								<div class="col-md-5">
									<select name="awb_number_id" class="form-control select2me" data-placeholder="Select..." >
										<option></option>
<?php
$get_awb_bl	= $conf->get_awb_bl($con);
while ($row	= mysqli_fetch_assoc($get_awb_bl)){
		$selected	= "";
	if($row['id']==$Show_data['id']){
		$selected	= "selected";
	}
?>
									<option value="<?php echo $row['id']?>" <?php echo $selected ?>><?php echo $row['awb_bl_number']." - ".$row['delivery_number'] ?></option>
							<?php	
							}
							?>
									</select>
								</div>
								<div class="col-md-1">
									
								</div>
								<div class="col-md-3">
									<button type="submit" name="show_data" value="1" class="btn green">Show Data</button>
								</div>	
								
							</div>
							<div class="form-group" >
								<div class="col-md-2">
									<label class="control-label">AWB / BL Number</label>
								</div>
								<div class="col-md-3">
									<input type="text" name="awb_number" id="awb_number" value="<?php echo $Show_data['awb_bl_number'] ?>" class="form-control"/>
								</div>
								<div class="col-md-1">
								<input type="hidden" name="data_id" value="<?php echo $Show_data['id'] ?>" />
								</div>
								<div class="col-md-2">
									<label class="control-label">Delivery Number</label>
								</div>
								<div class="col-md-3">
									<input type="text" name="delivery_number" id="delivery_number" value="<?php echo $Show_data['delivery_number'] ?>" class="form-control"/>
								</div>	
								
							</div>
<?php	
}
?>
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label">Loading Date</label>
								</div>
								<div class="col-md-3">
									<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
										<input name="loading_date" type="text" class="form-control" value="<?php echo $Show_data['loading_date'] ?>">
										<span class="input-group-btn">
										<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
										</span>
									</div>
								</div>
								<div class="col-md-1">
								</div>
								<div class="col-md-2">
									<label class="control-label">Shipping Method</label>
								</div>
								<div class="col-md-3">
									<select class="form-control" name="shipping_method">
									<option></option>
<?php	
$get_shipping	= $conf->get_shipping($con);
while ($row		= mysqli_fetch_assoc($get_shipping)){
	$selected	= "";
	if($_POST['shipping_method']==$row['id'] or $Show_data['shipping_method']==$row['id']){
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
							<div class="form-group last">
								<div class="col-md-2">
									<label class="control-label" >Data Items </label>
								</div>
								<div class="col-md-3">
									<select multiple="multiple" class="multi-select" id="my_multi_select2" name="awb_bl[]" onchange="Warehouse()">
<?php
	$data_id = ""; $type_show_data = 2;
	if(!empty($Show_data['id'])){
		$data_id	= $Show_data['id'];
		$type_show_data	= "";
	} 
	$get_warehouse_item	= $conf->get_warehouse_item_awb_bl($con,1,$data_id,"","",$type_show_data);
	while($row	= mysqli_fetch_assoc($get_warehouse_item)){ ?>
										<optgroup label="<?php echo $row['receipt_number']; ?>">
<?php
	$get_detail_item	= $conf->get_warehouse_item_awb_bl($con,"",$data_id,"",$row['receipt_number'],$type_show_data);
	while($row_rd		= mysqli_fetch_assoc($get_detail_item)){ 
		$selected			= "";
		if($row_rd['warehouse_status']==3){
			$selected	= "selected";
		}
	?>
										<option <?php echo $selected ?>><?php echo $row_rd['receipt_number']." - ".$row_rd['urutan'].". ".$row_rd['items_name']." - ".
										$row_rd['packing']." - ".$row_rd['description']." - ".$row_rd['weight']."Kg";?></option>
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
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label">Sum Early</label>
								</div>
								<div class="col-md-3">
									<input type="text" name="sum_early" id="sum_early" readonly class="form-control"
									value="<?php echo (isset($Show_data['sum_early'])  ? $Show_data['sum_early'] : "0"); ?>" />
								</div>
								<div class="col-md-1">
								</div>
								<div class="col-md-2">
									<label class="control-label">Number Of PCS</label>
								</div>
								<div class="col-md-3">
									<input type="text" name="pcs" id="pcs" value="<?php echo $Show_data['number_pcs'] ?>" class="form-control"/>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label">Combined</label>
								</div>
								<div class="col-md-3">
									<input type="text" name="combined" id="combined" class="form-control"
									value="<?php echo (isset($Show_data['combined'])  ? $Show_data['combined'] : "0"); ?>"/>
								</div>
								<div class="col-md-1">
								</div>
								<div class="col-md-2">
									<label class="control-label">Sum Weight</label>
								</div>
								<div class="col-md-3">
									<input type="text" name="sum_weight" id="sum_weight" value="<?php echo $Show_data['sum_weight'] ?>" readonly class="form-control"/>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label">Result Join</label>
								</div>
								<div class="col-md-3">
									<input type="text" name="result_join" id="result_join"  onchange="ResultJoin()" class="form-control"
									value="<?php echo (isset($Show_data['result_join'])  ? $Show_data['result_join'] : "0"); ?>"/>
								</div>
								<div class="col-md-6">
								</div>
								
							</div>
							<hr>
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label">Passport Number</label>
								</div>
								<div class="col-md-3">
									<input type="text" name="passport_number" value="<?php echo $Show_data['passport_number'] ?>" id="passport_number" class="form-control"/>
								</div>
								<div class="col-md-1">
								</div>
								<div class="col-md-2">
									<label class="control-label">Passport Name</label>
								</div>
								<div class="col-md-3">
									<input type="text" name="passport_name" id="passport_name" value="<?php echo $Show_data['passport_name'] ?>" class="form-control"/>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label">Passport Address</label>
								</div>
								<div class="col-md-3">
									<textarea name="passport_address" class="form-control"><?php echo $Show_data['passport_address'] ?></textarea>
								</div>
								<div class="col-md-1">
								</div>
								<div class="col-md-2">
									<label class="control-label">Airline / Cruise</label>
								</div>
								<div class="col-md-3">
									<input type="text" name="airline" id="airline" value="<?php echo $Show_data['airline'] ?>" class="form-control"/>
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
<script src="assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>

<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="assets/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/clockface/js/clockface.js"></script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/demo.js" type="text/javascript"></script>

<script src="assets/admin/pages/scripts/index.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/components-dropdowns.js"></script>
<script src="assets/admin/pages/scripts/components-pickers.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() { 
	ComponentsPickers.init();
	ComponentsDropdowns.init();
	Metronic.init(); // init metronic core componets
	Layout.init(); // init layout
	QuickSidebar.init(); // init quick sidebar
}); 
$(".tampil").hide();
function TypeForm() {
    var type_form = document.getElementById("type_form").value;
		if(type_form == 1){
			$(".tampil").hide();
			$.ajax({
			type: 'POST',
			url: 'desaign/awb_bl.php',
			data: {id : type_form },
			success: function(dataString){
				$('.datas').html(dataString);;
			}
		});
		} else if(type_form == 2){
			$(".tampil").show();
			$.ajax({
			type: 'POST',
			url: 'desaign/awb_bl.php',
			data: {id : 3 },
			success: function(dataString){
				$('.datas').html(dataString);;
				}
			});
		}
}  
function Warehouse() {
    var get_items = document.getElementById("my_multi_select2");
	var sum_early	= 0;
	var ttl			= 0;
	var combined	= parseInt(document.getElementById("combined").value);
	var result_join	= parseInt(document.getElementById("result_join").value);
	
	var potong,data,val_early;
	
	for (var i = 0; i < get_items.options.length; i++) {
        if(get_items.options[i].selected ==true){
			data	= get_items.options[i].value;
			potong	= data.split(" - ");
			val_early = potong[4].replace("Kg","");
			sum_early = parseInt(val_early) + parseInt(sum_early);
			ttl		  = parseInt(ttl) + 1 ;
          }
      }
	  document.getElementById("sum_early").value = ttl;
	  document.getElementById("sum_weight").value = sum_early;
	  document.getElementById("pcs").value = parseInt(ttl) - parseInt(combined) + parseInt(result_join);
}  
function ResultJoin() {
	var ttl			= parseInt(document.getElementById("sum_early").value);
	var combined	= parseInt(document.getElementById("combined").value);
	var result_join	= parseInt(document.getElementById("result_join").value);
	
	  document.getElementById("pcs").value = parseInt(ttl) - parseInt(combined) + parseInt(result_join);
}  
</script>

</body>
<!-- END BODY -->
</html>