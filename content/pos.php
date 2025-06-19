<?php
$queryTransaction = mysqli_query($conn, "SELECT u.name, t.* FROM transactions t
JOIN users u ON u.id = t.id_user
ORDER BY id DESC");
$rowsTransaction = mysqli_fetch_all($queryTransaction, MYSQLI_ASSOC);
?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Transaction Management</h4>
        <p class="card-text">Manage transaction for the POS.</p>
        <div>
          <a href="?page=tambah-pos" class="btn btn-primary rounded-pill float-end">
            <i class="bi bi-plus-circle"></i> Add Transaction
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-bordered datatable" id="userTable">
            <thead class="text-center table-primary">
              <tr>
                <th scope="col">No</th>
                <th scope="col">No Transaction</th>
                <th scope="col">Cashier Name</th>
                <th scope="col">Sub Total<small><sup>(Rp)</sup></small></th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($rowsTransaction as $index => $data): ?>
                <tr>
                  <td><?= $index += 1; ?></td>
                  <td><?= $data['no_transaction']; ?></td>
                  <td><?= $data['name']; ?></td>
                  <td><?= "Rp." . $data['sub_total']; ?></td>
                  <td>
                    <a href="?page=tambah-pos&print<?= $data['id'] ?>" class="btn btn-outline-primary rounded-pill">Print</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    let tableuser = new DataTable('#userTable');
  });
</script>