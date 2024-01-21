<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
?>
	<!doctype html>
	<html lang="en" class="no-js">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="theme-color" content="#3e454c">

		<title>VMS | Kolinlamil</title>
		<!-- Font awesome -->
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- Sandstone Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- Bootstrap Datatables -->
		<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
		<!-- Bootstrap social button library -->
		<link rel="stylesheet" href="css/bootstrap-social.css">
		<!-- Bootstrap select -->
		<link rel="stylesheet" href="css/bootstrap-select.css">
		<!-- Bootstrap file input -->
		<link rel="stylesheet" href="css/fileinput.min.css">
		<!-- Awesome Bootstrap checkbox -->
		<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
		<!-- Admin Stye -->
		<link rel="stylesheet" href="css/style.css">
		<style>
			.errorWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #dd3d36;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}

			.succWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #5cb85c;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}
		</style>
		<script type="text/javascript">
			function valid(theform) {
				pola_nama = /^[a-zA-Z]*$/;
				if (!pola_nama.test(theform.vehicletitle.value)) {
					alert('Hanya huruf yang diperbolehkan untuk Nama Mobil!');
					theform.vehicletitle.focus();
					return false;
				}
				return (true);
			}
		</script>
	</head>

	<body>
		<?php include('includes/header.php'); ?>
		<div class="ts-main-content">
			<?php include('includes/leftbar.php'); ?>
			<div class="content-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<h2 class="page-title">Tambah Kendaraan</h2>
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">Form Tambah Kendaraan</div>
										<div class="panel-body">
											<form method="post" name="theform" action="tambahmobilact.php" class="form-horizontal" onsubmit="return valid(this);" enctype="multipart/form-data">

												<div class="form-group">
													<label class="col-sm-2 control-label">Pemilik Kendaraan<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="hidden" name="id" class="form-control" value="<?php echo $id; ?>" required>
														<input type="text" name="pemegang" class="form-control" value="<?php echo htmlentities($result['pemegang']); ?>" required>
													</div>
													<label class="col-sm-2 control-label">Satker<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<select class="form-control" name="satker" required="" data-parsley-error-message="Field ini harus diisi">
															<option value=""></option>
															<?php
															$mySql = "SELECT distinct satker FROM mobil ORDER BY kd_satker";
															$myQry = mysqli_query($koneksidb, $mySql);
															$datasatker = $result['kd_satker'];
															while ($satkerData = mysqli_fetch_array($myQry)) {
																if ($satkerData['kd_satker'] == $datasatker) {
																	$cek = " selected";
																} else {
																	$cek = "";
																}
																echo "<option value='$satkerkData[kd_satker]' $cek>" . strtoupper($satkerData['satker']) . "</option>";
															}
															?>
														</select>
													</div>
												</div>

												<div class="form-group">
													<!-- <label class="col-sm-2 control-label">Nama Mobil<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="hidden" name="id" class="form-control" value="<?php echo $id; ?>" required>
														<input type="text" name="namacar" class="form-control" value="<?php echo htmlentities($result['nama_mobil']); ?>" required>
													</div> -->
													<label class="col-sm-2 control-label">Merek<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<select class="form-control" name="merek" required="" data-parsley-error-message="Field ini harus diisi">
															<option value=""></option>
															<?php
															$mySql = "SELECT * FROM merek ORDER BY nama_merek";
															$myQry = mysqli_query($koneksidb, $mySql);
															$dataMerek = $result['id_merek'];
															while ($merekData = mysqli_fetch_array($myQry)) {
																if ($merekData['id_merek'] == $dataMerek) {
																	$cek = " selected";
																} else {
																	$cek = "";
																}
																echo "<option value='$merekData[id_merek]' $cek>" . strtoupper($merekData['nama_merek']) . "</option>";
															}
															?>
														</select>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-2 control-label">Nama Kendaraan<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="hidden" name="id" class="form-control" value="<?php echo $id; ?>" required>
														<input type="text" name="nama_kendaraan" class="form-control" value="<?php echo htmlentities($result['nama_kendaraan']); ?>" required>
													</div>
													<label class="col-sm-2 control-label">Jenis Kendaraan<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="hidden" name="id" class="form-control" value="<?php echo $id; ?>" required>
														<input type="text" name="jenis_kendaraan" class="form-control" value="<?php echo htmlentities($result['jenis_kendaraan']); ?>" required>
													</div>
												</div>

												<div class="hr-dashed"></div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Kondisi Kendaraan<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="hidden" name="id" class="form-control" value="<?php echo $id; ?>" required>
														<input type="text" name="kondisi" class="form-control" value="<?php echo htmlentities($result['kondisi']); ?>" required>
													</div>
													<label class="col-sm-2 control-label">Nomor Randis Kotama<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="nomor_al_kotama" class="form-control" value="<?php echo htmlentities($result['nomor_al_kotama']); ?>" required>
													</div>
												</div>


												<div class="form-group">
													<label class="col-sm-2 control-label">Nomor Randis Pusat<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="nomor_al_pusat" class="form-control" value="<?php echo htmlentities($result['nomor_al_pusat']); ?>" required>
													</div>
													<label class="col-sm-2 control-label">Jenis Bahan Bakar<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<select class="form-control" name="fueltype" required>
															<?php
															$jk = $result['bb'];
															// echo "<option value='$jk' selected>" . $jk . "</option>";
															echo "<option value='Bensin'>Bensin</option>";
															echo "<option value='Diesel'>Diesel</option>";
															?>
														</select>
													</div>
												</div>

												<div class="form-group">

													<label class="col-sm-2 control-label">Nomor Mesin<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="nomor_mesin" class="form-control" value="<?php echo htmlentities($result['nomor_mesin']); ?>" required>
													</div>
													<label class="col-sm-2 control-label">Nomor Rangka<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="nomor_rangka" class="form-control" value="<?php echo htmlentities($result['nomor_rangka']); ?>" required>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-2 control-label">Tahun Registrasi<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="tahun_buat" class="form-control" value="<?php echo htmlentities($result['tahun_buat']); ?>" required>
													</div>
													<label class="col-sm-2 control-label">Perolehan<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="perolehan" class="form-control" value="<?php echo htmlentities($result['perolehan']); ?>" required>
													</div>
												</div>
												<div class="hr-dashed"></div>

												<div class="form-group">
													<div class="col-sm-12">
														<h4><b>Upload Gambar</b></h4>
													</div>
												</div>

												<div class="form-group">
													<div class="col-sm-4">
														Gambar 1<span style="color:red">*</span><input type="file" name="img1" accept="image/*" required>
													</div>
													<div class="col-sm-4">
														Gambar 2<span style="color:red">*</span><input type="file" name="img2" accept="image/*" required>
													</div>
													<div class="col-sm-4">
														Gambar 3<span style="color:red">*</span><input type="file" name="img3" accept="image/*" required>
													</div>
												</div>

												<div class="form-group">
													<div class="col-sm-4">
														Gambar 4<span style="color:red">*</span><input type="file" name="img4" accept="image/*" required>
													</div>
													<div class="col-sm-4">
														Gambar 5<input type="file" name="img5" accept="image/*">
													</div>
												</div>
												<div class="hr-dashed"></div>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">Accessories</div>
										<div class="panel-body">

											<div class="form-group">
												<div class="col-sm-3">
													<div class="checkbox checkbox-inline">
														<input type="checkbox" id="airconditioner" name="airconditioner" value="1">
														<label for="airconditioner"> Air Conditioner </label>
													</div>
												</div>

												<div class="col-sm-3">
													<div class="checkbox checkbox-inline">
														<input type="checkbox" id="powerdoorlocks" name="powerdoorlocks" value="1">
														<label for="powerdoorlocks"> Power Door Locks </label>
													</div>
												</div>

												<div class="col-sm-3">
													<div class="checkbox checkbox-inline">
														<input type="checkbox" id="antilockbrakingsys" name="antilockbrakingsys" value="1">
														<label for="antilockbrakingsys"> AntiLock Braking System </label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox checkbox-inline">
														<input type="checkbox" id="brakeassist" name="brakeassist" value="1">
														<label for="brakeassist"> Brake Assist </label>
													</div>
												</div>
											</div>

											<div class="form-group">
												<div class="col-sm-3">
													<div class="checkbox checkbox-inline">
														<input type="checkbox" id="powersteering" name="powersteering" value="1">
														<label for="inlineCheckbox5"> Power Steering </label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox checkbox-inline">
														<input type="checkbox" id="driverairbag" name="driverairbag" value="1">
														<label for="driverairbag">Driver Airbag</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox checkbox-inline">
														<input type="checkbox" id="passengerairbag" name="passengerairbag" value="1">
														<label for="passengerairbag"> Passenger Airbag </label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox checkbox-inline">
														<input type="checkbox" id="powerwindow" name="powerwindow" value="1">
														<label for="powerwindow"> Power Windows </label>
													</div>
												</div>
											</div>

											<div class="form-group">
												<div class="col-sm-3">
													<div class="checkbox checkbox-inline">
														<input type="checkbox" id="cdplayer" name="cdplayer" value="1">
														<label for="cdplayer"> CD Player </label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox h checkbox-inline">
														<input type="checkbox" id="centrallocking" name="centrallocking" value="1">
														<label for="centrallocking">Central Locking</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox checkbox-inline">
														<input type="checkbox" id="crashcensor" name="crashcensor" value="1">
														<label for="crashcensor"> Crash Sensor </label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox checkbox-inline">
														<input type="checkbox" id="leatherseats" name="leatherseats" value="1">
														<label for="leatherseats"> Leather Seats </label>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-body">
											<div class="form-group">
												<div class="col-sm-3">
													<div class="checkbox checkbox-inline">
														<button class="btn btn-primary" type="submit">Save changes</button>
														<button class="btn btn-default" type="reset">reset</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		</form>

		<!-- Loading Scripts -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap-select.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.bootstrap.min.js"></script>
		<script src="js/Chart.min.js"></script>
		<script src="js/fileinput.js"></script>
		<script src="js/chartData.js"></script>
		<script src="js/main.js"></script>
	</body>

	</html>
<?php } ?>