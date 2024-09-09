<?php
session_start();
require_once "database.php";
//Memanggil kelas database
$pdo = new database();

//Jika user sudah login, maka akan langsung terpindah ke dashboard user/admin
if (isset($_SESSION['email']) == 0) {
} else {
    header("Location: dashboard.php");
}

//Memunculkan daftar harga
$rows = $pdo->getHarga();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/dataTables.bootstrap4.min.css">
    <script src="js/jquery-3.5.1.js"></script>
    <script src="bootstrap/jquery.dataTables.min.js"></script>
    <script src="bootstrap/dataTables.bootstrap4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <link rel="shortcut icon" href="images/favico.png">
    <title>TRIWIRA88LAUNDRY.com</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark" style="background-color: pink;">
        <img src="images/favico.png" width=85px alt="logo">
        <a class="navbar-brand" href="index.php">
            <p style="font-size:25px;"><b> Triwira88Laundry</b></p>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <style>
            .nav-item.nav-link.active:active {
                background-color: blue;
                color: black;
            }
        </style>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link active nav-pills nav-fill" href="index.php">Beranda</a>
                <a class="nav-item nav-link active nav-pills nav-fill" href="panduan.php">Panduan Aplikasi</a>
                <a class="nav-item nav-link active nav-pills nav-fill" href="#how-to-order">Tutorial Order</a>
                <a class="nav-item nav-link active" href="#daftar-harga">Daftar Harga</a>
                <a class="nav-item nav-link active" href="#faq">FAQ</a>
                <a class="nav-item nav-link active" href="#hubungi-kami">Hubungi Kami</a>
                <a class="btn btn-outline-info active" href="login.php"><b>Login</b></a>
            </div>
        </div>
    </nav>

    <!-- Carousel -->
    <div class="carousel-caption">
        <h1><a class="display-4 text-light bg-transparent" style="font-family: Cambria;"><b>Selamat Datang di Laundry OnLine Triwira88</b></a></h1>
        <br>
        <h1><a class="text-light bg-transparent">Solusi cuci setiap hari</a></h1>
        <br>
        <h6><a class="btn btn-info btn-lg" href="signup.php" role="button">Daftar Sekarang</a></h6>
        <br><br><br><br><br>
    </div>
    <div id="carouselControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner text-center">
            <div class="carousel-item active">
                <img class="w-100" src="images/usaha-laundry.jpg">
            </div>
        </div>

        <!-- Isi -->
        <hr id="how-to-order">
        <div class="jumbotron jumbotron-fluid bg-white">
            <div class="container">
                <div class="tengah">
                    <h1 class="display-5" style="font-family: Cambria;">Tutorial Order</h1>
                    <br>
                    <p style="text-align:left;" class="lead">Mauu Order? yuk simak cara dibawah ini.</p>
                    <hr class="my-4">

                    <!-- Di row ini isinya merupakan tutorial beserta gambar dengan bentuk kotak ya -->
                    <div class="row">
                        <div class="col-sm">
                            <h6><img src="images/img3.png" width="135px"> </h6>
                            <h5>Daftar</h5>
                            <p>Pelanggan mendaftarkan akunnya pada website, dan dapat melakukan pemesanan </p>

                        </div>
                        <div class="col-sm">
                            <h6><img src="images/img4.png" width="100px"> </h6>
                            <h5>Pengambilan </h5>
                            <p>pihak kami akan mengambil barang yang akan di laundry</p>
                        </div>
                        <div class="col-sm">
                            <h6><img src="images/cuci.png" width="155px"> </h6>
                            <h5>Pencucian</h5>
                            <p>pencucian baju sesuai pemesanan</p>
                        </div>
                        <div class="col-sm">
                            <h6><img src="images/img6.png" width="100px"> </h6>
                            <h5>Pengantaran </h5>
                            <p> pihak kami akan mengantarkan barang yang telah di laundry di rumah anda</p>

                        </div>
                        <div class="col-sm">
                            <h6><img src="images/transak.png" width="160px"> </h6><br>
                            <h5>Pembayaran</h5>
                            <p>pembayaran pemesanan bisa dilakukan secara Cash on delivery</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr id="daftar-harga">
        <div class="jumbotron jumbotron-fluid" style=" background-color: azure;">
            <div class="container">
                <div class="tengah">
                    <h1 class="display-5" style="font-family: Cambria;">Daftar Harga</h1>
                    <br>
                    <p style="text-align:left;" class="lead">Berikut ini merupakan daftar harga yang tersedia, terjangkau dan murah!</p>
                    <hr class="my-4">
                    <br>
                    <table id="pagination" class="table table-striped table-bordered" style="background-color: pink;">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($rows as $row) {
                            ?>
                                <tr>
                                    <th><?= $row['id'] ?></th>
                                    <td><?= $row['nama_barang'] ?></td>
                                    <td><?= $row['harga'] ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <hr id="faq">
        <div class="jumbotron jumbotron-fluid bg-white">
            <div class="container">

                <h1 class="display-6" style="font-family: cambria;">Pertanyaan Para Pelaggan</h1>
                <br>
                <hr>
                <h4 style="font-family: cambria; ">Bagaimana saya dapat menggunakan layanan Laundry Online?</h4>
                <p class="my-4" style="font-family: cambria;"> Dapat digunakan melalui website resmi Laundry</p>
                <br>
                <h4 style="font-family: cambria;"> Bagaimana Cara Order Laundry Online?</h4>
                <p style="font-family: cambria;">Melalui website Laundry Online, Kamu dapat membuat order dengan memilih lokasi Kamu untuk
                    penjemputan dan pengembalian. Setelah itu, kamu pilih layanan yang kamu inginkan, buat order, dan menyelesaikan transaksi pembayaran. kemudian laundry akan di antarkan di alamatmu</p>
                <br>
                <h4 style="font-family: cambria;"> Apa saja layanan yang disediakan oleh Laundry Online ?</h4>
                <p class="my-4" style="font-family: cambria;">Jenis layanannya dua jenis Laundry, yaitu cuci kiloan dan satuan.</p>

            </div>
        </div>
    </div>
    </div>

    <!-- Di row ini isinya merupakan Tentang Triwira88Laundry -->

    <hr id="hubungi-kami">
    <div class="jumbotron jumbotron-fluid bg-dark text-white">
        <div class="container">
            <div class="tengah">
                <h1 class="display-5" style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">Hubungi Kami!</h1>
                <br>
                <p style="text-align:left;" class="lead">Jika ada keraguan, kami akan selalu ada untuk anda.</p>
                <hr class="my-4 bg-warning">

                <div class="row">
                    <div class="col-sm">
                        <br>

                        <h4 style="text-align: left;">
                            <b>Alamat kami :</b>
                        </h4>
                        <p style="text-align: left;"><img src="images/gmaps.png" width="60px">
                        <p style="text-align: left;">Jl. Bandar Labuhan Bawah, Limau Manis, Kec. Tj. Morawa, Kabupaten Deli Serdang, Sumatera Utara 20362</p>
                        <br>
                        <p style="text-align: left;">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.318445306024!2d98.7808476!3d3.5136309!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3031391a58f964eb%3A0x144a4efdb103367b!2sTriwira88-Laundry!5e0!3m2!1sid!2sid!4v1701276485048!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </p>
                        <hr class="my-4 bg-info">
                        <h4 style="text-align: left;">
                            <b>Nomor Telepon/WA :</b>
                        </h4>
                        <p style="text-align: left;"><img src="images/wa.png" width="40px">
                        <p style="text-align: left;">+62 813-1777-8117</p>
                        <br>
                        <hr class="my-4 bg-danger">
                        <h4 style="text-align: center;">
                            <b style="text-align: left;">Follow Sosial Media Kami</b>
                        </h4>
                        <p style="text-align: center;"><img src="images/ig.png" width="25px"><a style="color: red; " href="https://instagram.com/"> Triwira88-Laundry</a></p>
                        <p style="text-align: center;"><img src="images/fb.png" width="30px"><a style="color: #6DA5C0; " href="https://facebook.com/"> Triwira88-Laundry </a></p>
                        <p style="text-align: center;"><img src="images/tiktok.png" width="40px"><a style="color: #F1916D; " href="https://tiktok.com/"> Triwira88-Laundry </a></p>
                        <p style="text-align: center;"><img src="images/favico.png" width="40px"><a style="color: #C38EB4; " href="https://triwira88laundry.com/"> www.triwira88laundry.com </a></p>


                    </div>

                    <br>

                    <div class="col-sm">
                        <div id="googleMaps" style="width:100%;height:380px;"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <footer class="page-footer font-small bg-dark">
        <div class="footer-copyright text-center py-3">Copyright © 2023
            <a href="index.php" style="color: cyan;"> Triwira88Laundry</a>
        </div>
    </footer>
    <script>
        // fungsi initialize untuk mempersiapkan peta
        function initialize() {
            var propertiPeta = {
                center: new google.maps.LatLng(3.52571260, 98.79394360),
                zoom: 15,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            var peta = new google.maps.Map(document.getElementById("googleMaps"), propertiPeta);

            // membuat Marker untuk lokasi laundry
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(3.52571260, 98.79394360),
                map: peta,
                animation: google.maps.Animation.BOUNCE
            });
        }
        // event jendela di-load  
        google.maps.event.addDomListener(window, 'load', initialize);

        //Menggunakan DataTables
        $(document).ready(function() {
            $('#pagination').DataTable();
        });
    </script>
</body>

</html>