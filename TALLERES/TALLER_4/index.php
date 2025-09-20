<?php
require_once 'Empresa.php';
require_once 'Gerente.php';
require_once 'Desarrollador.php';

$empresa = new Empresa();

$gerente1 = new Gerente("Ana", 1, 3000, "Ventas");
$desarrollador1 = new Desarrollador("Carlos", 2, 2000, "PHP", "Senior");

$empresa->agregarEmpleado($gerente1);
$empresa->agregarEmpleado($desarrollador1);

echo "Lista de empleados:\n";
$empresa->listarEmpleados();

echo "\nEvaluación de desempeño:\n";
$empresa->evaluarEmpleados();

echo "\nNómina total: " . $empresa->calcularNomina() . "\n";
?>

