<?php
if (file_exists('registros.json')) {
    $registros = json_decode(file_get_contents('registros.json'), true);
    echo "<h2>Resumen de Registros</h2>";
    echo "<table border='1'>";
    foreach ($registros as $registro) {
        echo "<tr>";
        foreach ($registro as $campo => $valor) {
            echo "<td>";
            if ($campo === 'intereses') {
                echo implode(", ", $valor);
            } elseif ($campo === 'foto_perfil') {
                echo "<img src='$valor' width='100'>";
            } else {
                echo $valor;
            }
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No hay registros aún.";
}
?>
