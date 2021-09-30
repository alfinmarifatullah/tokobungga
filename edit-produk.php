<?php
		
	include 'db.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
	}
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
<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
</head>
<body>
		<!-- header -->
	<header>
		<div class="container">
		<h1><a href="dashboard.php"> Toko Bunga</a></h1>
		<ul>
		<li><a href="dashboard.php">Dashboard</a></li>
		<li><a href="profil.php">profil</a></li>
		<li><a href="data-kategori.php">Data Kategori</a></li>
		<li><a href="data-produk.php">Data Produk</a></li>
		<li><a href="keluar.php">Keluar</a></li>
	</ul>
</div>
</header>
<!-- content -->
<div class="section">
	<div class="container">
		<h3>Edit Data produk</h3>
		<div class="box">
			<form action="" method="POST" enctype="multipart/form-data">
				<select class="input-control" name="kategori" required>
					<option value="">--pilih--</option>
					<?php
					$Kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
					while($r = mysqli_fetch_array($Kategori)){
					?>
					<option value="<?php echo $r['category_id']?>" <?php echo ($r['category_id'] == $p->category_id)? 'selected':""; ?>><?php echo $r['category_nama']?></option>
				<?php } ?>
				</select>

				<input type="text" name="nama" class="input-control" placeholder="Nama Produk" value="<?php echo $p->produck_name ?>" required>
				<input type="text" name="harga" class="input-control" placeholder="Harga" value="<?php echo $p->produck_price ?>" required>

				<img src="produk/<?php echo $p->produck_image ?>" width="100px">
				<input type="hidden" name="foto" value="<?php echo $p->produck_image?>">
				<input type="file" name="gambar" class="input-control">
				<textarea class="input-control" name="deskripsi" placeholder="Deskripsi"><?php echo $p->produck_description ?></textarea> <br>

				<input type="submit" name="submit" value="submit" class="btn">
			</form>
			<?php
			if(isset($_POST['submit'])){

				// data inputan dari form
				$kategori 	= $_POST['kategori'];
				$nama 		= $_POST['nama'];
				$harga 		= $_POST['harga'];
				$deskripsi 	= $_POST['deskripsi'];

				$foto 		= $_POST['foto'];
				
				// data gambar yang baru
				$filename = $_FILES['gambar']['name'];
				$tmp_name = $_FILES['gambar']['tmp_name'];


				// jika admin gagal gamti gambar

				if($filename != ''){
				$type1 = explode('.', $filename);
				$type2 = $type1[1];

				$newname = 'produk'.time().'.'.$type2;

				// menampung data format file yang diizinkan
				$tipe_diizinkan = array('jpg','jpeg','png','gif');

					//validasi format file
				if(!in_array($type2, $tipe_diizinkan)){
					// jika format file tidak ada didalam type diizinkan
					echo '<script>alert("format file tidak diizinkan")</script>';
				}else{

					unlink('./produk/'.$foto);
						move_uploaded_file($tmp_name,'./produk/'.$newname);
						$namagambar - $newname;
				}
			}else{
				// jika admin tidak ganti gambar
				$namagambar = $foto;
			}
			// query update data produk
				$update = mysqli_query($conn, "UPDATE tb_product SET
									category_id = '".$kategori."',
									produck_name = '".$nama."',
									produck_price = '".$harga."',
									produck_description = '".$deskripsi."',
									produck_image = '".$namagambar."'
									WHERE produck_id = '".$p->produck_id."' ");
				if($update){
						echo '<script>alert("Ubah data berhasil")</script>';
						echo '<script>window.location="data-produk.php"</script>';
					}else{
						echo 'gagal'.mysqli_error($conn);
					}

			}
			?>
		</div>
		</tbody>
		</div>
	</div>
</div>
<script>
        CKEDITOR.replace( 'deskripsi' );
</script>
</body>
</html> 