<?php

/* ========= 1. Leer inventario desde el archivo JSON ========= */
function leerInventario(string $ruta = 'inventario.json'): array {
    if (!file_exists($ruta)) {
        die("Error: No se encontró el archivo $ruta\n");
    }

    $contenido = file_get_contents($ruta);
    $productos = json_decode($contenido, true); 

    if (!is_array($productos)) {
        die("Error: El contenido de $ruta no es un JSON válido.\n");
    }

    return $productos;
}

/* ========= 2. Ordenar alfabéticamente por nombre ========= */
function ordenarPorNombre(array $productos): array {
    usort($productos, function ($a, $b) {
        return strcasecmp($a['nombre'], $b['nombre']);
    });
    return $productos;
}

/* ========= 3. Resumen del inventario (nombre, precio, cantidad) ========= */
function resumenInventario(array $productos): array {
    $ordenados = ordenarPorNombre($productos);

    return array_map(function ($p) {
        return [
            'nombre'   => $p['nombre'],
            'precio'   => (float)$p['precio'],
            'cantidad' => (int)$p['cantidad']
        ];
    }, $ordenados);
}

/* ========= 4. Calcular el valor total del inventario ========= */
function valorTotalInventario(array $productos): float {
    $totalesPorProducto = array_map(function ($p) {
        return (float)$p['precio'] * (int)$p['cantidad'];
    }, $productos);

    return array_sum($totalesPorProducto);
}

/* ========= 5. Informe de productos con stock bajo ========= */
function productosConStockBajo(array $productos, int $umbral = 5): array {
    $filtrados = array_filter($productos, function ($p) use ($umbral) {
        return (int)$p['cantidad'] < $umbral;
    });

    return ordenarPorNombre(array_values($filtrados));
}

function imprimirTabla(array $productos): void {
    echo str_pad("Producto", 22) . str_pad("Precio", 14) . str_pad("Cantidad", 10) . PHP_EOL;
    echo str_repeat("-", 46) . PHP_EOL;

    foreach ($productos as $p) {
        echo str_pad($p['nombre'], 22);
        echo str_pad("$" . number_format((float)$p['precio'], 2), 14);
        echo str_pad((string)$p['cantidad'], 10);
        echo PHP_EOL;
    }
    echo PHP_EOL;
}

/* ========= 6. Script principal que demuestra todo ========= */
function main(): void {
    echo "=== Sistema de Gestión de Inventario (JSON) ===\n\n";

    $inventario = leerInventario();

    echo "1) Resumen del inventario (A → Z):\n";
    $resumen = resumenInventario($inventario);
    imprimirTabla($resumen);

    $total = valorTotalInventario($inventario);
    echo "2) Valor total del inventario: $" . number_format($total, 2) . "\n\n";

    echo "3) Productos con stock bajo (< 5 unidades):\n";
    $bajo = productosConStockBajo($inventario, 5);

    if (count($bajo) === 0) {
        echo "   No hay productos con stock bajo.\n\n";
    } else {
        imprimirTabla($bajo);
    }
}

main();

