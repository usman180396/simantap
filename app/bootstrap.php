<?php
session_start();
date_default_timezone_set('Asia/Jayapura');
const DB_HOST='localhost',DB_NAME='bukutamu_man',DB_USER='root',DB_PASS='';
const NAMA_SEKOLAH='MAN Kota Sorong';
const UNSUR=['Kesesuaian persyaratan layanan','Kemudahan prosedur layanan','Kecepatan waktu layanan','Keramahan dan kesopanan petugas','Kompetensi petugas','Kenyamanan dan kebersihan sarana'];
const NILAI=[1=>'Tidak puas','Kurang puas','Puas','Sangat puas'];
function db(){static $p;if(!$p)$p=new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4',DB_USER,DB_PASS,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]);return $p;}
function e($s){return htmlspecialchars((string)$s,ENT_QUOTES,'UTF-8');}
function csrf(){if(empty($_SESSION['t']))$_SESSION['t']=bin2hex(random_bytes(16));return $_SESSION['t'];}
function cek_csrf(){if(!hash_equals($_SESSION['t']??'',$_POST['t']??''))die('Token tidak valid, muat ulang halaman.');}
function wajib_admin(){if(empty($_SESSION['admin'])){header('Location: login.php');exit;}}
function head($judul,$base='',$menu=[]){echo '<!DOCTYPE html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>'.e($judul).' - '.NAMA_SEKOLAH.'</title><link rel="stylesheet" href="'.$base.'assets/style.css"></head><body><header><h1>'.NAMA_SEKOLAH.'</h1><p>'.e($judul).'</p></header>';
if($menu){echo '<nav>';foreach($menu as $u=>$l)echo '<a href="'.$u.'">'.e($l).'</a>';echo '</nav>';}echo '<main>';}
function foot(){echo '</main></body></html>';}
function rentang(){$d=$_GET['dari']??'';$s=$_GET['sampai']??'';$ok=fn($x)=>preg_match('/^\d{4}-\d{2}-\d{2}$/',$x);return [$ok($d)?$d:date('Y-m-01'),$ok($s)?$s:date('Y-m-d')];}
function ambil($jenis,$dari,$sampai){$t=$jenis==='survei'?'survei':'tamu';$q=db()->prepare("SELECT * FROM $t WHERE DATE(dibuat) BETWEEN ? AND ? ORDER BY dibuat DESC");$q->execute([$dari,$sampai]);return $q->fetchAll();}
function ikm($rows){if(!$rows)return null;$s=0;foreach($rows as $r){$s+=($r['u1']+$r['u2']+$r['u3']+$r['u4']+$r['u5']+$r['u6'])/6;}return $s/count($rows)*25;}
function predikat($n){return $n>=88.31?'A (Sangat Baik)':($n>=76.61?'B (Baik)':($n>=65?'C (Kurang Baik)':'D (Tidak Baik)'));}
