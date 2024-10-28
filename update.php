<?php
include 'connection.php';

$id = $_GET['edit'];

$messages[] = ' ';
if (isset($_POST['update_menu'])) {
    $nama_menu = mysqli_real_escape_string($conn, $_POST['nama_menu']);
    $harga_menu = mysqli_real_escape_string($conn, $_POST['harga_menu']);
    $gambar_menu = mysqli_real_escape_string($conn, $_FILES['gambar_menu']['name']);
    $stok = mysqli_real_escape_string($conn, $_POST['stok']);
    $gambar_menu_tmp_name = $_FILES['gambar_menu']['tmp_name'];
    $gambar_menu_folder = 'uploaded_img/' . $gambar_menu;

    if (empty($nama_menu) || empty($harga_menu) || empty($gambar_menu) || empty($stok)) {
        $messages[] = 'Mohon mengisi form inputan dengan benar';
    } else {

        $update = "UPDATE menu SET nama_menu ='$nama_menu', gambar_menu = '$gambar_menu', harga = '$harga_menu', stok = '$stok' WHERE id_menu = $id";
        $upload = mysqli_query($conn, $update);

        if ($upload) {
            move_uploaded_file($gambar_menu_tmp_name, $gambar_menu_folder);
            header('location:canteen.php');
        } else {
            $messages[] = 'Tidak ada Menu yang ditambahkan';
        }
    }


}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="styleC.css">
    <link rel="icon" href="./img/icon.png">
    <style>
        body {
            background-image: url(./img/background.png);
            background-attachment: fixed;
            background-size: 30%;
        }
    </style>
</head>

<body>

    <div class="container">


        <div class="container-form centered" style="margin-top:18rem;">

            <?php
            $select = mysqli_query($conn, "SELECT * FROM menu WHERE id_menu = $id");
            while ($row = mysqli_fetch_assoc($select)) {
                ?>

                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                    <h2>EDIT MENU</h2>
                    <input type="text" placeholder="Masukkan nama menu" value="<?php echo $row['nama_menu']; ?>"
                        name="nama_menu" class="box">
                    <input type="text" placeholder="Masukkan harga menu" value="<?php echo $row['harga']; ?>"
                        name="harga_menu" class="box">
                    <input type="text" placeholder="Masukkan Jumlah stok" value="<?php echo $row['stok']; ?>" name="stok"
                        class="box">
                    <input type="file" accept="image/png, image/jpg, image/jpeg" name="gambar_menu" class="box">
                    <input type="submit" value="Perbarui" name="update_menu" class="btn">
                    <a href="canteen.php" class="btn black">Batalkan</a>
                    <?php
                    if (isset($messages)) {
                        foreach ($messages as $message) {
                            echo '<span class="pesan">' . $message . '</span>';
                        }
                    }
                    ?>
                </form>

            <?php }
            ; ?>
        </div>
    </div>
</body>

</html>