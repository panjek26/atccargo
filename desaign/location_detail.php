<?php
include "configuration.php";
include "databases.php";
if(isset($_POST['id']) or isset($_POST['type'])){
$query_country	= $conf->get_location_detail($con,$_POST['id']);
$data_country	= mysqli_fetch_assoc($query_country);
$query_city		= $conf->get_location_detail($con,$data_country['id']);
$data_city		= mysqli_fetch_assoc($query_city);
$query_province	= $conf->get_location_detail($con,$data_city['id']);
$data_province	= mysqli_fetch_assoc($query_province);
$query_price	= $conf->get_price($con,"","","","","","","","",$_POST['shipping'],"",$_POST['from'],$_POST['to']);
$data_price		= mysqli_fetch_assoc($query_price);
if($_POST['type'] == "coupro"){
?>
<div class="form-group">
	<div class="col-md-2">
		<label class="control-label">Country</label>
	</div>
	<div class="col-md-3">
		<input type="text" disabled value="<?php echo $data_country['Country'] ?>" class="form-control"/>
	</div>
	<div class="col-md-1">
		
	</div>
	<div class="col-md-2">
		<label class="control-label">Province</label>
	</div>
	<div class="col-md-3">
		<input type="text" disabled value="<?php echo $data_province['provience'] ?>" class="form-control"/>
	</div>
</div>
<?php } else if($_POST['type'] == "city"){ ?>
	<div class="col-md-2">
		<label class="control-label">City</label>
	</div>
	<div class="col-md-3">
		<input type="text" disabled value="<?php echo $data_city['city'] ?>" class="form-control"/>
	</div>


<?php } else if($_POST['type'] == "price"){ 
	if(!empty($_POST['price'])){
		$show_price	= $_POST['price'];
	} else {
		$show_price	= $data_price['price'];
	}
?>
	<input name="shipping_price" id="shipping_price"  onchange="myTax()" type="text" autocomplete="off" value="<?php echo $show_price ?>" class="form-control numeric">
	
  <script>
    $(".numeric").lazzynumeric();
  </script>
<?php }} ?>

