<?php

include "operaciones_cadenas.php";

$frases = [
    "tres por tres es nueve",
    "PHP es un LENGUAJE de programacion",
    "La vida es bella bella",
    "HOLA mundo hola"
];

echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Frase Original</th><th>Capitalizada</th><th>Conteo Palabras</th></tr>";

foreach ($frases as $frase) {
    $capitalizada = capitalizar_palabras($frase);
    $conteo = contar_palabras_repetidas($frase);


    $conteo_str = "";
    foreach ($conteo as $palabra => $cantidad) {
        $conteo_str .= "$palabra => $cantidad<br>";
    }

    echo "<tr>";
    echo "<td>$frase</td>";
    echo "<td>$capitalizada</td>";
    echo "<td>$conteo_str</td>";
    echo "</tr>";
}

echo "</table>";
?>
