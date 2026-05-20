<?php
require_once __DIR__ . '/modelo/inicializador-modelo.php';
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
    require_once __DIR__ . '/vista/vista-calendario.php'; 
    require_once __DIR__ . '/../controlador/inicializador-controlador.php';
    echo "aqui estoy";
    
$listaDeMeses = [1];
$controlador = new ControlarCalendario($listaDeMeses);
$mesesIds = $controlador->ObtenerMesesDisponibles();?>
</body>
</html>