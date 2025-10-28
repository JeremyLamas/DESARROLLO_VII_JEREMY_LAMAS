<?php
require 'config.php';

if(isset($_POST['prestar'])){
  mysqli_begin_transaction($conn);
  try {
    $stmt = mysqli_prepare($conn, "INSERT INTO prestamos(usuario_id, libro_id, fecha_prestamo) VALUES(?,?,CURDATE())");
    mysqli_stmt_bind_param($stmt, "ii", $_POST['usuario_id'], $_POST['libro_id']);
    mysqli_stmt_execute($stmt);
    mysqli_query($conn, "UPDATE libros SET cantidad=cantidad-1 WHERE id=".$_POST['libro_id']);
    mysqli_commit($conn);
  } catch(Exception $e) {
    mysqli_rollback($conn);
  }
}

if(isset($_GET['devolver'])){
  mysqli_begin_transaction($conn);
  try {
    mysqli_query($conn, "UPDATE prestamos SET devuelto=1, fecha_devolucion=CURDATE() WHERE id=".$_GET['devolver']);
    mysqli_query($conn, "UPDATE libros l JOIN prestamos p ON l.id=p.libro_id SET l.cantidad=l.cantidad+1 WHERE p.id=".$_GET['devolver']);
    mysqli_commit($conn);
  } catch(Exception $e) {
    mysqli_rollback($conn);
  }
}

$usuarios = mysqli_query($conn, "SELECT * FROM usuarios");
$libros = mysqli_query($conn, "SELECT * FROM libros");
$prestamos = mysqli_query($conn, "SELECT p.id, u.nombre, l.titulo, p.fecha_prestamo, p.devuelto 
FROM prestamos p 
JOIN usuarios u ON p.usuario_id=u.id 
JOIN libros l ON p.libro_id=l.id");
?>
<h2>Préstamos</h2>
<form method="post">
  <select name="usuario_id">
    <?php while($u = mysqli_fetch_assoc($usuarios)): ?>
    <option value="<?=$u['id']?>"><?=$u['nombre']?></option>
    <?php endwhile; ?>
  </select>
  <select name="libro_id">
    <?php while($l = mysqli_fetch_assoc($libros)): ?>
    <option value="<?=$l['id']?>"><?=$l['titulo']?></option>
    <?php endwhile; ?>
  </select>
  <button name="prestar">Prestar</button>
</form>

<table border="1">
<tr><th>ID</th><th>Usuario</th><th>Libro</th><th>Fecha</th><th>Devuelto</th><th></th></tr>
<?php while($p = mysqli_fetch_assoc($prestamos)): ?>
<tr>
<td><?=$p['id']?></td>
<td><?=$p['nombre']?></td>
<td><?=$p['titulo']?></td>
<td><?=$p['fecha_prestamo']?></td>
<td><?=$p['devuelto'] ? 'Sí' : 'No'?></td>
<td><?php if(!$p['devuelto']): ?><a href="?devolver=<?=$p['id']?>">Devolver</a><?php endif; ?></td>
</tr>
<?php endwhile; ?>
</table>

