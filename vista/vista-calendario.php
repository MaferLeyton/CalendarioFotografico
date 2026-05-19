<form action="index.php"  method="POST">

<?php
require_once('vista/plantillas/input.php');
require_once('vista/plantillas/boton.php');
require_once('vista/style.php')
?>
<body>
<h3 text-shadow:2px 2px 4px #000000>Buscar Libro</h3>
    <div class="contenedor">
        <div class="cuadro">
            <?php
            MostrarInputSeleccionMes("nombreMeses", "<strong>Mes o Meses</strong><br>", "id");
            MostrarBoton("Buscar", "submit");
            
            ?>
        </div>
    </div>
</body>
</form>

<?php
if (
    empty($_POST["listaIdMeses"]) &&
    empty($_POST["meses"])
) 
        {
            exit("Introduce al menos un criterio");
        }
?>