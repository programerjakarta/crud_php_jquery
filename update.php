<?php

if (isset($_POST['nama'])) {
	require_once "../config/db.php";
	$nama = mysql_real_escape_string(strip_tags(trim($_POST['nama'])));
	$alamat = mysql_real_escape_string(strip_tags(trim($_POST['alamat'])));
	$hp = mysql_real_escape_string(strip_tags(trim($_POST['hp'])));
	$id = mysql_real_escape_string(strip_tags(trim($_POST['id'])));
	$sql = mysql_query("update karyawan set nama = '$nama', alamat = '$alamat' , hp = '$hp' where id = '$id';") or die(mysql_error());
	echo $nama."/".$alamat."/".$hp;
	?>

	<?php
} else {
	die("Access Denied");
}

?>
