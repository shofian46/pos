<?php
$queryUser = mysqli_query($conn, "SELECT * FROM users WHERE deleted_at = 1 ORDER BY id DESC");
$rowsUser = mysqli_fetch_all($queryUser, MYSQLI_ASSOC);

if (isset($_GET['restore'])) {
  $id = $_GET['restore'];
  $queryRestore = mysqli_query($conn, "UPDATE users SET deleted_at = 0 WHERE id = '$id'");
  if ($queryRestore) {
    echo "<script>alert('User restored successfully!'); window.location.href='?page=restore-user';</script>";
  } else {
    echo "<script>alert('Failed to restore user.');</script>";
  }
}
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $queryDelete = mysqli_query($conn, "DELETE FROM users WHERE id = '$id'");
  if ($queryDelete) {
    echo "<script>alert('User deleted successfully!'); window.location.href='?page=restore-user';</script>";
  } else {
    echo "<script>alert('Failed to deleted user.');</script>";
  }
}
?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">User Management</h4>
        <p class="card-text">Manage user accounts for the LMS.</p>
        <div>
          <a href="?page=user" class="btn btn-secondary rounded-pill float-end">
            <i class="bi bi-arrow-left"></i> Back to User List
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
                    <a href="?page=restore-user&restore=<?= $user['id']; ?>" class="btn btn-primary btn-sm rounded-pill">
                      <i class="bi bi-arrow-clockwise""></i> Restore
                    </a>
                    <a href=" ?page=restore-user&delete=<?= $user['id']; ?>" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm('Are you sure you want to delete this user?');">
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