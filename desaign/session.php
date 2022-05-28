<?php 
session_start();// mengecek ada tidaknya session untuk username
if ($_SESSION['username']){
	
	if(in_array($subheader,$_SESSION['menu'])){
		
	} else {
		session_destroy();	
		echo "<script>location.href='index.php'</script>";	
	}
	
}else {
	session_destroy();	
		echo "<script>location.href='index.php'</script>";	
		exit;}
?>