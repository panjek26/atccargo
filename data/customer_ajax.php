<?php
include "../desaign/configuration.php";
include "../desaign/databases.php";
if(isset($_POST['type'])){
	$get_customer	= $conf->get_customer($con,$_POST['type']);
	$nomor			= 1;
	$iTotalRecords	= mysqli_num_rows($get_customer);
	$iDisplayLength = intval($_REQUEST['length']);
	$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
	$iDisplayStart 	= intval($_REQUEST['start']);
	$sEcho			= intval($_REQUEST['draw']);
  
  $records = array();
  $records["data"] = array(); 
  $end = $iDisplayStart + $iDisplayLength;
  $end = $end > $iTotalRecords ? $iTotalRecords : $end;

	while($row	= mysqli_fetch_assoc($get_customer)){
		$records["data"][] = array(
		$nomor++,
		$row['name'],
		$row['country_name'],
		$row['provience_name'],
		$row['city_name'],
		$row['district_name'],
		$row['detail_address'],
		$row['mobile_phone'],
		$row['status_name'],
		"<form action='customer_detail.php' method='POST'>
		<input type='hidden' name='id' value='".$row['id']."'/>
		<button type='submit' name='detail' value='1' class='btn green-stripe btn-xs'>Change</button>
		</form>",
		);
	}

  $records["draw"] = $sEcho;
  $records["recordsTotal"] = $iTotalRecords;
  $records["recordsFiltered"] = $iTotalRecords;
  
  echo json_encode($records);
  
} else if (isset($_POST['dataku'])) {
	
	$dataku		= explode("&",$_POST['dataku']);
	$total_data	= count($dataku);
	$data_array	= array();
	$cek_data	= 0;
	
	for($i=0;$i<$total_data;$i++){
		$values	= explode("=",$dataku[$i]);
		$data_array[$values[0]]=str_replace('+',' ',$values[1]);
		if(!empty($values[1])){ $cek_data	=	1; }
	}
	$cusname 	= $data_array['customer'];
	$disctrict	= $data_array['district'];
	$country	= $data_array['country'];
	$provience	= $data_array['provience'];
	$city		= $data_array['city'];
	$status		= $data_array['status'];
	
	if($cek_data == 0){
		$get_customer		= $conf->get_customer($con,"4");
	} else {
		$get_customer		= $conf->get_customer($con,"","",$cusname,$disctrict,$country,$provience,$city,$status);		
	}
	
	$nomor			= 1;
	$iTotalRecords	= mysqli_num_rows($get_customer);
	$iDisplayLength = intval($_REQUEST['length']);
	$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
	$iDisplayStart 	= intval($_REQUEST['start']);
	$sEcho			= intval($_REQUEST['draw']);
  
  $records = array();
  $records["data"] = array(); 
  $datas	= $records["data"]["nama"];
  $end = $iDisplayStart + $iDisplayLength;
  $end = $end > $iTotalRecords ? $iTotalRecords : $end;

	while($row	= mysqli_fetch_assoc($get_customer)){
		$records["data"][] = array(
		$nomor++,
		$row['name'],
		$row['country_name'],
		$row['provience_name'],
		$row['city_name'],
		$row['district_name'],
		$row['detail_address'],
		$row['mobile_phone'],
		$row['status_name'],
		"<form action='customer_detail.php' method='POST'>
		<input type='hidden' name='id' value='".$row['id']."'/>
		<button type='submit' name='detail' value='1' class='btn green-stripe btn-xs'>Change</button>
		</form>",
		);
	}

  $records["draw"] = $sEcho;
  $records["recordsTotal"] = $iTotalRecords;
  $records["recordsFiltered"] = $iTotalRecords;
  
  echo json_encode($records);
}
?>