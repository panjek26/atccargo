<!DOCTYPE html>

<html lang="en" class="no-js">
<head>
<?php 
$header		= 50;
$subheader	= "Accounting Income";
include "desaign/configuration.php";
include "desaign/databases.php";
include "desaign/title.php" ;
include "desaign/css.php";
include "desaign/session.php";
$keterangan	= "";

if(isset($_POST['submit'])){

	
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
						<a href="accounting_income.php">Accounting Income List</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<!-- BEGIN TAB PORTLET-->
				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-money"></i> Accounting Income List
						</div>
						<ul class="nav nav-tabs">
							<li>
								<a href="accounting_income.php">
								Insert Data </a>
							</li>
							<li class="active">
								<a href="accounting_income_list.php">
								List Data </a>
							</li>
						</ul>
					</div>
					<div class="portlet-body">
						<div class="tab-content">
							<div class="tab-pane active" id="portlet_tab1">			
								<div class="portlet-body">
									<div class="table-container">
										<table class="table table-striped table-bordered table-hover">
										<thead>
										<tr role="row" class="heading">
											<th>No</th>
											<th>Receipt Number</th>
											<th>Date Shipping</th>
											<th>Date Accounting</th>
											<th>Sum Price</th>
											<th>Payment Type</th>
											<th>Already Paid</th>
											<th>Remaining Paid</th>
											<th>Detail</th>
										</tr>
										</thead>
										<tbody>
<?php
$Nomor	= 1;
$get_accounting_list	= $conf->get_accounting_list($con);
while($Row	= mysqli_fetch_assoc($get_accounting_list)){ ?>
										<tr>
											<td><?php echo $Nomor; $Nomor++;?></td>
											<td><?php echo $Row['receipt_number'] ?></td>
											<td><?php echo $Row['date_inserted'] ?></td>
											<td><?php echo $Row['receipt_date_accounting'] ?></td>
											<td><?php echo number_format($Row['sum_price'],2,",",".") ?></td>
											<td><?php echo $Row['payment_name'] ?></td>
											<td><?php echo number_format($Row['already_price'],2,",",".") ?></td>
											<td><?php echo number_format($Row['remaining_price'],2,",",".") ?></td>
											<td></td>
										</tr>
<?php
}
?>
										</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
		
			</div>
					<!-- END TAB PORTLET-->
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
  <script>
    $(".numeric").lazzynumeric();
  </script>

</body>
<!-- END BODY -->
</html>








