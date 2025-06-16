<?php
$queryUser = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
$rowsUser = mysqli_fetch_all($queryUser, MYSQLI_ASSOC);
?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">User Management</h4>
        <p class="card-text">Manage user accounts for the LMS.</p>
        <div>
          <a href="?page=tambah-user" class="btn btn-primary rounded-pill float-end">
            <i class="bi bi-plus-circle"></i> Add User
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-bordered datatable" id="userTable">
            <thead class="text-center table-primary">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Fullname</th>
                <th scope="col">Email</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($rowsUser as $user): ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $user['name']; ?></td>
                  <td><?= $user['email']; ?></td>
                  <td class="text-center">
                    <a href="?page=tambah-user&tambah-user-role=<?php echo $user['id'] ?>"
                      class="btn btn-success btn-sm rounded-pill">
                      <i class="bi bi-plus-circle"></i>
                      Add Role
                    </a>
                    <a href="?page=tambah-user&edit=<?= $user['id']; ?>" class="btn btn-primary btn-sm rounded-pill">
                      <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <a href="?page=tambah-user&delete=<?= $user['id']; ?>" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm('Are you sure you want to delete this user?');">
                      <i class="bi bi-trash"></i> Delete
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    let tableuser = new DataTable('#userTable');
  });
</script>