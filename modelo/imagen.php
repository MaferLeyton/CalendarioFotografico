<?php
class Imagen
{

    private string $carpeta = 'anuario-de-fotos/';
    public string $nombre;
    public TipoDeImagen $tiposPermitidos;
    public DateTime $fechaDeCreacion;

    public function __construct( string $carpeta, string $nombre, TipoDeImagen $tiposPermitidos, DateTime $fechaDeCreacion)
    {
        $this->carpeta = $carpeta; 
        $this->nombre = $nombre;
        $this->tiposPermitidos = $tiposPermitidos;
        $this->fechaDeCreacion = $fechaDeCreacion;
    }

    
    public function llamarFecha() : string 

        {
            return $this->fechaDeCreacion->format('Y-m-d');
        }
}

?>
