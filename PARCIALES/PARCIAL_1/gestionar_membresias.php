<?php
include "funciones_gimnasio.php";


$membresias = [
    "basica" => 80,
    "premium" => 120,
    "vip" => 180,
    "familiar" => 250,
    "corporativa" => 300
];


$miembros = [
    "Juan Perez" => ["tipo" => "premium", "antiguedad" => 15],
    "Ana García" => ["tipo" => "basica", "antiguedad" => 2],
    "Carlos López" => ["tipo" => "vip", "antiguedad" => 24],
    "María Rodríguez" => ["tipo" => "familiar", "antiguedad" => 8],
    "Luis Martínez" => ["tipo" => "corporativa", "antiguedad" => 18]
];


echo "<table border='1' cellpadding='6' cellspacing='0'>";
echo "<tr>
        <th>Nombre</th>
        <th>Tipo de Membresía</th>
        <th>Antigüedad (meses)</th>
        <th>Cuota Base</th>
        <th>Descuento</th>
        <th>Seguro Médico</th>
        <th>Cuota Final</th>
      </tr>";

foreach ($miembros as $nombre => $datos) {
    $tipo = $datos["tipo"];
    $antiguedad = $datos["antiguedad"];
    $cuota_base = $membresias[$tipo];

  
    $descuento = calcular_promocion($antiguedad);
    $seguro = calcular_seguro_medico($cuota_base);
    $cuota_final = calcular_cuota_final($cuota_base, $descuento, $seguro);

   
    echo "<tr>";
    echo "<td>$nombre</td>";
    echo "<td>$tipo</td>";
    echo "<td>$antiguedad</td>";
    echo "<td>$$cuota_base</td>";
    echo "<td>$descuento%</td>";
    echo "<td>$" . number_format($seguro, 2) . "</td>";
    echo "<td><b>$" . number_format($cuota_final, 2) . "</b></td>";
    echo "</tr>";
}

echo "</table>";
?>
