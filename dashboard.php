<?php
session_start();
require_once "database.php";
$pdo = new database();
$edit_form = false;

//Jika user belum login dan membuka ini, maka langsung diarahkan ke halaman login
if (isset($_SESSION['email']) == 0) {
  header('Location: login.php');
}

//Jika admin login, maka langsung diarahkan ke halaman dashboard admin
//Ubah e-mailnya jika ingin mengganti akun admin
if ($_SESSION['email'] == 'adminlaundry@gmail.com') {
  header('Location: admin_dash.php');
}


//Memanggil tabel pesanan
$rows = $pdo->getPesanan($_SESSION['id']);

//Mengambil data dan menaruh di kotak edit
if (isset($_GET['edit'])) {
  $data = $pdo->getEditPesanan($_GET['edit']);
  $edit_form = true;
  $name = $data['name'];
  $email = $data['email'];
  $nomor_telepon = $data['nomor_telepon'];
  $id = $data['id'];
}

//Mengupdate data
if (isset($_POST['update'])) {
  $update = $pdo->updateData($_POST['nama'], $_POST['email'], $_POST['password'], $_POST['nomor_telepon'], $id);
  $_SESSION['name'] = $_POST['nama'];
  $_SESSION['email'] = $_POST['email'];
  $_SESSION['nomortelepon'] = $_POST['nomor_telepon'];
  // Cara get data dari spesifik nama_order terus dikirim kesini
  header("Location: dashboard.php#profil");
}

//Untuk tombol membatalkan edit
if (isset($_POST['cancel'])) {
  header("Location: dashboard.php#profil");
}

?>

<!DOCTYPE html>

<head>
  <title>Dashboard User - Triwira88-Laundry</title>
  <script src="js/jquery-3.5.1.js"></script>
  <script src="bootstrap/js/bootstrap.bundle.js"></script>
  <script src="bootstrap/jquery.dataTables.min.js"></script>
  <script src="bootstrap/dataTables.bootstrap4.min.js"></script>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="css/dash.css">
  <link rel="stylesheet" href="bootstrap/dataTables.bootstrap4.min.css">
</head>


