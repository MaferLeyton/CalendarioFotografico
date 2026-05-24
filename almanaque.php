<?php
require_once __DIR__ . '/controlador/controlador-de-imagenes.php';

// Ruta a la carpeta de imágenes
$directorio = __DIR__ . '/anuario-de-fotos/Mayo'; // Cambia por la ruta que desees

$controlador = new ControladorDeImagen();

// 1. Llamar todas las imágenes
$rutasImagenes = $controlador->llamarImagenesDeCarpeta($directorio);

// 2. Crear objetos de imagen con fechaDeCreacion
$imagenes = [];
foreach ($rutasImagenes as $ruta) {
    $fecha = file_exists($ruta) ? new DateTime('@' . filemtime($ruta)) : null;
    $obj = (object) [
        'ruta' => $ruta,
        'fechaDeCreacion' => $fecha
    ];
    $imagenes[] = $obj;
}

// 3. Ordenar por fecha
$imagenesOrdenadas = $controlador->ordenarPorFechaDeCreacion($imagenes);

// 4. Agrupar por día
$imagenesPorDia = $controlador->agruparImagenesPorDia($imagenesOrdenadas);

// 5. Seleccionar una imagen por día
$imagenesSeleccionadas = $controlador->seleccionarImagenPorDia($imagenesOrdenadas);

// 6. Agrupar por mes
$imagenesPorMes = $controlador->agruparImagenesPorMes($imagenesOrdenadas);

// 7. Agrupar por año
$imagenesPorAno = $controlador->agruparImagenesPorAno($imagenesOrdenadas);

// --- EJEMPLO DE SALIDA ---
echo "<h2>Almanaque Mensual</h2>";
foreach ($imagenesPorMes as $mes => $imgs) {
    echo "<h3>Mes: $mes</h3>";
    foreach ($imgs as $img) {
        echo '<img src="' . str_replace(__DIR__, '', $img->ruta) . '" width="120" style="margin:4px">';
    }
}

echo "<h2>Almanaque Anual</h2>";
foreach ($imagenesPorAno as $ano => $imgs) {
    echo "<h3>Año: $ano</h3>";
    foreach ($imgs as $img) {
        echo '<img src="' . str_replace(__DIR__, '', $img->ruta) . '" width="120" style="margin:4px">';
    }
}
?>
