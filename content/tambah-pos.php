<!-- Delete user -->
<?php
$header = isset($_GET['edit']) ? "Edit" : "Tambah";
$id_user = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryedit = mysqli_query($conn, "SELECT * FROM users WHERE id='$id_user'");
$rowedit = mysqli_fetch_assoc($queryedit);

// Query Role
$rolesUser = isset($_GET['tambah-pos']) ? $_GET['tambah-pos'] : '';


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

$queryProducts = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
$rowProducts = mysqli_fetch_all($queryProducts, MYSQLI_ASSOC);

$queryNoTrans = mysqli_query($conn, "SELECT MAX(id) AS id_trans FROM transactions");
$rowNoTrans = mysqli_fetch_assoc($queryNoTrans);
$id_Trans = $rowNoTrans['id_trans'];
$id_Trans++;

$formatNo = "TR";
$date = date('dmy');
$icrement_number = sprintf("%03s", $id_Trans);
$noTransaction = $formatNo . "-" . $date . "-" . $icrement_number;
// $noTransaction = $formatNo . "-" . $date . "-" . str_pad("0", $id_Trans, STR_PAD_LEFT);
?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"></h4>
        <?php if (isset($_GET['tambah-pos'])):
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
            <a href="?page=pos" class="btn btn-secondary rounded-pill float-end">
              <i class="bi bi-arrow-left"></i> Transaction List
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
            <div class="row">
              <div class="col-sm-4">
                <div class="mb-3">
                  <label for="no_transaction" class="form-label">No Transaction<sup class="text-danger text-sm">*</sup></label>
                  <input type="text" class="form-control" id="no_transaction" name="no_transaction" readonly value="<?= $noTransaction; ?>">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="mb-3">
                  <label for="id_user" class="form-label">Cashier<sup class="text-danger text-sm">*</sup></label>
                  <input type="text" class="form-control" name="id_user" readonly value="<?= $_SESSION['name']; ?>">
                  <input type="hidden" class="form-control" name="id_user" value="<?= $_SESSION['uuid']; ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <div class="mb-3">
                  <label for="" class="form-label">Product<sup class="text-danger text-sm">*</sup></label>
                  <select name="id_product" id="id_product" class="form-control">
                    <option value="">Select Product</option>
                    <?php foreach ($rowProducts as $rowProduct): ?>
                      <option value="<?= $rowProduct['id']; ?>"><?= $rowProduct['name']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
            <div align="right" class="mb-3">
              <button type="button" class="btn btn-primary addRow" id="addRow">Add Row</button>
            </div>

            <div class="table-responsive">
              <table class="table table-hover" id="tablePos">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama product</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
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