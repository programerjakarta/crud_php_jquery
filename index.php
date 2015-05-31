<?php
require_once "../config/db.php";
$sql = mysql_query("select * from karyawan order by id desc;") or die (mysql_error());
$sql_country = mysql_query("select * from country;") or die (mysql_error());

?>
<!DOCTYPE html>
<html lang="">
    <head>
        <title>Data Karyawan</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="Demo project with jQuery">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
        <style type="text/css">.container{margin-top:30px}</style>
        <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    </head>
	<body>
		<nav class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">DEPKEU</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a data-toggle="modal" href='#modal-id'>Area</a></li>
                </ul>
            </div>
        </nav>
		<div class="container">
			<div class="row">
				<div class="col-md-3">
						<div class="form-group" ID="err_nama">
							<label for="">NAMA</label>
							<input type="text" class="form-control" id="nama" placeholder="">
							<dev id="error_nama"></dev>
						</div>
						<div class="form-group" ID="err_alamat">
							<label for="">ALAMAT</label>
							<input type="text" class="form-control" id="alamat" placeholder="">
							<dev id="error_alamat"></dev>
						</div>
						<div class="form-group" ID="err_hp">
							<label for="">HP</label>
							<input type="text" class="form-control" id="hp" placeholder="">
							<dev id="error_hp"></dev>
						</div>
				</div>
				<div class="col-md-9">
				<table class="table table-hover table-striped">
					<thead>
						<tr>
							<th>Nama</th>
							<th>Alamat</th>
							<th>HP</th>
							<th>Hapus</th>
							<th>Edit</th>
						</tr>
					</thead>
					<tbody>
						<tr id="insert"></tr>
						<?php while ($row = mysql_fetch_array($sql)) {?>
						<tr id="tr<?php echo $row['id']; ?>">
							<td id="n<?php echo $row['id']; ?>"><?php echo $row['nama']; ?></td>
							<td id="a<?php echo $row['id']; ?>"><?php echo $row['alamat']; ?></td>
							<td id="h<?php echo $row['id']; ?>"><?php echo $row['hp']; ?></td>
							<td>
								<button type="button" class="btn btn-danger button<?php echo $row['id'] ?>" id="<?php echo $row['id']; ?>">Hapus</button>
							</td>
							<td>
								<button type="button" class="btn btn-warning button_edit<?php echo $row['id'] ?>" id="<?php echo $row['id']; ?>">Edit</button>
								<button type="button" class="btn btn-primary button_batal<?php echo $row['id'] ?>" id="<?php echo $row['id']; ?>">Batal</button>
							</td>
						</tr>

						<script type="text/javascript">
							jQuery(document).ready(function($) {
								$(".button_batal<?php echo $row['id']; ?>").hide();

								$(".button_edit<?php echo $row['id']; ?>").click(function(event) {
									$("#n<?php echo $row["id"]; ?>").html('<input type="text" id="edit_n_<?php echo $row["id"] ?>" class="form-control" value="<?php echo $row["nama"]; ?>">');
									$("#a<?php echo $row["id"]; ?>").html('<input type="text" id="edit_a_<?php echo $row["id"] ?>" class="form-control" value="<?php echo $row["alamat"]; ?>">');
									$("#h<?php echo $row["id"]; ?>").html('<input type="text" id="edit_h_<?php echo $row["id"] ?>" class="form-control" value="<?php echo $row["hp"]; ?>">');
									$(".btn-warning").not(this).addClass('disabled');
									$(".btn-danger").addClass('disabled');

									$(".button_edit<?php echo $row['id'] ?>").hide();
									$(".button_batal<?php echo $row['id']; ?>").show();

									$(".button_batal<?php echo $row['id']; ?>").click(function(event) {
										$(".btn-warning").removeClass('disabled');
										$(".btn-danger").removeClass('disabled');
										$("#n<?php echo $row["id"]; ?>").html('<?php echo $row["nama"]; ?>');
										$("#a<?php echo $row["id"]; ?>").html('<?php echo $row["alamat"]; ?>');
										$("#h<?php echo $row["id"]; ?>").html('<?php echo $row["hp"]; ?>');
										$(".button_batal<?php echo $row['id']; ?>").hide();
										$(".button_edit<?php echo $row['id'] ?>").show();

										
									});
									$("#edit_h_<?php echo $row['id'] ?>").keypress(function(event) {
										
									});
									
								});

								$(".button<?php echo $row['id']; ?>").click(function(event) {
									$.ajax({
										url: 'delete.php',
										type: 'POST',
										data: {id: $(".button<?php echo $row['id']; ?>").attr("id")},
									})
									.done(function(str) {
										console.log("success");
										if(str == 1){
											$("#tr<?php echo $row['id']; ?>").fadeTo('1500', 0, function() {
												$("#tr<?php echo $row['id']; ?>").slideUp(400);
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
						<?php } ?>
						
					</tbody>
				</table>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$("#hp").keypress(function(event) {
					if (event.which == 13) {
						var nama = $("#nama").val();
						var alamat = $("#alamat").val();
						var hp = $("#hp").val();

						if (nama == "") {
							$('<span class="glyphicon glyphicon-remove"></span>').insertAfter('#nama');
							$("#err_nama").addClass('has-error has-feedback');
							$("#error_nama").hide().html('<code>Nama Harus Di ISI11</code>').fadeIn(2000);
						} else if(alamat == "") {
							$('<span class="glyphicon glyphicon-remove"></span>').insertAfter('#alamat');
							$("#err_alamat").addClass('has-error has-feedback');
							$("#error_alamat").hide().html('<code>Alamat Harus Di ISI11</code>').fadeIn(2000);
						}else if (hp == "") {
							$('<span class="glyphicon glyphicon-remove"></span>').insertAfter('#hp');
							$("#err_hp").addClass('has-error has-feedback');
							$("#error_hp").hide().html('<code>HP Harus Di ISI11</code>').fadeIn(2000);
						} else {
							$.ajax({
								url: 'insert.php',
								type: 'POST',
								data: {nama: nama,alamat: alamat,hp: hp},
							})
							.done(function(msg) {
								console.log("success");
								$('#insert').hide('4000', function() {
									$(msg).insertAfter('#insert');
									// $('#insert').html(msg).fadeTo(2000,1);
								});
								$("#nama").val('');
								$("#alamat").val('');
								$("#hp").val('');
							})
							.fail(function() {
								console.log("error");
							})
							.always(function() {
								console.log("complete");
							});
						};

						$("#nama").keypress(function(event) {
							$("#err_nama").removeClass('has-error has-feedback');
							$("#error_nama").fadeOut(2000);
						});
						$("#alamat").keypress(function(event) {
							$("#err_alamat").removeClass('has-error has-feedback');
							$("#error_alamat").fadeOut(2000);
						});
						$("#hp").keypress(function(event) {
							$("#err_hp").removeClass('has-error has-feedback');
							$("#error_hp").fadeOut(2000);
						});
						
						
					};
				});
			});
		</script>
		

		<div class="modal fade" id="modal-id">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Area</h4>
					</div>
					<div class="modal-body">
						
							<div class="form-group">
								<label for="">Country</label>
								<select name="" id="country" class="form-control" required="required">
									<?php while ($row_country = mysql_fetch_array($sql_country)) { ?>
									<option value="<?php echo $row_country['country_id']; ?>"><?php echo $row_country['country']; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="">City</label>
								<select name="" id="city" class="form-control" required="required">
									<option>-plih cuntry-</option>
								</select>
							</div>
						
							
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$("#country").change(function(event) {
					/* Act on the event */
					console.log('change');
					$.ajax({
						url: 'siti.php',
						type: 'POST',
						data: {country: $("#country").val()},
					})
					.done(function(str) {
						console.log(str);
						$("#city").html(str);
						
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
	</body>
</html>