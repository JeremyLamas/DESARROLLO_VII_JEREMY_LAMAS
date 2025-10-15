<?php 
include('config_sesion.php'); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Lista de Productos</title>
</head>
<body>
<h2>Productos disponibles</h2>

<?php
$productos = [
  1 => ['nombre' => 'Camisa', 'precio' => 20],
  2 => ['nombre' => 'Pantalón', 'precio' => 30],
  3 => ['nombre' => 'Zapatos', 'precio' => 50],
  4 => ['nombre' => 'Gorra', 'precio' => 10],
  5 => ['nombre' => 'Reloj', 'precio' => 80],
];

foreach ($productos as $id => $p) {
    echo "<p>" . htmlspecialchars($p['nombre']) . " - B/ " . $p['precio'] .
         " <a href='agregar_al_carrito.php?id=$id'>Agregar al carrito</a></p>";
}
?>

<p><a href="ver_carrito.php">Ver carrito de compras</a></p>
</body>
</html>
