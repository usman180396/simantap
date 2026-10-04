<?php
function tabel($jenis,$rows){
 if($jenis==='tamu'){echo '<table><tr><th>No</th><th>Waktu</th><th>Nama</th><th>Asal</th><th>HP</th><th>Keperluan</th><th>Bertemu</th><th>Catatan</th></tr>';
  foreach($rows as $i=>$r)echo '<tr><td>'.($i+1).'</td><td>'.e($r['dibuat']).'</td><td>'.e($r['nama']).'</td><td>'.e($r['asal']).'</td><td>'.e($r['hp']).'</td><td>'.e($r['keperluan']).'</td><td>'.e($r['temu']).'</td><td>'.e($r['catatan']).'</td></tr>';}
 else{echo '<table><tr><th>No</th><th>Waktu</th><th>Nama</th><th>Layanan</th>';foreach(UNSUR as $i=>$u)echo '<th>U'.($i+1).'</th>';echo '<th>Saran</th></tr>';
  foreach($rows as $i=>$r){echo '<tr><td>'.($i+1).'</td><td>'.e($r['dibuat']).'</td><td>'.e($r['nama']).'</td><td>'.e($r['layanan']).'</td>';for($k=1;$k<=6;$k++)echo '<td>'.$r["u$k"].'</td>';echo '<td>'.e($r['saran']).'</td></tr>';}}
 echo '</table>';
 if($jenis==='survei'){echo '<p><small>';foreach(UNSUR as $i=>$u)echo 'U'.($i+1).' = '.e($u).($i<5?'; ':'');echo '. Skala 1-4.</small></p>';}}
