<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<li class="sidebar-toggler-wrapper">
					<div class="sidebar-toggler">
					</div>
				</li>
				
<?php 
			$menu	= $conf->menu($con,$_SESSION['group']);
			while($Menu 	= mysqli_fetch_array($menu)){
			$active	= "";	$selected	= "";
			$open	= "";	
			if($subheader == $Menu['nama_menu'] or $header == $Menu['submenu']){
				$active		= "active";
				$open	= " open";
				$selected	= "<span class='selected'></span>";
			}
?>
				<li class="<?php echo $active.$open?>">
					<a href="<?php echo $Menu['link'] ?>">
					<i class="<?php echo $Menu['icon'] ?>"></i>
					<span class="title"><?php echo $Menu['nama_menu'] ?></span>
<?php echo $selected ;
			if($Menu['tipe'] == 2){
?>
					<span class="arrow <?php echo $open ?>"></span>
<?php } ?>
					</a>
<?php 
			if($Menu['tipe'] == 2){
			$submenu	= $conf->submenu($con,$_SESSION['group'],$Menu['submenu']);
?>

					<ul class="sub-menu">
<?php
			while($Submenu 	= mysqli_fetch_array($submenu)){
			$active2		= "";
			if($subheader == $Submenu['nama_menu'] && $header == $Menu['submenu']){
				$active2		= "active";
			} 
?>
						<li class="<?php echo $active2 ?>">
							<a href="<?php echo $Submenu['link'] ?>">
							<i class="<?php echo $Submenu['icon'] ?>"></i>
							<?php echo $Submenu['nama_menu'] ?></a>
						</li>
					
<?php
			}
?>
					</ul>
<?php
			}
?>
				</li>
<?php			
			}
?>
				
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	
	</div>
	<!-- END SIDEBAR -->