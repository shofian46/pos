<!-- Delete user -->
<?php
$header = isset($_GET['edit']) ? "Edit" : "Tambah";
$id_user = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryedit = mysqli_query($conn, "SELECT * FROM roles WHERE id='$id_user'");
$rowedit = mysqli_fetch_assoc($queryedit);

if (isset($_GET['delete'])) {
  $id_user = isset($_GET['delete']) ? $_GET['delete'] : '';
  $queryDelete = mysqli_query($conn, "DELETE FROM roles WHERE id='$id_user'");
  if ($queryDelete) {
    header('location:?page=role&hapus=success');
  } else {
    header('location:?page=role&hapus=failed');
  }
}
// Add or update user
if (isset($_POST['name'])) {
  // ada tidak parameter bernama edit, kalau ada jalankan perintah edit/upadate, kalau tidak ada jalankan perintah insert
  if (isset($_POST['edit'])) {
    $id_user = isset($_GET['edit']) ? $_GET['edit'] : '';
    $name = $_POST['name'];
    $queryEdit = mysqli_query($conn, "UPDATE roles SET name='$name' WHERE id='$id_user'");
    if ($queryEdit) {
      header('location:?page=role&edit=success');
    } else {
      header('location:?page=role&edit=failed');
    }
  } else {
    $name = $_POST['name'];
    $queryInsert = mysqli_query($conn, "INSERT INTO roles (name) VALUES ('$name')");
    if ($queryInsert) {
      header('location:?page=role&save=success');
    } else {
      header('location:?page=role&save=failed');
    }
  }
}

?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"></h4>
        <p class="card-text">Add or update role information.</p>
        <div>
          <a href="?page=role" class="btn btn-secondary rounded-pill float-end">
            <i class="bi bi-arrow-left"></i> Back to Role List
          </a>
        </div>
      </div>
      <div class="card-body">
        <form method="post" action="">
          <div class="mb-3">
            <label for="name" class="form-label">Name<sup class="text-danger text-sm">*</sup></label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter role name" required value="<?= isset($_GET['edit']) ? $rowedit['name'] : ''; ?>">
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