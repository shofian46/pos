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
      <strong>Telp:</strong> 0896-8796-0758<br </div>
    </div>
    <div class="line"></div>
    <div class="invoice-details">
      <div class="row">
        <span>20 Jun 2025</span>
        <span>09:39</span>
      </div>
      <div class="row">
        <span>Cashier</span>
        <span>Testing</span>
      </div>
      <div class="row">
        <span>Order ID</span>
        <span>TR-200625-001</span>
      </div>
    </div>
    <div class="line"></div>
    <div class="products">
      <div class="item">
        <strong>Rainbow Cake</strong>
        <div class="item-quatity">
          <span>1x @ 50.000</span>
          <span>Rp. 50.000</span>
        </div>
      </div>
    </div>
    <div class="line"></div>
    <div class="summary">
      <div class="row">
        <span>Sub Total</span>
        <span>Rp. 50.000</span>
      </div>
    </div>
    <div class="line"></div>
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