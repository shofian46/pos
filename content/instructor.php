<?php
$queryInstructor = mysqli_query($conn, "SELECT * FROM instructors ORDER BY id DESC");
$rowsInstructor = mysqli_fetch_all($queryInstructor, MYSQLI_ASSOC);
?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Instructor Management</h4>
        <p class="card-text">Manage instructor for the LMS.</p>
        <div>
          <a href="?page=tambah-instructor" class="btn btn-primary rounded-pill float-end">
            <i class="bi bi-plus-circle"></i> Add Instructor
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-bordered" id="insTable">
            <thead class="text-center table-primary">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Gender</th>
                <th scope="col">Education</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($rowsInstructor as $instructor): ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $instructor['name']; ?></td>
                  <td class="text-center"><?= $instructor['gender'] == 1 ? '<span class="badge rounded-pill bg-primary">Laki-Laki</span>' : '<span class="badge rounded-pill bg-danger">Perempuan</span>'; ?></td>
                  <td><?= $instructor['education']; ?></td>
                  <td class="text-center">
                    <a href="?page=detail-instructor&detail=<?= $instructor['id']; ?>" class="btn btn-success btn-sm rounded-pill">
                      <i class="bi bi-eye"></i> Detail
                    </a>
                    <a href="?page=tambah-instructor&edit=<?= $instructor['id']; ?>" class="btn btn-primary btn-sm rounded-pill">
                      <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <a href="?page=tambah-instructor&delete=<?= $instructor['id']; ?>" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm('Are you sure you want to delete this instructor?');">
                      <i class="bi bi-trash"></i> Delete
                    </a>
                    <a href="?page=tambah-instructor-major&id=<?php echo $instructor['id'] ?>"
                      class="btn btn-warning btn-sm rounded-pill">
                      <i class="bi bi-plus-circle"></i>
                      Add Major
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