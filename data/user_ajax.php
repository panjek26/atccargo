<?php
include "../desaign/configuration.php";
include "../desaign/databases.php";
if(isset($_POST['type'])){
	$get_user		= $conf->get_user($con,$_POST['type']);
	$nomor			= 1;
	$iTotalRecords	= mysqli_num_rows($get_user);
	$iDisplayLength = intval($_REQUEST['length']);
	$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
	$iDisplayStart 	= intval($_REQUEST['start']);
	$sEcho			= intval($_REQUEST['draw']);
  
  $records = array();
  $records["data"] = array(); 
  $end = $iDisplayStart + $iDisplayLength;
  $end = $end > $iTotalRecords ? $iTotalRecords : $end;

	while($row	= mysqli_fetch_assoc($get_user)){
		$records["data"][] = array(
		$nomor++,
		$row['username'],
		$row['fullname'],
		$row['division_name'],
		$row['Country'],
		$row['provience'],
		$row['city'],
		$row['districtt'],
		$row['level_name'],
		$row['group_menu'],
		$row['mobile_no'],
		$row['email'],
		$row['status_name'],
		"<form action='user_detail.php' method='POST'>
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
	$city 	= $data_array['city'];
	$district 	= $data_array['district'];
	$division 	= $data_array['division'];
	$level 	= $data_array['level'];
	$country  = $data_array['country'];
	$grp_menu =  $data_array['grp_menu'];
	$provience=$data_array['provience'];
	$status_usr=$data_array['status_usr'];
	
	if($cek_data == 0){
		$get_user		= $conf->get_user($con,"4");
	} else {
		$get_user		= $conf->get_user($con,"","","",$city,$district,$division,$level,$country,$grp_menu,$provience,$status_usr);		
	}
	
	$nomor			= 1;
	$iTotalRecords	= mysqli_num_rows($get_user);
	$iDisplayLength = intval($_REQUEST['length']);
	$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
	$iDisplayStart 	= intval($_REQUEST['start']);
	$sEcho			= intval($_REQUEST['draw']);
  
  $records = array();
  $records["data"] = array(); 
  $datas	= $records["data"]["nama"];
  $end = $iDisplayStart + $iDisplayLength;
  $end = $end > $iTotalRecords ? $iTotalRecords : $end;

	while($row	= mysqli_fetch_assoc($get_user)){
		$records["data"][] = array(
		$nomor++,
		$row['username'],
		$row['fullname'],
		$row['division_name'],
		$row['Country'],
		$row['provience'],
		$row['city'],
		$row['districtt'],
		$row['level_name'],
		$row['group_menu'],
		$row['mobile_no'],
		$row['email'],
		$row['status_name'],
		"<form action='user_detail.php' method='POST'>
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