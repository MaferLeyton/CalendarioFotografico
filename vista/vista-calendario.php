<?php
require_once __DIR__ . '/plantilla/select.php';
require_once __DIR__ . '/plantilla/boton.php';
require_once __DIR__ . '/style.php';

?>
<form action="index.php" method="POST">
    <h3 style="text-shadow:2px 2px 4px #000000">Buscar Carpeta</h3>
    <div class="contenedor">
        <div class="cuadro">
            <?php
            MostrarInputSeleccionMes("nombreMeses", "<strong>Mes o Meses</strong><br>", "id");
            MostrarBoton("Buscar", "submit", "buscar_mes");
            MostrarBoton("Mostrar cantidad de fotos", "submit", "mostrar_cantidad_fotos");
            MostrarBoton("Organizar fotos por mes", "submit", "organizar_fotos");
            ?>
        </div>
    </div>
</form>

<?php

require_once __DIR__ . '/../controlador/inicializador-controlador.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['organizar_fotos'])) {
        $directorioFotos = realpath(__DIR__ . '/../anuario-de-fotos');
        $moved = $directorioFotos ? OrganizarFotosPorMes($directorioFotos) : 0;
        echo "<div class=\"debug-info\">Se organizaron <strong>$moved</strong> archivo(s) en las carpetas de mes dentro de <strong>anuario-de-fotos</strong>.</div>";
    } elseif (isset($_POST['mostrar_cantidad_fotos'])) {
        $directorioFotos = realpath(__DIR__ . '/../anuario-de-fotos');
        $mesSeleccionado = (int) ($_POST['nombreMeses'] ?? 0);
        $cantidadFotos = $directorioFotos ? ContarFotosDebug($directorioFotos, $mesSeleccionado) : 0;
        $nombreMes = ObtenerNombreMesSeleccionado($mesSeleccionado);

        if ($cantidadFotos > 0) {
            echo "<div class=\"debug-info\">Mes seleccionado: <strong>$nombreMes</strong>.<br>Total de fotos en ese mes: <strong>$cantidadFotos</strong>.</div>";
        } else {
            echo "<div class=\"debug-info\">Mes seleccionado: <strong>$nombreMes</strong>.<br>No hay fotos en la carpeta <strong>anuario-de-fotos</strong> para ese mes.</div>";
        }
    } else {
        $valorMes = $_POST['nombreMeses'] ?? '';
        if ($valorMes === '') {
            exit("Introduce al menos un criterio");
        }
    }
}
?>