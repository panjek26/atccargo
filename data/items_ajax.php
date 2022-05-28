<?php
include "../desaign/configuration.php";
include "../desaign/databases.php";
if(isset($_POST['type'])){
	$get_items		= $conf->get_items($con,$_POST['type']);
	$nomor			= 1;
	$iTotalRecords	= mysqli_num_rows($get_items);
	$iDisplayLength = intval($_REQUEST['length']);
	$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
	$iDisplayStart 	= intval($_REQUEST['start']);
	$sEcho			= intval($_REQUEST['draw']);
  
  $records = array();
  $records["data"] = array(); 
  $end = $iDisplayStart + $iDisplayLength;
  $end = $end > $iTotalRecords ? $iTotalRecords : $end;

	while($row	= mysqli_fetch_assoc($get_items)){
		$records["data"][] = array(
		$nomor++,
		$row['name'],
		$row['price'],
		$row['type_name'],
		$row['stats_name'],
		"<form action='items_detail.php' method='POST'>
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
	$items_name 	= $data_array['items_name'];
	$type_items 	= $data_array['type_items'];
	$price 			= $data_array['price'];
	$status 		= $data_array['status'];
	
	
	if($cek_data == 0){
		$get_items		= $conf->get_items($con,"4");
	} else {
		$get_items		= $conf->get_items($con,"","",$status,$items_name,$type_items,$price );		
	}
	
	$nomor			= 1;
	$iTotalRecords	= mysqli_num_rows($get_items);
	$iDisplayLength = intval($_REQUEST['length']);
	$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
	$iDisplayStart 	= intval($_REQUEST['start']);
	$sEcho			= intval($_REQUEST['draw']);
  
  $records = array();
  $records["data"] = array(); 
  $datas	= $records["data"]["nama"];
  $end = $iDisplayStart + $iDisplayLength;
  $end = $end > $iTotalRecords ? $iTotalRecords : $end;

	while($row	= mysqli_fetch_assoc($get_items)){
		$records["data"][] = array(
		$nomor++,
		$row['name'],
		$row['price'],
		$row['type_name'],
		$row['stats_name'],
		"<form action='items_detail.php' method='POST'>
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