<!DOCTYPE html>
<?php if(isset($_POST['detail']) or isset($_POST['submit']) or isset($_POST['change_data'])){  ?>
<html lang="en" class="no-js">
<head>

<?php

$header		= 20;
$subheader	= "User";
include "desaign/configuration.php";
include "desaign/databases.php";
include "desaign/title.php" ;
include "desaign/css.php";
include "desaign/session.php";
$keterangan	= "";
$id			= $_POST['id'];
$user		= $conf->get_user($con,1,$id);
$list_user	= mysqli_fetch_assoc($user);
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
	$username			= $_POST['id'];
	$fullname			= $_POST['fullname'];
	if($_POST['password'] == $_POST['old_pass']){
	$hash_psw			= $_POST['password'];
	} else {
	$hasil				= $conf->rd(3) ;
	$password 			= md5($_POST['password']);
	$hash_psw			= $password. $hasil;
	}
	$division			= $_POST['division'];
	$district			= $_POST['district'];
	$level				= $_POST['level'];
	$gropmenu			= $_POST['gropmenu'];
	$mobile_no			= $_POST['mobile_no'];
	$email				= $_POST['email'];
	$status				= $_POST['status'];
	
	$cek_pass	= $conf->get_password_unique($con,$password);
	
	if(mysqli_num_rows($cek_pass)>=1){
		$keterangan	= "pass";
	} else {
		$update			= $conf->upd_data_user($con, $username, $fullname, $hash_psw, $division, $district, $level, $gropmenu, $mobile_no, $email, $status);
		if(update){
			$keterangan = "success";
		} else {
			$keterangan = "gagal";
		}
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
						<a href="index.php">Dashboard</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="user_list.php">User Detail</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="portlet box green ">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-users"></i> User Detail
						</div>
					</div>
					<div class="portlet-body form">
<?php if($keterangan == "success"){ ?>
						<div class="alert alert-success display-show">
							<button class="close" data-close="alert"></button>
							<span>
							Your Data Has Been Update, Thank You</span>
						</div>
<?php	echo "<script>window.setTimeout(function () {location.href='user_list.php';}, 700);</script>";
} else if($keterangan == "gagal"){ 
?>
						<div class="alert alert-danger display-show">
							<button class="close" data-close="alert"></button>
							<span>
							Oooppss, data not match, please cek again</span>
						</div>
<?php
} else if($keterangan == "pass"){ ?>
						<div class="alert alert-danger display-show">
							<button class="close" data-close="alert"></button>
							<span>
							Oooppss, Your Password is Wrong Please Change Password Unique</span>
						</div>
<?php
} else {
	
}
?>
						
					<form class="form-horizontal" action="" method="post" role="form">
						<div class="form-body">
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >UserName</label>
								</div>
								<div class="col-md-9">
									<input name="username" disabled value="<?php echo $list_user['username'] ?>" type="text" autocomplete="off" class="form-control">
									<?php echo $id_hidden; ?>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >FullName</label>
								</div>
								<div class="col-md-9">
									<input name="fullname" <?php  echo $readonly ?> value="<?php echo $list_user['fullname'] ?>" type="text" autocomplete="off" class="form-control">
									<?php echo $id_hidden; ?>
								</div>
							</div>
														<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >Password</label>
								</div>
								<div class="col-md-9">
									<input type ="password" name="password" <?php  echo $readonly ?> value="<?php echo $list_user['password'] ?>" type="text" autocomplete="off" class="form-control">
									<input type="hidden" name="old_pass" value="<?php echo $list_user['password'] ?>" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >Division</label>
								</div>
								<div class="col-md-9">
									<select class="form-control" <?php  echo $readonly ?> name="division">
<?php
	$get_div	= $conf->get_division($con);
	while ($row	= mysqli_fetch_assoc($get_div)){
		$selected	= "";
	if($list_user['id_division']==$row['id']){
		$selected	= "selected";
	}
		
?>
										<option value="<?php echo $row['id'] ?>"<?php echo $selected ?>> <?php echo $row['name'] ?></option>
<?php	
	}
?>
									</select>
								</div>
							</div>

						<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" name="district">District</label>
								</div>
								<div class="col-md-3">
									<select class="form-control" <?php  echo $readonly ?> name="district" id="mydistrict" onchange="myDistrict()">
<?php	
	$get_dis	= $conf->get_location($con,1);
	while ($row	= mysqli_fetch_assoc($get_dis)){
	$selected	= "";
	if($list_user['district']==$row['id']){
		$selected	= "selected";
	}
?>
										<option value="<?php echo $row['id'] ?>" <?php echo $selected ?>><?php echo $row['location_name'] ?></option>
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
									<label class="control-label" >Level</label>
								</div>
								<div class="col-md-9">
									<select class="form-control" <?php  echo $readonly ?> name="level">
<?php
	$get_lev	= $conf->get_level($con);
	while ($row	= mysqli_fetch_assoc($get_lev)){
		$selected	= "";
	if($list_user['level']==$row['id']){
		$selected	= "selected";
	}
		
?>
										<option value="<?php echo $row['id'] ?>"<?php echo $selected ?>> <?php echo $row['name'] ?></option>
<?php	
	}
?>
									</select>
								</div>
							</div>
							
																					<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >Group Menu</label>
								</div>
								<div class="col-md-9">
									<select class="form-control" <?php  echo $readonly ?> name="gropmenu">
<?php
	$get_menu_grp	= $conf->get_group_menu($con);
	while ($row	= mysqli_fetch_assoc($get_menu_grp)){
		$selected	= "";
	if($list_user['group_menu']==$row['id']){
		$selected	= "selected";
	}
		
?>
										<option value="<?php echo $row['id'] ?>"<?php echo $selected ?>> <?php echo $row['name'] ?></option>
<?php	
	}
?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >Mobile Phone</label>
								</div>
								<div class="col-md-9">
									<input name="mobile_no" <?php  echo $readonly ?> value="<?php echo $list_user['mobile_no'] ?>" type="text" autocomplete="off" class="form-control">
									<?php echo $id_hidden; ?>
								</div>
							</div>
														<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >Email</label>
								</div>
								<div class="col-md-9">
									<input name="email" <?php  echo $readonly ?> value="<?php echo $list_user['email'] ?>" type="text" autocomplete="off" class="form-control">
									<?php echo $id_hidden; ?>
								</div>
							</div>
																					<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >Status</label>
								</div>
								<div class="col-md-9">
									<select class="form-control" <?php  echo $readonly ?> name="status">
<?php
	$get_stats	= $conf->get_status($con);
	while ($row	= mysqli_fetch_assoc($get_stats)){
		$selected	= "";
	if($list_user['id_status']==$row['id']){
		$selected	= "selected";
	}
		
?>
										<option value="<?php echo $row['id'] ?>"<?php echo $selected ?>> <?php echo $row['name'] ?></option>
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
<script type="text/javascript">

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
</script>




<?php } ?>