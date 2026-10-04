<?php require '../app/bootstrap.php';require 'tabel.php';wajib_admin();
$jenis=($_GET['t']??'tamu')==='survei'?'survei':'tamu';[$dari,$sampai]=rentang();$rows=ambil($jenis,$dari,$sampai);
$qs='t='.$jenis.'&dari='.$dari.'&sampai='.$sampai;
head('Rekap '.($jenis==='tamu'?'Buku Tamu':'Survei Kepuasan'),'../',['index.php?t=tamu'=>'Rekap Buku Tamu','index.php?t=survei'=>'Rekap Survei','logout.php'=>'Keluar']);?>
<div class="card"><form class="filter"><input type="hidden" name="t" value="<?=$jenis?>"><div><label>Dari</label><input type="date" name="dari" value="<?=e($dari)?>"></div><div><label>Sampai</label><input type="date" name="sampai" value="<?=e($sampai)?>"></div><div><button class="btn">Tampilkan</button></div></form></div>
<div class="card"><div class="stat"><div><b><?=count($rows)?></b>Data</div>
<?php if($jenis==='survei'):$n=ikm($rows);?><div><b><?=$n===null?'-':number_format($n,2)?></b>Indeks Kepuasan</div><div><b><?=$n===null?'-':e(predikat($n))?></b>Predikat</div><?php endif;?></div>
<p><a class="btn" href="export.php?<?=$qs?>&amp;format=xls">⬇ Excel</a> <a class="btn sec" href="export.php?<?=$qs?>&amp;format=pdf" target="_blank">⬇ PDF</a></p>
<div class="tw"><?php tabel($jenis,$rows);?></div></div>
<?php foot();
