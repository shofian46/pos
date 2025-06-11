<?php
$queryMenu = mysqli_query($conn, "SELECT * FROM menus ORDER BY id DESC");
$rowsMenu = mysqli_fetch_all($queryMenu, MYSQLI_ASSOC);
?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Menu Management</h4>
        <p class="card-text">Manage menu for the LMS.</p>
        <div>
          <a href="?page=tambah-menu" class="btn btn-primary rounded-pill float-end">
            <i class="bi bi-plus-circle"></i> Add menu
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-bordered datatable" id="insTable">
            <thead class="text-center table-primary">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Menu</th>
                <th scope="col">Parent ID</th>
                <th scope="col">Icon</th>
                <th scope="col">Url</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($rowsMenu as $menu): ?>
                <?php if (isset($menu)) : ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $menu['name']; ?></td>
                    <td><?= $menu['parent_id']; ?></td>
                    <td><?= $menu['icon']; ?></td>
                    <td><?= $menu['url']; ?></td>
                    <td class="text-center">
                      <a href="?page=tambah-menu&edit=<?= $menu['id']; ?>" class="btn btn-primary btn-sm rounded-pill">
                        <i class="bi bi-pencil-square"></i> Edit
                      </a>
                      <a href="?page=tambah-menu&delete=<?= $menu['id']; ?>" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm('Are you sure you want to delete this role?');">
                        <i class="bi bi-trash"></i> Delete
                      </a>
                    </td>
                  </tr>
                <?php else: ?>
                  <td colspan="3">Tidak Ada Data</td>
                <?php endif; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>