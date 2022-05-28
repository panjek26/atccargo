<!DOCTYPE html>

<html lang="en" class="no-js">
<head>
<?php 
$header		= 30;
$subheader	= "Shipping Operational";
include "desaign/configuration.php";
include "desaign/databases.php";
include "desaign/title.php" ;
include "desaign/css.php";
include "desaign/session.php";
$keterangan	= "";

if(isset($_POST['submit'])){
	$id_resi 			= $_POST['id_resi'];
	$sender_type		= $_POST['sender_type'];
	$recipient_type		= $_POST['recipient_type'];
	$sender_id			= $_POST['customer_id'];
	$receipt_id			= $_POST['receipt_id'];
	$receipt_district	= $_POST['district'];
	$receipt_address	= $_POST['detail_address'];
	$amount				= $_POST['amount'];
	$weight				= $_POST['weight'];
	$get_resi			= $conf->get_resi($con,$id_resi);
	$data_resi			= mysqli_fetch_assoc($get_resi);
	if($sender_type == 2){
		$sender_phone	= $_POST['customer_phone'];
		$sender_district= $data_resi['district'];
		$sender_id	 	= $conf->ins_customer($con,$sender_id,$sender_district,$sender_phone,"");
	}
	if($recipient_type == 2){
		$receipt_phone	= $_POST['receipt_phone'];
		$receipt_id	 	= $conf->ins_customer($con,$receipt_id,$receipt_district,$receipt_phone,$receipt_address);
	}
	$update	= $conf->update_shipping_operational($con,$id_resi,$sender_id,$receipt_id,$receipt_district,$weight,$amount);
	if($update == "sukses"){
		$get_items	= $conf->get_warehouse_item($con,"",$id_resi);
		while($Row	= mysqli_fetch_assoc($get_items)){
			$conf->upd_warehouse_item_operational($con,$Row['id'],$_POST['weight'.$Row['id']],$_POST['description'.$Row['id']],
			$_POST['packing'.$Row['id']], $_POST['isurance'.$Row['id']], $_POST['status_item'.$Row['id']], $_POST['name_item'.$Row['id']]);
		}
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
						<a href="shipping_operational.php">Shipping Operational</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<!-- BEGIN TAB PORTLET-->
				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-codepen"></i> Shipping Operational
						</div>
					</div>
					<div class="portlet-body">
						<div class="tab-content">	
								<div class="portlet-body">
<?php if($keterangan == "success"){ ?>
						<div class="alert alert-success display-show">
							<button class="close" data-close="alert"></button>
							<span>
							Your Data Has Been Updated, Thank You</span>
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
								<form id="myform" class="form-horizontal" action="" method="post" role="form" enctype="multipart/form-data">
									<div class="form-body form">
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
												<option value="<?php echo $row['id']."|".$row['receive_location']."|".$row['sender']."|".
												$row['receive']."|".$row['weight']."|".$row['amount_insurance']?>"><?php echo $row['receipt_number'] ?></option>
<?php	
	}
?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-2">
												<label class="control-label" >Sender Type </label>
												<input type="hidden" name="id_resi" id="id_resi">
											</div>
											<div class="col-md-3">
												<select class="form-control" name="sender_type" id="sender_type" onchange="mySender()">
													<option value=""></option>
<?php	
	$get_customer_type	= $conf->get_customer_type($con);
	while ($row	= mysqli_fetch_assoc($get_customer_type)){
?>
													<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
<?php	
	}
?>
												</select>
											</div>
											<div class="col-md-1">
												
											</div>
											<div class="col-md-2">
												<label class="control-label" >Recipient Type </label>
											</div>
											<div class="col-md-3">
												<select class="form-control" name="recipient_type" id="recipient_type" onchange="myReceipient()">
													<option value=""></option>
<?php	
	$get_customer_type	= $conf->get_customer_type($con);
	while ($row	= mysqli_fetch_assoc($get_customer_type)){
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
												<label class="control-label" >Sender Name </label>
											</div>
											<div class="col-md-3">
												<div class="sender_name"></div>
											</div>
											<div class="col-md-1">
												
											</div>
											<div class="col-md-2">
												<label class="control-label" >Recipient Name </label>
											</div>
											<div class="col-md-3">
												<div class="receipt_name"></div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-2">
												<label class="control-label" >Sender Phone No </label>
											</div>
											<div class="col-md-3">
												<input name="customer_phone" id="customer_phone" type="text" autocomplete="off" class="form-control"> 
											</div>
											<div class="col-md-1">
												
											</div>
											<div class="col-md-2">
												<label class="control-label" >Recipient Phone No </label>
											</div>
											<div class="col-md-3">
												<input name="receipt_phone" id="receipt_phone" type="text" autocomplete="off" class="form-control"> 
											</div>
										</div>
										<hr>
										<h4>Recipient Location</h4>
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
												<label class="control-label" >Detail Address</label>
											</div>
											<div class="col-md-3">
											<textarea name="detail_address" id="detail_address" class="form-control"></textarea>
											</div>
											<div class="col-md-6">
												
											</div>
											
										</div>
										<hr>
										<h4>Data Items</h4>
										<div class="table-container">
											<table class="table table-striped table-bordered table-hover">
											<thead>
												<tr role="row" class="heading">
													<th>No</th>
													<th>Item Names</th>
													<th>Weight Of Goods</th>
													<th>Description</th>
													<th>Packing</th>
													<th>Value Of Insurance</th>
													<th>Status</th>
												</tr>
											</thead>
												<tbody class="data_items">
											</tbody>
											</table>
										</div>
										<div class="form-group">
											<div class="col-md-2">
												<label class="control-label" >Weight Total</label>
											</div>
											<div class="col-md-3">
												<input type="text" name="weight" id="weight" class="form-control">
											</div>
											<div class="col-md-1">
												
											</div>
											<div class="col-md-2">
												<label class="control-label" >Amount Total</label>
											</div>
											<div class="col-md-3">
												<input type="text" name="amount" id="amount" class="form-control numeric">
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
<script type="text/javascript">
function mySender() {
    var send_type = document.getElementById("sender_type").value;
	if(send_type){
		$.ajax({
			type: 'POST',
			url: 'desaign/data_type.php',
			data: {id : send_type, type : "send_name"},
			success: function(dataString){
				$('.sender_name').html(dataString);;
			}
		});
	}
	if(send_type == 2){
		document.getElementById('customer_phone').value="";
	}
}
function myReceipient() {
    var receipt_type = document.getElementById("recipient_type").value;
	if(receipt_type){
		$.ajax({
			type: 'POST',
			url: 'desaign/data_type.php',
			data: {id : receipt_type, type : "receipt_name"},
			success: function(dataString){
				$('.receipt_name').html(dataString);;
			}
		});
	}
	if(receipt_type == 2){
		document.getElementById('receipt_phone').value="";
		document.getElementById('detail_address').value="";
	}
}
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
function Receipt() {
    var receipt = document.getElementById("receipt").value;
	var potong	= receipt.split("|");
	var coupro	= potong[1];
	var sender	= potong[2];
	var reveiver= potong[3];
	var weight	= potong[4];
	var amount	= potong[5];
		if(receipt){
			$.ajax({
				type: 'POST',
				url: 'desaign/data_items.php',
				data: {id : potong[0]},
				success: function(dataString){
					$('.data_items').html(dataString);;
				}
			});
		document.getElementById("mydistrict").value=coupro;
		document.getElementById("id_resi").value=potong[0];
		document.getElementById("weight").value=weight;
		document.getElementById("amount").value=amount;
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
			if(sender){
				var send_type = 1;
				document.getElementById("sender_type").value=send_type;
				if(send_type){
					$.ajax({
						type: 'POST',
						url: 'desaign/data_type.php',
						data: {id : send_type, data_send : sender, type : "send_name"},
						success: function(dataString){
							$('.sender_name').html(dataString);;
						}
					});
				}

			} else {
				document.getElementById("sender_type").value="";
				document.getElementById('customer_phone').value="";
				document.getElementById('customer_id').value="";
			}
			if(reveiver){
				var receipt_type = 1;
				document.getElementById("recipient_type").value=receipt_type;
				if(receipt_type){
					$.ajax({
						type: 'POST',
						url: 'desaign/data_type.php',
						data: {id : receipt_type, data_recipient : reveiver, type : "receipt_name"},
						success: function(dataString){
							$('.receipt_name').html(dataString);;
						}
					});
				}

			} else {
				document.getElementById("recipient_type").value="";
				document.getElementById('customer_phone').value="";
				document.getElementById('customer_id').value;
				document.getElementById("receipt_id").value="";
				document.getElementById("receipt_phone").value="";
				document.getElementById("detail_address").value="";
			}			
		}
}

   $(".numeric").lazzynumeric();
</script>
</body>
<!-- END BODY -->
</html>








