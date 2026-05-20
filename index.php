<?php
 require_once __DIR__ . '/vista/inicializador-vista.php';

    echo "aqui estoy";
require_once __DIR__ . '/modelo/inicializador-modelo.php';
require_once __DIR__ . '/controlador/inicializador-controlador.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Calendario</title>
</head>
<body>
    <h3>Calendario Fotografico</h3>
    
    <?php 
   
        
    $listaDeMeses = [1];
    $controlador = new ControlarCalendario($listaDeMeses);
    $mesesIds = $controlador->ObtenerMesesDisponibles();
    ?>
</body>
</html>