<?php
$hostname = "localhost";
$hostusername = "root";
$hostpassword = "";
$hostdatabase = "lms_angkatan_2";
$conn = mysqli_connect($hostname, $hostusername, $hostpassword, $hostdatabase);

if (!$conn) {
  echo "Connection Failed";
}
