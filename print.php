<?php 
session_start();
ob_start();
date_default_timezone_set('Asia/Jakarta');
include 'config/koneksi.php';
include 'settingRole.php';
$id_user = isset($_GET['id']) ? $_GET['id'] : '';

$queryPrint = mysqli_query($conn, "SELECT u.name, t.*, td.id_transaction as transactionID, td.id_product as productID, td.qty as productQty, td.total as productTotal, p.name as product_name, p.price, p.price, p.qty, p.description FROM transactions t
JOIN users u ON u.id = t.id_user
JOIN transaction_details td ON td.id_transaction = t.id
JOIN products p ON p.id = td.id_product
WHERE t.id = $id_user");
// --- CHANGE STARTS HERE ---
// Initialize an empty array to store all rows
$rowsTransaction = [];
// Loop through the query result and fetch each row
while ($row = mysqli_fetch_assoc($queryPrint)) {
    $rowsTransaction[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Struk</title>
  <link rel="stylesheet" href="./assets/css/styles.css">
</head>

<body>
  <div class="invoice">
    <div class="invoice-header">
      <h3>Kedai Cookies</h3>
      <h2>Cookies & Cake</h2>
      <br class="info text-center">
      Jl. Warakas I Gg.24 No. 50, Jakarta Utara</br>
      <strong>Telp:</strong> 0896-8796-0758<br 
    </div>
  </div>
     <?php 
    // Check if there are any transactions to display
    if (!empty($rowsTransaction)): 
        // Assuming all transaction details belong to the same parent transaction,
        // we can take the first item to get the general transaction info like date, user, etc.
        // For product details, you'll loop through the $rowsTransaction array.
        $firstTransaction = $rowsTransaction[0]; 
    ?>
    <div class="line"></div>
    <div class="invoice-details">
      <div class="row">
        <span>
          <?= date('d F Y', $firstTransaction['create_at']); ?>
        </span>
        <span>
          <?= date('H:i:s', $firstTransaction['create_at']); ?>
        </span>
      </div>
      <div class="row">
        <span><?= canAddModul(1) ? 'Admin' : 'Cashier'; ?></span>
        <span><?= $firstTransaction['name']; ?></span>
      </div>
      
      <div class="row">
        <span>Order ID</span>
        <span><?= $firstTransaction['no_transaction']; ?></span>
      </div>
    </div>
    <div class="line"></div>
    <div class="products">
      <?php 
       $subTotal = 0;
      foreach($rowsTransaction as $d): // Now this loop will iterate through each product item ?>
      <div class="item">
        <strong><?= $d['product_name']; ?></strong>
        <div class="item-quatity">
          <span><?= $d['productQty'] .'x @'. number_format($d['price'], 0, ',', '.'); ?></span>
          <span>Rp. <?= number_format($d['productTotal'], 0, ',', '.'); ?></span>
        </div>
      </div>
      <?php 
      $subTotal += $d['productTotal'];
      endforeach; ?>
    </div>
    <div class="line"></div>
    <div class="summary">
      <div class="row">
        <span>Sub Total</span>
       <span>Rp. <?= number_format($subTotal, 0, ',', '.'); ?></span>
      </div>
      
    </div>
    <div class="line"></div>
    <?php else: ?>
        <p class="text-center">No transaction details found for this ID.</p>
    <?php endif; ?>
    <footer class="text-center">
      Terimakasih telah berbelanja di Kedai Cookies.
    </footer>
  </div>
  <script>
    window.onload = function () {
      window.print();
      setTimeout(function () {
        window.close();
      }, 1000);
    };
  </script>
</body>

</html>