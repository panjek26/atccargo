<!DOCTYPE html>

<html lang="en" class="no-js">
<head>
<?php 
$header		= 50;
$subheader	= "Accounting Income";
include "desaign/configuration.php";
include "desaign/databases.php";
include "desaign/title.php" ;
include "desaign/css.php";
include "desaign/session.php";
$keterangan	= "";

if(isset($_POST['submit'])){
	$id_resi 			= $_POST['id_resi'];
	$resi_date 			= $_POST['resi_date'];
	$district 			= $_POST['district'];
	$shipping_price 	= str_replace(",","",$_POST['shipping_price']);
	$weight				= $_POST['weight'];
	$packing_cost 		= str_replace(",","",$_POST['packing_cost']);
	$awb_fee 			= str_replace(",","",$_POST['awb_fee']);
	$insurance_number	= str_replace(",","",$_POST['insurance_number']);
	$tax_number 		= str_replace(",","",$_POST['tax_number']);
	$discount 			= str_replace(",","",$_POST['discount']);
	$payment 			= $_POST['payment'];
	$sum_price 			= str_replace(",","",$_POST['sum_price']);
	$already_paid 		= str_replace(",","",$_POST['already_paid']);
	$remaning_paid 		= str_replace(",","",$_POST['remaning_paid']);
		
	$update		= $conf->update_accounting_income($con,$id_resi,$resi_date,$district,$shipping_price,$weight,$packing_cost,$awb_fee,
	$insurance_number,$tax_number,$discount,$payment,$sum_price,$already_paid,$remaning_paid,3);
	if($update == "sukses"){		
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
						<a href="accounting_income.php">Accounting Income</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<!-- BEGIN TAB PORTLET-->
				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-money"></i> Accounting Income
						</div>
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="accounting_income.php">
								Insert Data </a>
							</li>
							<li>
								<a href="accounting_income_list.php">
								List Data </a>
							</li>
						</ul>
					</div>
					<div class="portlet-body">
						<div class="tab-content">
							<div class="tab-pane active" id="portlet_tab1">			
								<div class="portlet-body">
<?php if($keterangan == "success"){ ?>
						<div class="alert alert-success display-show">
							<button class="close" data-close="alert"></button>
							<span>
							Your Data Has Been Updated, Thank You</span>
						</div>
<?php	echo "<script>window.setTimeout(function () {location.href='accounting_income_list.php';}, 700);</script>";
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
								<form id="myform" class="form-horizontal" action="" method="post" role="form" enctype="multipart/form-data">
									<div class="form-body">
										<div class="form-group">
											<div class="col-md-2">
												<label class="control-label" >Receipt Number</label>
											</div>
											<div class="col-md-9">
												<select name="resi" class="form-control select2me" data-placeholder="Select..." id="receipt" onchange="Receipt()">
													<option value=""></option>
<?php
$get_resi	= $conf->get_resi($con);
while ($row	= mysqli_fetch_assoc($get_resi)){
?>
												<option value="<?php echo $row['id']."|".$row['date_inserted']."|".$row['district']."|".$row['shipping']."|".
												$row['receive_location']."|".$row['shipping_price']."|".$row['weight']."|".$row['packing_cost']."|".
												$row['awb_fee']."|".$row['insurance']."|".$row['tax']."|".$row['discount']."|".$row['payment_type']."|".
												$row['sum_price']."|".$row['already_price']."|".$row['remaining_price']."|".$row['receipt_date_accounting']?>"><?php echo $row['receipt_number'] ?></option>
<?php	
	}
?>
												</select>
											</div>
										</div>
<script type="text/javascript">
	function Receipt() {
		var receipt = document.getElementById("receipt").value;
		var potong	= receipt.split("|");
			document.getElementById('sales_order_date').value=potong[1];
			document.getElementById('id_resi').value=potong[0];
			document.getElementById('mydistrict').value=potong[4];
			document.getElementById('resi_date').value=potong[16];
			document.getElementById('weight').value=potong[6];
			document.getElementById('packing_cost').value=potong[7];
			document.getElementById('awb_fee').value=potong[8];
			document.getElementById('insurance_number').value=potong[9];
			document.getElementById('tax_number').value=potong[10];
			document.getElementById('discount').value=potong[11];
			document.getElementById('payment').value=potong[12];
			document.getElementById('sum_price').value=potong[13];
			document.getElementById('already_paid').value=potong[14];
			document.getElementById('remaning_paid').value=potong[15];
		var coupro = potong[4];
		var shipping_price = potong[5];
		var receipt = document.getElementById("receipt").value;
		var potong	= receipt.split("|");
		var from_data	= potong[2];
		var shipping_data	= potong[3];
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
				$.ajax({
					type: 'POST',
					url: 'desaign/location_detail.php',
					data: {to : coupro, from : from_data, shipping : shipping_data, price: shipping_price, type : "price"},
					success: function(dataString){
						$('.price').html(dataString);;
					}
				});
	}
</script>
										<div class="form-group">
											<div class="col-md-2">
												<label class="control-label" >Receipt Date </label>
											</div>
											<div class="col-md-3">
												<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
													<input name="resi_date" id="resi_date" type="text" class="form-control">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
											<div class="col-md-1">
												
											</div>
											<div class="col-md-2">
												<label class="control-label" >Sales Order Date</label>
												<input type="hidden" name="id_resi" id="id_resi">
											</div>
											<div class="col-md-3">
												<input name="sales_order_date" id="sales_order_date" readonly type="text" autocomplete="off" class="form-control">
											</div>
										</div>
										<hr>
										<h4>Receive Location</h4>
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
<script type="text/javascript">
function myDistrict() {
    var coupro = document.getElementById("mydistrict").value;
	var receipt = document.getElementById("receipt").value;
	var potong	= receipt.split("|");
	var from_data	= potong[2];
	var shipping_data	= potong[3];
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
			$.ajax({
				type: 'POST',
				url: 'desaign/location_detail.php',
				data: {to : coupro, from : from_data, shipping : shipping_data, type : "price"},
				success: function(dataString){
					$('.price').html(dataString);;
				}
			});
		}
}
</script>
										<div class="coupro"></div>
										<hr>
										<h4>Calculation SUM</h4>
										<div class="form-group">
											<div class="col-md-2">
												<label class="control-label" >Shipping Price / KG </label>
											</div>
											<div class="col-md-3">
												<div class="price"></div>
												<!-- <input name="shipping_price" id="shipping_price" type="text" autocomplete="off" class="form-control"> !-->
											</div>
											<div class="col-md-1">
												
											</div>
											<div class="col-md-2">
												<label class="control-label" >Weight Total</label>
											</div>
											<div class="col-md-3">
												<input name="weight" id="weight" type="text" autocomplete="off" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-2">
												<label class="control-label" >Packing Cost </label>
											</div>
											<div class="col-md-3">
												<input name="packing_cost" id="packing_cost" type="text" autocomplete="off" class="form-control numeric">
											</div>
											<div class="col-md-1">
												
											</div>
											<div class="col-md-2">
												<label class="control-label" >AWB Fee</label>
											</div>
											<div class="col-md-3">
												<input name="awb_fee" id="awb_fee" type="text" autocomplete="off" class="form-control numeric">
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-2">
												<label class="control-label" >Insurance </label>
											</div>
											<div class="col-md-1">
												<select class="form-control" name="insurance" id="insurance"  onchange="myTax()">
													<option value=""></option>
<?php	
	$get_cost	= $conf->get_cost($con,1,"",1);
	while ($row	= mysqli_fetch_assoc($get_cost)){
?>
													<option value="<?php echo $row['cost'] ?>"><?php echo $row['cost'] ?> </option>
<?php	
	}
?>
												</select>
											</div>
<script type="text/javascript">
	function myTax() {
		var insurance 		= document.getElementById("insurance").value;
		var tax 			= document.getElementById("tax").value;
		var discount		= document.getElementById("discount").value.replace(/,/g,"");
		var already_paid	= document.getElementById("already_paid").value.replace(/,/g,"");
		var shipping_price 	= document.getElementById("shipping_price").value.replace(/,/g,"");
		var weight 			= document.getElementById("weight").value;
		var packing_cost 	= document.getElementById("packing_cost").value.replace(/,/g,"");
		var awb_fee		 	= document.getElementById("awb_fee").value.replace(/,/g,"");
		var total_insurance	= ((shipping_price * weight) + parseInt(packing_cost) + parseInt(awb_fee)) * (insurance / 100);
		var total_tax		= ((shipping_price * weight) + parseInt(packing_cost) + parseInt(awb_fee)) * (tax / 100);
		var sum_price		= (shipping_price * weight) + parseInt(packing_cost) + parseInt(awb_fee) + parseInt(total_insurance) + parseInt(total_tax) - parseInt(discount);
		var remaning_paid 	= parseInt(sum_price) - parseInt(already_paid);
			document.getElementById('insurance_number').value=total_insurance;
			document.getElementById('tax_number').value=total_tax;
			document.getElementById('sum_price').value=sum_price;
			document.getElementById('remaning_paid').value=remaning_paid;
	}
</script>
											<div class="col-md-2">
												<input name="insurance_number" id="insurance_number" type="text" autocomplete="off" class="form-control numeric">
											</div>
											<div class="col-md-1">
												
											</div>
											<div class="col-md-2">
												<label class="control-label" >Tax </label>
											</div>
											<div class="col-md-1">
												<select class="form-control" name="tax" id="tax" onchange="myTax()">
													<option value=""></option>
<?php	
	$get_cost	= $conf->get_cost($con,1,"",2);
	while ($row	= mysqli_fetch_assoc($get_cost)){
?>
													<option value="<?php echo $row['cost'] ?>"><?php echo $row['cost'] ?> </option>
<?php	
	}
?>
												</select>
											</div>
											<div class="col-md-2">
												<input name="tax_number" id="tax_number" type="text" autocomplete="off" class="form-control numeric">
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-2">
												<label class="control-label" >Discount </label>
											</div>
											<div class="col-md-3">
												<input name="discount" id="discount" value="0" onchange="myTax()" type="text" autocomplete="off" class="form-control numeric">
											</div>
											<div class="col-md-6">
												
											</div>	
										</div>
										<hr>
										<h4>Total Payment</h4>
										<div class="form-group">
											<div class="col-md-2">
												<label class="control-label" >Payment</label>
											</div>
											<div class="col-md-3">
												<select class="form-control" id="payment" name="payment">
													<option value=""></option>
<?php	
	$get_payment_type	= $conf->get_payment_type($con,1,"",2);
	while ($row	= mysqli_fetch_assoc($get_payment_type)){
?>
													<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?> </option>
<?php	
	}
?>
												</select>
											</div>
											<div class="col-md-1">
												
											</div>
											<div class="col-md-2">
												<label class="control-label" >Sum Price</label>
											</div>
											<div class="col-md-3">
												<input name="sum_price" id="sum_price" type="text" autocomplete="off" class="form-control numeric">
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-2">
												<label class="control-label" >Already Paid</label>
											</div>
											<div class="col-md-3">
												<input name="already_paid" id="already_paid" value="0" onchange="myTax()" type="text" autocomplete="off" class="form-control numeric">
											</div>
											<div class="col-md-1">
												
											</div>
											<div class="col-md-2">
												<label class="control-label" >Remaining Paid</label>
											</div>
											<div class="col-md-3">
												<input name="remaning_paid" id="remaning_paid" readonly type="text" autocomplete="off" class="form-control numeric">
											</div>
										</div>
									</div>
									<div class="form-group">
											<div class="col-md-2">
												
											</div>
											<div class="col-md-3">
												<button type="submit" name="submit" value="1" class="btn green">Save</button></div>
											<div class="col-md-6">
												
											</div>
										</div>
								</form>
									
								</div>
							</div>
							
							
						</div>
					</div>
				</div>
		
			</div>
					<!-- END TAB PORTLET-->
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
  <script>
    $(".numeric").lazzynumeric();
  </script>

</body>
<!-- END BODY -->
</html>








