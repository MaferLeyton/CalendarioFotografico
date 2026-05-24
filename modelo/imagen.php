<?php
class Imagen
{

    private string $carpeta;
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
//retomar la imagen desde el archivo con la fecha de creación
    public static function desdeArchivo(string $ruta, TipoDeImagen $tipo): self
    {
        $carpeta = dirname($ruta);
        $nombre = basename($ruta);

        $fecha = new DateTime();
        $fecha->setTimestamp(filemtime($ruta));

        return new self($carpeta, $nombre, $tipo, $fecha);
    }

    public function llamarFecha() : string 

        {
            return $this->fechaDeCreacion->format('Y-m-d');
        }
}

?>