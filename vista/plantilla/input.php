<?php 
function MostrarInputText(string $nombre, string $nombreParaMostrar, string $id)
    {
        $etiqueta = "<label for=\"$id\">$nombreParaMostrar  </label>";
        $input = "<input type=\"text\" id=\"$id\" name=\"$nombre\">";
        $espacioPosterior = "<br><br>";
        echo $etiqueta.$input.$espacioPosterior;
    }
?>