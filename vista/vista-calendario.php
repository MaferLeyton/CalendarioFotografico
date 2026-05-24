<?php

require_once __DIR__ . '/plantilla/select.php';
require_once __DIR__ . '/plantilla/boton.php';
require_once __DIR__ . '/../controlador/controlador-de-imagenes.php';
require_once __DIR__ . '/../modelo/calendario.php';

session_start();

$ruta = __DIR__ . '/../storage/anuario-de-fotos';

if (!is_dir($ruta)) {
    exit("La carpeta de imágenes no existe.");
}

?>

<style>
    body {
        background: #f4f6f9;
        font-family: Arial, Helvetica, sans-serif;
        margin: 0;
        padding: 0;
    }

    .contenedor {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 60px;
    }

    .cuadro {
        background: white;
        width: 420px;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0px 4px 15px rgba(0,0,0,0.15);
        text-align: center;
    }

    h3 {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 25px;
        font-size: 28px;
    }

    select {
        width: 100%;
        padding: 12px;
        margin-top: 10px;
        margin-bottom: 25px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 16px;
        background: #fafafa;
        transition: 0.3s;
    }

    select:focus {
        border-color: #3498db;
        outline: none;
        box-shadow: 0px 0px 6px rgba(52,152,219,0.5);
    }

    button,
    input[type="submit"] {
        width: 100%;
        padding: 12px;
        margin-top: 12px;
        border: none;
        border-radius: 8px;
        background: #3498db;
        color: white;
        font-size: 15px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }

    button:hover,
    input[type="submit"]:hover {
        background: #2980b9;
        transform: scale(1.02);
    }

    .debug-info {
        width: 420px;
        margin: 25px auto;
        padding: 15px;
        background: #ecf9f1;
        border-left: 5px solid #2ecc71;
        border-radius: 8px;
        color: #2c3e50;
        box-shadow: 0px 2px 8px rgba(0,0,0,0.08);
        text-align: center;
    }

    strong {
        color: #34495e;
        font-size: 17px;
    }

    img {
        margin-top: 15px;
        border-radius: 10px;
        box-shadow: 0px 2px 10px rgba(0,0,0,0.2);
    }
</style>

<form action="" method="POST">

    <h3 style="text-shadow:2px 2px 4px #000000">
        Buscar Carpeta
    </h3>

    <div class="contenedor">

        <div class="cuadro">

            <?php

            MostrarInputSeleccionMes(
                "nombreMeses",
                "<strong>Mes o Meses</strong><br>",
                "id"
            );

            MostrarBoton("Buscar imagen aleatoria", "submit", "buscar_mes");

            MostrarBoton(
                "Mostrar cantidad de fotos",
                "submit",
                "mostrar_cantidad_fotos"
            );

            MostrarBoton(
                "Organizar fotos por mes",
                "submit",
                "organizar_fotos"
            );

            ?>

        </div>

    </div>

</form>

<?php
// organizar fotos por mes -- no funciona
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['organizar_fotos'])) {

        $directorioFotos = realpath($ruta);

        $moved = $directorioFotos
            ? ControladorDeImagen::organizarFotosPorMes($directorioFotos)
            : 0;

        echo "
        <div class='debug-info'>
            Se organizaron
            <strong>$moved</strong>
            archivo(s).
        </div>";
    }
// contar cantidad de fotos del mes seleccionado
    elseif (isset($_POST['mostrar_cantidad_fotos'])) {

        $directorioFotos = realpath($ruta);

        $mesSeleccionado = (int) ($_POST['nombreMeses'] ?? 0);

        $cantidadFotos = $directorioFotos
            ? ControladorDeImagen::contarImagenesPorMes(
                $directorioFotos,
                $mesSeleccionado
            )
            : 0;

        $nombreMes = Calendario::obtenerNombre($mesSeleccionado);

        if ($cantidadFotos > 0) {

            echo "
            <div class='debug-info'>
                Mes seleccionado:
                <strong>$nombreMes</strong>
                <br><br>
                Total de fotos:
                <strong>$cantidadFotos</strong>
            </div>";

        } else {

            echo "
            <div class='debug-info'>
                Mes seleccionado:
                <strong>$nombreMes</strong>
                <br><br>
                No hay fotos disponibles.
            </div>";
        }
    }
// mostrar imagen aleatoria del mes seleccionado
elseif (isset($_POST['buscar_mes'])) {

    $extensiones = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    $imagenes = [];

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($ruta)
    );

    foreach ($iterator as $archivo) {

        if ($archivo->isDir()) {
            continue;
        }

        $extension = strtolower(
            pathinfo($archivo->getFilename(), PATHINFO_EXTENSION)
        );

        if (in_array($extension, $extensiones)) {
            $imagenes[] = $archivo->getPathname();
        }
    }

    if (!empty($imagenes)) {

        // Imagen aleatoria
        $imgAleatoria = $imagenes[array_rand($imagenes)];

        // Obtener ruta pública desde htdocs
        $imgPublica = str_replace(
            '/Applications/XAMPP/xamppfiles/htdocs',
            '',
            $imgAleatoria
        );

        echo "
        <div class='debug-info'>

            <strong>Imagen aleatoria:</strong>

            <br><br>

            <img
                src='$imgPublica'
                style='max-width:300px;
                       border-radius:10px;'
            >

            <br><br>

            $imgPublica

        </div>";

    } else {

        echo "
        <div class='debug-info'>
            No se encontraron imágenes.
        </div>";
    }
}
}
?>
