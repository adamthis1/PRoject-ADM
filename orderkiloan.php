<?php
session_start();
require_once "database.php";
// membuat objek
$pdo = new database();

//Jika user belum login dan membuka halaman order, maka langsung diarahkan ke halaman login
if (isset($_SESSION['email']) == 0) {
	header('Location: login.php');
}

//Jika admin login, maka langsung diarahkan ke halaman dashboard admin
//Ubah e-mailnya jika ingin mengganti akun admin
if ($_SESSION['email'] == 'admin@laundryonlinemks.com') {
	header('Location: admin_dash.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	//Mencegah data pesanan kosong
	if (
		empty($_POST['jenis_laundry']) || empty($_POST['tanggalPengambilan']) || empty($_POST['tanggalPengantaran']) ||
		empty($_POST['alamat']) /* || empty($_POST['lat']) || empty($_POST['lng']) */ || empty($_POST['hargaTotal'])
	) {
		$message = "Harap Mengisi Semua Data!";
		echo "<script type='text/javascript'>alert('$message');</script>";
	}

	//Memasukkan Data Pesanan
	else {

		// Menampilkan pesan dan kembali ke halaman dashboard pengguna
		echo "<script>alert('Pesanan Berhasil Ditambahkan!, Silahkan Kembali Ke Halaman Sebelumnya'); window.location.href='index.php'; </script>";

		$status = "Tunggu Konfirmasi";
		//Masukkan data pesanan ke database
		$pdo->tambah_pesanan(
			$_POST['jenis_laundry'],
			$_POST['beratBarang'],
			$_POST['jumlahBarang'],
			$_POST['tanggalPengambilan'],
			$_POST['tanggalPengantaran'],
			$_POST['alamat'],
			$_POST['catatan'],
			$_POST['lat'],
			$_POST['lng'],
			$_POST['hargaTotal'],
			$status,
			$_SESSION['id'],
			$_POST['list_satuan']
		);
	}
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
	<title>Pemesanan Laundry</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" type="text/css" href="css/order.css" />
	<link rel="stylesheet" type="text/css" href="css/roboto-font.css">
	<link rel="stylesheet" type="text/css" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/jquery.steps.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/order.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2VtG22tEEfSw-KA850vyuWzL5xAvS4-U&callback=initMap" async defer></script>


</head>

<body>
	<div class="page-content" style="background-image:  linear-gradient(to bottom right, cyan,  salmon, salmon)">

		<div class="pemesanan" style="background-color:  azure">
			<div class="order-form">
				<div class="order-header">
					<h3 class="heading" style="color: black;">Triwira-88-Laundry</h3>
					<p>Harap Mengisi Semua Data Yang Dibutuhkan</p>
				</div>
				<form class="form-order" action="" method="post" name="form-order" id="form-order">
					<h2>
						<span class="step-icon"><i class="zmdi zmdi-shopping-cart"></i></span>
						<span class="step-text">Pemesanan</span>
					</h2>
					<section>
						<div class="inner" style="background-color: white;">
							<h3>Silahkan Isi Form Pemesanan Anda</h3>
							<div class="form-group" id="radio">
								<label>Pilihan Kiloan Laundry :</label>
								<label>
									<input type="radio" class="jenis_laundry" name="jenis_laundry" id="kiloanCheck" value="Kiloan" checked>
								</label> Kiloan

							</div>
							<div class="form-group" id="radio">


							</div>
							<div class="form-row" id="kiloan_checked" name="kiloan_checked">
								<div class="form-holder form-holder-1">
									<h5> Deskripsi Jasa:</h5>
									<ol>
										<li> Untuk Pemesanan antar jemput memliki batas jangkauan. antar jemput hanya berlaku untuk daerah sekitaran laundry saja.</li>
										<li>Minimum order laundry kiloan 5Kg</li>
										<li>Untuk Melakukan Pemesanan antar jemput laundry, sharelock alamat via whatsapp lebih dulu</li>
										<li>Kurir akan datang ke lokasi pelanggan</li>
										<li>Kurir akan login ke website menggunakan akun pelanggan</li>
										<li>Kurir akan menimbang untuk laundry kiloan</li>
										<li> Kurir memasukan tanggal pengambilan dan tanggal pengantaran</li>
										<li>Kurir menambahkan catatan jenis cucian dan tambahan catatan dari pelanggan</li>
										<li> Kurir memasukan alamat pelanggan</li>
										<li> Kurir mengkonfirmasi pesanan pelanggan</li>
										<li> Pelanggan dapat login kembali dan memantau status pesanannya</li>
										<li> Kurir akan mengantarkan pakaian dan menerima pembayaran</li>

									</ol>
									<label class="form-row-inner">
										<input type="number" class="form-control" id="beratBarang" name="beratBarang" min="4" max="50">
										<span class="label">Berat Barang (Kg)</span>
										<span class="border"></span>
									</label>
								</div>
							</div>
							<div class="form-row" id="satuan_checked" name="satuan_checked" style="display:none">
								<div class="form-holder form-holder-2">

								</div>
								<div class="form-group" id="checkbox">


									<label>Jumlah Barang: <input type="text" id="jumlahBarang" name="jumlahBarang" class="jumlahBarang" value="0" readonly="readonly" /></label>
								</div>
							</div>
							<div class="form-row">
								<div class="form-holder form-holder-1">
									<label class="form-row-inner" for="tanggalPengambilan">Pilih Tanggal Pengambilan :</label>
									<div class="form-holder form-holder-1">
										<input type="date" id="tanggalPengambilan" name="tanggalPengambilan" required>
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-holder form-holder-1">
									<label class="form-row-inner" for="tanggalPengantaran">Pilih Tanggal Pengantaran :</label>
									<div class="form-holder form-holder-1">
										<input type="date" id="tanggalPengantaran" name="tanggalPengantaran" required>
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-holder form-holder-2">
									<label class="form-row-inner">
										<input type="text" class="form-control" id="catatan" name="catatan">
										<span class="label">Tambahkan Catatan</span>
										<span class="border"></span>
									</label>
								</div>
							</div>
							<p class="harga-total">
								<label>Harga Total: Rp. <input type="text" id="hargaTotal" name="hargaTotal" class="harga-total" value="0" readonly="readonly" /></label>
							</p>
							<input type="hidden" id="harga-sementara" name="harga-sementara" value="0">
							<input type="hidden" id="list_satuan" name="list_satuan" value="">
						</div>
					</section>
					<!-- Pilihan 2 -->
					<h2>
						<span class="step-icon"><i class="zmdi zmdi-home"></i></span>
						<span class="step-text">Alamat</span>
					</h2>
					<section>
						<div class="inner">
							<h3>Harap Masukkan Alamat Anda</h3>
							<div class="form-row">
								<div class="form-holder form-holder-2">
									<label class="form-row-inner">
										<input type="text" class="form-control" id="alamat" name="alamat" required>
										<span class="label">Alamat Lengkap</span>
										<span class="border"></span>
									</label>
								</div>
							</div>

					</section>
					<!-- Pilihan 3 -->
					<h2>
						<span class="step-icon"><i class="zmdi zmdi-card"></i></span>
						<span class="step-text">Pembayaran</span>
					</h2>
					<section>
						<div class="inner">
							<h3>Metode Pembayaran:</h3>
							<div class="form-row table-responsive">
								<table class="table">
									<tbody>
										<tr class="space-row">
											<input type="radio" class="pay" name="pay" id="cod" value="COD" checked>
											<span class="label">Cash On Delivery</span>
											<th class="space-row">
												<img src="images/cod192.png" alt="pay-1">
											</th>
										</tr>

									</tbody>
								</table>
							</div>
						</div>
					</section>
					<!-- Pilihan 4 -->
					<h2>
						<span class="step-icon"><i class="zmdi zmdi-receipt"></i></span>
						<span class="step-text">Konfirmasi</span>
					</h2>
					<section>
						<div class="inner">
							<h3>Detail Konfirmasi :</h3>
							<div class="form-row table-responsive">
								<table class="table">
									<tbody>

										<tr class="space-row">
											<th>Jenis Laundry </th>
											<td id="jenis_laundry-val"></td>
										</tr>
										<tr class="space-row">
											<th id="beratBarangText">Berat Barang </th>
											<td id="berat_barang-val"></td>
										</tr>
										<tr class="space-row">
											<th id="jumlahBarangText" style="display:none">Jumlah Barang </th>
											<td id="jumlah_barang-val" style="display:none"></td>
										</tr>
										<tr class="space-row">
											<th>Catatan Tambahan </th>
											<td id="catatan-val"></td>
										</tr>
										<tr class="space-row">
											<th>Waktu Pengambilan </th>
											<td id="waktu_pengambilan-val"></td>
										</tr>
										<tr class="space-row">
											<th>Waktu Pengantaran </th>
											<td id="waktu_pengantaran-val"></td>
										</tr>
										<tr class="space-row">
											<th>Alamat </th>
											<td id="alamat-val"></td>
										</tr>
										<tr class="space-row">
											<th>
												<input type="checkbox" id="tampilkanPeta" name="tampilkanPeta" value="">
												<label for="checkbox">Tampilkan Peta</label>
											</th>
											<td>
												<div id="googleMapsK" style="width:100%; height:200px; display:none;"></div>
											</td>
										</tr>
										<tr class="space-row">
											<th>Harga Total </th>
											<td id="harga-val"></td>
										</tr>
										<tr class="space-row">
											<th>Metode Pembayaran </th>
											<td id="pay-val"></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</section>
				</form>
			</div>
		</div>
	</div>
</body>

</html>