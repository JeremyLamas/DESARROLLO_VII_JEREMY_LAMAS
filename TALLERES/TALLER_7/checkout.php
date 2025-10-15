<?php
include('config_sesion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';

    if ($nombre !== '') {
        setcookie('usuario', $nombre, time() + 86400);

        $_SESSION['carrito'] = [];

        echo "<h2>Gracias por tu compra, " . htmlspecialchars($nombre) . ".</h2>";
        echo "<p>Tu cookie se guardó por 24 horas.</p>";
        echo "<p><a href='productos.php'>Volver a la tienda</a></p>";
        exit;
    } else {
        $error = "Por favor, escribe tu nombre.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Finalizar Compra</title>
</head>
<body>
<h2>Finalizar Compra</h2>

<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="post">
    <label>Nombre: </label>
    <input type="text" name="nombre" required>
    <input type="submit" value="Confirmar compra">
</form>

<p><a href="ver_carrito.php">Volver al carrito</a></p>
</body>
</html>
