<?php require 'app/bootstrap.php';
$pesan='';$err='';
if($_SERVER['REQUEST_METHOD']==='POST'){cek_csrf();$v=[];
 foreach(range(1,6) as $i){$x=(int)($_POST["u$i"]??0);if($x<1||$x>4){$err="Mohon nilai semua pertanyaan (nomor $i belum diisi).";break;}$v[]=$x;}
 if(!$err){db()->prepare('INSERT INTO survei(nama,layanan,u1,u2,u3,u4,u5,u6,saran) VALUES(?,?,?,?,?,?,?,?,?)')->execute(array_merge([mb_substr(trim($_POST['nama']??''),0,100),mb_substr(trim($_POST['layanan']??'Lainnya'),0,100)],$v,[trim($_POST['saran']??'')]));$pesan='Terima kasih atas penilaian Anda!';}}
head('Survei Kepuasan Layanan','',['index.php'=>'Beranda','buku-tamu.php'=>'Buku Tamu']);?>
<div class="card"><?php if($pesan)echo '<div class="ok">'.e($pesan).'</div>';if($err)echo '<div class="err">'.e($err).'</div>';?>
<form method="post"><input type="hidden" name="t" value="<?=csrf()?>">
<label>Nama (boleh dikosongkan)</label><input name="nama">
<label>Layanan yang diterima</label><select name="layanan"><option>Layanan Tata Usaha</option><option>Layanan Akademik / Guru</option><option>Layanan Kepala Madrasah</option><option>Layanan Perpustakaan</option><option>Lainnya</option></select>
<?php foreach(UNSUR as $i=>$q):$n=$i+1;?><label><?=$n?>. <?=e($q)?> *</label><div class="skala"><?php foreach(NILAI as $k=>$l):?><label><input type="radio" name="u<?=$n?>" value="<?=$k?>" required><?=e($l)?></label><?php endforeach;?></div><?php endforeach;?>
<label>Kritik dan saran</label><textarea name="saran" rows="3"></textarea>
<p><button class="btn">Kirim Survei</button></p></form></div>
<?php foot();
