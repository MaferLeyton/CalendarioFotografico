<?php
class Calendario
{
    private static array $nombresMeses = [
            0 => 'Todos',
            1 => 'Enero', 
            2 => 'Febrero', 
            3 => 'Marzo', 
            4 => 'Abril',
            5 => 'Mayo', 
            6 => 'Junio', 
            7 => 'Julio', 
            8 => 'Agosto',
            9 => 'Septiembre', 
            10 => 'Octubre', 
            11 => 'Noviembre', 
            12 => 'Diciembre'
        ];

    public function __construct(private int $id) 
        {
            if ($this->id < 0 || $this->id > 12) 
                {
                return "El número del mes debe estar entre 0 y 12.";
                }
        }
    public function obtenerNombre () :string
        {
            return self::$nombresMeses[$this->id];
        }
}
?>
