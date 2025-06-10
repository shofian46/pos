<?php
if (isset($_GET['delete'])) {
    $id = isset($_GET['delete']) ? $_GET['delete'] : '';
    // query untuk mengambil name dari path 
    $queryModulsDetails = mysqli_query($conn, "SELECT file FROM modules_detail WHERE id_modul = '$id'");
    $rowModulsDetails = mysqli_fetch_assoc($queryModulsDetails);
    unlink("uploads/" . $rowModulsDetails['file']); // menghapus file dari folder uploads

    $queryDelete = mysqli_query($conn, "DELETE FROM modules_detail WHERE id_modul = '$id'");
    $queryDelete = mysqli_query($conn, "DELETE FROM modules WHERE id = '$id'");
    if ($queryDelete) {
        header("location:?page=moduls&hapus=berhasil");
    } else {
        header("location:?page=moduls&hapus=gagal");
    }
}


if (isset($_POST['save'])) {
    $id_instructor = $_POST['id_instructor'];
    $id_majors = $_POST['id_major'];
    $name = $_POST['name'];

    $insert = mysqli_query($conn, "INSERT INTO modules(id_majors,id_instructor, name) VALUES ('$id_majors','$id_instructor','$name')");
    if ($insert) {
        $id_moduls = mysqli_insert_id($conn);
        foreach ($_FILES['file']['name'] as $index => $file) {
            if ($_FILES['file']['error'][$index] == 0) {
                $name = basename($_FILES['file']['name'][$index]);
                $fileName = uniqid() . "-" . $name;
                $path = "uploads/";
                $targetPath = $path . $fileName;

                if (move_uploaded_file($_FILES['file']['tmp_name'][$index], $targetPath)) {
                    $insertFile = mysqli_query($conn, "INSERT INTO modules_detail(id_modul, file) VALUES ('$id_moduls','$fileName')");
                }
            }
        }
        header("location:?page=moduls&tambah=berhasil");
    }
    // $id_majors = isset($_GET['edit'])? $_GET['edit'] : '';
}

$id_instructor = isset($_SESSION['uuid']) ? $_SESSION['uuid'] : '';
$queryInstructorMajor = mysqli_query($conn, "SELECT majors.name, 
instructor_majors.* FROM instructor_majors LEFT JOIN majors ON majors.id = instructor_majors.id_major
WHERE instructor_majors.id_instructor = '$id_instructor'");

$rowInstructorMajors = mysqli_fetch_all($queryInstructorMajor, MYSQLI_ASSOC);


// Detail untuk mengedit modul
$id_moduls = isset($_GET['detail']) ? $_GET['detail'] : '';
$queryModuls = mysqli_query($conn, "SELECT majors.name as majors_name, instructors.name as instructors_name, modules.* 
    FROM modules 
    LEFT JOIN majors ON majors.id = modules.id_majors
    LEFT JOIN instructors ON instructors.id = modules.id_instructor WHERE modules.id = '$id_moduls'");
$rowModuls = mysqli_fetch_assoc($queryModuls);

$queryDetailsModuls = mysqli_query($conn, "SELECT * FROM modules_detail WHERE id_modul = '$id_moduls'");
$rowDetailsModuls = mysqli_fetch_all($queryDetailsModuls, MYSQLI_ASSOC);

if (isset($_GET['download'])) {
    $file = $_GET['download'];
    $filePath = "uploads/" . $file;
    if (file_exists($filePath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filePath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath) . '');
        ob_clean(); // Clean the output buffer
        flush(); // Flush system output buffer
        readfile($filePath);
        exit;
    } else {
        echo "File not found.";
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo isset($_GET['edit']) ? 'Edit' : 'Add' ?> Modul</h5>
                <?php if (isset($_GET['detail'])): ?>
                    <div class="d-flex justify-content-end">
                        <a href="?page=moduls" class="btn btn-secondary mb-3">Back</a>
                    </div>
                    <table class="table table-striped">
                        <tr>
                            <th>Modul Name</th>
                            <th>:</th>
                            <td><?= $rowModuls['name'] ?></td>
                            <th>Modul Name</th>
                            <th>:</th>
                            <td><?= $rowModuls['majors_name'] ?></td>
                        </tr>
                        <tr>
                            <th>Instructors</th>
                            <th>:</th>
                            <td><?= $rowModuls['instructors_name'] ?></td>
                    </table>
                    <br>
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>File</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php foreach ($rowDetailsModuls as $key => $data): ?>
                                    <td><?= $key + 1 ?></td>
                                    <td>
                                        <a href="?page=tambah-modul&download=<?= urlencode($data['file']) ?>" target="_blank" download="?page=tambah-modul&download=<?= urlencode($data['file']) ?>" class="btn btn-primary">
                                            <?= $data['file'] ?> <i class="bi bi-download"></i>
                                        </a>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        </tbody>
                    </table>
                <?php else: ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Instructor Name *</label>
                                    <input readonly value="<?php echo $_SESSION['name'] ?>" type="text" class="form-control">
                                    <input type="hidden" name="id_instructor" value="<?php echo $_SESSION['uuid'] ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Major Name</label>
                                    <select name="id_major" id="" class="form-control">
                                        <option value="">Select One</option>
                                        <?php foreach ($rowInstructorMajors as $row): ?>
                                            <option value="<?php echo $row['id_major'] ?>"><?php echo $row['name'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group my-3">
                                    <label for="">Modul Name</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Modul Name" required>
                                </div>
                            </div>
                        </div>
                        <div align="right" class="mb-3">
                            <button type="button" class="btn btn-primary addRow" id="addRow">Add Row</button>
                        </div>

                        <table class="table" id="tableModul">
                            <thead>
                                <tr>
                                    <th>File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                        <div class="mb-3">
                            <input type="submit" class="btn btn-success" name="save" value="save">
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- Javascript -->
<script>
    // variabel
    // var ketika nilainya tidak ada maka tidak error.
    // let harus mempunyai nilai
    // const tidak boleh diubah nilainya

    // Menggunakan id
    // const button = document.getElementById('addRow');

    // Menggunakan class
    // const button = document.getElementsByClassName('addRow');

    // Menggunakan querySelector
    const button = document.querySelector('.addRow');
    const tbody = document.querySelector('#tableModul tbody'); // untuk mengambil tbody dari table dengan id myTable
    // kalau mau gampang pake slector aja kalau manggil kelas pakai titik (.), kalau pakai id pakai pagar (#)

    // button.textContent = 'Tambah Baris'; // mengubah text content dari button
    // button.style.color = 'red'; // mengubah warna text content dari button
    // button.style.backgroundColor = 'yellow'; // mengubah warna background dari button

    button.addEventListener('click', function() {
        // alert ('Tombol Add Row Diklik');
        const tr = document.createElement('tr'); // membuat elemen tr baru
        tr.innerHTML =
            `<td> <input type='file' name='file[]'> </td>
        <td>Delete</td>`;
        tbody.appendChild(tr); // menambahkan elemen tr ke tbody
    });
</script>