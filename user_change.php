<!DOCTYPE html>

<html lang="en" class="no-js">
<head>
<?php 
$header		= 10;
$subheader	= "Dashboard";
include "desaign/configuration.php";
include "desaign/databases.php";
include "desaign/title.php" ;
include "desaign/css.php";
include "desaign/session.php";
$keterangan	= "";

if(isset($_POST['submit'])){
	$old		= md5($_POST['old']);
	$new		= $_POST['new'];
	$confirm	= $_POST['confirm'];
	$id_usr		= $_SESSION['username'];
	
	$cek_user	= $conf->cek_user($con,$id_usr);
	$user_data	= mysqli_fetch_assoc($cek_user);
	if($old == substr($user_data['password'],0,-3) && $new == $confirm){
	
		$cek_pass	= $conf->get_password_unique($con,md5($new));
		if(mysqli_num_rows($cek_pass)>=1){
			$keterangan	= "pass";
		} else {
			$pass_en	= md5($new). $conf->rd(3);
			$update	= $conf->upd_user($con,$id_usr,$pass_en);
			if($update){
				$keterangan	= "success";
			} else {
				$keterangan = "gagal";
			}
		}
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
						<a href="index.php">Dashboard</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="user_change.php">Change Password</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="portlet box green ">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-gift"></i> Change Password Form
						</div>
					</div>
					<div class="portlet-body form">
<?php if($keterangan == "success"){ ?>
						<div class="alert alert-success display-show">
							<button class="close" data-close="alert"></button>
							<span>
							Your Password Success Change, Please logout and login back. </span>
						</div>
<?php
} else if($keterangan == "gagal"){ ?>
						<div class="alert alert-danger display-show">
							<button class="close" data-close="alert"></button>
							<span>
							Password Not Match Or Wrong Your Password </span>
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
								<div class="col-md-3">
									<label class="control-label" >Old Password</label>
								</div>
								<div class="col-md-8">
									<input name="old" type="password" autocomplete="off" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3">
									<label class="control-label" >New Password</label>
								</div>
								<div class="col-md-8">
									<input name="new" type="password" autocomplete="off" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3">
									<label class="control-label" >Confirm New Password</label>
								</div>
								<div class="col-md-8">
									<input name="confirm" type="password" autocomplete="off" class="form-control">
								</div>
							</div>
						</div>
						<div class="form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" name="submit" value="1" class="btn green">Change</button>
								</div>
						</div>
					</form>
					</div>
				</div>
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