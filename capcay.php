<?php
$data_capcay = base64_decode($_GET['data']);
if($data_capcay ==  1){
//mengaktifkan session
session_start();
 
//header("Content-type: image/png");
 
// menentukan session
$_SESSION["nomor_acak"]="";
 
// membuat gambar dengan menentukan ukuran
$gbr = imagecreate(100, 40);

//warna background captcha
imagecolorallocate($gbr, 69, 179, 157);
 
// pengaturan font captcha
$color = imagecolorallocate($gbr, 253, 252, 252);
$font = "assets/global/font/GIGI.TTF"; 
$ukuran_font = 20;
$posisi = 32;
// membuat nomor acak dan ditampilkan pada gambar
for($i=0;$i<=5;$i++) {
	// jumlah karakter
	$angka=rand(0, 9);
 
	$_SESSION["nomor_acak"].=$angka;
 
	$kemiringan= rand(0, 50);
 	
	imagettftext($gbr, $ukuran_font, $kemiringan, 8+15*$i, $posisi, $color, $font, $angka);	
}
//untuk membuat gambar 
imagepng($gbr); 
imagedestroy($gbr);
} else {
	header("location:index.php");
}
?>