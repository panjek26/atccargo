<?php
include "../desaign/configuration.php";
include "../desaign/databases.php";
if(isset($_POST['type'])){
	$get_transport	= $conf->get_transport($con,$_POST['type']);
	$nomor			= 1;
	$iTotalRecords	= mysqli_num_rows($get_transport);
	$iDisplayLength = intval($_REQUEST['length']);
	$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
	$iDisplayStart 	= intval($_REQUEST['start']);
	$sEcho			= intval($_REQUEST['draw']);
  
  $records = array();
  $records["data"] = array(); 
  $end = $iDisplayStart + $iDisplayLength;
  $end = $end > $iTotalRecords ? $iTotalRecords : $end;

	while($row	= mysqli_fetch_assoc($get_transport)){
		$records["data"][] = array(
		$nomor++,
		$row['plate_number'],
		$row['type_name'],
		$row['production'],
		$row['kir'],
		$row['oil'],
		$row['fullname'],
		$row['country_name'],
		$row['status_name'],
		"<form action='transport_detail.php' method='POST'>
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
	$plate 		= $data_array['plate'];
	$change_oil	= $data_array['change_oil'];
	$trans_type	= $data_array['trans_type'];
	$driver		= $data_array['driver'];
	$production	= $data_array['production'];
	$country	= $data_array['country'];
	$kir		= $data_array['kir'];
	$status		= $data_array['status'];
	
	if($cek_data == 0){
		$get_transport		= $conf->get_transport($con,"4");
	} else {
		$get_transport		= $conf->get_transport($con,"","",$plate,$change_oil,$trans_type,$driver,$production,$country,$kir,$status);		
	}
	
	$nomor			= 1;
	$iTotalRecords	= mysqli_num_rows($get_transport);
	$iDisplayLength = intval($_REQUEST['length']);
	$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
	$iDisplayStart 	= intval($_REQUEST['start']);
	$sEcho			= intval($_REQUEST['draw']);
  
  $records = array();
  $records["data"] = array(); 
  $datas	= $records["data"]["nama"];
  $end = $iDisplayStart + $iDisplayLength;
  $end = $end > $iTotalRecords ? $iTotalRecords : $end;

	while($row	= mysqli_fetch_assoc($get_transport)){
		$records["data"][] = array(
		$nomor++,
	$row['plate_number'],
		$row['type_name'],
		$row['production'],
		$row['kir'],
		$row['oil'],
		$row['fullname'],
		$row['country_name'],
		$row['status_name'],
		"<form action='transport_detail.php' method='POST'>
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