<?php

class ControlarCalendario
{
    public array $listaDeMeses;
    public int $mesId = 0;
    public string $imagenId = '';

    public function __construct(array $listaDeMeses)
        {
            $this->listaDeMeses = $listaDeMeses;
        }

    public function ObtenerMesesDisponiblesConFotos()
    {
        $listaDeIdsDeMeses = [];
        foreach ($this->listaDeMeses as $mesItem) {
            $mesId = is_object($mesItem) && property_exists($mesItem, 'id')
                ? (int) $mesItem->id
                : (int) $mesItem;

            if (in_array($mesId, $listaDeIdsDeMeses, true)) {
                continue;
            }
            $listaDeIdsDeMeses[] = $mesId;
        }
        return $listaDeIdsDeMeses;
    }
    public function ObtenerMesesDisponiblesConFotosConNombre(): array
        {
            $meses = [];

            foreach ($this->listaDeMeses as $mesId)
            {
                $id = $mesId;

                if (!isset($meses[$id]))
                {
                    $meses[$id] = Calendario::obtenerNombre($id);
                }
            }
            return $meses;
        }



    public function __construct(array $listaDeMeses = [])
    {
        $this->listaDeMeses = $listaDeMeses;
    }

public function generarAlmanaqueMensual(array $imagenes): array
    {
        $almanaque = [];
        foreach ($imagenes as $imagen) {
            if (!isset($imagen->fecha)) {
                continue;
            }
            $fecha = date('Y-m-d', strtotime($imagen->fecha));
            $almanaque[$fecha] = $imagen;
        }
        ksort($almanaque);
        return $almanaque;
    }
     
    public function generarAlmanaqueAnual(array $imagenes): array
    {
        $almanaque = [];
        foreach ($imagenes as $imagen) {
            if (!isset($imagen->fecha)) {
                continue;
            }
            $fecha = date('Y-m-d', strtotime($imagen->fecha));
            $almanaque[$fecha] = $imagen;
        }
        ksort($almanaque);
        return $almanaque;
    }
}
?>
