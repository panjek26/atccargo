<?php
class Config
{
	
	function cek_user($con,$user){
		$query = "select * from data_user where username='$user' and status='1'";
		$result = mysqli_query($con,$query);
		return $result;
	}	
	
	function menu($con,$group_menu){
		$query	= "SELECT a.*,LEFT(a.`menu_id`,2) as submenu FROM daftar_menu a
		LEFT JOIN group_menu b ON a.`menu_id`=b.`id_menu` 
		WHERE a.`status`=1 AND b.`id_group`=".$group_menu." AND a.tipe IN (1,2);";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function submenu($con,$group_menu,$menu){
		$query	= "SELECT a.* FROM daftar_menu a
		LEFT JOIN group_menu b ON a.`menu_id`=b.`id_menu` 
		WHERE a.`status`=1 AND b.`id_group`=".$group_menu." 
		AND a.tipe = 3 AND LEFT(a.`menu_id`,2)=".$menu;
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function rd($len) {
		$word = array_merge(range('a', 'z'), range ('0', '9'));
		shuffle($word);
		return substr(implode($word), 0, $len);
	}
	//edit by panji 
	function get_user($con,$type,$id,$user,$city,$district,$division,$level,$country,$grp_menu,$provience,$status_usr){
		if($type=="1"){
			$dataType = "";
		} else if($type=="2"){
			$dataType = " and a.status='1'";
		} else if($type=="3"){
			$dataType = " and a.status='2'";
		} else if($type=="4"){
			$dataType = " and a.id='0'";
		}
		
		if(!empty($id)){
			$id	 = " AND a.id ='".$id."'";
		}
		
		if(!empty($user)){
		$user = " and a.username = '$user'";
		}
		
		if(!empty($city)){
		$city = " and d.id = '$city '";
		}
		
		if(!empty($district)){
		$district= " and c.id = '$district'";
		}
		
		if(!empty($division)){
		$division= " and b.id = '$division'";
		}
		
		if(!empty($level)){
		$level= " and a.level = '$level'";
		}
		
		if(!empty($country)){
		$country= " and f.id= '$country'";
		}
		
		if(!empty($grp_menu)){
		$grp_menu= " and h.id= '$grp_menu'";
		}
		
		if(!empty($provience)){
		$provience= " and e.id= '$provience'";
		}
		
		if(!empty($status_usr)){
		$status_usr= " and i.id= '$status_usr'";
		}
		
		$query = "select a.*, b.id as id_division, b.name as division_name, c.id as id_lokasi, c.location_link, c.location_name as districtt,
				  d.location_name as city, e.location_name as provience, f.location_name as Country, g.name as level_name,
				  h.name as group_menu, i.name as status_name, i.id as id_status
				  from data_user a
			      inner join division b on a.division = b.id
			      inner join location c on a.district=c.id
				  inner join location d on c.location_link = d.id
				  inner join location e on d.location_link = e.id
				  inner join location f on e.location_link = f.id
				  inner join user_level g on a.level = g.id
				  inner join group_menu_name h on a.group_menu = h.id
				  inner join user_status i on a.status = i.id
				where 1 $dataType $user $id $city $district $division $level $country $grp_menu $provience $status_usr";
		$result = mysqli_query($con,$query);
		return $result;
	}	
	//end edit by panji
	
	function upd_user($con,$user,$pass){
		$query = "update data_user set password='$pass' where username='$user'";
		$result = mysqli_query($con,$query);
		return $result;
	}	
	
	function get_list_division($con,$type,$id,$div_name,$status){
		if($type=="1"){
			$dataType = "";
		} else if($type=="2"){
			$dataType = " and a.status='1'";
		} else if($type=="3"){
			$dataType = " and a.status='2'";
		} else if($type=="4"){
			$dataType = " and a.id='0'";
		}
		if(!empty($div_name)){
			$div_name		= " AND a.name like '%".$div_name."%'";
		}
		
		if(!empty($status)){
			$status		= " AND a.status = '$status'";
		}
		
		if(!empty($id)){
			$id	 = " AND a.id ='".$id."'";
		}
		
		$query = "SELECT a.*,b.`name` AS status_name FROM division a
				INNER JOIN division_status b ON
				a.`status` =b.`id` 
				where 1 $dataType $id $div_name $status";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_status_division($con){
		$query	= "SELECT * FROM division_status order by name";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	
	function get_division($con){
		$query	= "select * from division order by name";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_level($con){
		$query	= "select * from user_level order by name";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_group_menu($con){
		$query	= "select * from group_menu_name order by name";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_location($con,$type){
		$query	= "select * from location where location_type='$type' order by location_name";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_location_link($con,$type){
	if(!empty($type)){
			$type		= " and status ='$type'";
		}
		$query	= "select id,location_name from location where 1 $type";
		$result = mysqli_query($con,$query);
		return $result;
	}
	function get_status_location($con){
		$query	= "select id,name from location_status order by name";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_location_detail_price($con,$id){
		$query	= "select c.*,
				   d.location_name as city, e.location_name as provience, f.location_name as Country,c.location_type
				   from location c
			       inner join location d on c.location_link = d.id
				   inner join location e on d.location_link = e.id
				   inner join location f on e.location_link = f.id
				   WHERE d.id='$id' ";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
		function get_list_loc($con,$type,$id,$loc_type,$link_name,$loc_name,$status){
		if($type=="1"){
			$dataType = "";
		} else if($type=="2"){
			$dataType = " and a.status='1'";
		} else if($type=="3"){
			$dataType = " and a.status='2'";
		} else if($type=="4"){
			$dataType = " and a.id='0'";
		}
		
		if(!empty($loc_type)){
			$loc_type		= " AND a.location_type ='$loc_type'";
		}
		
			if(!empty($id)){
			$id		= " AND a.id ='$id'";
		}
		
		if(!empty($link_name)){
			$link_name		= " AND a.location_link ='$link_name'";
		}
		
		if(!empty($loc_name)){
			$loc_name		= " AND a.location_name ='$loc_name'";
		}
		
		if(!empty($status)){
			$status		= " AND a.status ='$status'";
		}
		
		$query	= "SELECT c.`name` AS tipe_name, a.id,a.location_type,a.location_name,a.location_link, b.`location_name` AS location_link_name, d.name AS stats_name, a.status as id_status FROM location a
					LEFT JOIN location b
					ON a.`location_link` =b.`id`
					INNER JOIN location_type c
					ON a.`location_type` =c.`id`
					INNER JOIN location_status d
					ON a.status=d.id
					where 1 $id $dataType $loc_type $link_name $loc_name $status";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_location_detail($con,$id){
		$query	= "select c.*,
				   d.location_name as city, e.location_name as provience, f.location_name as Country
				   from location c
			       inner join location d on c.location_link = d.id
				   inner join location e on d.location_link = e.id
				   inner join location f on e.location_link = f.id
				   WHERE c.id='$id'";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
//add start by panji 5-3-18
	function ins_user($con,$username, $fullname, $hash_psw, $division, $district, $level, $group_menu, $mobile_no, $email, $status){
		$query="insert into data_user (username, fullname, password, division, district, level, group_menu, mobile_no, email, status)
				values ('$username', '$fullname', '$hash_psw', '$division', '$district', '$level', '$group_menu', '$mobile_no', '$email', '$status')";
		$result=mysqli_query($con,$query);
		return $result;
	}
	
	function ins_location($con,$type,$loc_name,$link_name,$status){
	
	if($link_name== 0)
{
    $link_name= "NULL";
    }else{
     $link_name= "'$link_name'";
}
		
		$query="insert into location(location_type, location_name, location_link, status)
				values ('$type', '$loc_name', $link_name, '$status')";
		$result=mysqli_query($con,$query);
		return $result;
	}	
	
	function get_status($con){
		$query	= "select * from user_status order by name";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function upd_data_user($con, $id, $fullname, $hash_psw, $division, $district, $level, $gropmenu, $mobile_no, $email, $status){
		$query	= "UPDATE data_user set fullname = '$fullname', password='$hash_psw',
			division='$division',district='$district',level='$level',group_menu='$gropmenu',mobile_no='$mobile_no',email='$email',status='$status'
			WHERE id='$id'";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	

//add end 5-3-18


	function ins_customer($con,$name,$district,$no_telp,$address){
		$query	= "insert into customer (name, district, mobile_phone, detail_address, status)
			VALUES	('$name','$district','$no_telp','$address',1)";
		$result = mysqli_query($con,$query);
		$last_id= mysqli_insert_id($con);
		return $last_id;
	}
	
	function get_customer($con,$type,$id,$cusname,$disctrict,$country,$provience,$city,$status){
		if($type=="1"){
			$dataType = "";
		} else if($type=="2"){
			$dataType = " and a.status='1'";
		} else if($type=="3"){
			$dataType = " and a.status='2'";
		} else if($type=="4"){
			$dataType = " and a.id='0'";
		}
		
		if(!empty($id)){
			$id	 = " AND a.id like '%".$id."%'";
		}
		
		
		if(!empty($cusname)){
			$cusname		= " AND a.name like '%$cusname%'";
		}
		
		if(!empty($disctrict)){
			$disctrict		= " AND b.`id`='$disctrict'";
		}
		
		if(!empty($country)){
			$country		= " AND f.`id`='$country'";
		}
		
		if(!empty($provience)){
			$provience		= " AND e.id='$provience'";
		}
		
		if(!empty($city)){
			$city			= " AND d.`id`='$city'";
		}
		
		if(!empty($status)){
			$status			= " AND a.`status`='$status'";
		}
		
		$query = "SELECT a.*, b.location_name AS district_name, c.name AS status_name,
			b.`id` AS id_district, d.`id` AS id_city,d.`location_name` AS city_name, e.`id` AS id_provience,e.`location_name` AS provience_name,
			 f.id AS id_country,f.`location_name` AS country_name
			FROM customer a
			LEFT JOIN location b ON a.`district`=b.`id`
			LEFT JOIN customer_status c ON a.`status`=c.`id`
			LEFT JOIN location d ON b.`location_link`=d.`id`
			LEFT JOIN location e ON d.`location_link`=e.`id`
			LEFT JOIN location f ON e.`location_link` =f.`id`
			WHERE 1 $id $dataType $cusname $disctrict $country $provience $city $status";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function upd_customer($con,$id,$name,$district,$no_telp,$address,$status){
		$query	= "UPDATE customer set name='$name', district = '$district', detail_address='$address',
			mobile_phone='$no_telp',status='$status' 
			WHERE id='$id'";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_customer_status($con){
		$query	= "select * from customer_status order by name";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_password_unique($con,$pass){
		$query	= "select * from data_user where `password` like '".$pass."___'";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_transport($con,$type,$id,$plate,$change_oil,$trans_type,$driver,$production,$country,$kir,$status){
		if($type=="1"){
			$dataType = "";
		} else if($type=="2"){
			$dataType = " and a.status='1'";
		} else if($type=="3"){
			$dataType = " and a.status='2'";
		} else if($type=="4"){
			$dataType = " and a.id='0'";
		}
		
		if(!empty($id)){
			$id	 = " AND a.id = '".$id."'";
		}
		
		if(!empty($plate)){
			$plate		= " AND a.plate_number like '%".$plate."%'";
		}
		
		if(!empty($change_oil)){
			$change_oil		= " AND a.`oil`='$change_oil'";
		}
		
		if(!empty($trans_type)){
			$trans_type		= " AND a.`type`='$trans_type'";
		}
		
		if(!empty($driver)){
			$driver		= " AND a.`driver`='$driver'";
		}
		
		if(!empty($production)){
			$production			= " AND a.`production`='$production'";
		}
		
		if(!empty($country)){
			$country			= " AND a.`country`='$country'";
		}
		
		if(!empty($kir)){
			$kir			= " AND a.`kir`='$kir'";
		}
		
		if(!empty($status)){
			$status			= " AND a.`status`='$status'";
		}
		
		$query = "SELECT a.*,b.`fullname`,c.`name` AS country_name, d.`name` AS status_name,
			e.`name` AS type_name FROM transport a
			LEFT JOIN data_user b ON a.`driver`=b.`id`
			LEFT JOIN transport_country c ON a.`country`=c.`id`
			LEFT JOIN transport_status d ON a.`status`=d.`id`
			LEFT JOIN transport_type e ON a.`type`=e.`id`
			WHERE 1 $dataType $id $plate $change_oil $trans_type $driver $production $country $kir $status";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_transport_type($con){
		$query	= "select * from transport_type order by name";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_transport_country($con){
		$query	= "select * from transport_country order by name";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_employee($con,$division){
		if(!empty($division)){
			$division	= " and division='$division'";
		}
		$query	= "select * from data_user where status=1 $division order by fullname";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function session_menu($con,$group){
		$query	= "SELECT a.*,b.nama_menu FROM group_menu a
		LEFT JOIN daftar_menu b ON a.id_menu=b.menu_id 
		WHERE a.id_group='$group' AND b.`status`=1;";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function ins_transport($con,$plate_number,$type_trans,$production,$kir,$change_oil,$driver,$country,$status){
		$query	= "insert into transport (plate_number,`type`,production,kir,oil,driver,country,`status`)
			VALUES	('$plate_number','$type_trans','$production','$kir','$change_oil','$driver','$country','$status')";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function ins_div($con,$division,$status){
		$query	= "insert into division (name,`status`)
			VALUES	('$division','$status')";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	
		function ins_price($con,$city_send,$city_recv,$price_kg,$ship,$status){
		$query	= "insert into price (sender,receiver,price,shipping,status)
			VALUES	('$city_send','$city_recv','$price_kg','$ship','$status')";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_transport_status($con){
		$query	= "select * from transport_status order by name";
		$result = mysqli_query($con,$query);
		return $result;
	}

	function upd_transport($con, $id_transport, $plate_number, $production, $kir, $change_oil, $driver, $country, $type_trans, $status){
		$query	= "UPDATE transport set plate_number='$plate_number', `type` = '$type_trans', production='$production',
			kir='$kir',oil='$change_oil',driver='$driver',country='$country',status='$status' 
			WHERE id='$id_transport'";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_menu_list($con,$type,$id){
		if($type=="1"){
			$dataType = "";
		} else if($type=="2"){
			$dataType = " and a.status='1'";
		} else if($type=="3"){
			$dataType = " and a.status='2'";
		} 
		if(!empty($id)){
			$id		= " and a.id='$id'";
		}
		
		$query = "SELECT a.*,GROUP_CONCAT(nama_menu) AS list_menu, GROUP_CONCAT(menu_id) AS list_id, d.name AS status_name FROM group_menu_name a
			LEFT JOIN (SELECT * FROM group_menu ORDER BY id_menu) b ON a.id=b.`id_group`
			LEFT JOIN daftar_menu c ON b.`id_menu`=c.menu_id
			LEFT JOIN group_menu_name_status d ON a.`status`=d.`id`
			WHERE 1 $dataType $id
			GROUP BY a.id";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_dft_menu($con){
		$query	= "select * from daftar_menu where menu_id<>1000 order by menu_id";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function ins_group_menu_name($con,$name,$status){
		$query	= "insert into group_menu_name (`name`,`status`)
			VALUES	('$name','$status')";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function check_group_menu_name($con,$name){
		$query	= "select * from group_menu_name where `name` ='$name'";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function ins_group_menu($con,$menu,$id){
		$query	= "insert ignore into group_menu (id_menu,id_group)
			VALUES	('$menu','$id')";
		$result = mysqli_query($con,$query);
		return $result;
	}

	function get_group_menu_name_status($con){
		$query	= "select * from group_menu_name_status order by name";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function upd_group_menu_name($con,$name,$status,$id_group){
		$query	= "UPDATE group_menu_name set name='$name', status='$status' 
			WHERE id='$id_group'";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function del_group_menu($con,$id){
		$query	= "delete from group_menu
			WHERE id_group='$id'";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_shipping($con){
		$query	= "select * from price_shipping order by name";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function ins_shipping_sales($con,$receipt_number,$foto,$driver,$district,$shipping,$total_qty,$price,$sales_by,$date_inserted){
		$query	= "insert into shipping (receipt_number,foto,driver,district,total_qty,price,sales_by,date_inserted,`status`)
			VALUES	('$receipt_number','$foto','$driver','$district','$total_qty','$price','$sales_by','$date_inserted','1')";
		$result	= "gagal"; 
		if(mysqli_query($con,$query)){
			$last_id	= mysqli_insert_id($con);
			mysqli_query($con,"insert into shipping_log(id_shipping, date_inserted, employee, status)
					VALUES ('$last_id', '$date_inserted', '$sales_by', '1')");
			for($awal=1;$awal<=$total_qty;$awal++){
				mysqli_query($con,"insert into warehouse_item (id_shipping,urutan,shipping_method,warehouse_status,status)
					VALUES('$last_id',$awal,$shipping,'1','1')");
			}
			$result	= "sukses";
		}
		return $result;
	}
	
	function get_items($con,$type,$id,$status,$items_name, $type_items, $price ){
	if($type=="1"){
			$dataType = "";
		} else if($type=="2"){
			$dataType = " and a.status='1'";
		} else if($type=="3"){
			$dataType = " and a.status='2'";
		} else if($type=="4"){
			$dataType = " and a.id='0'";
		}
	if(!empty($id)){
			$id	 = " AND a.id like '%".$id."%'";
		}
		
	if(!empty($items_name)){
			$items_name	 = " AND a.name='$items_name'";
		}
		
	if(!empty($type_items)){
			$type_items	 = " AND a.type='$type_items'";
		}
		
	if(!empty($price)){
			$price	 = " AND a.price='$price'";
		}
		
		if(!empty($status)){
			$status	 = " AND a.status='$status'";
		}
		
		
	
		$query	= "SELECT a.*,b.`name` AS type_name,c.`name`AS stats_name FROM items a
				INNER JOIN items_type b
				ON a.`type` =b.`id`
				INNER JOIN items_status c
				ON a.`status`=c.`id`
				where 1 $dataType $id $items_name $type_items $price $status
				ORDER BY a.`name`";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_items_type($con){
		$query	= "SELECT * FROM items_type
				ORDER BY name";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	
	function get_items_status($con){
		$query	= "SELECT * FROM items_status
				ORDER BY name";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_cost($con,$type,$id,$type_cost,$status){
	if($type=="1"){
			$dataType = "";
		} else if($type=="2"){
			$dataType = " and a.status='1'";
		} else if($type=="3"){
			$dataType = " and a.status='2'";
		} else if($type=="4"){
			$dataType = " and a.id='0'";
		}
		
		if(!empty($id)){
			$id	 = " AND a.id like '%".$id."%'";
		}
		
		if(!empty($type_cost)){
			$type_cost	 = " AND a.type='$type_cost'";
		}
		
		if(!empty($status)){
			$status	 = " AND a.status='$status'";
		}
		
		$query	= "SELECT a.*,b.id AS id_type, b.`name` AS type_name,c.`id` AS id_status, c.`name` AS status_name FROM cost a
					INNER JOIN cost_type b
					ON a.`type` = b.`id`
					INNER JOIN cost_status c
					ON a.`status` = c.`id`
					where 1 $dataType $id $type_cost $status";
		$result = mysqli_query($con,$query);
		return $result;
	}	

	function get_type_cost($con){
		$query	= "select * from cost_type order by name";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_type($con){
		$query	= "select * from location_type order by name";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function upd_division ($con, $id, $division, $status){
		$query	= "UPDATE division set name = '$division', status='$status'
						WHERE id='$id'";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function upd_price ($con, $id, $city_send, $city_recv, $price_kg, $ship_w, $status){
		$query	= "UPDATE price set sender = '$city_send', receiver='$city_recv', price='$price_kg', shipping='$ship_w', status='$status'
				   WHERE id='$id'";
		$result = mysqli_query($con,$query);
		return $result;
	}

	function get_status_cost($con){
		$query	= "select * from cost_status order by name";
		$result = mysqli_query($con,$query);
		return $result;
	}		
	
	function ins_items($con,$items_name,$price,$type_items,$status){
		$query	= "insert into items (name,price,type,status)
			VALUES	('$items_name','$price','$type_items','$status')";
		$result = mysqli_query($con,$query);
		return $result;
	}

	function ins_cost($con,$type_cost,$cost,$status){
		$query	= "insert into cost (type,cost,status)
			VALUES	('$type_cost','$cost','$status')";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function upd_loc_list($con, $id, $type, $loc_name, $link_name, $status){
		if(!empty($link_name)){
			$link_name		= "'" . mysql_escape_string($link_name) . "'";
		}else{
			$link_name = "NULL";
		}
		
		$query	= "update location set location_type = '$type', location_name='$loc_name',
			location_link=$link_name,status='$status'
			WHERE id='$id'";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	
	function upd_items($con, $items_name, $price, $type_items, $status, $id){
		$query	= "update items set name = '$items_name', price='$price',
			type='$type_items',status='$status'
			WHERE id='$id'";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function upd_cost($con, $type_cost, $cost,$status,$id){
		$query	= "update cost set type = '$type_cost', cost='$cost', status='$status'
			WHERE id='$id'";
		$result = mysqli_query($con,$query);
		return $result;
	}

	function get_price_status($con){
		$query	= "select * from price_status order by name";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_price($con,$type,$id,$sender_con,$receive_con,$send_prov,$recv_prov,$send_cit,$recv_city,$ship,$status,$sender,$receiver){
		if($type=="1"){
			$dataType = "";
		} else if($type=="2"){
			$dataType = " and a.status='1'";
		} else if($type=="3"){
			$dataType = " and a.status='2'";
		} else if($type=="4"){
			$dataType = " and a.id='0'";
		}
		
		if(!empty($id)){
			$id	 = " AND a.id = '".$id."'";
		}
		
		if(!empty($sender_con)){
			$sender_con		= " AND d.id ='$sender_con'";
		}
		
		if(!empty($receive_con)){
			$receive_con		= " AND g.id ='$receive_con'";
		}
		
		if(!empty($send_prov)){
			$send_prov		= " AND c.id ='$send_prov'";
		}
		
		if(!empty($recv_prov)){
			$recv_prov		= " AND f.id ='$recv_prov'";
		}
		
		if(!empty($send_cit)){
			$send_cit		= " AND b.id ='$send_cit'";
		}
		
		if(!empty($recv_city)){
			$recv_city		= " AND e.id ='$recv_city'";
		}
		
		if(!empty($ship)){
			$ship		= " AND a.shipping ='$ship'";
		}
		
		if(!empty($status)){
			$status		= " AND a.status ='$status'";
		}
		
		if(!empty($sender)){
			$sender		= " AND a.sender ='$sender'";
		}
		
		if(!empty($receiver)){
			$receiver		= " AND a.receiver ='$receiver'";
		}
		
		$query = "SELECT a.*,b.`location_name` AS city_name_sender,c.`location_name` AS provience_name_sender,
				d.`location_name` AS country_name_sender,e.`location_name` AS city_name_receiver ,
				f.`location_name` AS provience_name_receiver, g.`location_name` AS country_name_receiver, 
				h.`name` AS shipping_name,i.`name` AS status_name FROM price a
				LEFT JOIN location b
				ON a.`sender`=b.`id`
				LEFT JOIN location c
				ON b.`location_link` =c.`id`
				LEFT JOIN location d
				ON c.`location_link` =d.`id`
				LEFT JOIN location e
				ON a.`receiver`=e.`id`
				LEFT JOIN location f
				ON e.`location_link`=f.`id`
				LEFT JOIN location g
				ON f.`location_link`=g.`id`
				LEFT JOIN price_shipping h
				ON a.`shipping` =h.`id`
				LEFT JOIN price_status i
				ON a.`status` =i.`id`
			WHERE 1 $dataType $id $sender_con $receive_con $send_prov $recv_prov $send_cit $recv_city $ship $status $sender $receiver";
		$result = mysqli_query($con,$query);
		return $result;
	}

	function get_warehouse_item($con,$group,$id,$shipping,$receipt_number,$warehouse_status, $urutan){
		if(!empty($group)){
			$group	= "GROUP BY receipt_number;";
		}
		if(!empty($id)){
			$id		= " and a.id_shipping='$id'";
		}
		if(!empty($shipping)){
			$shipping		= " and a.shipping_method='$shipping'";
		}
		if(!empty($receipt_number)){
			$receipt_number		= " and b.receipt_number='$receipt_number'";
		}
		if(!empty($warehouse_status)){
			$warehouse_status		= " and a.warehouse_status='$warehouse_status'";
		}
		if(!empty($urutan)){
			$urutan		= " and a.urutan='$urutan'";
		}
		$query	= "SELECT a.*, b.`receipt_number`, c.name AS items_name FROM warehouse_item a
		LEFT JOIN shipping b ON a.`id_shipping`=b.`id`
		LEFT JOIN items c ON a.`id_items`=c.id
		WHERE a.`status`=1 and a.`warehouse_status`<>3 $id $shipping $receipt_number $warehouse_status $urutan $group";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_warehouse_item_awb_bl($con,$group,$awb_bl,$shipping,$receipt_number,$warehouse_status, $urutan){
		if(!empty($group)){
			$group	= "GROUP BY receipt_number;";
		}
		if(!empty($awb_bl)){
			$awb_bl		= " and (a.id_awb_bl='$awb_bl' or a.warehouse_status=2)";
		} 
		if(!empty($shipping)){
			$shipping		= " and a.shipping_method='$shipping'";
		}
		if(!empty($receipt_number)){
			$receipt_number		= " and b.receipt_number='$receipt_number'";
		}
		if(!empty($warehouse_status)){
			$warehouse_status		= " and a.warehouse_status='$warehouse_status'";
		}
		if(!empty($urutan)){
			$urutan		= " and a.urutan='$urutan'";
		}
		$query	= "SELECT a.*, b.`receipt_number`, c.name AS items_name FROM warehouse_item a
		LEFT JOIN shipping b ON a.`id_shipping`=b.`id`
		LEFT JOIN items c ON a.`id_items`=c.id
		WHERE a.`status`=1 and a.`warehouse_status`<>1 $awb_bl $shipping $receipt_number $warehouse_status $urutan $group";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function upd_warehouse_item($con, $id_shipping, $id, $warehouse_status, $shipping, $type, $data_id, $awb_bl, $shipping_method, $data_null){
		if(!empty($id_shipping)){
			$id_shipping = " and id_shipping='$id_shipping'";
		}
		if(!empty($id)){
			$id = " and id='$id'";
		}
		if(!empty($shipping)){
			$shipping = " and shipping_method='$shipping'";
		}
		if(!empty($shipping_method)){
			$shipping_method = " , shipping_method='$shipping_method'";
		}
		if(!empty($type)){
			$type = " and warehouse_status='$type'";
		}
		if(!empty($data_id)){
			$data_id = " and id not in ($data_id)";
		}
		if(!empty($awb_bl)){
			$awb_bl = " , id_awb_bl = '$awb_bl'";
		}
		if(!empty($data_null)){
			$data_null = " , id_awb_bl = NULL";
		}
		$query	= "update warehouse_item 
			SET warehouse_status = '$warehouse_status' $awb_bl $shipping_method $data_null
			WHERE 1 $id_shipping $id $shipping $type $data_id";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function upd_warehouse_item_new($con, $receipt_number, $urutan, $set_status, $where_status, $shipping_method, $data_id,
		$id_awb_bl, $change_awb_bl){
		if(!empty($receipt_number)){
			$receipt_number = " and b.receipt_number='$receipt_number'";
		}
		if(!empty($urutan)){
			$urutan = " and a.urutan='$urutan'";
		}
		if(!empty($where_status)){
			$where_status = " and a.warehouse_status='$where_status'";
		}
		if(!empty($shipping_method)){
			$shipping_method = " and a.shipping_method='$shipping_method'";
		}
		if(!empty($data_id)){
			$data_id = " and a.id not in ($data_id)";
		}
		if(!empty($id_awb_bl)){
			$id_awb_bl = " and a.id_awb_bl = '$id_awb_bl'";
		}
		if(!empty($change_awb_bl)){
			$change_awb_bl = ", id_awb_bl = NULL";
		}
		$query	= "update warehouse_item a
			LEFT JOIN shipping b on a.id_shipping = b.id
			SET a.warehouse_status = '$set_status' $change_awb_bl
			WHERE 1 $receipt_number $urutan $where_status $shipping_method $data_id $id_awb_bl";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	
	function get_resi($con,$id){
		if(!empty($id)){
			$id = " and id='$id'";
		}
		$query	= "select * from shipping where 1 $id order by receipt_number";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_payment_type($con){
		$query	= "select * from payment_type";
		$result = mysqli_query($con,$query);
		return $result;
	}

	function update_accounting_income($con,$id_resi,$resi_date,$district,$shipping_price,$weight,$packing_cost,$awb_fee,
	$insurance_number,$tax_number,$discount,$payment,$sum_price,$already_paid,$remaning_paid,$status){
		$query	= "UPDATE shipping SET receipt_date_accounting='$resi_date', receive_location='$district', shipping_price='$shipping_price',
			weight='$weight', packing_cost='$packing_cost', awb_fee='$awb_fee', insurance='$insurance_number', tax='$tax_number', status='$status',
			discount='$discount', payment_type='$payment', sum_price='$sum_price', already_price='$already_paid', remaining_price='$remaning_paid'
			WHERE id='$id_resi'";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_accounting_list($con){
		$query	= "SELECT *, b.name AS payment_name FROM shipping a
			LEFT JOIN payment_type b ON a.`payment_type`=b.id 
			WHERE STATUS=3 ORDER BY date_inserted DESC";
		$result = mysqli_query($con,$query);
		return $result;
	}

	function get_customer_type($con){
		$query	= "select * from customer_type";
		$result = mysqli_query($con,$query);
		return $result;
	}

	function get_warehouse_item_status($con){
		$query	= "select * from warehouse_item_status";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function update_shipping_operational($con,$id_resi,$sender_id,$receipt_id,$receipt_district,$weight,$amount){
		$query	= "UPDATE shipping SET sender='$sender_id', receive='$receipt_id', receive_location='$receipt_district', weight='$weight',
		amount_insurance = '$amount'
			WHERE id='$id_resi'";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function upd_warehouse_item_operational($con,$id,$weight,$description,$packing, $insurance, $status, $id_item){
		if(!empty($id_item)){
			$id_item	= ", id_items ='$id_item'";
		}
		$query	= "UPDATE warehouse_item SET weight='$weight', description='$description', packing='$packing',
		insurance='$insurance', `status`='$status' $id_item WHERE id='$id';";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_tertiary($con,$type,$id){
		if(!empty($id)){
			$id	= " and id='$id'";
		}
		$query	= "select * from tertiary where id_type='$type' $id";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_awb_bl($con,$awb_number,$delivery_number){
		if(!empty($awb_number)){
			$awb_number = " and a.id='$awb_number'";
		}
		if(!empty($delivery_number)){
			$delivery_number = " and a.id='$delivery_number'";
		}
		$query	= "SELECT a.*, b.shipping_method FROM awb_bl a
		LEFT JOIN (SELECT * FROM warehouse_item  GROUP BY id_awb_bl) b ON a.`id` = b.id_awb_bl
		WHERE a.status='4' $delivery_number $awb_number";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function ins_awb_bl($con,$awb_bl_number, $delivery_number, $loading_date, $sum_early, $combined, 
	$result_join, $number_pcs, $sum_weight, $passport_number, $passport_name, $passport_address, $airline, $status){
		$query	= "insert into awb_bl (awb_bl_number, delivery_number, loading_date,
		sum_early, combined, result_join, number_pcs, sum_weight, passport_number, passport_name, 
		passport_address, airline, status) values ('$awb_bl_number', '$delivery_number', '$loading_date', '$sum_early', 
		'$combined', '$result_join', '$number_pcs', '$sum_weight', '$passport_number', '$passport_name', '$passport_address', 
		'$airline', '$status')";
		$result = mysqli_query($con,$query);
		$last_id	= mysqli_insert_id($con);
		return $last_id;
	}
	
	function upd_warehouse_item_for_awb($con, $receipt_number, $urutan, $set_status, $shipping_method, $id_awb_bl){
		if(!empty($receipt_number)){
			$receipt_number = " and b.receipt_number = '$receipt_number'";
		}
		if(!empty($urutan)){
			$urutan = " and urutan ='$urutan'";
		}
		if(!empty($shipping_method)){
			$shipping_method = " , shipping_method = '$shipping_method'";
		}
		if(!empty($id_awb_bl)){
			$id_awb_bl = " , id_awb_bl = '$id_awb_bl'";
		}
		$query	= "update warehouse_item a
			LEFT JOIN shipping b on a.id_shipping = b.id
			SET warehouse_status = '$set_status' $shipping_method $id_awb_bl
			WHERE 1 $receipt_number $urutan ";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_group_acc($con){
		$query = "select * from accounting_group order by id";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_status_acc($con){
		$query = "select * from accounting_status order by id";
		$result = mysqli_query($con,$query);
		return $result;
	}

	function upd_acc($con, $id_acc, $est, $group_acc,$status){
		$query	= "UPDATE accounting set pos_name='$est', `group`= '$group_acc', status='$status' WHERE id='$id_acc'";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function ins_acc($con,$est,$group_acc,$status){
		$query	= "insert into accounting (pos_name,`group`,`status`)
			VALUES ('$est','$group_acc','$status')";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_acc($con,$type,$id,$est,$group,$status){
		if($type=="1"){
			$dataType = "";
		} else if($type=="2"){
			$dataType = " and a.status='1'";
		} else if($type=="3"){
			$dataType = " and a.status='2'";
		} else if($type=="4"){
			$dataType = " and a.id='0'";
		}

		if(!empty($id)){
			$id	 = " AND a.id like '%".$id."%'";
		}
		
		if(!empty($est)){
			$est		= " AND a.pos_name like '%".$est."%'";
		}
		
		if(!empty($group)){
			$group		= " AND a.`group`='$group'";
		}
		
		if(!empty($status)){
			$status		= " AND a.`status`='$status'";
		}
		
		$query = "SELECT a.*,b.name AS group_acc_name,c.name AS status_name FROM accounting a
				INNER JOIN accounting_group b 
				ON a.`group`=b.`id` 
			    INNER JOIN accounting_status c
				ON a.`status`=c.`id`
				WHERE 1 $dataType $id $est $group $status";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function ins_per($con,$periode_tgl,$from_periode,$to_periode,$status_per){
		$query	= "insert into periode (periode,`from`,`to`,`status`)
			VALUES	('$periode_tgl','$from_periode','$to_periode','$status_per')";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_periode($con,$type,$id,$per,$status,$frm,$to_tgl){
		if($type=="1"){
			$dataType = "";
		} else if($type=="4"){
			$dataType = " and a.id='0'";
		}
		
		if(!empty($id)){
			$id	 = " AND a.id like '%".$id."%'";
		}
		
		if(!empty($per)){
			$per		= " AND a.`periode`='$per'";
		}
		
		if(!empty($status)){
			$status		= " AND a.`status`='$status'";
		}
		
		if(!empty($frm)){
			$frm		= " AND a.`from`<='$frm'";
		}
		
		if(!empty($to_tgl)){
			$to_tgl		= " AND a.`to`>='$to_tgl'";
		}
		
		$query = "SELECT a.*,b.name AS status_posted FROM periode a
				  INNER JOIN periode_status b ON 
			      a.`status`=b.`id`
				  WHERE 1 $dataType $id $per $status $frm $to_tgl
				  ORDER BY a.periode, a.`from`,a.`to`";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function get_periode_status($con){
		$query = "SELECT * FROM periode_status ORDER BY id";
		$result = mysqli_query($con,$query);
		return $result;
	}
	
	function upd_awb_bl($con, $id, $loading_date, $sum_early, $combined, $result_join, $number_pcs, $sum_weight, 
		$passport_number, $passport_name, $passport_address, $airline, $awb_number, $delivery_number){
		$query	= "UPDATE awb_bl set loading_date='$loading_date', sum_early='$sum_early', combined='$combined',
		result_join='$result_join', number_pcs='$number_pcs', sum_weight='$sum_weight', passport_number='$passport_number',
		passport_name='$passport_name', passport_address='$passport_address', airline='$airline', awb_bl_number='$awb_number', delivery_number='$delivery_number'
		where id='$id'";
		$result = mysqli_query($con,$query);
		return $result;
	}
}
?>