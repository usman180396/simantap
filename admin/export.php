<?php require '../app/bootstrap.php';require 'tabel.php';wajib_admin();
$jenis=($_GET['t']??'tamu')==='survei'?'survei':'tamu';[$dari,$sampai]=rentang();$rows=ambil($jenis,$dari,$sampai);
$judul='Rekap '.($jenis==='tamu'?'Buku Tamu':'Survei Kepuasan Layanan').' '.NAMA_SEKOLAH.' ('.$dari.' s.d. '.$sampai.')';
$n=$jenis==='survei'?ikm($rows):null;$ket=$n!==null?'<p>Indeks Kepuasan: <b>'.number_format($n,2).'</b> - '.e(predikat($n)).'</p>':'';
if(($_GET['format']??'')==='xls'){header('Content-Type: application/vnd.ms-excel; charset=utf-8');header('Content-Disposition: attachment; filename="rekap-'.$jenis.'-'.$dari.'_'.$sampai.'.xls"');
 echo '<html><head><meta charset="utf-8"></head><body><h3>'.e($judul).'</h3>';tabel($jenis,$rows);echo $ket.'</body></html>';exit;}
?><!DOCTYPE html><html lang="id"><head><meta charset="utf-8"><title><?=e($judul)?></title><link rel="stylesheet" href="../assets/style.css"></head><body onload="window.print()">
<main><h3><?=e($judul)?></h3><?php tabel($jenis,$rows);echo $ket;?>
<p class="noprint"><small>Pada dialog cetak pilih "Simpan sebagai PDF".</small></p></main></body></html>
