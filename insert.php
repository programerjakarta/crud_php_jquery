<?php

if (isset($_POST['nama'])) {
	require_once "../config/db.php";
	$nama = mysql_real_escape_string(strip_tags(trim($_POST['nama'])));
	$alamat = mysql_real_escape_string(strip_tags(trim($_POST['alamat'])));
	$hp = mysql_real_escape_string(strip_tags(trim($_POST['hp'])));
	$sql = mysql_query("insert into karyawan values ('','$nama','$alamat','$hp');") or die(mysql_error());
	$id = mysql_insert_id();
	echo "
	<tr id='tr".$id."'>
	<td>".$nama."</td>
	<td>".$alamat."</td>
	<td>".$hp."</td>
	<td>
		<button type='button' class='btn btn-default button". $id."' id='".$id."'>Hapus</button>
	</td>
	<td>
		<button type='button' class='btn btn-default button_edit". $id."' id='".$id."'>Edit</button>
	</td>
</tr>
	";
	?>
	<!-- // <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script> -->
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".button<?php echo $id; ?>").click(function(event) {
				$.ajax({
					url: 'delete.php',
					type: 'POST',
					data: {id: $(".button<?php echo $id; ?>").attr("id")},
				})
				.done(function(str) {
					console.log("success");
					if(str == 1){
						$("#tr<?php echo $id; ?>").fadeTo('1500', 0, function() {
							$("#tr<?php echo $id; ?>").slideUp(400);
						});
					} else {
						alert("failed");
					}
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				
			});
		});
	</script>
	<?php
} else {
	die("Access Denied");
}

?>
