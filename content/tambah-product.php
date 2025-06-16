<!-- Delete user -->
<?php
$header = isset($_GET['edit']) ? "Edit" : "Tambah";
$id_user = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryedit = mysqli_query($conn, "SELECT * FROM instructors WHERE id='$id_user'");
$rowedit = mysqli_fetch_assoc($queryedit);

if (isset($_GET['delete'])) {
  $id_user = isset($_GET['delete']) ? $_GET['delete'] : '';
  $queryDelete = mysqli_query($conn, "DELETE FROM instructors WHERE id='$id_user'");
  if ($queryDelete) {
    header('location:?page=instructor&hapus=success');
  } else {
    header('location:?page=instructor&hapus=failed');
  }
}
// Add or update user
if (isset($_POST['name'])) {
  // ada tidak parameter bernama edit, kalau ada jalankan perintah edit/upadate, kalau tidak ada jalankan perintah insert
  if (isset($_POST['edit'])) {
    $id_user = isset($_GET['edit']) ? $_GET['edit'] : '';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $education = $_POST['education'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = isset($_POST['password']) ? sha1($_POST['password']) : $rowedit['password'];
    $id_role = 1;
    $queryEdit = mysqli_query($conn, "UPDATE instructors SET id_role='$id_role', name='$name', email='$email', gender='$gender', education='$education', phone='$phone', address='$address', password='$password' WHERE id='$id_user'");
    if ($queryEdit) {
      header('location:?page=instructor&edit=success');
    } else {
      header('location:?page=instructor&edit=failed');
    }
  } else {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $education = $_POST['education'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = isset($_POST['password']) ? sha1($_POST['password']) : $rowedit['password'];
    $id_role = 1; // Assuming role 1 is for instructors
    $queryInsert = mysqli_query($conn, "INSERT INTO instructors (id_role, name, email, gender, education, phone, address, password) VALUES ('$id_role','$name', '$email', '$gender', '$education', '$phone', '$address', '$password')");
    if ($queryInsert) {
      header('location:?page=instructor&save=success');
    } else {
      header('location:?page=instructor&save=failed');
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
          <a href="?page=instructor" class="btn btn-secondary rounded-pill float-end">
            <i class="bi bi-arrow-left"></i> Back to User List
          </a>
        </div>
      </div>
      <div class="card-body">
        <form method="post" action="">
          <div class="mb-3">
            <label for="name" class="form-label">Name<sup class="text-danger text-sm">*</sup></label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter full name" required value="<?= isset($_GET['edit']) ? $rowedit['name'] : ''; ?>">
          </div>
          <div class="mb-3">
            <label for="gender" class="form-label">Gender<sup class="text-danger text-sm">*</sup></label>
            <div class="col-sm-10">
              <input type="radio" name="gender" value="1" <?= isset($_GET['edit']) ? $rowedit['gender'] == $rowedit['gender'] ? 'checked' : "" : "" ?>> Laki-Laki

              <input type="radio" name="gender" value="0" <?= isset($_GET['edit']) ? $rowedit['gender'] == 0 ? 'checked' : "" : "" ?>> Perempuan
            </div>
          </div>
          <div class="mb-3">
            <label for="education" class="form-label">Education<sup class="text-danger text-sm">*</sup></label>
            <input type="text" class="form-control" id="education" name="education" placeholder="Enter education" required value="<?= isset($_GET['edit']) ? $rowedit['education'] : ''; ?>">
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Phone<sup class="text-danger text-sm">*</sup></label>
            <input type="number" class="form-control" id="phone" name="phone" placeholder="Enter phone" required value="<?= isset($_GET['edit']) ? $rowedit['phone'] : ''; ?>">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email<sup class="text-danger text-sm">*</sup></label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required value="<?= isset($_GET['edit']) ? $rowedit['email'] : ''; ?>">
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Address<sup class="text-danger text-sm">*</sup></label>
            <textarea name="address" id="address" class="form-control"><?= isset($_GET['edit']) ? $rowedit['address'] : ''; ?></textarea>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password<sup class="text-danger text-sm">*</sup></label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required value="<?= isset($_GET['edit']) ? $rowedit['password'] : ''; ?>">
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