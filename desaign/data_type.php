<?php

include "configuration.php";
include "databases.php";

if($_POST['type'] == "send_name"){
	if($_POST['id']== 1){ ?>
		<select class="form-control" name="customer_id" id="customer_id" onchange="CustomerId()">
			<option value=""></option>
<?php	
	$get_customer	= $conf->get_customer($con,2);
	while ($row	= mysqli_fetch_assoc($get_customer)){
		$selected	= "";
		if($_POST['data_send'] == $row['id']){
			$selected	= "selected";
		} 
?>
			<option value="<?php echo $row['id']."|".$row['mobile_phone'] ?>" <?php echo $selected ?>><?php echo $row['name'] ?></option>
		<?php	
		}
		?>
		</select>
<script>
	function CustomerId() {
		var cusid = document.getElementById("customer_id").value;
		var potong	= cusid.split("|");
		if(potong[1]){
			document.getElementById('customer_phone').value=potong[1];
		} else {
			document.getElementById('customer_phone').value="";
		}
	}
		var cusid = document.getElementById("customer_id").value;
		var potong	= cusid.split("|");
		if(potong[1]){
			document.getElementById('customer_phone').value=potong[1];
		} else {
			document.getElementById('customer_phone').value="";
		}
</script>
	<?php
	} else if ($_POST['id'] == 2) { ?>
		<input name="customer_id" type="text" autocomplete="off" class="form-control"> 
	<?php }
} else if ($_POST['type'] == "receipt_name"){
	if($_POST['id']== 1){ ?>
		<select class="form-control" name="receipt_id" id="receipt_id" onchange="ReceiptId()">
			<option value=""></option>
<?php	
	$get_customer	= $conf->get_customer($con,2);
	while ($row	= mysqli_fetch_assoc($get_customer)){
		$selected	= "";
		if($_POST['data_recipient'] == $row['id']){
			$selected	= "selected";
		} 
?>
			<option value="<?php echo $row['id']."|".$row['mobile_phone']."|".$row['district']."|".$row['detail_address'] ?>" <?php echo $selected ?>>
			<?php echo $row['name'] ?></option>
		<?php	
		}
		?>
		</select>
<script>
	function ReceiptId() {
		var receipt = document.getElementById("receipt_id").value;
		var potong	= receipt.split("|");
		var coupro	= potong[2];
		if(potong[1]){
			document.getElementById('receipt_phone').value=potong[1];
			document.getElementById('mydistrict').value=potong[2];
			document.getElementById('detail_address').value=potong[3];
		} else {
			document.getElementById('receipt_phone').value="";
			document.getElementById('mydistrict').value="";
			document.getElementById('detail_address').value="";
		}
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
		var receipt = document.getElementById("receipt_id").value;
		var potong	= receipt.split("|");
		var coupro	= potong[2];
		if(potong[1]){
			document.getElementById('receipt_phone').value=potong[1];
			document.getElementById('detail_address').value=potong[3];
		} else {
			document.getElementById('receipt_phone').value="";
			document.getElementById('detail_address').value="";
		}
</script>
	<?php
	} else if ($_POST['id'] == 2) { ?>
		<input name="receipt_id" type="text" autocomplete="off" class="form-control"> 
	<?php }
} ?>

