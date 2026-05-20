<?php 
function MostrarInputText(string $nombre, string $nombreParaMostrar, string $id)
    {
        $etiqueta = "<label for=\"$id\">$nombreParaMostrar  </label>";
        $input = "<input type=\"text\" id=\"$id\" name=\"$nombre\">";
        $espacioPosterior = "<br><br>";
        echo $etiqueta.$input.$espacioPosterior;
    }
function MostrarInputMail (string $nombre, string $nombreParaMostrar, string $id)
     {
        $etiqueta = "<label mail for=\"$id\">$nombreParaMostrar  </label>";
        $input = "<input type=\"email\" id=\"$id\" name=\"$nombre\">";
        $espacioPosterior = "<br><br>";
        echo $etiqueta.$input.$espacioPosterior;
     }
function MostrarInputDate (string $nombre, string $nombreParaMostrar, string $id)
     {
        $etiqueta = "<label date for=\"$id\">$nombreParaMostrar  </label>";
        $input = "<input type=\"date\" id=\"$id\" name=\"$nombre\">";
        $espacioPosterior = "<br><br>";
        echo $etiqueta.$input.$espacioPosterior;}
?>