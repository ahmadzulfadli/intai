<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Monitoring PLTS UIN SUSKA</title>
	<link rel="shortcut icon" href="assets/image/logo1.svg">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/halfmoon/css/halfmoon.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/style_table.css">

</head>

<body class="with-custom-webkit-scrollbars with-custom-css-scrollbars">
	<!-- page wrapper with sidebar -->
	<div id="page-wrapper" class="page-wrapper with-navbar with-sidebar with-transitions" data-sidebar-type="overlayed-sm-and-down">
		<!-- Navbar (immediate child of the page wrapper) -->
		<nav class="navbar">
			<!-- Navbar content (with toggle sidebar button) -->

			<button class="btn btn-action " onclick="halfmoon.toggleSidebar()" type="button" style="background-color: #5e81ac;">
			</button>


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
					<li class="active"><a href="#">Tabel</a></li>
					<li><a href="grafik.php">Grafik</a></li>
				</ul><br>
			</div>
		</div>
		<!-- content wrapper -->
		<div class="content-wrapper">
			<!-- content -->
			<div class="content">
				<div class="col-lg-12">
					<div class="card" style="height: 700px;" align="center" onload="table();">
						<h3 align="center"> DATA PLTS TEKNIK ELEKTRO<br>UIN SUSKA RIAU </h3>
						<!--kalender picker -->
						<form action="cari.php" method="post" name="postform">
							<table width="750" border="0">
								<td width="105">Tanggal Awal</td>
								<td colspan="2"><input type="text" name="tgl_awal" size="10" placeholder="yyyy-mm-dd" />
									<a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.postform.tgl_awal);return false;"><img src="assets/calender/calender.jpeg" alt="" name="popcal" width="34" height="29" border="0" align="absmiddle" id="popcal" /></a>
								</td>
								<td width="105">Tanggal Akhir</td>
								<td colspan="2"><input type="text" name="tgl_akhir" size="10" placeholder="yyyy-mm-dd" />
									<a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.postform.tgl_akhir);return false;"><img src="assets/calender/calender.jpeg" alt="" name="popcal" width="34" height="29" border="0" align="absmiddle" id="popcal" /></a>
								<td width="188">
									<button type="submit" name="cari" class="btn btn-white btn-info btn-bold">Tampil</button>
								</td>
								</tr>
							</table>
						</form>

						<script type="text/javascript">
							function table() {
								const xhttp = new XMLHttpRequest();
								xhttp.onload = function() {
									document.getElementById("table").innerHTML = this.responseText;
								}
								xhttp.open("GET", "system/tableload.php");
								xhttp.send();
							}
							setInterval(function() {
								table();
							}, 1);
						</script>
						<div id="table"></div>
					</div>
				</div>
			</div>
			<!-- end of content -->
		</div>
		<!-- end of content wrapper -->
	</div>

	<script src="https://cdn.jsdelivr.net/npm/halfmoon/js/halfmoon.min.js"></script>
</body>
<iframe width=174 height=189 name="gToday:normal:assets/calender/normal.js" id="gToday:normal:assets/calender/normal.js" src="assets/calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>

</html>