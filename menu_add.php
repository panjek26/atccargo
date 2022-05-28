<!DOCTYPE html>

<html lang="en" class="no-js">
<head>
<?php 
$header		= 20;
$subheader	= "Menu";
include "desaign/configuration.php";
include "desaign/databases.php";
include "desaign/title.php" ;
include "desaign/css.php";
include "desaign/session.php";
$keterangan	= "";

if(isset($_POST['submit'])){
	$name			= $_POST['name'];
	$menu			= $_POST['menu'];
	$status			= 1;
	$ttl_menu		= count($menu);
	
	$insert	= $conf->ins_group_menu_name($con,$name,$status);
	if($insert){
		$check_gr_menu	= $conf->check_group_menu_name($con,$name);
		$row_data		= mysqli_fetch_assoc($check_gr_menu);
		$cek_id			= "";
		
		$conf->ins_group_menu($con,'1000',$row_data['id']);
		
		for($awal=0;$awal<$ttl_menu;$awal++){
		$conf->ins_group_menu($con,$menu[$awal],$row_data['id']);
			if($cek_id !== substr($menu[$awal],0,2)){ 
				$cek_id	= substr($menu[$awal],0,2);
				$conf->ins_group_menu($con,substr($menu[$awal],0,2).'00',$row_data['id']);
			}
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
						<a href="index.php">Dashboard</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="menu_add.php">Add Group Menu</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="portlet box green ">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-th-list"></i> Add Group Menu
						</div>
					</div>
					<div class="portlet-body form">
<?php if($keterangan == "success"){ ?>
						<div class="alert alert-success display-show">
							<button class="close" data-close="alert"></button>
							<span>
							Your Data Has Been Inserted, Thank You</span>
						</div>
<?php	echo "<script>window.setTimeout(function () {location.href='menu_list.php';}, 700);</script>";
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
						
					<form class="form-horizontal" action="" method="post" role="form">
						<div class="form-body">
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label" >Name Group Menu</label>
								</div>
								<div class="col-md-9">
									<input name="name" type="text" autocomplete="off" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<h3>List Menu :</h3>
								
<?php 
$dft=$conf->get_dft_menu($con);
while($row=mysqli_fetch_assoc($dft)){ 
if($row['tipe']=='2'){ ?>		
								<div class="col-md-12">
									<h4><i class="fa fa-slack"></i><b> <?php echo $row['nama_menu'] ?></b></h4>
								</div>
<?php 
} else if($row['tipe']=='3'){ ?>
								<div class="col-md-12">
                                     <h4><input type="checkbox"  class="form-control" name="menu[]" value="<?php echo $row['menu_id'] ?>"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <?php echo $row['nama_menu'] ?> </h4>
                                   
								</div>
<?php	
}  }
?>
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
