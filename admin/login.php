<?php require '../app/bootstrap.php';
$err='';$ada=(int)db()->query('SELECT COUNT(*) c FROM admin')->fetch()['c']>0;
if($_SERVER['REQUEST_METHOD']==='POST'){cek_csrf();$u=trim($_POST['username']??'');$p=$_POST['password']??'';
 if(!$ada){if($u===''||strlen($p)<6)$err='Username wajib diisi dan password minimal 6 karakter.';else{db()->prepare('INSERT INTO admin(username,password) VALUES(?,?)')->execute([$u,password_hash($p,PASSWORD_DEFAULT)]);$ada=true;}}
 else{$q=db()->prepare('SELECT * FROM admin WHERE username=?');$q->execute([$u]);$r=$q->fetch();
  if($r&&password_verify($p,$r['password'])){session_regenerate_id(true);$_SESSION['admin']=$r['username'];header('Location: index.php');exit;}$err='Username atau password salah.';}}
head($ada?'Login Admin':'Buat Akun Admin Pertama','../');?>
<div class="card" style="max-width:420px;margin:auto"><?php if($err)echo '<div class="err">'.e($err).'</div>';?>
<form method="post"><input type="hidden" name="t" value="<?=csrf()?>"><label>Username</label><input name="username" required autofocus><label>Password</label><input type="password" name="password" required>
<p><button class="btn"><?=$ada?'Masuk':'Buat Akun'?></button></p></form></div>
<?php foot();
