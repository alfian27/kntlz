<?php 
$koneksi = new mysqli("localhost","root","","trainittoko");


 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Nota Pembelian</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
<nav class="navbar navbar-default">
		<div class="container">
			<ul class="nav navbar-nav">
				<li><a href="index.php">Home</a></li>
				<li><a href="keranjang.php">Keranjang</a></li>
				
				<?php if (isset($_SESSION["pelanggan"])): ?>
					<li><a href="logout.php">Logout</a></li>
				

				<?php else: ?>
				<li><a href="login.php">Login</a></li>
				
				<?php endif ?>


				<li><a href="checkout.php">Checkout</a></li>
			</ul>
		</div>
	</nav>

	<section class="konten">
		<div class="container">
			
		<h2>Detail Pembelian</h2>
<?php 
 $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
 
$detail = $ambil->fetch_assoc();

 ?>
 <pre><?php print_r($detail); ?></pre>

 <strong><?php echo $detail['nama_pelanggan']; ?></strong>
 <p>
 	<?php echo $detail['telepon_pelanggan']; ?><br>
 	<?php echo $detail['email_pelanggan']; ?>
 </p>

 <p>
 	tanggal : <?php echo $detail['tanggal_pembelian']; ?><br>
 	total : <?php echo $detail['total_pembelian']; ?>
 </p>

 <table class="table table-bordered">
 	<thead>
 		<tr>
 			<th>No</th>
 			<th>Nama </th>
 			<th>Harga </th>
 			<th>Berat</th>
 			<th>Jumlah</th>
 			<th>Subberat</th>
 			<th>Subtotal</th>
 			<!-- <th>total harga (termasuk aongkir)</th> -->
 		</tr>
 	</thead>
 	<tbody>
 		<?php $nomor=1; ?>
 		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
 		<?php while($pecah=$ambil->fetch_assoc()){ ?>
 		<tr>
 			<td><?php echo $nomor; ?></td>
 			<td><?php echo $pecah['nama']; ?></td>
 			<td>Rp. <?php echo number_format($pecah['harga']); ?></td>
 			<td><?php echo $pecah['berat']; ?> gram</td>
 			<td><?php echo $pecah['jumlah']; ?></td>
 			<td><?php echo $pecah['subberat']; ?> gram</td>
 			<td>Rp.<?php echo number_format($pecah['subharga']);?></td>
 			<!-- <td>
 				Rp. <?php echo number_format($detail['total_pembelian']); ?>
 			</td> -->
 		</tr>
 		<?php $nomor++; ?>
 	<?php } ?>
 	</tbody>
 </table>


 <div class="row">
 	<div class="col-md-7">
 		<div class="alert alert-info">
 			<p>
 				Silahkan melakukan pembayaran Rp. <?php echo number_format($detail['total_pembelian']); ?> ke <br>
 				<strong>BANK MANDIRI 137-0001200-2323 AN. Alfian Ferdiansyah</strong>
 			</p>
 		</div>
 	</div>
 </div>

		</div>
	</section>





</body>
</html>