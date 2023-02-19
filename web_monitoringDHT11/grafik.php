<?php
require 'koneksi/konek.php';
$app = new Intai;
$data = $app->garfik_data();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>INTAI</title>
	<link rel="shortcut icon" href="assets/image/logo1.svg">
	<!-- halfmoon css -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/halfmoon/css/halfmoon.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- halfmoon js -->
	<script src="https://cdn.jsdelivr.net/npm/halfmoon/js/halfmoon.min.js"></script>
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
				INTAI
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
					<h4>INTAI</h4>
				</center>
				<!-- Dashboard table and graph -->
				<ul class="nav nav-pills nav-stacked">
					<li><a href="index.php">Home</a></li>
					<li><a href="tabel.php">Tabel</a></li>
					<li class="active"><a href="grafik.php">Grafik</a></li>
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
						<h3> Grafik Sensor</h3>
						<div id="chart"></div>
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
	<script>
		var options = {
			chart: {
				type: 'line',
				height: 350
			},
			series: [{
				name: 'Temperature',
				data: []
			}, {
				name: 'Humidity',
				data: []
			}, {
				name: 'Kebisingan',
				data: []
			}],
			xaxis: {
				categories: []
			},
			yaxis: {
				title: {
					text: 'Nilai Sensor'
				}
			}
		}

		// Mengolah data yang diperoleh dari database
		var categories = [];
		var Temperature = [];
		var Humidity = [];
		var Kebisingan = [];

		<?php foreach ($data as $row) : ?>
			categories.push("<?php echo $row['timestamp']; ?>");
			Temperature.push(parseFloat("<?php echo $row['data_temperature']; ?>"));
			Humidity.push(parseFloat("<?php echo $row['data_humidity']; ?>"));
			Kebisingan.push(parseFloat("<?php echo $row['data_humidity']; ?>"));
		<?php endforeach; ?>

		// Mengubah format timestamp
		categories = categories.map(function(timestamp) {
			var date = new Date(timestamp);
			return date.getHours() + ":" + date.getMinutes();
		});

		// Memasukkan data ke dalam grafik
		options.series[0].data = Temperature;
		options.series[1].data = Humidity;
		options.series[2].data = Kebisingan;
		options.xaxis.categories = categories;

		var chart = new ApexCharts(document.querySelector("#chart"), options);
		chart.render();
	</script>

</body>

</html>