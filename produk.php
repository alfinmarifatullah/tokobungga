<?php
	error_reporting(0);
	include 'db.php';
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
			<!--nem product-->
			<div class="section">
				<div class="container">
					<h3>Produk</h3>
					<div class="box">
						<?php
						if($_GET['search'] != '' || $_GET['kat'] !=''){
							$where = "AND produck_name LIKE '%".$_GET['search']."%' AND category_id LIKE '%".$_GET['kat']."%' ";
						
							}
						$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE produck_status = 1 $where ORDER BY produck_id DESC");
						if(mysqli_num_rows($produk) > 0){
							while($p = mysqli_fetch_array($produk)){
						?>
						<a href="detail-produk.php?id=<?php echo $p['produck_id']?>">
						<div class="col-4">
							<img src="produk/<?php echo $p['produck_image'] ?>">
							<p class="nama"><?php echo $p['produck_name'] ?></p>
							<p class="harga">Rp. <?php echo $p['produck_price'] ?></p>
							</a>
						</div>
					<?php }}else{ ?>
						<p>produk tidak ada</p>
					<?php } ?>
					</div>
				</div>
			</div>
</body>
</html> 