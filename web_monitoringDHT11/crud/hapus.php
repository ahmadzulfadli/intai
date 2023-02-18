<?php
require '../koneksi/konek.php';
$no = $_GET["id"];

$app = new Intai;

if ($app->delete_data($no) > 0) {
	echo "
	<script>
		alert('Kartu Berhasil di Hapus');
		document.location.href = '../index.php';
	</script>
		 ";
} else {
	echo "
		<script>
			alert('Kartu Gagal di Hapus');
			document.location.href = '../index.php';
		</script>
		 ";
}
