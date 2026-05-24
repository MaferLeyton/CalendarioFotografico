<?php
require 'controlador/base-de-datos.php';

$pdo= ConectarBaseDeDatos("localhost", "calendario_fotografico", "root", "");

$email = $_POST['email'];
$password_hash = $_POST['password_hash'];

$sql ="SELECT * FROM usuarios WHERE email =?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);
$usuario = $stmt->fetch();

if ($usuario) {
    if (password_verify($password_hash, $usuario['password_hash'])) {
        header("Location: vista/vista-calendario.php");
        exit;
    } else {
        echo "Contraseña incorrecta.";
    }
} else {
    echo "Usuario no encontrado.";
}