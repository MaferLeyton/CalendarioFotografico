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
//meses disponibles con fotos

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

    public function ObtenerMesesDisponiblesConFotosConNombreMes(): array
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

public function generarAlmanaqueMensual(array $imagenes): array
    {
        $almanaque = [];
        foreach ($imagenes as $imagen) {
            if (!isset($imagen->fechaDeCreacion)) {
                continue;
            }
            $fecha = date('Y-m-d', strtotime($imagen->fechaDeCreacion));
            $almanaque[$fecha] = $imagen;
        }
        ksort($almanaque);
        return $almanaque;
    }
     
    public function generarAlmanaqueAnual(array $imagenes): array
    {
        $almanaque = [];
        foreach ($imagenes as $imagen) {
            if (!isset($imagen->fechaDeCreacion)) {
                continue;
            }
            $fecha = date('Y-m-d', strtotime($imagen->fechaDeCreacion));
            $almanaque[$fecha] = $imagen;
        }
        ksort($almanaque);
        return $almanaque;
    }
    public function obtenerRutaCompleta(): string
{
    return $this->carpeta .
           DIRECTORY_SEPARATOR .
           $this->nombre;
}
}
?>
