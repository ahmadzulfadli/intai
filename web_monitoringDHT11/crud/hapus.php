<?php
require '../koneksi/koneksi.php';
$no = $_GET["id"];

if (hapus($no) > 0) {
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
