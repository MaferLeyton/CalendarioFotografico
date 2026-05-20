<?php
function ConectarBaseDeDatos(string $host, string $dbname, string $username, string $password): PDO
{
     $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
     return new PDO($dsn, $username, $password, [
         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
     ]);
}

$pdo = ConectarBaseDeDatos("localhost", "calendario_fotografico", "root", "");
?>