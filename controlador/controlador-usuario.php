<?php
require_once __DIR__ . '/../controlador/base-de-datos.php';
require_once __DIR__ . '/../modelo/usuario.php';

$modelo = new UsuarioModelo($pdo);
$correo_prueba = 'test@correo.com';

$resultado = $modelo->ObtenerPorEmail($correo_prueba);

echo "<pre>";
if ($resultado) {
    echo "¡Éxito! El modelo encontró al usuario en la Base de Datos:\n\n";
    print_r($resultado);
} else {
    echo "El modelo funciona, pero no se encontró ningún usuario con el correo: " . $correo_prueba;
}
echo "</pre>";
