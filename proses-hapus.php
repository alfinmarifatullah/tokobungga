<?php

	include 'db.php';

	if(isset($_GET['idk'])){
		$delate = mysqli_query($conn, "DELETE FROM tb_category WHERE category_id = '".$_GET['idk']."' ");
		echo '<script>window.location="data-kategori.php"</script>';
	}

	if(isset($_GET['idp'])){
		$produk = mysqli_query($conn, "SELECT produck_image FROM tb_product WHERE produck_id = '".$_GET['idp']."' ");
		$p = mysqli_fetch_object($produk);

		unlink('./produk'.$p->produck_image);

		$delate = mysqli_query($conn, "DELETE FROM tb_product WHERE produck_id = '".$_GET['idp']."'");
		echo '<script>window.location="data-produk.php"</script>';

	}
	?>