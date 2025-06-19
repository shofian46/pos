<?php

ob_clean();
require_once 'vendor/autoload.php';
require_once 'config/koneksi.php';

$mpdf = new \Mpdf\Mpdf();
$IdPrint = $_GET['print'];
$queryPrint = mysqli_query($conn, "SELECT u.name, t.* FROM transactions t
JOIN users u ON u.id = t.id_user
WHERE t.id = '$IdPrint'");
$dataPrint = mysqli_fetch_assoc($queryPrint);

$mpdf->SetTitle('Print Transaction');
$mpdf->SetHeader('Transaction No: ' . $dataPrint['no_transaction'] . ' | Cashier: ' . $dataPrint['name'] . ' | Date: ' . date('d-F-Y H:i:s', $dataPrint['created_at']));
$mpdf->SetFooter('Page {PAGENO} of {nbpg}');
$mpdf->WriteHTML('<h1>Hello world!</h1>');
$mpdf->Output();