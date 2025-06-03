<!-- Delete user -->
<?php
$header = isset($_GET['edit']) ? "Edit" : "Tambah";
$id_user = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryedit = mysqli_query($conn, "SELECT * FROM users WHERE id='$id_user'");
$rowedit = mysqli_fetch_assoc($queryedit);
if (isset($_GET['delete'])) {
  $id_user = isset($_GET['delete']) ? $_GET['delete'] : '';
  $queryDelete = mysqli_query($conn, "UPDATE users SET deleted_at = 1 WHERE id='$id_user'");
  if ($queryDelete) {
    header('location:?page=user&hapus=success');
  } else {
    header('location:?page=user&hapus=failed');
  }
}
// Add or update user
if (isset($_POST['name'])) {
  // ada tidak parameter bernama edit, kalau ada jalankan perintah edit/upadate, kalau tidak ada jalankan perintah insert
  if (isset($_POST['edit'])) {
    $id_user = isset($_GET['edit']) ? $_GET['edit'] : '';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $queryEdit = mysqli_query($conn, "UPDATE users SET name='$name', email='$email', password='$password' WHERE id='$id_user'");
    if ($queryEdit) {
      header('location:?page=user&edit=success');
    } else {
      header('location:?page=user&edit=failed');
    }
  } else {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $queryInsert = mysqli_query($conn, "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')");
    if ($queryInsert) {
      header('location:?page=user&save=success');
    } else {
      header('location:?page=user&save=failed');
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
          <a href="?page=user" class="btn btn-secondary rounded-pill float-end">
            <i class="bi bi-arrow-left"></i> Back to User List
          </a>
        </div>
      </div>
      <div class="card-body">
        <form method="post" action="">
          <div class="mb-3">
            <label for="name" class="form-label">Full Name<sup class="text-danger text-sm">*</sup></label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter full name" required value="<?= isset($_GET['edit']) ? $rowedit['name'] : ''; ?>">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email<sup class="text-danger text-sm">*</sup></label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address" required value="<?= isset($_GET['edit']) ? $rowedit['email'] : ''; ?>">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password<sup class="text-danger text-sm">*</sup></label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
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