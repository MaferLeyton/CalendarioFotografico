<?php
$ruta = $_GET['ruta'] ?? 'login';

switch ($ruta) {
    case 'login':
        require_once __DIR__ . '/vista-login.php';
        break;

    case 'calendario':
        require_once __DIR__ . '/vista-calendario.php';
        break;

    default:
        http_response_code(404);
        echo '<h1>404 - Ruta no encontrada</h1>';
        echo '<p>La ruta solicitada no existe. Usa <a href="index.php?ruta=login">login</a> o <a href="index.php?ruta=calendario">calendario</a>.</p>';
        break;
}
?>