<?php 
include('config_sesion.php'); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Carrito de Compras</title>
</head>
<body>
<h2>Carrito de Compras</h2>

<?php
$productos = [
  1 => ['nombre' => 'Camisa', 'precio' => 20],
  2 => ['nombre' => 'Pantalón', 'precio' => 30],
  3 => ['nombre' => 'Zapatos', 'precio' => 50],
  4 => ['nombre' => 'Gorra', 'precio' => 10],
  5 => ['nombre' => 'Reloj', 'precio' => 80],
];

if (!empty($_SESSION['carrito'])) {
    $total = 0;

    foreach ($_SESSION['carrito'] as $id => $cantidad) {
        $nombre = isset($productos[$id]) ? $productos[$id]['nombre'] : 'Producto';
        $precio = isset($productos[$id]) ? $productos[$id]['precio'] : 0;
        $subtotal = $precio * $cantidad;
        $total += $subtotal;

        echo "<p>" . htmlspecialchars($nombre) . " - Cantidad: $cantidad - Subtotal: B/ " . $subtotal .
             " <a href='eliminar_del_carrito.php?id=$id'>Eliminar</a></p>";
    }

    echo "<h3>Total a pagar: B/ " . $total . "</h3>";
    echo "<p><a href='checkout.php'>Finalizar compra</a></p>";

} else {
    echo "<p>El carrito está vacío.</p>";
}
?>

<p><a href="productos.php">Volver a la lista de productos</a></p>
</body>
</html>
