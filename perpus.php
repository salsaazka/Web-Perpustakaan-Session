<?php
session_start();
if (!isset($_SESSION['perpus'])) {
    $_SESSION['perpus'] = [];
}
$stok = ["Tersedia", "Tidak Tersedia"];

$alert = false;
$berhasil = false;
$delete = false;
$edit = false;

if (isset($_POST['cek'])) {
    if (!empty($_POST['judul']) && !empty($_POST['penulis']) && !empty($_POST['penerbit']) && !empty($_POST['stok'])) {

        $isi = [
            "judul" => $_POST['judul'],
            "penulis" => $_POST['penulis'],
            "penerbit" => $_POST['penerbit'],
            "stok" => $_POST['stok'],
        ];

        array_push($_SESSION['perpus'], $isi);
        $berhasil = true;
    } else {
        $gagal = true;
    }
} else {
    $alert = true;
}

if (isset($_GET['delete'])) {
    array_splice($_SESSION['perpus'], $_GET['output'], 1);
    $delete = true;
}
if (isset($_GET['edit'])) {
    $output = $_GET['output'];
    $update = $_SESSION['perpus'][$output];
}
if (isset($_POST['update'])) {
    if (!empty($_POST['judul']) && !empty($_POST['penulis']) && !empty($_POST['penerbit']) && !empty($_POST['stok'])) {

        $output = $_POST['output'];
        $_SESSION['perpus'][$output]['judul'] = $_POST['judul'];
        $_SESSION['perpus'][$output]['penulis'] = $_POST['penulis'];
        $_SESSION['perpus'][$output]['penerbit'] = $_POST['penerbit'];
        $_SESSION['perpus'][$output]['stok'] = $_POST['stok'];

        $edit = true;
    }
}

if (isset($_POST['reset'])) {
    session_destroy();
    header("Location: perpus.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />

     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <div class="icon">
        <i class="fa-regular fa-bookmark"></i>
    </div>

    <div class="section">
        <div class="container">
            <div class="row full-height justify-content-center">
                <div class="col-12 text-center align-self-center py-5">
                    <div class="section pb-5 pt-5 pt-sm-2 text-center">
                        <h6 class="mb-0 pb-3"><span>Daftar Buku</span><span>Data</span></h6>
                        <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
                        <label for="reg-log"></label>
                        <form action="" method="POST">
                            <input type="submit" name="reset" value="Hapus">
                        </form>
                        <div class="card-3d-wrap mx-auto">
                            <div class="card-3d-wrapper">
                                <div class="card-front">
                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <h4 class="mb-4 pb-3">Daftar Buku</h4>
                                            <form action="" method="POST">
                                                <?php
                                                if (isset($update)) {
                                                ?>
                                                    <input type="text" name="output" value="<?= $_GET['output'] ?>" hidden>
                                                <?php
                                                }
                                                ?>
                                                <div class="form-group">
                                                    <input type="text" name="judul" value="<?= @$update['judul'] ?>" class="form-style" placeholder="Isi Judul" required="required" data-error="Firstname is required.">
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="text" name="penulis" value="<?= @$update['penulis'] ?>" class="form-style" placeholder="Isi Penulis" required="required" data-error="Firstname is required.">
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="text" name="penerbit" class="form-style" value="<?= @$update['penerbit'] ?>" placeholder="Isi Penerbit" required="required" data-error="Firstname is required.">
                                                </div>
                                                <div class="form-group mt-2">
                                                    <select name="stok" class="form-style" required="required" data-error="Please specify your need.">
                                                        <option hidden>--Pilih--</option>
                                                        <?php
                                                        foreach ($stok as $kon) {
                                                            if (isset($update)) {
                                                        ?>
                                                                <option value="<?= $kon ?>" <?= $kon == $update['stok'] ? 'selected' : '' ?>><?= $kon ?></option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <option value="<?= $kon ?>"><?= $kon ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <!-- <a href="#" class="btn mt-4" name="cek">submit</a> -->
                                                <div class="d-flex justify-content-center mt-1">
                                                    <div class="col-md-6">
                                                        <?php
                                                        if (isset($_GET['edit'])) {
                                                        ?>
                                                            <input type="submit" name="update" class="btn mt-4" value="Edit">
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <input type="submit" name="cek" class="btn mt-4" value="Simpan">
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-back">

                                    <div class="center wrap">
                                        <?php
                                        if (!empty($_SESSION['perpus'])) {
                                        ?>
                                            <table class="table table-dark table-striped table-bordered border-secondary table-hover table-responsive mt-3 mx-3" style="max-width: 665px;">
                                                <thead>
                                                    <tr style="text-align:center" ;>
                                                        <th>Judul Buku</th>
                                                        <th>Penulis</th>
                                                        <th>Penerbit</th>
                                                        <th>Stok</th>
                                                        <th>Edit dan Hapus</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 1;
                                                    foreach ($_SESSION['perpus'] as $key => $real) {
                                                    ?>
                                                        <tr>
                                                            <td><?= $real['judul']; ?></td>
                                                            <td><?= $real['penulis']; ?></td>
                                                            <td><?= $real['penerbit']; ?></td>
                                                            <td><?= $real['stok']; ?></td>
                                                            <td>
                                                                <a href="?edit&output=<?= $key ?>"><i class="bi bi-pencil-square"></i></i></a>
                                                                <a href="?delete&output=<?= $key ?>" onclick="return confirm(`Hapus data <?= $real['judul'] ?> ?`)"><i class="bi bi-archive-fill"></i></a>
                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>