<?php
class Imagen
{

    private string $carpeta = 'fotos/';
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

    public function llamarImagenes () : array
        {
            return glob(
                $this->carpeta . '*.{jpg, jpeg, png}',
                GLOB_BRACE
            );
        }
    
    public function llamarFecha() : string 

        {
            return $this->fechaDeCreacion->format('Y-m-d');
        }
}

?>
