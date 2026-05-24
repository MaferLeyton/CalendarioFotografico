

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Calendario</title>
</head>
<body>
    <h3>Calendario Fotografico</h3>
    
    <?php 
     require_once __DIR__ . '/vista/vista-login.php';
    echo "aqui estoy";
   
    ?>
</body>
</html>
<?php
   require_once __DIR__ . '/modelo/inicializador-modelo.php';
   require_once __DIR__ . '/controlador/inicializador-controlador.php';
   require_once __DIR__ . '/vista/inicializador-vista.php'; 
   
   $listaDeMeses = [1];
    $controlador = new ControlarCalendario($listaDeMeses);
    echo "aqui estare";
    
    $controladordePdf = new ControlarPDF();
    $controladordePdf->generarPDF();
?>