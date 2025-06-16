<?php
$queryProduct = mysqli_query($conn, "SELECT products.*, categories.name as category_name FROM products JOIN categories ON categories.id = products.id_category ORDER BY id DESC");
$rowsProduct = mysqli_fetch_all($queryProduct, MYSQLI_ASSOC);
?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Product Management</h4>
        <p class="card-text">Manage product for the LMS.</p>
        <div>
          <a href="?page=tambah-product" class="btn btn-primary rounded-pill float-end">
            <i class="bi bi-plus-circle"></i> Add Product
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-bordered datatable" id="insTable">
            <thead class="text-center table-primary">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Category</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Price</th>
                <th scope="col">Qty</th>
                <th scope="col">Desc</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($rowsProduct as $product): ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $product['categpry_name']; ?></td>
                  <td><?= $product['name']; ?></td>
                  <td><?= $product['price']; ?></td>
                  <td><?= $product['qty']; ?></td>
                  <td><?= $product['desc']; ?></td>
                  <td class="text-center">
                    <a href="?page=detail-product&detail=<?= $product['id']; ?>" class="btn btn-success btn-sm rounded-pill">
                      <i class="bi bi-eye"></i> Detail
                    </a>
                    <a href="?page=tambah-product&edit=<?= $product['id']; ?>" class="btn btn-primary btn-sm rounded-pill">
                      <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <a href="?page=tambah-product&delete=<?= $product['id']; ?>" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm('Are you sure you want to delete this product?');">
                      <i class="bi bi-trash"></i> Delete
                    </a>
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