<?php
require 'config.php';

if(isset($_POST['guardar'])){
  $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $stmt = mysqli_prepare($conn, "INSERT INTO usuarios(nombre, email, password) VALUES(?,?,?)");
  mysqli_stmt_bind_param($stmt, "sss", $_POST['nombre'], $_POST['email'], $hash);
  mysqli_stmt_execute($stmt);
}

if(isset($_GET['borrar'])){
  $stmt = mysqli_prepare($conn, "DELETE FROM usuarios WHERE id=?");
  mysqli_stmt_bind_param($stmt, "i", $_GET['borrar']);
  mysqli_stmt_execute($stmt);
}

$res = mysqli_query($conn, "SELECT * FROM usuarios");
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
<?php while($u = mysqli_fetch_assoc($res)): ?>
<tr>
<td><?=$u['id']?></td><td><?=$u['nombre']?></td><td><?=$u['email']?></td>
<td><a href="?borrar=<?=$u['id']?>">Eliminar</a></td>
</tr>
<?php endwhile; ?>
</table>
