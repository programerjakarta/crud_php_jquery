<?php

if (isset($_POST['id'])) {
	require_once "../config/db.php";
	$id = (int) mysql_real_escape_string(strip_tags(trim($_POST['id'])));
	$sql = mysql_query("delete from karyawan where id = ".$id." ") or die(mysql_error());
	echo ($sql) ? 1 : 2;
} else {
	die("Access Denied");
}
hallo
