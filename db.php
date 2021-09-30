<?php
	$hostname = 'localhost';
	$username =  'root';
	$password = '1234567';
	$dbname = 'db_tokobunga';

	$conn = mysqli_connect($hostname, $username, $password, $dbname) or die ('Gagal Terhubung data base');
	?>