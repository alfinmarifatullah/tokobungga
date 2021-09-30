<?php
	session_start();
	include 'db.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
	}
	$Kategori = mysqli_query($conn, "SELECT * FROM jb_category WHERE category_id = '".$_GET['id']."' ");
	if(mysqli_num_rows($Kategori) == 0){
		echo '<script>window.location="data-kategori.php"</script>';
	}
	$k = mysqli_fetch_object($Kategori);
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
		<h1><a href="dashboard.php"> Toko Bunga</a></h1>
		<ul>
		<li><a href="dashboard.php">Dashboard</a></li>
		<li><a href="data-kategori.php">Data Kategori</a></li>
		<li><a href="data-produk.php">Data Produk</a></li>
		<li><a href="keluar.php">Keluar</a></li>
	</ul>
</div>
</header>
<!-- content -->
<div class="section">
	<div class="container">
		<h3>Edit Data Kategori</h3>
		<div class="box">
			<form action="" method="POST">
				<input type="text" name="nama" placeholder="Nama Kategori" class="input-control" value="<?php echo $k->category_nama ?>" required>
				<input type="submit" name="submit" value="Submit" class="btn">
			</form>
			<?php
			if(isset($_POST['submit'])){
				$nama = ucwords($_POST['nama']);
				
				$update = mysqli_query($conn, "UPDATE jb_category SET category_nama = '".$nama."' WHERE category_id = '".$k->category_id."' ");

				if($update){
					echo '<script>alert("edit data berhasil")</script>';
					echo '<script>window.location="categori.php"</script>';
				}else{
					echo 'gagal'.mysqli_error($con);
				}
			}
			?>
		</div>
		</tbody>
		</div>
	</div>
</div>
</body>
</html> 