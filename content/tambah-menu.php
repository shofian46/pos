<!-- Delete user -->
<?php
$header = isset($_GET['edit']) ? "Edit" : "Tambah";
$id_menu = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryedit = mysqli_query($conn, "SELECT * FROM menus WHERE id='$id_menu'");
$rowedit = mysqli_fetch_assoc($queryedit);

if (isset($_GET['delete'])) {
  $id_menu = isset($_GET['delete']) ? $_GET['delete'] : '';
  $queryDelete = mysqli_query($conn, "DELETE FROM menus WHERE id='$id_menu'");
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
    $id_menu = isset($_GET['edit']) ? $_GET['edit'] : '';
    $name = $_POST['name'];
    $parent_id = $_POST['parent_id'];
    $icon = $_POST['icon'];
    $url = $_POST['url'];
    $urutan = $_POST['urutan'];
    $queryEdit = mysqli_query($conn, "UPDATE menus SET name='$name', parent_id='$parent_id', icon='$icon', url='$url', urutan='$urutan' WHERE id='$id_menu'");
    if ($queryEdit) {
      header('location:?page=menu&edit=success');
    } else {
      header('location:?page=menu&edit=failed');
    }
  } else {
    $name = $_POST['name'];
    $parent_id = $_POST['parent_id'];
    $icon = $_POST['icon'];
    $url = $_POST['url'];
    $urutan = $_POST['urutan'];
    $queryInsert = mysqli_query($conn, "INSERT INTO menus (name, parent_id, icon, url, urutan) VALUES ('$name','$parent_id','$icon', '$url', '$urutan')");
    if ($queryInsert) {
      header('location:?page=menu&save=success');
    } else {
      header('location:?page=menu&save=failed');
    }
  }
}

$queryparentid = mysqli_query($conn, "SELECT * FROM menus WHERE parent_id = 0 OR parent_id=''");
$rowparentid = mysqli_fetch_all($queryparentid, MYSQLI_ASSOC);

?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"></h4>
        <p class="card-text">Add or update menu information.</p>
        <div>
          <a href="?page=menu" class="btn btn-secondary rounded-pill float-end">
            <i class="bi bi-arrow-left"></i> Back to Menu List
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
            <label for="parent_id" class="form-label">Parent Id<sup class="text-danger text-sm">*</sup></label>
            <select name="parent_id" id="parent_id" class="form-select">
              <option value="">Select One</option>
              <?php foreach ($rowparentid as $parent): ?>
                <option value="<?= $parent['id']; ?>" <?= isset($_GET['edit']) && $rowedit['parent_id'] == $parent['id'] ? 'selected' : ''; ?>>
                  <?= $parent['name']; ?>
                </option>
                >
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="icon" class="form-label">Icon<sup class="text-danger text-sm">*</sup></label>
            <input type="text" class="form-control" id="icon" name="icon" placeholder="Enter icon name" required value="<?= isset($_GET['edit']) ? $rowedit['icon'] : ''; ?>">
          </div>
          <div class="mb-3">
            <label for="url" class="form-label">Url<sup class="text-danger text-sm">*</sup></label>
            <input type="text" class="form-control" id="url" name="url" placeholder="Enter url name" value="<?= isset($_GET['edit']) ? $rowedit['url'] : ''; ?>">
          </div>
          <div class="mb-3">
            <label for="urutan" class="form-label">urutan<sup class="text-danger text-sm">*</sup></label>
            <input type="text" class="form-control" id="urutan" name="urutan" placeholder="Enter urutan" required value="<?= isset($_GET['edit']) ? $rowedit['urutan'] : ''; ?>">
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