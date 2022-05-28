<?php
include "../desaign/configuration.php";
include "../desaign/databases.php";
if(isset($_POST['type'])){
	$get_price	= $conf->get_price($con,$_POST['type']);
	$nomor			= 1;
	$iTotalRecords	= mysqli_num_rows($get_price);
	$iDisplayLength = intval($_REQUEST['length']);
	$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
	$iDisplayStart 	= intval($_REQUEST['start']);
	$sEcho			= intval($_REQUEST['draw']);
  
  $records = array();
  $records["data"] = array(); 
  $end = $iDisplayStart + $iDisplayLength;
  $end = $end > $iTotalRecords ? $iTotalRecords : $end;

	while($row	= mysqli_fetch_assoc($get_price)){
		$records["data"][] = array(
		$nomor++,
		$row['country_name_sender'],
		$row['provience_name_sender'],
		$row['city_name_sender'],
		$row['country_name_receiver'],
		$row['provience_name_receiver'],
		$row['city_name_receiver'],
		$row['price'],
		$row['shipping_name'],
		$row['status_name'],
		"<form action='price_detail.php' method='POST'>
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
	$sender_con  = $data_array['sender_con'];
	$receive_con = $data_array['receive_con'];
	$send_prov	 = $data_array['send_prov'];
	$recv_prov	 = $data_array['recv_prov'];
	$send_cit	 = $data_array['send_cit'];
	$recv_city   = $data_array['recv_city'];
	$ship		 = $data_array['ship'];
	$status      = $data_array['status'];
	
	if($cek_data == 0){
		$get_price		= $conf->get_price($con,"4");
	} else {
		$get_price		= $conf->get_price($con,"","",$sender_con,$receive_con,$send_prov,$recv_prov,$send_cit,$recv_city,$ship,$status);		
	}
	
	$nomor			= 1;
	$iTotalRecords	= mysqli_num_rows($get_price);
	$iDisplayLength = intval($_REQUEST['length']);
	$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
	$iDisplayStart 	= intval($_REQUEST['start']);
	$sEcho			= intval($_REQUEST['draw']);
  
  $records = array();
  $records["data"] = array(); 
  $datas	= $records["data"]["nama"];
  $end = $iDisplayStart + $iDisplayLength;
  $end = $end > $iTotalRecords ? $iTotalRecords : $end;

	while($row	= mysqli_fetch_assoc($get_price)){
		$records["data"][] = array(
		$nomor++,
		$row['country_name_sender'],
		$row['provience_name_sender'],
		$row['city_name_sender'],
		$row['country_name_receiver'],
		$row['provience_name_receiver'],
		$row['city_name_receiver'],
		$row['price'],
		$row['shipping_name'],
		$row['status_name'],
		"<form action='price_detail.php' method='POST'>
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