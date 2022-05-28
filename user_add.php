<!DOCTYPE html>

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

//add by panji 5-3-18
if(isset($_POST['submit'])){
	$hasil		= $conf->rd(3) ;
	$username 	= $_POST['username'];
	$fullname 	= $_POST['fullname'];
	$password 	= md5($_POST['password']);
	$hash_psw 	= $password. $hasil;
	$division 	= $_POST['division'];
	$district 	= $_POST['district'];
	$level 		= $_POST['level'];
	$group_menu	= $_POST['group_menu'];
	$mobile_no 	= $_POST['mobile_no'];
	$email		= $_POST['email'];
	$status 	= 1;
	$cek_pass	= $conf->get_password_unique($con,$password);
	
	if(mysqli_num_rows($cek_pass)>=1){
		$keterangan	= "pass";
	} else {
		$insert		= $conf->ins_user($con,$username, $fullname, $hash_psw, $division, $district, $level, $group_menu, $mobile_no, $email, $status);	
		if($insert){
			$keterangan	= "success";
		} else {
			$keterangan = "gagal";
		}
	}
}
//add end by panji 5-3-18	
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
						<a href="user_add.php">Add User</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="portlet box green ">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-gift"></i> Add User
						</div>
					</div>
					<div class="portlet-body form">
<?php if($keterangan == "success"){ ?>
						<div class="alert alert-success display-show">
							<button class="close" data-close="alert"></button>
							<span>
							Your Data Has Been Inserted, Thank You </span>
						</div>
<?php echo "<script>window.setTimeout(function () {location.href='user_list.php';}, 700);</script>";
} else if($keterangan == "gagal"){ ?>
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
									<input name="username" type="text" autocomplete="off" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >FullName</label>
								</div>
								<div class="col-md-9">
									<input name="fullname" type="text" autocomplete="off" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >Password</label>
								</div>
								<div class="col-md-9">
									<input name="password" type="password" autocomplete="off" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >Division</label>
								</div>
								<div class="col-md-9">
									<select class="form-control" name="division">
<?php
	$get_div	= $conf->get_division($con);
	while ($row	= mysqli_fetch_assoc($get_div)){
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
									<label class="control-label" >Level</label>
								</div>
								<div class="col-md-9">
									<select class="form-control" name="level">
<?php	
	$get_level	= $conf->get_level($con);
	while ($row	= mysqli_fetch_assoc($get_level)){
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
									<label class="control-label" >Group Menu</label>
								</div>
								<div class="col-md-9">
									<select class="form-control" name="group_menu">
<?php	
	$get_group_menu	= $conf->get_group_menu($con);
	while ($row	= mysqli_fetch_assoc($get_group_menu)){
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
									<label class="control-label" >Mobile No</label>
								</div>
								<div class="col-md-9">
									<input name="mobile_no" type="text" autocomplete="off" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >Email</label>
								</div>
								<div class="col-md-9">
									<input name="email" type="text" autocomplete="off" class="form-control">
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






