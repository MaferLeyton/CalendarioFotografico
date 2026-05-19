<?php 

function MostrarInputSeleccionMes(string $nombre, string $nombreParaMostrar, string $id)
    {
        $etiqueta = "<label  for=\"$id\">$nombreParaMostrar  </label>";
        $input = "<input type=\"number\" min=\"0\" max=\"12\" step=\"1\" value=\"1\" id=\"$id\" name=\"$nombre\">";
        $espacioPosterior = "<br><br>";
        echo $etiqueta.$input.$espacioPosterior;
    }

?>