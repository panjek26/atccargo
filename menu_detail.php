<!DOCTYPE html>
<?php if(isset($_POST['detail']) or isset($_POST['submit']) or isset($_POST['change_data'])){  ?>
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
$id			= $_POST['id'];
$list_menu	= $conf->get_menu_list($con,1,$id);
$ls_menu	= mysqli_fetch_assoc($list_menu);
$readonly	= "disabled";
$name_input	= "change_data";
$Input		= "Change Data";
$id_hidden	= "<input type='hidden' name='id' value='$id'/>";
$pecah_menu	= explode(",",$ls_menu['list_id']);
$ttl		= count($pecah_menu);
$datas		= array();
for($awal=0;$awal<$ttl;$awal++){
	$datas[]=$pecah_menu[$awal];
}

if(isset($_POST['change_data'])){
$readonly	= "";
$name_input	= "submit";
$Input		= "Save Data";
}


if(isset($_POST['submit'])){
	$id_group		= $_POST['id'];
	$name			= $_POST['name'];
	$menu			= $_POST['menu'];
	$status			= $_POST['status'];
	$ttl_menu		= count($menu);
	
	$update	= $conf->upd_group_menu_name($con,$name,$status,$id_group);
	if($update){
		$conf->del_group_menu($con,$id_group);
		$cek_id			= "";
		
		$conf->ins_group_menu($con,'1000',$id_group);
		
		for($awal=0;$awal<$ttl_menu;$awal++){
		$conf->ins_group_menu($con,$menu[$awal],$id_group);
			if($cek_id !== substr($menu[$awal],0,2)){ 
				$cek_id	= substr($menu[$awal],0,2);
				$conf->ins_group_menu($con,substr($menu[$awal],0,2).'00',$id_group);
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
						<a href="dashboard.php">Dashboard</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="menu_add.php">Detail Group Menu</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="portlet box green ">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-th-list"></i> Detail Group Menu
						</div>
					</div>
					<div class="portlet-body form">
<?php if($keterangan == "success"){ ?>
						<div class="alert alert-success display-show">
							<button class="close" data-close="alert"></button>
							<span>
							Your Data Has Been Update, Thank You</span>
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
									<input name="name" <?php  echo $readonly ?> value="<?php echo $ls_menu['name'] ?>" type="text" autocomplete="off" class="form-control">
									<?php echo $id_hidden; ?>
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
} else if($row['tipe']=='3'){ 
if(in_array($row['menu_id'],$datas)){
	$checked	= "checked";
	} else {
	$checked	="";
	} 
?>
								<div class="col-md-12">
                                     <h4><input type="checkbox"  class="form-control" <?php echo $checked ?> name="menu[]" value="<?php echo $row['menu_id'] ?>" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <?php echo $row['nama_menu'] ?> </h4>
                                   
								</div>
<?php	
}  }
?>
							</div>
							
						</div>
						<div class="form-group">
								<div class="col-md-2">
									<label class="control-label">Status</label>
								</div>
								<div class="col-md-9">
									<select class="form-control" <?php  echo $readonly ?> name="status" >
<?php	
	$get_stat	= $conf->get_group_menu_name_status($con);
	while ($row	= mysqli_fetch_assoc($get_stat)){
	$selected	= "";
	if($ls_menu['status']==$row['id']){
		$selected	= "selected";
	}
?>
										<option value="<?php echo $row['id'] ?>" <?php echo $selected ?>><?php echo $row['name'] ?></option>
<?php	
	}
?>
									</select>
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
<?php } ?>