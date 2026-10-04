<?php require 'app/bootstrap.php';
$pesan='';$err='';
if($_SERVER['REQUEST_METHOD']==='POST'){cek_csrf();
 $n=trim($_POST['nama']??'');$a=trim($_POST['asal']??'');$k=trim($_POST['keperluan']??'');
 if($n===''||$a===''||$k==='')$err='Nama, asal, dan keperluan wajib diisi.';
 else{db()->prepare('INSERT INTO tamu(nama,asal,hp,keperluan,temu,catatan) VALUES(?,?,?,?,?,?)')->execute([mb_substr($n,0,100),mb_substr($a,0,150),mb_substr(trim($_POST['hp']??''),0,25),mb_substr($k,0,100),mb_substr(trim($_POST['temu']??''),0,100),trim($_POST['catatan']??'')]);$pesan='Terima kasih, kunjungan Anda telah dicatat.';}}
head('Buku Tamu','',['index.php'=>'Beranda','survei.php'=>'Survei Kepuasan']);?>
<div class="card"><?php if($pesan)echo '<div class="ok">'.e($pesan).'</div>';if($err)echo '<div class="err">'.e($err).'</div>';?>
<form method="post"><input type="hidden" name="t" value="<?=csrf()?>">
<label>Nama lengkap *</label><input name="nama" required>
<label>Instansi / asal *</label><input name="asal" required placeholder="Contoh: Wali murid, Dinas Pendidikan">
<label>No. HP / WhatsApp</label><input name="hp" type="tel">
<label>Keperluan *</label><select name="keperluan" required><option value="">Pilih keperluan</option><option>Bertemu Kepala Madrasah</option><option>Bertemu guru / wali kelas</option><option>Layanan Tata Usaha</option><option>Urusan administrasi siswa</option><option>Kunjungan dinas / kerja sama</option><option>Lainnya</option></select>
<label>Bertemu dengan</label><input name="temu">
<label>Catatan</label><textarea name="catatan" rows="3"></textarea>
<p><button class="btn">Simpan Kunjungan</button></p></form></div>
<?php foot();
