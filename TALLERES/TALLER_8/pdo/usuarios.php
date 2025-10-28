<?php
require 'config.php';

if(isset($_POST['guardar'])){
  $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
  $stmt->execute([$_POST['nombre'], $_POST['email'], $hash]);
}

if(isset($_GET['borrar'])){
  $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id=?");
  $stmt->execute([$_GET['borrar']]);
}

$res = $pdo->query("SELECT * FROM usuarios");
?>
<h2>Usuarios</h2>
<form method="post">
  <input name="nombre" placeholder="Nombre">
  <input name="email" placeholder="Email">
  <input name="password" type="password" placeholder="Contraseña">
  <button name="guardar">Guardar</button>
</form>

<table border="1">
<tr><th>ID</th><th>Nombre</th><th>Email</th><th></th></tr>
<?php while($u = $res->fetch(PDO::FETCH_ASSOC)): ?>
<tr>
<td><?=$u['id']?></td><td><?=$u['nombre']?></td><td><?=$u['email']?></td>
<td><a href="?borrar=<?=$u['id']?>">Eliminar</a></td>
</tr>
<?php endwhile; ?>
</table>
