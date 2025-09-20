<?php
function contar_palabras_repetidas($texto) {

    $palabras = explode(" ", trim($texto));

    $conteo = [];

    foreach ($palabras as $palabra) {
  
        $palabra = strtolower(trim($palabra));

        if ($palabra != "") {
            if (isset($conteo[$palabra])) {
                $conteo[$palabra]++;
            } else {
                $conteo[$palabra] = 1;
            }
        }
    }

    return $conteo;
}

function capitalizar_palabras($texto) {
 
    $palabras = explode(" ", trim($texto));
    $resultado = [];

    foreach ($palabras as $palabra) {
        if ($palabra != "") {
            $primera = strtoupper(substr($palabra, 0, 1));
            $resto = strtolower(substr($palabra, 1));
            $resultado[] = $primera . $resto;
        }
    }

    return implode(" ", $resultado);
}
?>

