<?php
if (isset($_GET['delete'])) {
    $id = $_GET['delete']; //id=1,2,3
    $id_instructor = $_GET['id_instructor']; //id=1,2,3
    // print_r($id_instructor);
    // die;


    $queryDelete = mysqli_query($conn, "DELETE FROM instructor_majors  WHERE id ='$id'");
    if ($queryDelete) {
        header("location:?page=tambah-instructor-major&id=" . $id_instructor . "&hapus=berhasil");
    } else {
        header("location:?page=tambah-instructor-major&id=" . $id_instructor . "&tambah=gagal");
    }
}



$id_instructor = isset($_GET['id']) ? $_GET['id'] : '';
$edit = isset($_GET['edit']) ? $_GET['edit'] : '';

if (isset($_POST['id_major'])) {
    // ada tidak parameter bernama edit, kalo ada jalankan perintah edit/update, kalo tidak ada
    // tambah data baru / insert
    $id_major  = $_POST['id_major'];
    if (isset($_GET['edit'])) {
        $update = mysqli_query($conn, "UPDATE instructor_majors SET id_major='$id_major'
        WHERE id='$edit'");
        header("location:?page=tambah-instructor-major&id=" . $id_instructor . "&ubah=berhasil");
    } else {

        $insert = mysqli_query($conn, "INSERT INTO instructor_majors (id_major, id_instructor)
         VALUES('$id_major','$id_instructor')");
        header("location:?page=tambah-instructor-major&id=" . $id_instructor . "&tambah=berhasil");
    }
}

$queryMajors = mysqli_query($conn, "SELECT * FROM majors ORDER BY id DESC");
$rowMajors   = mysqli_fetch_all($queryMajors, MYSQLI_ASSOC);


$queryInstructor = mysqli_query($conn, "SELECT * FROM instructors WHERE id ='$id_instructor'");
$rowInstructor = mysqli_fetch_assoc($queryInstructor);


$id_instructors = isset($_SESSION['uuid']) ? $_SESSION['uuid'] : '';
$queryInstructorsMajors = mysqli_query($conn, "SELECT majors.name, instructor_majors.* FROM instructor_majors
LEFT JOIN majors ON majors.id = instructor_majors.id_major
WHERE instructor_majors.id_instructor = '$id_instructors'");

$rowInstructorsMajors = mysqli_fetch_all($queryInstructorsMajors, MYSQLI_ASSOC);
// print_r($rowInstructorsMajors);
// die;


$queryEdit = mysqli_query($conn, "SELECT * FROM instructor_majors WHERE id='$edit'");
$rowEdit   = mysqli_fetch_assoc($queryEdit);





?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo isset($_GET['edit']) ? 'Edit' : 'Add' ?> Instructor Major : <?php echo $rowInstructor['name'] ?></h5>
                <!-- form edit -->
                <?php if (isset($_GET['edit'])): ?>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="" class="form-label">Major Name</label>
                            <select name="id_major" id="" class="form-control">
                                <option value="">Select One</option>
                                <?php foreach ($rowMajors as $rowMajor): ?>
                                    <option <?php echo ($rowMajor['id'] == $rowEdit['id_major']) ? 'selected' : '' ?>
                                        value="<?php echo $rowMajor['id'] ?>"><?php echo $rowMajor['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Save Changes</button>
                        </div>
                    </form>
                    <!-- endform edit -->
                <?php else: ?>
                    <!-- listing table -->
                    <div align="right">
                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Add Instructor Major
                        </button>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Major Name</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($rowInstructorsMajors as $index => $rowInstructorMajor): ?>
                                <tr>
                                    <!-- <td><?php echo $index += 1 ?></td> -->
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $rowInstructorMajor['name'] ?></td>
                                    <td>
                                        <a href="?page=tambah-instructor-major&id=<?php echo $rowInstructorMajor['id_instructor'] ?>&edit=<?php echo $rowInstructorMajor['id'] ?>"
                                            class="btn btn-primary">Edit</a>
                                        <a onclick="return confirm('Are you sure wanna delete this data??')"
                                            href="?page=tambah-instructor-major&delete=<?php echo $rowInstructorMajor['id'] ?>&id_instructor=<?php echo $rowInstructorMajor['id_instructor'] ?>"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                <?php endif ?>


            </div>
        </div>
    </div>
</div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Instructor Major : </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Major Name</label>
                        <select name="id_major" id="" class="form-control">
                            <option value="">Select One</option>
                            <?php foreach ($rowMajors as $rowMajor): ?>
                                <option value="<?php echo $rowMajor['id'] ?>"><?php echo $rowMajor['name'] ?></option>
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