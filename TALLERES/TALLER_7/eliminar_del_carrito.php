<?php
include('config_sesion.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0 && isset($_SESSION['carrito'][$id])) {
    unset($_SESSION['carrito'][$id]);
}

header('Location: ver_carrito.php');
exit;
?>
