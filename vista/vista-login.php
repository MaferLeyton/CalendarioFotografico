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
<form action="index.php" method="POST">
    <div class="contenedor">
        <h2>Buscar Usuario</h2>

        <form action="buscar_usuario.php" method="POST">
            <label for="email">Correo electrónico</label>

            <?php
            echo "aqui estoy";
        MostrarInputMail("mail", "<strong>Correo Electronico:</strong><br>", "mail");
        MostrarInputText("password_hash", "<strong>Contraseña:</strong><br>", "password_hash");
        MostrarInputText("clave_carpeta", "<strong>Carpeta:</strong><br>", "clave_carpeta");
        MostrarBoton("Buscar Usuario");
            ?>
    
        </form>
    </div>
</form>
</body>
</html>
<?php
if(isset($_POST["numeroDeIdentificacionPersonal"]))
    { 
        echo "hola";
        $usuario = new Usuario("", 
                            $_POST["mail"], 
                            $_POST["password_hash"], 
                            $_POST["clave_carpeta"]);
        $controladorDeUsuarios->InsertarUsuario($usuario);
    }
?>