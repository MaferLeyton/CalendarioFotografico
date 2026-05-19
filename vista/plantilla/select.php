<?php 

if (count($listaDeMeses) == 0)

        {
            return;
        }

echo "$nombreDeMeses: ";

echo "<select name=\"$nombreDeMeses\" onchange=\"document.formulario.submit()\">";

for ($i = 0; $i <count($listaDeIdsDeMeses); $i++)
        {
        if (isset($_GET[$nombreDeMeses])
        && $listaDeIdsDeMeses[$i] == $_GET[$nombreDeMeses])
                {
                        echo "<option selected value=\"$nombreDeMeses[$i]\">$listaIdsDeMenu[$i]</option>";
                }
        else
                {
                        echo "<option value=\"$listaDeIdsDeMeses[$i]\">$listaDeIdsDeMeses[$i]</option>";
                }
        }
echo "</select>";

?>