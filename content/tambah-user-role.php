<?php
$queryRoleuser = mysqli_query($conn, "SELECT * FROM user_role ORDER BY id DESC");
$rowsRoleuser = mysqli_fetch_all($queryRoleuser, MYSQLI_ASSOC);
if (isset($_GET['delete'])) {
    $id = $_GET['delete']; //id=1,2,3
    $id_user = $_GET['id_user']; //id=1,2,3
    // print_r($id_user);
    // die;


    // $queryDelete = mysqli_query($conn, "DELETE FROM users  WHERE id ='$id'");
    // if ($queryDelete) {
    //     header("location:?page=tambah-user-role&id=" . $id_user . "&hapus=berhasil");
    // } else {
    //     header("location:?page=tambah-user-role&id=" . $id_user . "&tambah=gagal");
    // }
}



$id_user = isset($_GET['id']) ? $_GET['id'] : '';
$edit = isset($_GET['edit']) ? $_GET['edit'] : '';

if (isset($_POST['id_user'])) {
    // ada tidak parameter bernama edit, kalo ada jalankan perintah edit/update, kalo tidak ada
    // tambah data baru / insert
    $id_users  = $_POST['id_user'];
    if (isset($_GET['edit'])) {
        $update = mysqli_query($conn, "UPDATE user_role SET id_user='$id_users'
        WHERE id='$edit'");
        header("location:?page=tambah-user-role&id=" . $id_users . "&ubah=berhasil");
    } else {

        $insert = mysqli_query($conn, "INSERT INTO user_role (id_user, id_role)
         VALUES('$users','$id_user')");
        header("location:?page=tambah-instructor-major&id=" . $id_users . "&tambah=berhasil");
    }
}

$queryUsers = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
$rowUsers   = mysqli_fetch_all($queryUsers, MYSQLI_ASSOC);


$queryUser = mysqli_query($conn, "SELECT * FROM users WHERE id ='$id_user'");
$rowUser = mysqli_fetch_assoc($queryUser);


$id_user_role = isset($_SESSION['uuid']) ? $_SESSION['uuid'] : '';
$queryIdRole = mysqli_query($conn, "SELECT users.name, user_role.* FROM user_role
LEFT JOIN users ON users.id = user_role.id_user
WHERE user_role.id_user = '$id_user_role'");

$rowIDUserRole = mysqli_fetch_all($queryIdRole, MYSQLI_ASSOC);
// print_r($rowIDUserRole);
// die;


$queryEdit = mysqli_query($conn, "SELECT * FROM user_role WHERE id='$edit'");
$rowEdit   = mysqli_fetch_assoc($queryEdit);





?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo isset($_GET['edit']) ? 'Edit' : 'Add' ?> Instructor User : <?= isset($rowUser['name']) ?></h5>
                <!-- form edit -->
                <?php if (isset($_GET['edit'])): ?>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="" class="form-label">User Name</label>
                            <select name="id_user" id="" class="form-control">
                                <option value="">Select One</option>
                                <?php foreach ($rowUsers as $user): ?>
                                    <option <?php echo ($user['id'] == $rowEdit['id_user']) ? 'selected' : '' ?>
                                        value="<?php echo $user['id'] ?>"><?php echo $user['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Save Changes</button>
                        </div>
                    </form>
                    <!-- endform edit -->
                <?php else: ?>
                    <?php if (isset($rowUser)): ?>
                        <!-- listing table -->
                        <div align="right">
                            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Add Role User
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
                                foreach ($rowIDUserRole as $index => $rowIdUser): ?>
                                    <tr>
                                        <!-- <td><?php echo $index += 1 ?></td> -->
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $rowIdUser['name'] ?></td>
                                        <td>
                                            <a href="?page=tambah-user-role&id=<?php echo $rowIdUser['id_user'] ?>&edit=<?php echo $rowIdUser['id'] ?>"
                                                class="btn btn-primary">Edit</a>
                                            <a onclick="return confirm('Are you sure wanna delete this data??')"
                                                href="?page=tambah-user-role&delete=<?php echo $rowIdUser['id'] ?>&id_user=<?php echo $rowIdUser['id_user'] ?>"
                                                class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Role Major : </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Major Name</label>
                        <select name="id_major" id="" class="form-control">
                            <option value="">Select One</option>
                            <?php foreach ($rowUsers as $rowRole): ?>
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