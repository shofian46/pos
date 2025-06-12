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

if (isset($_GET['add-role-menu'])) {
  $id_role = $_GET['add-role-menu'];
  $menus = mysqli_query($conn, "SELECT * FROM menus order by parent_id, urutan");
  $rowMenu = [];
  while ($m = mysqli_fetch_assoc($menus)) {
    $rowMenu[] = $m;
  }
}

if (isset($_POST['save-role-menu'])) {
  $id_role = $_GET['add-role-menu'];
  $id_menus = $_POST['id_menus'] ?? [];
  // Delete existing role menus
  mysqli_query($conn, "DELETE FROM menu_roles WHERE id_role='$id_role'");
  // Insert new role menus
  foreach ($id_menus as $m) {
    mysqli_query($conn, "INSERT INTO menu_roles (id_role, id_menu) VALUES ('$id_role', '$m')");
  }
  header("location:?page=role&add-role-menu=" . $id_role . "&tambah=success");
}

if (isset($_GET['add-role-menu'])) {
  $id_role = $_GET['add-role-menu'];

  $roweditrolemenu = [];
  $editrolemenu = mysqli_query($conn, "SELECT * FROM menu_roles WHERE id_role='$id_role'");
  // $roweditrolemenu = mysqli_fetch_all($editrolemenu, MYSQLI_ASSOC);

  while ($editmenu = mysqli_fetch_assoc($editrolemenu)) {
    $roweditrolemenu[] = $editmenu['id_menu'];
  }



  $Menus = mysqli_query($conn, "SELECT * FROM menus ORDER BY parent_id, urutan");
  $rowmenus = [];
  while ($m = mysqli_fetch_assoc($Menus)) {
    $rowmenus[] = $m;
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
        <?php if (isset($_GET['add-role-menu'])): ?>
          <form action="" method="post">
            <ul>
              <?php foreach ($rowMenu as $mainMenu): ?>
                <?php if ($mainMenu['parent_id'] == 0 or $mainMenu['parent_id'] == ""): ?>
                  <li>
                    <div class="mb-3 form-check">
                      <!-- <label for="menu" class="form-check-label">Menu</label> -->
                      <input type="checkbox" class="form-check-input" name="id_menus[]" value="<?= $mainMenu['id']; ?>" <?php echo in_array($mainMenu['id'], $roweditrolemenu) ? 'checked' : '' ?>>
                      <?= $mainMenu['name'] ?>
                    </div>
                    <ul>
                      <?php foreach ($rowMenu as $subMenu): ?>
                        <?php if ($subMenu['parent_id'] == $mainMenu['id']): ?>
                          <li>
                            <div class="mb-3 form-check">
                              <input type="checkbox" class="form-check-input" name="id_menus[]" value="<?= $subMenu['id']; ?>" <?php echo in_array($subMenu['id'], $roweditrolemenu) ? 'checked' : ''  ?>>
                              <?= $subMenu['name'] ?>
                            </div>
                          </li>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </ul>
                  </li>
                <?php endif; ?>
              <?php endforeach; ?>
            </ul>
            <div class="my-3 float-end">
              <button type="submit" class="btn btn-success rounded-pill" name="save-role-menu">Save Role Menu</button>
            </div>
          </form>
        <?php elseif (isset($_GET['edit']) || empty($_GET['edit'])): ?>
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
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>