<body>
  <!-- Navbar -->
  <nav id="navbar-user" class="navbar fixed-top navbar-expand-lg navbar-dark bg-info">
    <a class="navbar-brand" href="admin_dash.php"><b>Triwira88-Laundry</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#beranda">Beranda</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#order-satuan">Order Satuan</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#order-kiloan">Order Kiloan</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#status-order">Status Order</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#profil">Profil</a>
        </li>
        <li class="nav-item active">
          <a style="background-color: black;" class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Isi -->
  <div data-spy="scroll" data-target="#navbar-user" data-offset="0">
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <br>
        <h1 id="beranda" class="display-5" style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">Selamat datang pelanggan setia, <?php echo $_SESSION['name']; ?>!</h1>
        <br>
        <p class="lead" style="font-family: Cambria;">Silahkan order atau cek status laundry anda disini.</p>

      </div>
    </div>

    <hr id="how-to-order">
    <div class="jumbotron jumbotron-fluid bg-white">
      <div class="container">
        <div class="tengah">

          <h1 class="display-5" id="order-satuan" style="font-family: cambria;">Pesan Laundry Satuan</h1>
          <hr color="deeppink;">
          <br>

          <!-- Di row ini isinya merupakan tutorial beserta gambar -->
          <div class="row">
            <div class="col-md">
              <p style="font-family: Cambria, Cochin, Georgia, Times, serif;"><b>Bed Cover</b></p>
              <h4><img src="images/bedcover.jpg" width="105px"> </h4>
              <a class="btn btn-outline-info active" href="order.php">Order</a>

            </div>
            <div class="col-sm">
              <p style="font-family: Cambria, Cochin, Georgia, Times, serif;"><b>Selimut</b></p>
              <h6><img src="images/selimut.png" width="100px"> </h6>
              <a class="btn btn-outline-info active" href="order.php">Order</a>

            </div>
            <div class="col-sm">
              <p style="font-family: Cambria, Cochin, Georgia, Times, serif;"><b>Longdress</b></p>
              <h6><img src="images/longdress.jpeg" width="110px"> </h6>
              <a class="btn btn-outline-info active" href="order.php">Order</a>

            </div>
            <div class="col-sm">
              <p style="font-family: Cambria, Cochin, Georgia, Times, serif;"><b>Jacket</b></p>
              <h6><img src="images/jacket.jpg" width="115px"> </h6>
              <a class="btn btn-outline-info active" href="order.php">Order</a>

            </div>

            <div class="col-sm">
              <p style="font-family: Cambria, Cochin, Georgia, Times, serif;"><b>Boneka</b></p>
              <h6><img src="images/bonek.jpeg" width="120px" style="border-radius: 8%;"> </h6>
              <a class="btn btn-outline-info active" href="order.php">Order</a>

            </div>
          </div>
        </div>
      </div>
      <br>


      <div class="container">
        <div class="tengah">

          <div class="row">
            <div class="col-sm">
              <p style="font-family: Cambria, Cochin, Georgia, Times, serif;"><b>Tas</b></p>
              <h6><img src="images/tas.jpeg" width="110px"> </h6>
              <a class="btn btn-outline-info active" href="order.php">Order</a>

            </div>
            <div class="col-sm">
              <p style="font-family: Cambria, Cochin, Georgia, Times, serif;"><b>Sepatu</b></p>
              <h6><img src="images/sepatu.jpeg" width="110px"> </h6>
              <a class="btn btn-outline-info active" href="order.php">Order</a>

            </div>
            <div class="col-sm">
              <p style="font-family: Cambria, Cochin, Georgia, Times, serif;"><b>Helm</b></p>
              <h6><img src="images/helm.jpeg" width="108px"> </h6>
              <a class="btn btn-outline-info active" href="order.php">Order</a>

            </div>
            <div class="col-sm">
              <p style="font-family: Cambria, Cochin, Georgia, Times, serif;"><b>Kebaya</b></p>
              <h6><img src="images/kebaya.jpeg" width="89px"> </h6>
              <a class="btn btn-outline-info active" href="order.php">Order</a>

            </div>
            <div class="col-sm">
              <p style="font-family: Cambria, Cochin, Georgia, Times, serif;"><b>Karpet</b></p>
              <h6><img src="images/karpet.jpeg" width="140px" style="border-radius: 8%;"> </h6>
              <a class="btn btn-outline-info active" href="order.php">Order</></a>

            </div>

          </div>
        </div>
      </div>

      <br>

      <div class="container">
        <div class="tengah">
          <div class="row">
            <div class="col-sm">
              <p style="font-family: Cambria, Cochin, Georgia, Times, serif;"><b>Peci</b></p>
              <h6><img src="images/peci.jpeg" width="80px" style="border-radius: 8%;"> </h6>
              <a class="btn btn-outline-info active" href="order.php">Order</></a>

            </div>
            <div class="col-sm">
            </div>
            <div class="col-sm">
            </div>
            <div class="col-sm">
            </div>

            <div class="col-sm">
              <p style="font-family: Cambria, Cochin, Georgia, Times, serif;"><b>Topi</b></p>
              <h6><img src="images/topi.jpeg" width="100px" style="border-radius: 8%;"> </h6>
              <a class="btn btn-outline-info active" href="order.php">Order</></a>

            </div>
          </div>
        </div>
      </div>
    </div>


    <br>

    <!-- Pesanan laundry kiloan -->
    <hr id="how-to-order">
    <hr color="deeppink;">
    <div class="jumbotron jumbotron-fluid bg-white">
      <div class="container">
        <div class="tengah">
          <h2 class="display-5" id="order-kiloan" style="font-family: cambria;">Pesan Laundry Kiloan</h2>
          <hr color="deeppink;">
          <br>

          <!-- Di row ini isinya merupakan tutorial beserta gambar -->
          <div class="row">
            <div class="col-sm">
              <p style="font-family: Cambria, Cochin, Georgia, Times, serif;"><b>Cuci Basah</b></p>
              <h4><img src="images/cucibasah.jpeg" width="150px" height="100px"> </h4>
              <a class="btn btn-outline-info active" href="orderkiloan.php">Order</a>

            </div>
            <div class="col-sm">
              <p style="font-family: Cambria, Cochin, Georgia, Times, serif;"><b>Setrika</b></p>
              <h6><img src="images/setrika.jpeg" width="100px"> </h6>
              <a class="btn btn-outline-info active" href="orderkiloan.php">Order</a>

            </div>
            <div class="col-sm">
              <p style="font-family: Cambria, Cochin, Georgia, Times, serif;"><b>Cuci Kering</b></p>
              <h6><img src="images/cucikering.jpeg" width="100px"> </h6>
              <a class="btn btn-outline-info active" href="orderkiloan.php">Order</a>

            </div>
            <div class="col-sm">
              <p style="font-family: Cambria, Cochin, Georgia, Times, serif;"><b>Cuci Gorden</b></p>
              <h6><img src="images/gorden.jpeg" width="150px" height="100px"> </h6>
              <a class="btn btn-outline-info active" href="orderkiloan.php">Order</a>

            </div>
            <div class="col-sm">
              <p style="font-family: Cambria, Cochin, Georgia, Times, serif;"><b>Cuci Kering Lipat</b></p>
              <h6><img src="images/cuckerilipat.jpeg" width="150px"> </h6>
              <a class="btn btn-outline-info active" href="orderkiloan.php">Order</a>

            </div>
          </div>
        </div>
        <br>
        <br>
        <!-- dg -->
        <div class="container">
          <div class="tengah">

            <div class="row">
              <div class="col-sm">
                <p style="font-family: Cambria, Cochin, Georgia, Times, serif;"><b>Cuci Setrika</b></p>
                <h6><img src="images/cucisetrika.jpeg" width="110px"> </h6>
                <a class="btn btn-outline-info active" href="orderkiloan.php">Order</a>

              </div>
            </div>
          </div>
        </div>
      </div>

      <hr color="deeppink;">


      <div class="jumbotron jumbotron-fluid bg-white">
        <div class="container">
          <h1 class="tengah" id="status-order" style="font-family: oldenglisth;">Status Order</h1>
          <p class="tengah">Cek status laundry anda disini.</p>
          <br>
          <table id="pagination" class="table table-striped table-bordered" style="background-color: pink;">
            <thead>
              <tr>
                <th scope="col">Jenis Laundry</th>
                <th scope="col">Massa Barang</th>
                <th scope="col">Jumlah Barang</th>
                <th scope="col">Waktu Pengambilan</th>
                <th scope="col">Waktu Pengantaran</th>
                <th scope="col">Alamat</th>
                <th scope="col">Catatan</th>
                <th scope="col">Harga Total</th>
                <th scope="col">Status Pemesanan</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($rows as $row) {
              ?>
                <tr>
                  <td><?= $row['jenis_laundry'] ?></td>
                  <td><?= $row['massa_barang'] ?></td>
                  <td><?= $row['jumlah_barang'] ?></td>
                  <td><?= $row['waktu_pengambilan'] ?></td>
                  <td><?= $row['waktu_pengantaran'] ?></td>
                  <td><?= $row['alamat'] ?></td>
                  <td><?= $row['catatan'] ?></td>
                  <td><?= $row['harga_total'] ?></td>
                  <td><?= $row['status_pemesanan'] ?></td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="jumbotron jumbotron-fluid  text-light ;" style="background: black;">
        <div class="container">
          <h1 class="tengah" id="profil">Informasi Profil</h1>
          <p class="tengah">Informasi tentang Nama, E-mail, dan Nomor Telepon yang digunakan.</p>
          <br>
          <ul>
            <li>Nama : <?php echo ($_SESSION['name']) ?></li>
            <br>
            <li>E-mail : <?php echo ($_SESSION['email']) ?> </li>
            <br>
            <li>Nomor Telepon : <?php echo ($_SESSION['nomortelepon']) ?> </li>
          </ul>
          <br>
          <form action="dashboard.php?edit=<?php echo $_SESSION['id']; ?>#profil" method="post">
            <input type="hidden" name="id" value="<?= $_SESSION['id'] ?>">
            <input type="submit" class="btn btn-warning btn-sm" value="Edit" name="edit">
            <br>

          </form>
          <br>

          <?php
          if ($edit_form == false) { ?>
            <!-- Kosong -->
          <?php
          } else { ?>
            <!-- Untuk memunculkan edit profil -->
            <h4 class="tengah">Edit profil</h4>
            <form method="post">
              <p class="tengah">Nama : </p>
              <p class="tengah"><input type="text" class="tengah" name="nama" value="<?php echo $name; ?>"></p>
              <p class="tengah">E-mail : </p>
              <p class="tengah"><input type="email" class="tengah" name="email" value="<?php echo $email; ?>"></p>
              <p class="tengah">Password : </p>
              <p class="tengah"><input type="password" class="tengah" name="password" id="password" pattern=".{8,}" required title="Minimum 8 karakter" placeholder="Masukkan password"></p>
              <p class="tengah"><input type="checkbox" onclick="myFunction()"> Show Password</p>
              <p class="tengah">Nomor Telepon : </p>
              <p class="tengah"><input type="text" class="tengah" name="nomor_telepon" value="<?php echo $nomor_telepon; ?>" pattern=".{10,14}" required></p>

            <?php
          } ?>

            <?php
            if ($edit_form == false) { ?>
            <?php
            } else { ?>
              <p class="tengah"><input type="submit" class="btn btn-info btn-sm" name="update" value="Update" />
                <input type="button" class="btn btn-danger btn-sm" onclick="location.href='dashboard.php#profil';" value="Cancel" />
              </p>
            </form>
          <?php
            } ?>
        </div>
      </div>
    </div>

  </div>


</body>
<script>
  $(document).ready(function() {
    $('#pagination').DataTable();
  });

  //Memunculkan password
  function myFunction() {
    var x = document.getElementById("password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
</script>
<!-- Footer -->
<footer class="page-footer font-small blue" style="background: black;">
  <div class="footer-copyright text-center py-3   text-white" style="height: 80px;">© 2023 Copyright:
    <a href="#"> Triwira-88-Laundry</a>
  </div>
</footer>