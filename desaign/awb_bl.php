<?php
include "configuration.php";
include "databases.php";
if($_POST['id'] == 1){
?>
<div class="form-group">
	<div class="col-md-2">
		<label class="control-label">AWB / BL Number</label>
	</div>
	<div class="col-md-3">
		<input type="text" name="awb_number" id="awb_number" class="form-control"/>
	</div>
	<div class="col-md-1">
	</div>
	<div class="col-md-2">
		<label class="control-label">Delivery Number</label>
	</div>
	<div class="col-md-3">
		<input type="text" name="delivery_number" id="delivery_number" class="form-control"/>
	</div>
</div>
	
<?php 
} else if($_POST['id'] == 2){ ?>
<div class="form-group">
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
<?php	
} else {
} ?>