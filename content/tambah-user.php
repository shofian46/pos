<!-- Delete user -->
<?php
$header = isset($_GET['edit']) ? "Edit" : "Tambah";
$id_user = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryedit = mysqli_query($conn, "SELECT * FROM users WHERE id='$id_user'");
$rowedit = mysqli_fetch_assoc($queryedit);

// Query Role
$rolesUser = isset($_GET['tambah-user-role']) ? $_GET['tambah-user-role'] : '';
$queryRoles = mysqli_query($conn, "SELECT * FROM role ORDER BY id DESC");
$rowRoles = mysqli_fetch_all($queryRoles, MYSQLI_ASSOC);

if (isset($_POST['id_role']) && isset($_GET['tambah-user-role'])) {
  $id_role = $_POST['id_role'];
  $queryInsertRole = mysqli_query($conn, "INSERT INTO user_role (id_user, id_role) VALUES ('$rolesUser', '$id_role')");
  if ($queryInsertRole) {
    header('location:?page=tambah-user-role&tambah-user-role=' . $rolesUser . '&save=success');
  } else {
    header('location:?page=tambah-user-role&tambah-user-role=' . $rolesUser . '&save=failed');
  }
}

$queryUserRoles = mysqli_query($conn, "SELECT user_role.*,role.name as name_role FROM user_role JOIN role ON role.id = user_role.id_role ORDER BY id DESC");
$rowUserRoles = mysqli_fetch_all($queryUserRoles, MYSQLI_ASSOC);
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
        <?php if (isset($_GET['tambah-user-role'])):
          $title = "Add User Role";
        elseif (isset($_GET['edit'])):
          $title = "Edit User";
        else:
          $title = "";
        endif; ?>
        <p class="card-text"><?= $title; ?> information.</p>
        <php>
          <?php if (isset($_GET['tambah-user-role'])): ?>
            <a href="#" class="btn btn-primary rounded-pill float-end" data-bs-toggle="modal" data-bs-target="#ModalRole">
              <i class="bi bi-plus-circle"></i> Add New Role
            </a>
          <?php else: ?>
            <a href="?page=user" class="btn btn-secondary rounded-pill float-end">
              <i class="bi bi-arrow-left"></i> Back to User List
            </a>
          <?php endif; ?>
        </php>
      </div>
      <div class="card-body">
        <?php if (isset($_GET['tambah-user-role'])): ?>
          <div class="table-responsive">
            <table class="table table-hover table-bordered table-stripped">
              <thead class="text-center table-success">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Role Name</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                foreach ($rowUserRoles as $rowUserRole): ?>
                  <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $rowUserRole['name_role']; ?></td>
                    <td class="text-center">
                      <a href="?page=tambah-user&edit-user-role=<?= $rowUserRole['id_user']; ?>&edit=<?= $rowUserRole['id']; ?>" class="btn btn-primary btn-sm rounded-pill">
                        <i class="bi bi-pencil-square"></i> Edit
                      </a>
                      <a href="?page=tambah-user&hapus-user-role=<?= $rowUserRole['id']; ?>" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm('Are you sure you want to delete this role?');">
                        <i class="bi bi-trash"></i> Delete
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php else: ?>
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
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ModalRole" tabindex="-1" aria-labelledby="ModalRoleLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="ModalRoleLabel">Add New Role: </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <div class="mb-3">
            <label for="" class="form-label">Role Name</label>
            <select name="id_role" id="" class="form-control">
              <option value="">Select One</option>
              <?php foreach ($rowRoles as $rowRole): ?>
                <option value="<?php echo $rowRole['id'] ?>"><?php echo $rowRole['name'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>