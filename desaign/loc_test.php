<?php
include "configuration.php";
include "databases.php";
if(isset($_POST['id'])){
$query_country	= $conf->get_location_detail_price($con,$_POST['id']);
$data_country		= mysqli_fetch_assoc($query_country);
if($_POST['type'] == "coupro"){
?>
<div class="form-group">
	<div class="col-md-2">
		<label class="control-label">Provience</label>
	</div>
	<div class="col-md-3">
		<input type="text" disabled value="<?php echo $data_country['provience'] ?>" class="form-control"/>
	</div>
	</div>
<div class="form-group">
	<div class="col-md-2">
		<label class="control-label">Country</label>
	</div>
	<div class="col-md-3">
		<input type="text" disabled value="<?php echo $data_country['Country'] ?>" class="form-control"/>
	</div>
	
	</div>
	<p>_______________________________________________________________________________________________________________________</p>
	
<?php }} ?>