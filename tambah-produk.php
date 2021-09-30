<?php
	session_start();
	include 'jb.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width-device-width, initial-scale-1">
<title>toko bunga</title>
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
		<h3>Tambah Data produk</h3>
		<div class="box">
			<form action="" method="POST" enctype="multipart/form-data">
				<select class="input-control" name="kategori" required>
					<option value="">--pilih--</option>
					<?php
					$Kategori = mysqli_query($conn, "SELECT * FROM jb_category ORDER BY category_id DESC");
					while($r = mysqli_fetch_array($Kategori)){
					?>
					<option value="<?php echo $r['category_id']?>"><?php echo $r['category_nama']?></option>
				<?php } ?>
				</select>

				<input type="text" name="nama" class="input-control" placeholder="Nama jasa" required>
				<input type="text" name="harga" class="input-control" placeholder="Harga" required>
				<input type="file" name="gambar" class="input-control" required>
				<textarea class="input-control" name="deskripsi" placeholder="Deskripsi"></textarea> <br>
				<select class="input-control" name="status">
					<option value="">--Pilih--</option>
					<option value="1">Aktif</option>
					<option value="0">Tidak Aktif</option>
				</select>
				<input type="submit" name="submit" value="Submit" class="btn">
			</form>
			<?php
			if(isset($_POST['submit'])){
				
				//print_r($_FILES['gambar']);
				// menampung inputan dari form
				$kategori 	= $_POST['kategori'];
				$nama 		= $_POST['nama'];
				$harga 		= $_POST['harga'];
				$deskripsi 	= $_POST['deskripsi'];
				$status 	= $_POST['status'];
				// menampung data file yang diupload
				$filename = $_FILES['gambar']['name'];
				$tmp_name = $_FILES['gambar']['tmp_name'];

				$type1 = explode('.', $filename);
				$type2 = $type1[1];

				$newname = 'jasa'.time().'.'.$type2;

				// menampung data format file yang diizinkan
				$tipe_diizinkan = array('jpg','jpeg','png','gif');

				//validasi format file
				if(!in_array($type2, $tipe_diizinkan)){
					// jika format file tidak ada didalam type diizinkan
					echo '<script>alert("format file tidak diizinkan")</script>';
				}else{
					// jika format file sesuai dengan yang ada di dalam array tipe diizinkan 
					// proses upload file sekaligus insert ke database
					move_uploaded_file($tmp_name,'./jasa/'.$newname);

					$insert = mysqli_query($conn, "INSERT INTO jb_jasa VALUES (
								null,
								'".$kategori."',
								'".$nama."',
								'".$harga."',
								'".$deskripsi."',
								'".$newname."',
								'".$status."',
								null
				)");
					if($insert){
						echo '<script>alert("tambah data berhasil")</script>';
						echo '<script>window.location="dt_jasa.php"</script>';
					}else{
						echo 'gagal'.mysqli_error($conn);
					}
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