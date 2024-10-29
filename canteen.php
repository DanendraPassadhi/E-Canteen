<?php
include 'db/database.php';

$message = '';
if (isset($_POST['tambah_menu'])) {
    $nama_menu = htmlspecialchars($_POST['nama_menu']);
    $harga_menu = htmlspecialchars($_POST['harga_menu']);
    $gambar_menu = htmlspecialchars( $_FILES['gambar_menu']['name']);
    $stok = htmlspecialchars( $_POST['stok']);
    $gambar_menu_tmp_name = $_FILES['gambar_menu']['tmp_name'];
    $gambar_menu_folder = 'uploaded_img/' . $gambar_menu;

    if (empty($nama_menu) || empty($harga_menu) || empty($gambar_menu) || empty($stok)) {
        $message = 'Mohon mengisi form inputan dengan benar';
    } else {
        $insert = "INSERT INTO menu(nama_menu, gambar_menu, harga, stok) VALUES('$nama_menu',  '$gambar_menu', '$harga_menu', '$stok')";
        $upload = sqlsrv_query($conn, $insert);

        if ($upload) {
            move_uploaded_file($gambar_menu_tmp_name, $gambar_menu_folder);
            $message = 'Menu berhasil ditambahkan';
        } else {
            $message = 'Tidak ada Menu yang ditambahkan';
        }
    }


}
if (isset($_GET['delete'])) {
    $id_menu = $_GET['delete'];
    sqlsrv_query($conn, "DELETE FROM menu WHERE id_menu = $id_menu");
    header('location:canteen.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>E-Canteen</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="styleC.css">
    <link rel="icon" href="./img/icon.png">
    <style>
        body {
            background-image: linear-gradient(rgba(255,255,255,0.2), rgba(255,255,255,0.2)), url(./img/background.png);
            background-attachment: fixed;
            background-size: 30%;    
        }

        .nav-bar {
            background: var(--bg-color);
            width: 9rem;
            height: 9rem;
            border-bottom-right-radius: 10rem;
            position: fixed;
        }
        
        .nav-bar:hover{
            width: 11rem;
            height: 11rem;
        }

        .nav-bar img {
            width: 7rem;
        }
        
        .nav-bar img:hover {
            width: 8rem;
        }

        h1 {
            height: 4.9rem;
            padding-top: 5px;
            margin-top: 8rem;
            text-align: center;
            color: #fff;
            background-color: #F39237;
            border-top-left-radius: 2rem;
            border-top-right-radius: 2rem;
        }

        .footer {
            width: 100%;
            height: 5rem;
            background: var(--bg-color);
            color: var(--white);
            font-size:1.5rem;
            display: flex;
            justify-content: center;
            align-item: center;
        }

        .footer p {
            padding-top: 2rem;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            alert("HALOO, SELAMAT DATANG ADMIN, GIMANA KABARNYAA???😁");
        });
    </script>
</head>

<body>

    <div class="nav-bar">
        <a href="index.php">
            <img src="img/icon.png" alt="icon">
        </a>
    </div>
    <div class="container">

        <!-- Teks Sambutan -->
        <h1 class="sambutan">DAFTAR MENU KANTIN JTI 🧑‍🍳</h1>

        <!-- Query menampilkan data pada tabel menu-->
        <?php

        $select = sqlsrv_query($conn, "SELECT * FROM menu");

        ?>
        <!-- Tampilan Menu -->
        <div class="tampilan-menu">
            <table class="table-tampilan-menu">
                <thead>
                    <tr>
                        <th>Nama Menu</th>
                        <th>Gambar Menu</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <?php while ($row = sqlsrv_fetch_array($select, SQLSRV_FETCH_ASSOC)) { ?>
                    <tbody>
                        <tr>
                            <td><?php echo $row['nama_menu']; ?></td>
                            <td><img src="uploaded_img/<?php echo $row['gambar_menu']; ?>" height="100" alt=""></td>
                            <td>Rp. <?php echo $row['harga']; ?></td>
                            <td><?php echo $row['stok']; ?> pcs</td>
                            <td>
                                <a href="update.php?edit=<?php echo $row['id_menu']; ?>" class="btn"><i
                                        class="fas fa-edit"></i>Edit</a>
                                <a href="canteen.php?delete=<?php echo $row['id_menu']; ?>" class="btn"><i
                                        ></i>Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>

        <!-- Tampilan form inputan menu baru -->
        <div class="container-form">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                <h2>Ada menu baru apa hari ini?</h2>
                <input type="text" placeholder="Masukkan nama menu" name="nama_menu" class="box">
                <input type="text" placeholder="Masukkan harga menu" name="harga_menu" class="box">
                <input type="text" placeholder="Masukkan Jumlah Stok" name="stok" class="box">
                <input type="file" accept=".png, .jpg, .jpeg" name="gambar_menu" class="box">
                <input type="submit" value="Tambahkan" name="tambah_menu" class="btn">
                <?php
                if (isset($message)) {
                        echo '<span class="message">' . $message . '</span>';
                }
                ?>
            </form>
        </div>
    </div>

    <div class="footer">
    <p>&copy; 2024 E-Canteen JTI. All rights reserved.</p>
    </div>


</body>

</html>