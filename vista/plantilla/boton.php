<?php 
function MostrarBoton( string $nombreParaMostrar, string $action)
    {
        $boton = "<button action=\"$action\">$nombreParaMostrar</button>";
        $espacioPosterior = "<br><br>";
        echo $boton.$espacioPosterior;
    }

?>