<?php
	error_reporting(0);
	include 'db.php';
	$kotak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_adress FROM tb_admin Where admin_admin =1");
	$a = mysqli_fetch_object($kotak);
	$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE produck_id = '".$_GET['id']."' ");
	$p = mysqli_fetch_object($produk);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width-device-width, initial-scale-1">
<title>Tokobunga</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
		<!-- header -->
	<header>
		<div class="container">
		<h1><a href="index.php"> Toko Bunga</a></h1>
		<ul>
			<li><a href="produk.php">produk</a></li>
		</ul>

</div>
</header>
<!-- search-->
			<div class="search">
				<div class="container">
					<form action="produk.php">
						<input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search']?>">
						<input type="hidden" name="kat" value="<?php echo $_GET['kat']?>">
						<input type="submit" name="cari" value="cari produk">
					</form>
				</div>	
			</div>
		<!--product detail -->
		<div class="section">
			<div class="container">
				<h3>Detail Produk</h3>
				<div class="box">
					<div class="col-2">
						<img src="produk/<?php echo $p->produck_image?>" width="100%">
					</div>
					<div class="col-2">
						<h3><?php echo $p->produck_name ?></h3>
						<h4>Rp. <?php echo number_format($p->produck_price) ?></h4>
						<p>Deskripsi : <br>
							<?php echo $p->produck_description ?>
						</p>
						<p><a href="https://api.Whatsapp.com/send?phone=<?php echo $a->admin_telp ?>&text-hai, saya tertarik dengan produkanda."> Hubungi Via Whatsapp <img src="img/wa.png" width="90px"></a></p>
					</div>
				</div>
				
			</div>
		</div>
</body>
</html> 