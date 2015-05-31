<?php

if (isset($_POST['country'])) {
	require_once "../config/db.php";
	$country = mysql_real_escape_string(strip_tags(trim($_POST['country'])));
	$sql = mysql_query("select * from city where country_id = '$country';") or die(mysql_error());
	// echo ($sql) ? 1 : 2;
	while ($siti = mysql_fetch_array($sql)) {
		echo "<option value= ".$siti['city_id'].">".$siti['city']."</option>";
	}

	?>
	<?php
} else {
	die("Access Denied");
}

?>
