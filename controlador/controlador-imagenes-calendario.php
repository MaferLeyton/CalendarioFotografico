<?php

class ControlarImagenesCalendario
{
    private array $listaDeMeses;

    public function __construct(array $listaDeMeses)
    {
        $this->listaDeMeses = $listaDeMeses;
    }

    public function obtenerImagenesOrdenadasPorFecha(): array
    {
        $imagenes = [];

        foreach ($this->listaDeMeses as $calendario) {
            if (isset($calendario->imagen)) {
                $imagenes[] = $calendario->imagen;
            }
        }

        return $this->ordenarPorFecha($imagenes);
    }

    public function obtenerImagenesPorMes(int $mesBuscado): array
    {
        $imagenesFiltradas = [];

        foreach ($this->listaDeMeses as $calendario) {
            if (!isset($calendario->imagen->fecha)) {
                continue;
            }

            $fecha = $calendario->imagen->fecha;
            $numeroMes = (int) date('n', strtotime($fecha));

            if ($numeroMes === $mesBuscado) {
                $imagenesFiltradas[] = $calendario->imagen;
            }
        }

        return $this->ordenarPorFecha($imagenesFiltradas);
    }

    public function obtenerImagenesPorId(string $imagenId): array
    {
        $imagenes = [];

        foreach ($this->listaDeMeses as $calendario) {
            if (isset($calendario->imagen->id) && $calendario->imagen->id == $imagenId) {
                $imagenes[] = $calendario->imagen;
            }
        }

        return $imagenes;
    }

    public function ordenarPorFecha(array $imagenes): array
    {
        usort($imagenes, function ($a, $b) {
            return strtotime($a->fecha) - strtotime($b->fecha);
        });

        return $imagenes;
    }
}
?>