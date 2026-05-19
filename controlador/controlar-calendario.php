<?php

class ControlarCalendario

{

        public array $listaDeMeses;
        public int $mesId;
        public string $imagenId;

    public function __construct(array $listaDeMeses)
        {
            $this->listaDeMeses = $listaDeMeses;
        }
        
    public function ObtenerMesesDisponibles() 
        {
            $listaDeIdsDeMeses = [];
                 foreach ($this->listaDeMeses as $calendario)
                {
                    if (in_array($calendario->mes->id, $listaDeIdsDeMeses))
                        {
                            continue;
                        }
                        $listaDeIdsDeMeses[] = $calendario->mes->id;
                }
            return $listaDeIdsDeMeses;
        }
    public function ObtenerMesesDisponiblesConNombre(): array
        {
            $meses = [];

            foreach ($this->listaDeMeses as $calendario)
            {
                $id = $calendario->mes->id;

                if (!isset($meses[$id]))
                {
                    $mes = new Calendario($id);
                    $meses[$id] = $mes->obtenerNombre();
                }
            }

            return $meses;
        }
    public function ObtenerImagenesDisponibles() 
        {
            if (!isset($_GET["imagen"]) )
                {
                        return [];
                }
                $this->imagenId = (string) $_GET["imagen"];
                 $imagenes = [];

                foreach ($this->listaDeMeses as $calendario)
                {
                    if ($calendario->imagen->id == $this->imagenId)
                            {
                                $imagenes[] = $calendario->imagen;
                            }
                }
                return $imagenes;
            }
        public function ObtenerImagenesPorMes(int $mesBuscado): array
                {
                    $imagenesFiltradas = [];
                    foreach ($this->listaDeMeses as $calendario)
                            {
                                $fecha = $calendario->imagen->fecha;
                                $numeroMes = (int) date("n", strtotime($fecha));
                        
                                if ($numeroMes === $mesBuscado)
                                {
                                    $imagenesFiltradas[] = $calendario->imagen;
                                }
                            }
                    usort($imagenesFiltradas, function($a, $b)
                            {
                                return strtotime($a->fecha) - strtotime($b->fecha);
                            });
                    return $imagenesFiltradas;
                }
        public function ObtenerImagenesOrdenadasPorFecha()
            {
                $imagenes = [];
            
                foreach ($this->listaDeMeses as $calendario)
                        {
                            $imagenes[] = $calendario->imagen;
                        }
                usort($imagenes, function($a, $b)
                        {
                            return strtotime($a->fecha) - strtotime($b->fecha);
                        });
                return $imagenes;
            }
}
?>
