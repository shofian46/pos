<?php
$hostname = "localhost";
$hostusername = "root";
$hostpassword = "";
$hostdatabase = "point_of_sale2";
$conn = mysqli_connect($hostname, $hostusername, $hostpassword, $hostdatabase);

if (!$conn) {
  echo "Connection Failed";
}
