<body>

    <div class="contenedor">
        <h2>Buscar Usuario</h2>

        <form action="buscar_usuario.php" method="POST">
            <label for="email">Correo electrónico</label>

            <?php
        MostrarInputMail("mail", "<strong>Correo Electronico:</strong><br>", "mail");
        MostrarInputText("password_hash", "<strong>Contraseña:</strong><br>", "password_hash");
        MostrarInputText("clave_carpeta", "<strong>Carpeta:</strong><br>", "clave_carpeta");
        MostrarBoton("Buscar Usuario");
            ?>
    
        </form>
    </div>

</body>
</html>