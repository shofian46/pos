<?php
$queryrole = mysqli_query($conn, "SELECT * FROM roles ORDER BY id DESC");
$rowsrole = mysqli_fetch_all($queryrole, MYSQLI_ASSOC);
?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Role Management</h4>
        <p class="card-text">Manage role for the LMS.</p>
        <div>
          <a href="?page=tambah-role" class="btn btn-primary rounded-pill float-end">
            <i class="bi bi-plus-circle"></i> Add Role
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-bordered datatable" id="insTable">
            <thead class="text-center table-primary">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($rowsrole as $role): ?>
                <?php if (isset($role)) : ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $role['name']; ?></td>
                    <td class="text-center">
                      <a href="?page=tambah-role&edit=<?= $role['id']; ?>" class="btn btn-primary btn-sm rounded-pill">
                        <i class="bi bi-pencil-square"></i> Edit
                      </a>
                      <a href="?page=tambah-role&delete=<?= $role['id']; ?>" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm('Are you sure you want to delete this role?');">
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