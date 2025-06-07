<?php
$header = isset($_GET['detail']) ? "Edit" : "Tambah";
$id_user = isset($_GET['detail']) ? $_GET['detail'] : '';
$queryDetail = mysqli_query($conn, "SELECT * FROM instructors WHERE id='$id_user'");
$rowDetail = mysqli_fetch_assoc($queryDetail);

?>
<div class="card mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?= $rowDetail['name']; ?></h5>
        <div class="row">
          <div class="col-md-7">
            <p class="card-text"><small class="text-muted">Gender: <?= $rowDetail['gender'] == '1' ? '<span class="badge rounded-pill bg-primary">Laki-Laki</span>' : '<span class="badge rounded-pill bg-danger">Perempuan</span>'; ?></small></p>
          </div>
          <div class="col">
            <p class="card-text"><small class="text-muted">Education: <?= $rowDetail['education']; ?></small></p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-7">
            <p class="card-text"><small class="text-muted">Email: <?= $rowDetail['email']; ?></small></p>
          </div>
          <div class="col">
            <p class="card-text"><small class="text-muted">Phone: <?= $rowDetail['phone']; ?></small></p>
          </div>
        </div>




        <p class="card-text">Address: <?= $rowDetail['address']; ?> </p>
        <p class="card-text"><small class="text-muted"><?= date('d-F-Y', strtotime($rowDetail['created_at'])); ?></small></p>
      </div>
    </div>
  </div>
</div>