<!-- Delete user -->
<?php
$header = isset($_GET['edit']) ? "Edit" : "Tambah";
$id_user = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryedit = mysqli_query($conn, "SELECT * FROM products WHERE id='$id_user'");
$rowedit = mysqli_fetch_assoc($queryedit);
// Categories query
$queryCategory = mysqli_query($conn, "SELECT * FROM categories ORDER BY id DESC");

if (isset($_GET['delete'])) {
  $id_user = isset($_GET['delete']) ? $_GET['delete'] : '';
  $queryDelete = mysqli_query($conn, "DELETE FROM products WHERE id='$id_user'");
  if ($queryDelete) {
    header('location:?page=product&hapus=success');
  } else {
    header('location:?page=product&hapus=failed');
  }
}
// Add or update user
if (isset($_POST['name'])) {
  // ada tidak parameter bernama edit, kalau ada jalankan perintah edit/upadate, kalau tidak ada jalankan perintah insert
  if (isset($_POST['edit'])) {
    $id_user = isset($_GET['edit']) ? $_GET['edit'] : '';
    $id_category = $_POST['id_category'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $description = $_POST['description'];
    $queryEdit = mysqli_query($conn, "UPDATE products SET id_category='$id_category', name='$name', price='$price', qty='$qty', description='$description' WHERE id='$id_user'");
    if ($queryEdit) {
      header('location:?page=product&edit=success');
    } else {
      header('location:?page=product&edit=failed');
    }
  } else {
    $id_category = $_POST['id_category'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $description = $_POST['description'];
    $queryInsert = mysqli_query($conn, "INSERT INTO products (id_category, name, price, qty, description) VALUES ('$id_category','$name', '$price', '$qty','$description')");
    if ($queryInsert) {
      header('location:?page=product&save=success');
    } else {
      header('location:?page=product&save=failed');
    }
  }
}

?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"></h4>
        <p class="card-text">Add or update user information.</p>
        <div>
          <a href="?page=product" class="btn btn-secondary rounded-pill float-end">
            <i class="bi bi-arrow-left"></i> Back to User List
          </a>
        </div>
      </div>
      <div class="card-body">
        <form method="post" action="">
          <div class="mb-3">
            <label for="name" class="form-label">Category<sup class="text-danger text-sm">*</sup></label>
            <select name="id_category" id="ic_category" class="form-select" required>
              <option value="">Select Category</option>
              <?php
              while ($rowCategory = mysqli_fetch_assoc($queryCategory)) {
                $selected = isset($_GET['edit']) && $rowedit['id_category'] == $rowCategory['id'] ? 'selected' : '';
                echo "<option value='{$rowCategory['id']}' $selected>{$rowCategory['name']}</option>";
              }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Product Name<sup class="text-danger text-sm">*</sup></label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter product" required value="<?= isset($_GET['edit']) ? $rowedit['name'] : ''; ?>">
            <div class="mb-3">
              <label for="price" class="form-label">Price<sup class="text-danger text-sm">*</sup></label>
              <input type="number" class="form-control" id="price" name="price" placeholder="Enter price" required value="<?= isset($_GET['edit']) ? $rowedit['price'] : ''; ?>">
            </div>
            <div class="mb-3">
              <label for="qty" class="form-label">Qty<sup class="text-danger text-sm">*</sup></label>
              <input type="number" class="form-control" id="qty" name="qty" placeholder="Enter qty" required value="<?= isset($_GET['edit']) ? $rowedit['qty'] : ''; ?>">
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Description<sup class="text-danger text-sm">*</sup></label>
              <textarea name="description" id="description" class="form-control"><?= isset($_GET['edit']) ? $rowedit['description'] : null; ?></textarea>
            </div>
            <div class="mb-3">
              <button type="submit" class="btn btn-success rounded-pill" name="<?= isset($_GET['edit']) ? 'edit' : 'save'; ?>"><?= $header; ?></button>
              <button type="reset" class="btn btn-secondary rounded-pill">Reset</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>