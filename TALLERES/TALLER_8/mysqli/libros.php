<?php
require 'config.php';

if(isset($_POST['guardar'])){
  $stmt = mysqli_prepare($conn, "INSERT INTO libros(titulo, autor, isbn, anio, cantidad) VALUES(?,?,?,?,?)");
  mysqli_stmt_bind_param($stmt, "sssii", $_POST['titulo'], $_POST['autor'], $_POST['isbn'], $_POST['anio'], $_POST['cantidad']);
  mysqli_stmt_execute($stmt);
}

if(isset($_GET['borrar'])){
  $stmt = mysqli_prepare($conn, "DELETE FROM libros WHERE id=?");
  mysqli_stmt_bind_param($stmt, "i", $_GET['borrar']);
  mysqli_stmt_execute($stmt);
}

$res = mysqli_query($conn, "SELECT * FROM libros");
?>
<h2>Libros</h2>
<form method="post">
  <input name="titulo" placeholder="Título">
  <input name="autor" placeholder="Autor">
  <input name="isbn" placeholder="ISBN">
  <input name="anio" type="number" placeholder="Año">
  <input name="cantidad" type="number" placeholder="Cantidad">
  <button name="guardar">Guardar</button>
</form>

<table border="1">
<tr><th>ID</th><th>Título</th><th>Autor</th><th>ISBN</th><th>Año</th><th>Cantidad</th><th></th></tr>
<?php while($l = mysqli_fetch_assoc($res)): ?>
<tr>
<td><?=$l['id']?></td>
<td><?=$l['titulo']?></td>
<td><?=$l['autor']?></td>
<td><?=$l['isbn']?></td>
<td><?=$l['anio']?></td>
<td><?=$l['cantidad']?></td>
<td><a href="?borrar=<?=$l['id']?>">Eliminar</a></td>
</tr>
<?php endwhile; ?>
</table>
