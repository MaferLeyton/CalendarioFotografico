<?php
class Usuario
{
    public ?int $id;
    public string $email;
    public string $password_hash;
    public string $clave_carpeta;

    public function __construct(?int $id, string $email, string $password_hash, string $clave_carpeta)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password_hash = $password_hash;
        $this->clave_carpeta = $clave_carpeta;
    }
}

class UsuarioModelo
{
    private PDO $pdo;

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

    public function Insertar(Usuario $usuario): bool
    {
        try {
            $sql = "INSERT INTO usuarios (email, password_hash, clave_carpeta) VALUES (:email, :password_hash, :clave_carpeta)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                ':email' => $usuario->email,
                ':password_hash' => $usuario->password_hash,
                ':clave_carpeta' => $usuario->clave_carpeta,
            ]);
        } catch (PDOException $e) {
            die("Error en el modelo al insertar el usuario: " . $e->getMessage());
        }
    }
}
?>