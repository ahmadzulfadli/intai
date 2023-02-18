<?php
include("koneksi.php");

$sql_id = mysqli_query($conn, "SELECT MAX(id_log) FROM tbl_log ");
$data_id = mysqli_fetch_array($sql_id);
$id_akhir = $data_id['MAX(id_log)'];
$id_awal = $id_akhir - 5;

$tegangan_p = mysqli_query($conn, "SELECT tegangan_p FROM tbl_log WHERE id_log>='$id_awal' and id_log<='$id_akhir' ORDER BY id_log ASC");
$arus_p = mysqli_query($conn, "SELECT arus_p FROM tbl_log WHERE id_log>='$id_awal' and id_log<='$id_akhir' ORDER BY id_log ASC");
$daya_p = mysqli_query($conn, "SELECT daya_p FROM tbl_log WHERE id_log>='$id_awal' and id_log<='$id_akhir' ORDER BY id_log ASC");
$tanggal = mysqli_query($conn, "SELECT tanggal FROM tbl_log WHERE id_log>='$id_awal' and id_log<='$id_akhir' ORDER BY id_log ASC");

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Monitoring PLTS UIN SUSKA</title>
	<link rel="shortcut icon" href="assets/image/logo1.svg">
	<!-- halfmoon css -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/halfmoon/css/halfmoon.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">

</head>

<body class="with-custom-webkit-scrollbars with-custom-css-scrollbars">
	<!-- page wrapper with sidebar -->
	<div id="page-wrapper" class="page-wrapper with-navbar with-sidebar with-transitions" data-sidebar-type="overlayed-sm-and-down">
		<!-- Navbar (immediate child of the page wrapper) -->
		<nav class="navbar">
			<!-- Navbar content (with toggle sidebar button) -->

			<button class="btn btn-action " onclick="halfmoon.toggleSidebar()" type="button" style="background-color: #5e81ac;"></button>

			<!-- Navbar brand -->
			<a href="#" class="navbar-brand ">
				Monitoring PLTS
			</a>
			<!-- Navbar text -->
			<span class="navbar-text text-monospace">Teknik Elektro USR</span>
		</nav>
		<div class="sidebar-overlay" onclick="halfmoon.toggleSidebar()"></div>
		<!-- sidebar -->
		<div class="sidebar">
			<div class="sidebar-menu">
				<center>
					<img src="assets/image/logo.svg" width="100px" height="100px" style="border-radius: 40%; margin-top: 10px;">
					<h4>Mahasiswa</h4>
				</center>
				<!-- Dashboard table and graph -->
				<ul class="nav nav-pills nav-stacked">
					<li><a href="index.php">Dashboard</a></li>
					<li><a href="tabel.php">Tabel</a></li>
					<li class="active"><a href="#">Grafik</a></li>
				</ul><br>
			</div>
		</div>
		<!-- end of sidebar -->
		<!-- content wrapper -->
		<div class="content-wrapper">

			<!-- content -->
			<div class="content">
				<div class="col-lg-12">
					<div class="card" style="height: 700px;" align="center">
						<h3> GRAFIK DAYA PLTS TEKNIK ELEKTRO<br>UIN SUSKA RIAU </h3>
						<div class="chart">
						</div>
					</div>
				</div>
				<!-- end of content -->
			</div>
			<!-- end of content wrapper -->
		</div>
	</div>
	<!-- end of page wrapper with sidebar -->
	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	<!-- <script src="assets/js/grafik.js"></script> -->
	<script>
		var options = {
			series: [{
					name: "Tegangan V",
					data: [
						<?php
						while ($data_tegangan_p = mysqli_fetch_array($tegangan_p)) {
							echo '"' . $data_tegangan_p['tegangan_p'] . '",';
						}
						?>
					],
				},
				{
					name: "Arus A",
					data: [
						<?php
						while ($data_arus_p = mysqli_fetch_array($arus_p)) {
							echo '"' . $data_arus_p['arus_p'] . '",';
						}
						?>
					],
				},
				{
					name: "Daya W",
					data: [
						<?php
						while ($data_daya_p = mysqli_fetch_array($daya_p)) {
							echo '"' . $data_daya_p['daya_p'] . '",';
						}
						?>
					],
				}
			],
			chart: {
				type: "bar",
				height: 500,
			},
			plotOptions: {
				bar: {
					horizontal: false,
					columnWidth: "55%",
					endingShape: "rounded",
				},
			},
			dataLabels: {
				enabled: false,
			},
			stroke: {
				show: true,
				width: 2,
				colors: ["transparent"],
			},
			xaxis: {
				categories: [
					<?php
					while ($data_tanggal = mysqli_fetch_array($tanggal)) {
						echo '"' . $data_tanggal['tanggal'] . '",';
					}
					?>
				],
			},
			yaxis: {
				title: {
					text: "",
				},
			},
			fill: {
				opacity: 1,
			},
			tooltip: {
				y: {
					formatter: function(val) {
						return val;
					},
				},
			},
		};
		var chart = new ApexCharts(document.querySelector(".chart"), options);
		chart.render();
	</script>
</body>

</html>