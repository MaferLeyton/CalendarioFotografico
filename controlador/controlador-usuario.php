<?php

class ControladorUsuario
{
    private UsuarioModelo $modelo;

    public function __construct(UsuarioModelo $modelo)
    {
        $this->modelo = $modelo;
    }

    public function InsertarUsuario(Usuario $usuario): bool
    {
        return $this->modelo->Insertar($usuario);
    }

    public function ObtenerPorEmail(string $email)
    {
        return $this->modelo->ObtenerPorEmail($email);
    }
}
?>