<?php

include "configuration.php";
include "databases.php";

if($_POST['id']){
	$nomor		= 1;
	$query_data	= $conf->get_warehouse_item($con,"",$_POST['id']);
	while ($Row	= mysqli_fetch_assoc($query_data)){
	?>
	<tr>
		<td><?php echo $nomor; ?></td>
		<td>
			<select class="form-control" name="name_item<?php echo $Row['id']; ?>" id="name_item">
				<option value=""></option>
<?php	
$get_items	= $conf->get_items($con,2);
while ($row	= mysqli_fetch_assoc($get_items)){
	$selected	= "";
	if($Row['id_items']==$row['id']){
		$selected	= "selected";
	}
?>
				<option value="<?php echo $row['id'] ?>" <?php echo $selected ?>><?php echo $row['name'] ?> </option>
<?php	
}
?>
			</select>
		</td>
		<td><input name="weight<?php echo $Row['id']; ?>" id="weight<?php echo $nomor;?>" value="<?php echo !empty($Row['weight']) ? $Row['weight'] : 0; ?>"
		type="text" autocomplete="off" onchange="hitung_data()" class="form-control"></td>
		<td><input name="description<?php echo $Row['id']; ?>" type="text" autocomplete="off" class="form-control" value="<?php echo $Row['description'] ?>"></td>
		<td><input name="packing<?php echo $Row['id']; ?>" type="text" autocomplete="off" class="form-control" value="<?php echo $Row['packing'] ?>"></td>
		<td><input name="isurance<?php echo $Row['id']; ?>" id="isurance<?php echo $nomor;?>" value="<?php echo !empty($Row['insurance']) ? $Row['insurance'] : 0; ?>"
		type="text" autocomplete="off" onchange="hitung_data()" class="form-control numeric"></td>
		<td>
			<select class="form-control" required name="status_item<?php echo $Row['id']; ?>" id="status_item">
				<option value=""></option>
<?php	
$get_warehouse_item_status	= $conf->get_warehouse_item_status($con);
while ($row	= mysqli_fetch_assoc($get_warehouse_item_status)){
		$selected	= "";
	if($Row['status']==$row['id']){
		$selected	= "selected";
	}
?>
				<option value="<?php echo $row['id'] ?>" <?php echo $selected ?>><?php echo $row['name'] ?> </option>
<?php	
}
?>
			</select>
		</td>
	</tr>
<?php $nomor++;		
	}
?>
	<input type="hidden" id="last_number" value="<?php echo $nomor; ?>">
<script>
function hitung_data() {
	var weight		= 0;
	var isurance	= 0;
	var last_number = document.getElementById("last_number").value
	for( var awal=1; awal<last_number; awal++){
		weight = parseInt(document.getElementById("weight" + awal).value) + parseInt(weight);
		isurance = parseInt(document.getElementById("isurance" + awal).value.replace(/,/g,"")) + parseInt(isurance);
	}
	document.getElementById("weight").value=weight;
	document.getElementById("amount").value=isurance;
}
    $(".numeric").lazzynumeric();
</script>
<?php
}  ?>

