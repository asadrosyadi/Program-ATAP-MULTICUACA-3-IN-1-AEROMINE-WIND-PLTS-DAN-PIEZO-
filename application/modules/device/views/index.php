<?php
foreach ($data as $d) { //untuk menampilkan variabel data yang diangkut dari controller
?>
	<?php
	$time = $d->time;
	$arus_masuk = $d->arus_masuk;
	$tegangan_masuk = $d->tegangan_masuk;
	$daya_masuk = $d->daya_masuk;
	$arus_baterai = $d->arus_baterai;
	$tegangan_baterai = $d->tegangan_baterai;
	$daya_baterai = $d->daya_baterai;
	$presentase_baterai = $d->presentase_baterai;
	$arus_keluar = $d->arus_keluar;
	$tegnagan_keluar = $d->tegnagan_keluar;
	$daya_keluar = $d->daya_keluar;
	$arus_ac = $d->arus_ac;
	$tengangan_ac = $d->tengangan_ac;
	$daya_aktif = $d->daya_aktif;
	$daya_reaktif = $d->daya_reaktif;
	$daya_semu = $d->daya_semu;
	$faktor_daya = $d->faktor_daya;
	?>
<?php }

?>

<style>
	/* Customize the switch */
	.switch {
		position: relative;
		display: inline-block;
		width: 30px;
		/* Setengah dari ukuran sebelumnya */
		height: 17px;
		/* Setengah dari ukuran sebelumnya */
	}

	/* Hide default HTML checkbox */
	.switch input {
		opacity: 0;
		width: 0;
		height: 0;
	}

	/* The slider */
	.slider {
		position: absolute;
		cursor: pointer;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: #ccc;
		-webkit-transition: .4s;
		transition: .4s;
	}

	.slider:before {
		position: absolute;
		content: "";
		height: 13px;
		/* Setengah dari ukuran sebelumnya */
		width: 13px;
		/* Setengah dari ukuran sebelumnya */
		left: 2px;
		bottom: 2px;
		background-color: white;
		-webkit-transition: .4s;
		transition: .4s;
	}

	input:checked+.slider {
		background-color: #2196F3;
	}

	input:focus+.slider {
		box-shadow: 0 0 1px #2196F3;
	}

	input:checked+.slider:before {
		-webkit-transform: translateX(13px);
		/* Setengah dari ukuran sebelumnya */
		-ms-transform: translateX(13px);
		/* Setengah dari ukuran sebelumnya */
		transform: translateX(13px);
		/* Setengah dari ukuran sebelumnya */
	}

	/* Rounded sliders */
	.slider.round {
		border-radius: 17px;
		/* Setengah dari ukuran sebelumnya */
	}

	.slider.round:before {
		border-radius: 50%;
	}
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h1 mb-0 text-gray-800"><?= $title; ?></h1>
		<h7>Update Terakhir : <?php echo $time ?></h7>
	</div>
	<div class="d-sm-flex align-items-left justify-content-between mb-4">
		<div class="ml-auto">
			<form action="<?= site_url('device/clearData') ?>" method="post">
				<button type="submit" class="btn btn-primary text-center"> Reset Data</button>
			</form>
		</div>
	</div>

	<h1 class="h4 mb-0 text-gray-800">
		<center>Hasil Pembangkit Listrik</center>
	</h1> </br>
	<!-- Content Row -->
	<div class="row">

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-5">
			<div class="card border-left-primary shadow h-90 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								Arus Masuk (DCA)</div>
							<div class="h2 mb-0 font-weight-bold text-gray-800"><?php echo $arus_masuk ?> mA</div>
							<?php
							// Mengambil data dari database
							$CI = &get_instance();
							$CI->load->database(); // Load library database
							$query = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->limit(30)->get()->result(); // limit disesuaikan
							$query2 = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->limit(60)->get()->result(); // limit disesuaikan

							// Menghitung rata-rata
							$total = 0;
							foreach ($query as $row) {
								$total += $row->arus_masuk;
							}

							// Menghitung rata-rata
							$total2 = 0;
							foreach ($query2 as $row2) {
								$total2 += $row2->arus_masuk;
							}
							//$average = count($query) > 0 ? $total / count($query) : 0;
							$menit = count($query) > 0 ? $total / 30 : 0;
							$jam = count($query2) > 0 ? $total2 / 60 : 0;

							// Format angka dengan 3 angka di belakang koma
							$menit = number_format($menit, 3);
							$jam = number_format($jam, 3);
							?>

							<div class="h7 mb-0 font-weight-bold text-gray-800">Σ tiap menit: <?php echo $menit ?> mA</div>
							<div class="h7 mb-0 font-weight-bold text-gray-800">Σ tiap Jam: <?php echo $jam ?> mA</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-solid fa-bolt fa-2x text-gray-300"></i>
						</div>
					</div>
					<div class="d-sm-flex align-items-left justify-content-between mb-0">
						<div class="ml-auto">
							<?php echo anchor('device/arus_masuk/', '<button type="button" class="btn btn-primary text-center">Grafik</button>'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-5">
			<div class="card border-left-success shadow h-90 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
								Tegangan Masuk (DCV)</div>
							<div class="h2 mb-0 font-weight-bold text-gray-800"><?php echo $tegangan_masuk ?> V</div>
							<?php
							// Mengambil data dari database
							$CI = &get_instance();
							$CI->load->database(); // Load library database
							$query = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->limit(30)->get()->result(); // limit disesuaikan
							$query2 = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->limit(60)->get()->result(); // limit disesuaikan

							// Menghitung rata-rata
							$total = 0;
							foreach ($query as $row) {
								$total += $row->tegangan_masuk;
							}

							// Menghitung rata-rata
							$total2 = 0;
							foreach ($query2 as $row2) {
								$total2 += $row2->tegangan_masuk;
							}
							//$average = count($query) > 0 ? $total / count($query) : 0;
							$menit = count($query) > 0 ? $total / 30 : 0;
							$jam = count($query2) > 0 ? $total2 / 60 : 0;

							// Format angka dengan 3 angka di belakang koma
							$menit = number_format($menit, 3);
							$jam = number_format($jam, 3);
							?>
							<div class="h7 mb-0 font-weight-bold text-gray-800">Σ tiap menit:<?php echo $menit ?> V</div>
							<div class="h7 mb-0 font-weight-bold text-gray-800">Σ tiap Jam:<?php echo $jam ?> V</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-solid fa-charging-station fa-2x text-gray-300"></i>
						</div>
					</div>
					<div class="d-sm-flex align-items-left justify-content-between mb-0">
						<div class="ml-auto">
							<?php echo anchor('device/tegangan_masuk/', '<button type="button" class="btn btn-success text-center">Grafik</button>'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-5">
			<div class="card border-left-info shadow h-90 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Daya masuk (DC P)
							</div>
							<div class="row no-gutters align-items-center">
								<div class="col-auto">
									<div class="h2 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $daya_masuk ?> Watt</div>
									<?php
									// Mengambil data dari database
									$CI = &get_instance();
									$CI->load->database(); // Load library database
									$query = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->limit(30)->get()->result(); // limit disesuaikan
									$query2 = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->limit(60)->get()->result(); // limit disesuaikan

									// Menghitung rata-rata
									$total = 0;
									foreach ($query as $row) {
										$total += $row->daya_masuk;
									}

									// Menghitung rata-rata
									$total2 = 0;
									foreach ($query2 as $row2) {
										$total2 += $row2->daya_masuk;
									}
									//$average = count($query) > 0 ? $total / count($query) : 0;
									$menit = count($query) > 0 ? $total / 30 : 0;
									$jam = count($query2) > 0 ? $total2 / 60 : 0;

									// Format angka dengan 3 angka di belakang koma
									$menit = number_format($menit, 3);
									$jam = number_format($jam, 3);
									?>
									<div class="h7 mb-0 font-weight-bold text-gray-800">Σ tiap menit:<?php echo $menit ?> Watt</div>
									<div class="h7 mb-0 font-weight-bold text-gray-800">Σ tiap Jam:<?php echo $jam ?> Watt</div>
								</div>
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-solid fa-car-battery fa-2x text-gray-300"></i>
						</div>
					</div>
					<div class="d-sm-flex align-items-left justify-content-between mb-0">
						<div class="ml-auto">
							<?php echo anchor('device/daya_masuk/', '<button type="button" class="btn btn-info text-center">Grafik</button>'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>


	<h1 class="h4 mb-0 text-gray-800">
		<center>Charge Controller</center>
	</h1> </br>
	<div class="row">

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-5">
			<div class="card border-left-primary shadow h-90 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								Arus Baterai (DCA)</div>
							<div class="h2 mb-0 font-weight-bold text-gray-800"><?php echo $arus_baterai ?> mA</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-solid fa-bolt fa-2x text-gray-300"></i>
						</div>
					</div>
					<div class="d-sm-flex align-items-left justify-content-between mb-0">
						<div class="ml-auto">
							<?php echo anchor('device/arus_baterai/', '<button type="button" class="btn btn-primary text-center">Grafik</button>'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-5">
			<div class="card border-left-success shadow h-90 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
								Tegangan Baterai (DCV)</div>
							<div class="h2 mb-0 font-weight-bold text-gray-800"><?php echo $tegangan_baterai ?> V</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-solid fa-charging-station fa-2x text-gray-300"></i>
						</div>
					</div>
					<div class="d-sm-flex align-items-left justify-content-between mb-0">
						<div class="ml-auto">
							<?php echo anchor('device/tegangan_baterai/', '<button type="button" class="btn btn-success text-center">Grafik</button>'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-5">
			<div class="card border-left-info shadow h-90 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Daya Baterai (DC P)
							</div>
							<div class="row no-gutters align-items-center">
								<div class="col-auto">
									<div class="h2 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $daya_baterai ?> Watt</div>
								</div>
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-solid fa-car-battery fa-2x text-gray-300"></i>
						</div>
					</div>
					<div class="d-sm-flex align-items-left justify-content-between mb-0">
						<div class="ml-auto">
							<?php echo anchor('device/daya_baterai/', '<button type="button" class="btn btn-info text-center">Grafik</button>'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-5">
			<div class="card border-left-danger shadow h-90 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Presentase Daya Baterai
							</div>
							<div class="row no-gutters align-items-center">
								<div class="col-auto">
									<div class="h2 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $presentase_baterai ?> %</div>
								</div>
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-solid fa-battery-half fa-2x text-gray-300"></i>
						</div>
					</div>
					<div class="d-sm-flex align-items-left justify-content-between mb-0">
						<div class="ml-auto">
							<?php echo anchor('device/presentase_baterai/', '<button type="button" class="btn btn-danger text-center">Grafik</button>'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>


	</div>

	<div class="row">

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-5">
			<div class="card border-left-primary shadow h-90 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								Arus Keluar (DCA)</div>
							<div class="h2 mb-0 font-weight-bold text-gray-800"><?php echo $arus_keluar ?> mA</div>
							<?php
							// Mengambil data dari database
							$CI = &get_instance();
							$CI->load->database(); // Load library database
							$query = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->limit(30)->get()->result(); // limit disesuaikan
							$query2 = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->limit(60)->get()->result(); // limit disesuaikan
							$query3 = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->get()->result(); // limit disesuaikan

							// Menghitung rata-rata
							$total = 0;
							foreach ($query as $row) {
								$total += $row->arus_keluar;
							}

							// Menghitung rata-rata
							$total2 = 0;
							foreach ($query2 as $row2) {
								$total2 += $row2->arus_keluar;
							}

							// Menghitung rata-rata
							$total3 = 0;
							foreach ($query3 as $row3) {
								$total3 += $row3->arus_keluar;
							}
							//$average = count($query) > 0 ? $total / count($query) : 0;
							$menit = count($query) > 0 ? $total / 30 : 0;
							$jam = count($query2) > 0 ? $total2 / 60 : 0;
							$semua = count($query3) > 0 ? $total3 / count($query) : 0;
							$semua = $semua / 1000;

							// Format angka dengan 3 angka di belakang koma
							$menit = number_format($menit, 3);
							$jam = number_format($jam, 3);
							$semua = number_format($semua, 3);
							?>
							<div class="h7 mb-0 font-weight-bold text-gray-800">Σ tiap menit:<?php echo $menit ?> mA</div>
							<div class="h7 mb-0 font-weight-bold text-gray-800">Σ tiap jam:<?php echo $jam ?> mA</div>
							<div class="h7 mb-0 font-weight-bold text-gray-800">Σ :<?php echo $semua ?> A</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-solid fa-bolt fa-2x text-gray-300"></i>
						</div>
					</div>
					<div class="d-sm-flex align-items-left justify-content-between mb-0">
						<div class="ml-auto">
							<?php echo anchor('device/arus_keluar/', '<button type="button" class="btn btn-primary text-center">Grafik</button>'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-5">
			<div class="card border-left-success shadow h-90 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
								Tegangan Keluar (DCV)</div>
							<div class="h2 mb-0 font-weight-bold text-gray-800"><?php echo $tegnagan_keluar ?> V</div>
							<?php
							// Mengambil data dari database
							$CI = &get_instance();
							$CI->load->database(); // Load library database
							$query = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->limit(30)->get()->result(); // limit disesuaikan
							$query2 = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->limit(60)->get()->result(); // limit disesuaikan
							$query3 = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->get()->result(); // limit disesuaikan

							// Menghitung rata-rata
							$total = 0;
							foreach ($query as $row) {
								$total += $row->tegnagan_keluar;
							}

							// Menghitung rata-rata
							$total2 = 0;
							foreach ($query2 as $row2) {
								$total2 += $row2->tegnagan_keluar;
							}

							// Menghitung rata-rata
							$total3 = 0;
							foreach ($query3 as $row3) {
								$total3 += $row3->tegnagan_keluar;
							}
							//$average = count($query) > 0 ? $total / count($query) : 0;
							$menit = count($query) > 0 ? $total / 30 : 0;
							$jam = count($query2) > 0 ? $total2 / 60 : 0;
							$semua = count($query3) > 0 ? $total3 / count($query) : 0;

							// Format angka dengan 3 angka di belakang koma
							$menit = number_format($menit, 3);
							$jam = number_format($jam, 3);
							$semua = number_format($semua, 3);
							?>
							<div class="h7 mb-0 font-weight-bold text-gray-800">Σ tiap menit:<?php echo $menit ?> V</div>
							<div class="h7 mb-0 font-weight-bold text-gray-800">Σ tiap jam:<?php echo $jam ?> V</div>
							<div class="h7 mb-0 font-weight-bold text-gray-800">Σ :<?php echo $semua ?> V</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-solid fa-charging-station fa-2x text-gray-300"></i>
						</div>
					</div>
					<div class="d-sm-flex align-items-left justify-content-between mb-0">
						<div class="ml-auto">
							<?php echo anchor('device/tegnagan_keluar/', '<button type="button" class="btn btn-success text-center">Grafik</button>'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-5">
			<div class="card border-left-info shadow h-90 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Daya Keluar (DC P)
							</div>
							<div class="row no-gutters align-items-center">
								<div class="col-auto">
									<div class="h2 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $daya_keluar ?> Watt</div>

									<?php
									// Mengambil data dari database
									$CI = &get_instance();
									$CI->load->database(); // Load library database
									$query = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->limit(30)->get()->result(); // limit disesuaikan
									$query2 = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->limit(60)->get()->result(); // limit disesuaikan
									$query3 = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->get()->result(); // limit disesuaikan

									// Menghitung rata-rata
									$total = 0;
									foreach ($query as $row) {
										$total += $row->daya_keluar;
									}

									// Menghitung rata-rata
									$total2 = 0;
									foreach ($query2 as $row2) {
										$total2 += $row2->daya_keluar;
									}

									// Menghitung rata-rata
									$total3 = 0;
									foreach ($query3 as $row3) {
										$total3 += $row3->daya_keluar;
									}
									//$average = count($query) > 0 ? $total / count($query) : 0;
									$menit = count($query) > 0 ? $total / 30 : 0;
									$jam = count($query2) > 0 ? $total2 / 60 : 0;
									$semua = count($query3) > 0 ? $total3 / count($query) : 0;

									// Format angka dengan 3 angka di belakang koma
									$menit = number_format($menit, 3);
									$jam = number_format($jam, 3);
									$semua = number_format($semua, 3);
									?>
									<div class="h7 mb-0 font-weight-bold text-gray-800">Σ tiap menit:<?php echo $menit ?> Watt</div>
									<div class="h7 mb-0 font-weight-bold text-gray-800">Σ tiap jam:<?php echo $jam ?> Watt</div>
									<div class="h7 mb-0 font-weight-bold text-gray-800">Σ :<?php echo $semua ?> Watt</div>
								</div>
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-solid fa-car-battery fa-2x text-gray-300"></i>
						</div>
					</div>
					<div class="d-sm-flex align-items-left justify-content-between mb-0">
						<div class="ml-auto">
							<?php echo anchor('device/daya_keluar/', '<button type="button" class="btn btn-info text-center">Grafik</button>'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>


	<h1 class="h4 mb-0 text-gray-800">
		<center>Inverter Pure Sine Wave</center>
	</h1> </br>
	<div class="row">

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-5">
			<div class="card border-left-primary shadow h-90 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								Arus AC (ACA)</div>
							<div class="h2 mb-0 font-weight-bold text-gray-800"><?php echo $arus_ac ?> mA</div>

							<?php
							// Mengambil data dari database
							$CI = &get_instance();
							$CI->load->database(); // Load library database
							$query = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->limit(30)->get()->result(); // limit disesuaikan
							$query2 = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->limit(60)->get()->result(); // limit disesuaikan
							$query3 = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->get()->result(); // limit disesuaikan

							// Menghitung rata-rata
							$total = 0;
							foreach ($query as $row) {
								$total += $row->arus_ac;
							}

							// Menghitung rata-rata
							$total2 = 0;
							foreach ($query2 as $row2) {
								$total2 += $row2->arus_ac;
							}

							// Menghitung rata-rata
							$total3 = 0;
							foreach ($query3 as $row3) {
								$total3 += $row3->arus_ac;
							}
							//$average = count($query) > 0 ? $total / count($query) : 0;
							$menit = count($query) > 0 ? $total / 30 : 0;
							$jam = count($query2) > 0 ? $total2 / 60 : 0;
							$semua = count($query3) > 0 ? $total3 / count($query) : 0;
							$semua = $semua / 1000;

							// Format angka dengan 3 angka di belakang koma
							$menit = number_format($menit, 3);
							$jam = number_format($jam, 3);
							$semua = number_format($semua, 3);
							?>
							<div class="h7 mb-0 font-weight-bold text-gray-800">Σ tiap menit:<?php echo $menit ?> mA</div>
							<div class="h7 mb-0 font-weight-bold text-gray-800">Σ tiap jam:<?php echo $jam ?> mA</div>
							<div class="h7 mb-0 font-weight-bold text-gray-800">Σ :<?php echo $semua ?> A</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-solid fa-bolt fa-2x text-gray-300"></i>
						</div>
					</div>
					<div class="d-sm-flex align-items-left justify-content-between mb-0">
						<div class="ml-auto">
							<?php echo anchor('device/arus_ac/', '<button type="button" class="btn btn-primary text-center">Grafik</button>'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-5">
			<div class="card border-left-success shadow h-90 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
								Tegangan AC (ACV)</div>
							<div class="h2 mb-0 font-weight-bold text-gray-800"><?php echo $tengangan_ac ?> V</div>

							<?php
							// Mengambil data dari database
							$CI = &get_instance();
							$CI->load->database(); // Load library database
							$query = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->limit(30)->get()->result(); // limit disesuaikan
							$query2 = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->limit(60)->get()->result(); // limit disesuaikan
							$query3 = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->get()->result(); // limit disesuaikan

							// Menghitung rata-rata
							$total = 0;
							foreach ($query as $row) {
								$total += $row->tengangan_ac;
							}

							// Menghitung rata-rata
							$total2 = 0;
							foreach ($query2 as $row2) {
								$total2 += $row2->tengangan_ac;
							}

							// Menghitung rata-rata
							$total3 = 0;
							foreach ($query3 as $row3) {
								$total3 += $row3->tengangan_ac;
							}
							//$average = count($query) > 0 ? $total / count($query) : 0;
							$menit = count($query) > 0 ? $total / 30 : 0;
							$jam = count($query2) > 0 ? $total2 / 60 : 0;
							$semua = count($query3) > 0 ? $total3 / count($query) : 0;

							// Format angka dengan 3 angka di belakang koma
							$menit = number_format($menit, 3);
							$jam = number_format($jam, 3);
							$semua = number_format($semua, 3);
							?>
							<div class="h7 mb-0 font-weight-bold text-gray-800">Σ tiap menit:<?php echo $menit ?> V</div>
							<div class="h7 mb-0 font-weight-bold text-gray-800">Σ tiap jam:<?php echo $jam ?> V</div>
							<div class="h7 mb-0 font-weight-bold text-gray-800">Σ :<?php echo $semua ?> V</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-solid fa-charging-station fa-2x text-gray-300"></i>
						</div>
					</div>
					<div class="d-sm-flex align-items-left justify-content-between mb-0">
						<div class="ml-auto">
							<?php echo anchor('device/tengangan_ac/', '<button type="button" class="btn btn-success text-center">Grafik</button>'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-5">
			<div class="card border-left-info shadow h-90 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Daya Aktif (P)
							</div>
							<div class="row no-gutters align-items-center">
								<div class="col-auto">
									<div class="h2 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $daya_aktif ?> Watt</div>

									<?php
									// Mengambil data dari database
									$CI = &get_instance();
									$CI->load->database(); // Load library database
									$query = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->limit(30)->get()->result(); // limit disesuaikan
									$query2 = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->limit(60)->get()->result(); // limit disesuaikan
									$query3 = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->get()->result(); // limit disesuaikan

									// Menghitung rata-rata
									$total = 0;
									foreach ($query as $row) {
										$total += $row->daya_aktif;
									}

									// Menghitung rata-rata
									$total2 = 0;
									foreach ($query2 as $row2) {
										$total2 += $row2->daya_aktif;
									}

									// Menghitung rata-rata
									$total3 = 0;
									foreach ($query3 as $row3) {
										$total3 += $row3->daya_aktif;
									}
									//$average = count($query) > 0 ? $total / count($query) : 0;
									$menit = count($query) > 0 ? $total / 30 : 0;
									$jam = count($query2) > 0 ? $total2 / 60 : 0;
									$semua = count($query3) > 0 ? $total3 / count($query) : 0;

									// Format angka dengan 3 angka di belakang koma
									$menit = number_format($menit, 3);
									$jam = number_format($jam, 3);
									$semua = number_format($semua, 3);
									?>
									<div class="h7 mb-0 font-weight-bold text-gray-800">Σ tiap menit:<?php echo $menit ?> Watt</div>
									<div class="h7 mb-0 font-weight-bold text-gray-800">Σ tiap jam:<?php echo $jam ?> Watt</div>
									<div class="h7 mb-0 font-weight-bold text-gray-800">Σ :<?php echo $semua ?> Watt</div>
								</div>
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-solid fa-car-battery fa-2x text-gray-300"></i>
						</div>
					</div>
					<div class="d-sm-flex align-items-left justify-content-between mb-0">
						<div class="ml-auto">
							<?php echo anchor('device/daya_aktif/', '<button type="button" class="btn btn-info text-center">Grafik</button>'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Pending Requests Card Example -->
		<div class="col-xl-3 col-md-6 mb-5">
			<div class="card border-left-danger shadow h-90 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
								Daya Reaktif (Q)</div>
							<div class="h2 mb-0 font-weight-bold text-gray-800"><?php echo $daya_reaktif ?> VAR</div>
							<?php
							// Mengambil data dari database
							$CI = &get_instance();
							$CI->load->database(); // Load library database
							$query = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->limit(30)->get()->result(); // limit disesuaikan
							$query2 = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->limit(60)->get()->result(); // limit disesuaikan
							$query3 = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->get()->result(); // limit disesuaikan

							// Menghitung rata-rata
							$total = 0;
							foreach ($query as $row) {
								$total += $row->daya_reaktif;
							}

							// Menghitung rata-rata
							$total2 = 0;
							foreach ($query2 as $row2) {
								$total2 += $row2->daya_reaktif;
							}

							// Menghitung rata-rata
							$total3 = 0;
							foreach ($query3 as $row3) {
								$total3 += $row3->daya_reaktif;
							}
							//$average = count($query) > 0 ? $total / count($query) : 0;
							$menit = count($query) > 0 ? $total / 30 : 0;
							$jam = count($query2) > 0 ? $total2 / 60 : 0;
							$semua = count($query3) > 0 ? $total3 / count($query) : 0;

							// Format angka dengan 3 angka di belakang koma
							$menit = number_format($menit, 3);
							$jam = number_format($jam, 3);
							$semua = number_format($semua, 3);
							?>
							<div class="h7 mb-0 font-weight-bold text-gray-800">Σ tiap menit:<?php echo $menit ?> VAR</div>
							<div class="h7 mb-0 font-weight-bold text-gray-800">Σ tiap jam:<?php echo $jam ?> VAR</div>
							<div class="h7 mb-0 font-weight-bold text-gray-800">Σ :<?php echo $semua ?> VAR</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-solid fa-dumpster-fire fa-2x text-gray-300"></i>
						</div>
					</div>
					<div class="d-sm-flex align-items-left justify-content-between mb-0">
						<div class="ml-auto">
							<?php echo anchor('device/daya_reaktif/', '<button type="button" class="btn btn-danger text-center">Grafik</button>'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Pending Requests Card Example -->
		<div class="col-xl-3 col-md-6 mb-5">
			<div class="card border-left-warning shadow h-90 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
								Daya Semu (S)</div>
							<div class="h2 mb-0 font-weight-bold text-gray-800"><?php echo $daya_semu ?> VA</div>
							<?php
							// Mengambil data dari database
							$CI = &get_instance();
							$CI->load->database(); // Load library database
							$query = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->limit(30)->get()->result(); // limit disesuaikan
							$query2 = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->limit(60)->get()->result(); // limit disesuaikan
							$query3 = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->get()->result(); // limit disesuaikan

							// Menghitung rata-rata
							$total = 0;
							foreach ($query as $row) {
								$total += $row->daya_semu;
							}

							// Menghitung rata-rata
							$total2 = 0;
							foreach ($query2 as $row2) {
								$total2 += $row2->daya_semu;
							}

							// Menghitung rata-rata
							$total3 = 0;
							foreach ($query3 as $row3) {
								$total3 += $row3->daya_semu;
							}
							//$average = count($query) > 0 ? $total / count($query) : 0;
							$menit = count($query) > 0 ? $total / 30 : 0;
							$jam = count($query2) > 0 ? $total2 / 60 : 0;
							$semua = count($query3) > 0 ? $total3 / count($query) : 0;

							// Format angka dengan 3 angka di belakang koma
							$menit = number_format($menit, 3);
							$jam = number_format($jam, 3);
							$semua = number_format($semua, 3);
							?>
							<div class="h7 mb-0 font-weight-bold text-gray-800">Σ tiap menit:<?php echo $menit ?> VA</div>
							<div class="h7 mb-0 font-weight-bold text-gray-800">Σ tiap jam:<?php echo $jam ?> VA</div>
							<div class="h7 mb-0 font-weight-bold text-gray-800">Σ :<?php echo $semua ?> VA</div>
						</div>
						<div class="col-auto">
							<i class="fab fa-solid fa-superpowers fa-2x text-gray-300"></i>
						</div>
					</div>
					<div class="d-sm-flex align-items-left justify-content-between mb-0">
						<div class="ml-auto">
							<?php echo anchor('device/daya_semu/', '<button type="button" class="btn btn-warning text-center">Grafik</button>'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Pending Requests Card Example -->
		<div class="col-xl-3 col-md-6 mb-5">
			<div class="card border-left-secondary shadow h-90 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
								Faktor Daya (pf)</div>
							<div class="h2 mb-0 font-weight-bold text-gray-800"><?php echo $faktor_daya ?> Cos φ</div>
							<?php
							// Mengambil data dari database
							$CI = &get_instance();
							$CI->load->database(); // Load library database
							$query = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->limit(30)->get()->result(); // limit disesuaikan
							$query2 = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->limit(60)->get()->result(); // limit disesuaikan
							$query3 = $CI->db->select('*')->from('datasensor')->where('email', $CI->session->userdata('email'))->order_by('id', 'DESC')->get()->result(); // limit disesuaikan

							// Menghitung rata-rata
							$total = 0;
							foreach ($query as $row) {
								$total += $row->faktor_daya;
							}

							// Menghitung rata-rata
							$total2 = 0;
							foreach ($query2 as $row2) {
								$total2 += $row2->faktor_daya;
							}

							// Menghitung rata-rata
							$total3 = 0;
							foreach ($query3 as $row3) {
								$total3 += $row3->faktor_daya;
							}
							//$average = count($query) > 0 ? $total / count($query) : 0;
							$menit = count($query) > 0 ? $total / 30 : 0;
							$jam = count($query2) > 0 ? $total2 / 60 : 0;
							$semua = count($query3) > 0 ? $total3 / count($query) : 0;

							// Format angka dengan 3 angka di belakang koma
							$menit = number_format($menit, 3);
							$jam = number_format($jam, 3);
							$semua = number_format($semua, 3);
							?>
							<div class="h7 mb-0 font-weight-bold text-gray-800">Σ tiap menit:<?php echo $menit ?> Cos φ</div>
							<div class="h7 mb-0 font-weight-bold text-gray-800">Σ tiap jam:<?php echo $jam ?> Cos φ</div>
							<div class="h7 mb-0 font-weight-bold text-gray-800">Σ :<?php echo $semua ?> Cos φ</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-solid fa-dumpster fa-2x text-gray-300"></i>
						</div>
					</div>
					<div class="d-sm-flex align-items-left justify-content-between mb-0">
						<div class="ml-auto">
							<?php echo anchor('device/faktor_daya/', '<button type="button" class="btn btn-secondary text-center">Grafik</button>'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	</br>
	<h1 class="h4 mb-0 text-gray-800">
		<center>Kontrol Listrik</center>
	</h1> </br>


	<div class="row">

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-90 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								Kontrol Sumber Listrik</div>
							<label class="switch">
								<input type="checkbox" id="switch1">
								<span class="slider round"></span>
							</label>

							<?php
							$kesimpulan1 = '';
							$switch1 = $user['sumber_listrik'];
							if ($switch1 == '1') {
								$kesimpulan1 = 'Otomatis / Energi Mandiri';
							} else {
								$kesimpulan1 = 'PLN';
							}
							?>
							<b><?php echo $kesimpulan1 ?></b>

							<script>
								// Function to check if input value is 1 and set the switch accordingly
								function checkAndSetSwitch() {
									const inputValue = "<?= $user['sumber_listrik']; ?>"; // Manually set the value to 1
									const switchElement = document.getElementById('switch1');

									// If input value is 1, turn on the switch; otherwise, turn it off
									if (inputValue === '1') {
										switchElement.checked = true;

									} else {
										switchElement.checked = false;
									}
								}
								// Call the function to set the switch status on page load
								checkAndSetSwitch();
							</script>
						</div>
						<div class="col-auto">
							<i class="fas fa-solid fa-plug fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-success shadow h-90 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
								Kontrol Faktor Daya (PF)</div>
							<label class="switch">
								<input type="checkbox" id="switch2">
								<span class="slider round"></span>
							</label>
							<?php
							$kesimpulan2 = '';
							$switch2 = $user['faktor_daya'];
							if ($switch2 == '1') {
								$kesimpulan2 = 'ON';
							} else {
								$kesimpulan2 = 'OFF';
							}
							?>
							<b><?php echo $kesimpulan2 ?></b>
							<script>
								// Function to check if input value is 1 and set the switch accordingly
								function checkAndSetSwitch() {
									const inputValue = "<?= $user['faktor_daya']; ?>"; // Manually set the value to 1
									const switchElement = document.getElementById('switch2');

									// If input value is 1, turn on the switch; otherwise, turn it off
									if (inputValue === '1') {
										switchElement.checked = true;
									} else {
										switchElement.checked = false;
									}
								}
								// Call the function to set the switch status on page load
								checkAndSetSwitch();
							</script>
							<div class="h7 mb-0 font-weight-bold text-gray-800">Nilai Kapasitor yang berjalan</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-solid fa-dumpster fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	<div class="row">
		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-info shadow h-90 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Kontrol Output DC 12 V & 5 V
							</div>
							<div class="row no-gutters align-items-center">
								<div class="col-auto">
									<label class="switch">
										<input type="checkbox" id="switch3">
										<span class="slider round"></span>
									</label>
									<?php
									$kesimpulan3 = '';
									$switch3 = $user['output_dc'];
									if ($switch3 == '1') {
										$kesimpulan3 = 'ON';
									} else {
										$kesimpulan3 = 'OFF';
									}
									?>
									<b><?php echo $kesimpulan3 ?></b>
									<script>
										// Function to check if input value is 1 and set the switch accordingly
										function checkAndSetSwitch() {
											const inputValue = "<?= $user['output_dc']; ?>"; // Manually set the value to 1
											const switchElement = document.getElementById('switch3');

											// If input value is 1, turn on the switch; otherwise, turn it off
											if (inputValue === '1') {
												switchElement.checked = true;
											} else {
												switchElement.checked = false;
											}
										}
										// Call the function to set the switch status on page load
										checkAndSetSwitch();
									</script>
								</div>
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-solid fa-power-off fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Pending Requests Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-warning shadow h-90 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
								Kontrol Stop Kontak 1</div>
							<label class="switch">
								<input type="checkbox" id="switch4">
								<span class="slider round"></span>
							</label>
							<?php
							$kesimpulan4 = '';
							$switch4 = $user['stopkontak_1'];
							if ($switch4 == '1') {
								$kesimpulan4 = 'ON';
							} else {
								$kesimpulan4 = 'OFF';
							}
							?>
							<b><?php echo $kesimpulan4 ?></b>
							<script>
								// Function to check if input value is 1 and set the switch accordingly
								function checkAndSetSwitch() {
									const inputValue = "<?= $user['stopkontak_1']; ?>"; // Manually set the value to 1
									const switchElement = document.getElementById('switch4');

									// If input value is 1, turn on the switch; otherwise, turn it off
									if (inputValue === '1') {
										switchElement.checked = true;
									} else {
										switchElement.checked = false;
									}
								}
								// Call the function to set the switch status on page load
								checkAndSetSwitch();
							</script>
						</div>
						<div class="col-auto">
							<i class="fas fa-solid fa-power-off fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-info shadow h-90 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1">
								Kontrol Stop Kontak 2</div>
							<label class="switch">
								<input type="checkbox" id="switch5">
								<span class="slider round"></span>
							</label>
							<?php
							$kesimpulan5 = '';
							$switch5 = $user['stopkontak_2'];
							if ($switch5 == '1') {
								$kesimpulan5 = 'ON';
							} else {
								$kesimpulan5 = 'OFF';
							}
							?>
							<b><?php echo $kesimpulan5 ?></b>
							<script>
								// Function to check if input value is 1 and set the switch accordingly
								function checkAndSetSwitch() {
									const inputValue = "<?= $user['stopkontak_2']; ?>"; // Manually set the value to 1
									const switchElement = document.getElementById('switch5');

									// If input value is 1, turn on the switch; otherwise, turn it off
									if (inputValue === '1') {
										switchElement.checked = true;
									} else {
										switchElement.checked = false;
									}
								}
								// Call the function to set the switch status on page load
								checkAndSetSwitch();
							</script>
						</div>
						<div class="col-auto">
							<i class="fas fa-solid fa-power-off fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-secondary shadow h-90 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
								Kontrol Lampu</div>

							<label class="switch">
								<input type="checkbox" id="switch6">
								<span class="slider round"></span>
							</label>
							<?php
							$kesimpulan6 = '';
							$switch6 = $user['lampu'];
							if ($switch6 == '1') {
								$kesimpulan6 = 'ON';
							} else {
								$kesimpulan6 = 'OFF';
							}
							?>
							<b><?php echo $kesimpulan6 ?></b>
							<script>
								// Function to check if input value is 1 and set the switch accordingly
								function checkAndSetSwitch() {
									const inputValue = "<?= $user['lampu']; ?>"; // Manually set the value to 1
									const switchElement = document.getElementById('switch6');

									// If input value is 1, turn on the switch; otherwise, turn it off
									if (inputValue === '1') {
										switchElement.checked = true;
									} else {
										switchElement.checked = false;
									}
								}
								// Call the function to set the switch status on page load
								checkAndSetSwitch();
							</script>

						</div>
						<div class="col-auto">
							<i class="fas fa-solid fa-lightbulb fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>

<script>
	document.getElementById('switch6').addEventListener('change', function() {
		var switchStatus6 = this.checked ? 1 : 0; // Jika switch diaktifkan, nilai 1, jika tidak, nilai 0
		sendDataToServer6(switchStatus6); // Panggil fungsi untuk mengirim data ke server
	});

	function sendDataToServer6(switchStatus6) {
		var xhr = new XMLHttpRequest();
		xhr.open('POST', '<?= base_url('device/save_switch6') ?>', true); // Ganti 'update_switch.php' dengan URL ke skrip PHP yang menangani penyimpanan data
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.onload = function() {
			if (xhr.status === 200) {
				console.log('Data sent successfully');
			} else {
				console.error('Error sending data');
			}
		};
		var data = 'switch_status6=' + switchStatus6; // Data yang akan dikirimkan, misalnya switch_status=1 untuk switch aktif
		xhr.send(data);
	}

	document.getElementById('switch5').addEventListener('change', function() {
		var switchStatus5 = this.checked ? 1 : 0; // Jika switch diaktifkan, nilai 1, jika tidak, nilai 0
		sendDataToServer5(switchStatus5); // Panggil fungsi untuk mengirim data ke server
	});

	function sendDataToServer5(switchStatus5) {
		var xhr = new XMLHttpRequest();
		xhr.open('POST', '<?= base_url('device/save_switch5') ?>', true); // Ganti 'update_switch.php' dengan URL ke skrip PHP yang menangani penyimpanan data
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.onload = function() {
			if (xhr.status === 200) {
				console.log('Data sent successfully');
			} else {
				console.error('Error sending data');
			}
		};
		var data = 'switch_status5=' + switchStatus5; // Data yang akan dikirimkan, misalnya switch_status=1 untuk switch aktif
		xhr.send(data);
	}


	document.getElementById('switch4').addEventListener('change', function() {
		var switchStatus4 = this.checked ? 1 : 0; // Jika switch diaktifkan, nilai 1, jika tidak, nilai 0
		sendDataToServer4(switchStatus4); // Panggil fungsi untuk mengirim data ke server
	});

	function sendDataToServer4(switchStatus4) {
		var xhr = new XMLHttpRequest();
		xhr.open('POST', '<?= base_url('device/save_switch4') ?>', true); // Ganti 'update_switch.php' dengan URL ke skrip PHP yang menangani penyimpanan data
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.onload = function() {
			if (xhr.status === 200) {
				console.log('Data sent successfully');
			} else {
				console.error('Error sending data');
			}
		};
		var data = 'switch_status4=' + switchStatus4; // Data yang akan dikirimkan, misalnya switch_status=1 untuk switch aktif
		xhr.send(data);
	}

	document.getElementById('switch3').addEventListener('change', function() {
		var switchStatus3 = this.checked ? 1 : 0; // Jika switch diaktifkan, nilai 1, jika tidak, nilai 0
		sendDataToServer3(switchStatus3); // Panggil fungsi untuk mengirim data ke server
	});

	function sendDataToServer3(switchStatus3) {
		var xhr = new XMLHttpRequest();
		xhr.open('POST', '<?= base_url('device/save_switch3') ?>', true); // Ganti 'update_switch.php' dengan URL ke skrip PHP yang menangani penyimpanan data
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.onload = function() {
			if (xhr.status === 200) {
				console.log('Data sent successfully');
			} else {
				console.error('Error sending data');
			}
		};
		var data = 'switch_status3=' + switchStatus3; // Data yang akan dikirimkan, misalnya switch_status=1 untuk switch aktif
		xhr.send(data);
	}

	document.getElementById('switch2').addEventListener('change', function() {
		var switchStatus2 = this.checked ? 1 : 0; // Jika switch diaktifkan, nilai 1, jika tidak, nilai 0
		sendDataToServer2(switchStatus2); // Panggil fungsi untuk mengirim data ke server
	});

	function sendDataToServer2(switchStatus2) {
		var xhr = new XMLHttpRequest();
		xhr.open('POST', '<?= base_url('device/save_switch2') ?>', true); // Ganti 'update_switch.php' dengan URL ke skrip PHP yang menangani penyimpanan data
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.onload = function() {
			if (xhr.status === 200) {
				console.log('Data sent successfully');
			} else {
				console.error('Error sending data');
			}
		};
		var data = 'switch_status2=' + switchStatus2; // Data yang akan dikirimkan, misalnya switch_status=1 untuk switch aktif
		xhr.send(data);
	}

	document.getElementById('switch1').addEventListener('change', function() {
		var switchStatus1 = this.checked ? 1 : 0; // Jika switch diaktifkan, nilai 1, jika tidak, nilai 0
		sendDataToServer1(switchStatus1); // Panggil fungsi untuk mengirim data ke server
	});

	function sendDataToServer1(switchStatus1) {
		var xhr = new XMLHttpRequest();
		xhr.open('POST', '<?= base_url('device/save_switch1') ?>', true); // Ganti 'update_switch.php' dengan URL ke skrip PHP yang menangani penyimpanan data
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.onload = function() {
			if (xhr.status === 200) {
				console.log('Data sent successfully');
			} else {
				console.error('Error sending data');
			}
		};
		var data = 'switch_status1=' + switchStatus1; // Data yang akan dikirimkan, misalnya switch_status=1 untuk switch aktif
		xhr.send(data);
	}
</script>


<meta http-equiv="refresh" content="10">