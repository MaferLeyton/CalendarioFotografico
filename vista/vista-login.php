<?php
require_once __DIR__ . '/plantilla/input.php';
require_once __DIR__ . '/plantilla/select.php';
require_once __DIR__ . '/plantilla/boton.php';
require_once __DIR__ . '/../controlador/base-de-datos.php';
require_once __DIR__ . '/../modelo/usuario.php';
require_once __DIR__ . '/../controlador/controlador-usuario.php';

$modeloUsuario = new UsuarioModelo($pdo);
$controladorDeUsuarios = new ControladorUsuario($modeloUsuario);

$mensajeRegistro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['password_hash'], $_POST['clave_carpeta'])) {
    $usuario = new Usuario(null,
        trim($_POST['email']),
        trim($_POST['password_hash']),
        trim($_POST['clave_carpeta'])
    );

    if ($controladorDeUsuarios->InsertarUsuario($usuario)) {
        $mensajeRegistro = 'Usuario registrado correctamente.';
    } else {
        $mensajeRegistro = 'No se pudo registrar el usuario.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar Usuario</title>

<style>
        body{
            background-color: #FFB6C1;
            text-align: center;
            font-family: Arial, sans-serif;
        }

        .contenedor{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
        }

        .cuadro{
            border: 1px solid #333;
            padding: 20px;
            width: 350px;
            background-color: #f5f5f5;
            border-radius: 10px;
        }

        input{
            width: 80%;
            padding: 8px;
            margin-top: 5px;
        }

        button{
            background-color: violet;
            font-style: italic;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        </style>
</head>
<body>
<form action="index.php?ruta=login" method="POST">
    <div class="contenedor">
        <h2>Buscar Usuario</h2>

            <label for="email">Correo electrónico</label>

            <?php
            echo "aqui estoy";
        MostrarInputMail("email", "<strong>Correo Electronico:</strong><br>", "email");
        MostrarInputText("password_hash", "<strong>Contraseña:</strong><br>", "password_hash");
        MostrarInputText("clave_carpeta", "<strong>Carpeta:</strong><br>", "clave_carpeta");
        MostrarBoton("Registrar Usuario", "submit", "registrar_usuario");
            ?>
    
    </div>
</form>

<?php if ($mensajeRegistro !== ''): ?>
    <p><?php echo htmlspecialchars($mensajeRegistro, ENT_QUOTES, 'UTF-8'); ?></p>
<?php endif; ?>
</body>
</html>
