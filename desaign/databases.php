<?php
 error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_STRICT));
 date_default_timezone_set ('Asia/Jakarta');
$host="localhost";
$user="root";
$password="";
$db="cargoind_db";
$con = mysqli_connect($host,$user,$password,$db);

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$conf = new Config();
?>