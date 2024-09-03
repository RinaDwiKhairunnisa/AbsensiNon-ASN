<?php
include '../koneksi.php';
if (isset($_POST['simpan'])) {
	$id_karyawan = $_POST['id_karyawan'];
	$nama = $_POST['nama'];
	$waktu = $_POST['waktu'];


}

// Menentukan batasan waktu presensi
$startTime = strtotime("08:00:00");
$endTime = strtotime("08:15:00");
$currentTime = strtotime(date("H:i:s"));

// Mengecek apakah waktu saat ini berada dalam rentang waktu presensi
if ($currentTime >= $startTime && $currentTime <= $endTime) {
    // Presensi diizinkan
    echo "Presensi berhasil!";
} else {
    // Presensi tidak diizinkan
    echo "Maaf, Anda tidak dapat melakukan presensi di luar jam yang ditentukan.";
}

$save = "INSERT INTO tb_absen SET id_karyawan='$id_karyawan', nama='$nama', waktu='$waktu'";
mysqli_query($koneksi, $save);

if ($save) {
	echo "<script>alert('Anda sudah absen untuk hari ini') </script>";
	 echo "<script>window.location.href = \"index.php?m=awal\" </script>";	
}else{
	echo "kryptosssss";
}

 ?>


