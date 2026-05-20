<?php
class UsuarioModelo
{
    public PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function ObtenerPorEmail(string $email)
    {
        try {
            $sql = "SELECT id, email, password_hash, clave_carpeta FROM usuarios WHERE email = :email LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':email' => $email]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error en el modelo al buscar el usuario: " . $e->getMessage());
        }
    }
}
?>