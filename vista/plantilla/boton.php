<?php 
function MostrarBoton(string $nombreParaMostrar, string $type = 'submit', string $name = '')
{
    $nameAttribute = $name !== '' ? " name=\"$name\"" : '';
    $boton = "<button type=\"$type\"$nameAttribute>$nombreParaMostrar</button>";
    $espacioPosterior = "<br><br>";
    echo $boton.$espacioPosterior;
}
?>