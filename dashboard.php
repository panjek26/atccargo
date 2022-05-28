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
						<a href="index.html">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Dashboard</a>
					</li>
				</ul>
			</div>
			<h3 class="page-title">
			Dashboard <small>reports & statistics</small>
			</h3>
			<!-- END PAGE HEADER-->
			<!-- BEGIN DASHBOARD STATS -->
			<div class="row">
			askdjkasdjaslkjd <?php echo $_SESSION['fullname'] ?>
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