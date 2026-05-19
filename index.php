<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Calendario</title>
</head>
<body>
        <p>
            <h3>  
                <?php   
                echo "Calendario Fotografico";

                ?>
            </h3>
       
        </p>
</body>
<?php


require_once __DIR__ . 'modelo/inicializador-modelo.php';

require_once __DIR__ . 'controlador/controlar-calendario.php';

require_once __DIR__ . 'vista/vista-calendario.php';

$listaDeMeses = [1];
$controlador = new ControlarCalendario($listaDeMeses);

$mesesIds = $controlador->ObtenerMesesDisponibles();
?>
