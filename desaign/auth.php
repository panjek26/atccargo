<?php
if(isset($_POST['submit'])){
session_start();
	
	$nama		= str_replace(array("'",'"'),'',$_POST['username']);
	$pass 		= str_replace(array("'",'"'),'',$_POST['password']);
	$capcay		= str_replace(array("'",'"'),'',$_POST['captcha']);
	$data_error	= "false";
	$cek_user	= $conf->cek_user($con,$nama);
	if($_SESSION['nomor_acak'] == $capcay ){
		if(mysqli_num_rows($cek_user) == 1){
			$r_user	= mysqli_fetch_assoc($cek_user);
			if(substr($r_user['password'],0,-3) == md5($pass)){
		$_SESSION['username']=$r_user['username'];
		$_SESSION['fullname']=$r_user['fullname'];
		$_SESSION['level']=$r_user['level'];
		$_SESSION['division']=$r_user['division'];
		$_SESSION['group']=$r_user['group_menu'];
		$_SESSION['id']=$r_user['id'];
		
		$data_menus=$conf->session_menu($con,$r_user['group_menu']);
		$ar_menu=array();
		while($q_menus=mysqli_fetch_assoc($data_menus)){
			$ar_menu[]=$q_menus['nama_menu'];
		}
		$_SESSION['menu']=$ar_menu;
		?>
<script>location.href='dashboard.php';</script>
<?php 		}
		}
	}
} 


?>