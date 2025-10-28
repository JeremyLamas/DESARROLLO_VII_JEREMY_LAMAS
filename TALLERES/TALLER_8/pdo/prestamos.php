<?php
require 'config.php';

if(isset($_POST['prestar'])){
  try {
    $pdo->beginTransaction();
    $stmt = $pdo->prepare("INSERT INTO prestamos (usuario_id, libro_id, fecha_prestamo) VALUES (?, ?, CURDATE())");
    $stmt->execute([$_POST['usuario_id'], $_POST['libro_id']]);
    $pdo->exec("UPDATE libros SET cantidad = cantidad - 1 WHERE id = " . $_POST['libro_id']);
    $pdo->commit();
  } catch (Exception $e) {
    $pdo->rollBack();
  }
}

if(isset($_GET['devolver'])){
  try {
    $pdo->beginTransaction();
    $pdo->exec("UPDATE prestamos SET devuelto = 1, fecha_devolucion = CURDATE() WHERE id = " . $_GET['devolver']);
    $pdo->exec("UPDATE libros l JOIN prestamos p ON l.id = p.libro_id SET l.cantidad = l.cantidad + 1 WHERE p.id = " . $_GET['devolver']);
    $pdo->commit();
  } catch (Exception $e) {
    $pdo->rollBack();
  }
}

$usuarios = $pdo->query("SELECT * FROM usuarios");
$libros = $pdo->query("SELECT * FROM libros");
$prestamos = $pdo->query("SELECT p.id, u.nombre, l.titulo, p.fecha_prestamo, p.devuelto 
                          FROM prestamos p 
                          JOIN usuarios u ON p.usuario_id = u.id 
                          JOIN libros l ON p.libro_id = l.id");
?>
<h2>Préstamos</h2>
<form method="post">
  <select name="usuario_id">
    <?php while($u = $usuarios->fetch(PDO::FETCH_ASSOC)): ?>
    <option value="<?=$u['id']?>"><?=$u['nombre']?></option>
    <?php endwhile; ?>
  </select>
  <select name="libro_id">
    <?php while($l = $libros->fetch(PDO::FETCH_ASSOC)): ?>
    <option value="<?=$l['id']?>"><?=$l['titulo']?></option>
    <?php endwhile; ?>
  </select>
  <button name="prestar">Prestar</button>
</form>

<table border="1">
<tr><th>ID</th><th>Usuario</th><th>Libro</th><th>Fecha</th><th>Devuelto</th><th></th></tr>
<?php while($p = $prestamos->fetch(PDO::FETCH_ASSOC)): ?>
<tr>
<td><?=$p['id']?></td><td><?=$p['nombre']?></td><td><?=$p['titulo']?></td>
<td><?=$p['fecha_prestamo']?></td><td><?=$p['devuelto'] ? 'Sí' : 'No'?></td>
<td><?php if(!$p['devuelto']): ?><a href="?devolver=<?=$p['id']?>">Devolver</a><?php endif;?></td>
</tr>
<?php endwhile; ?>
</table>
