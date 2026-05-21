<?php

class ControladorDeImagen
{
    private static array $extensiones = ['jpg', 'jpeg', 'png', 'jfif'];
        
    //llamar imagenes de carpeta
    public function llamarImagenesDeCarpeta(string $directorio): array
    {
        $imagenes = [];
        if (!is_dir($directorio)) {
            return $imagenes;
        }
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($directorio, FilesystemIterator::SKIP_DOTS)
        );
        foreach ($iterator as $archivo) {
            if (!$archivo->isFile()) {
                continue;
            }
            $extension = strtolower($archivo->getExtension());
            if (in_array($extension, self::$extensiones, true)) {
                $imagenes[] = $archivo->getPathname();
            }
        }
        return $imagenes;
    }
    
    //ordenar imágenes por fechaDeCreacion
    private function ordenarPorfechaDeCreacion(array $imagenes): array
    {
            usort($imagenes, function ($a, $b) {
            return ($a->fechaDeCreacion ?? '') <=> ($b->fechaDeCreacion ?? '');
        });    
            return $imagenes;
    }
    //agrupar imágenes por día
    public function agruparImagenesPorDia(array $imagenes): array
    {
        $agrupadas = [];
        foreach ($imagenes as $imagen) {
            if (!isset($imagen->fechaDeCreacion)) {
                continue;
            }
            $fechaDeCreacion = $imagen->fechaDeCreacion->format('Y-m-d');
            if (!isset($agrupadas[$fechaDeCreacion])) {
                $agrupadas[$fechaDeCreacion] = [];
            }
            $agrupadas[$fechaDeCreacion][] = $imagen;
        }
        return $agrupadas;
    }
    //seleccionar imagen por día-- reconfigurar a seleccionar una unica imagen por dia y si no imprime "no existe foto de dia"
    public function seleccionarImagenPorDia(array $imagenes): array
    {
        $seleccionadas = [];
        foreach ($imagenes as $imagen) {               
            if (!isset($imagen->fechaDeCreacion)) {
                continue;
            }
            $fechaDeCreacion = $imagen->fechaDeCreacion->format('Y-m-d');
            
            if (!isset($seleccionadas[$fechaDeCreacion]) || ($imagen->fechaDeCreacion) < ($seleccionadas[$fechaDeCreacion]->fechaDeCreacion)) {
                $seleccionadas[$fechaDeCreacion] = $imagen;
            }
            return array_values($seleccionadas);
            }
    }
//agrupar imágenes por mes

    public function agruparImagenesPorMes(array $imagenes): array
    {
        $agrupadas = [];
        foreach ($imagenes as $imagen) {
            if (!isset($imagen->fechaDeCreacion)) {
                continue;
            }
            $fechaDeCreacion = $imagen->fechaDeCreacion->format('Y-m-d');
            if (!isset($agrupadas[$fechaDeCreacion])) {
                $agrupadas[$fechaDeCreacion] = [];
            }
            $agrupadas[$fechaDeCreacion][] = $imagen;
        }
        return $agrupadas;
    }
    //obtener imágenes ordenadas por fechaDeCreacion y filtradas por mes  

    public function obtenerImagenesPorMes(int $mesBuscado): array
    {
        $imagenesFiltradas = [];
        foreach ($this->listaDeMeses as $calendario) {
            if (!isset($calendario->imagen->fechaDeCreacion)) {
                continue;
            }
            $fechaDeCreacion = $calendario->imagen->fechaDeCreacion;
            $numeroMes = (int) date('n', ($fechaDeCreacion));
            if ($numeroMes === $mesBuscado) {
                $imagenesFiltradas[] = $calendario->imagen;
            }
        }
        return $this->ordenarPorfechaDeCreacion($imagenesFiltradas);
    }
//conteo de imágenes en carpeta
    public static function contarImagenesEnCarpeta(string $directorio): int
    {
        if (!is_dir($directorio)) {
            return 0;
        }
        $contador = 0;
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($directorio, FilesystemIterator::SKIP_DOTS)
        );
        foreach ($iterator as $archivo) {
            if (!$archivo->isFile()) {
                continue;
            }
            $extension = strtolower($archivo->getExtension());
            if (in_array($extension, self::$extensiones, true)) {
                $contador++;
            }
        }
        return $contador;
    }

    public static function contarImagenesPorMes(string $directorioBase, int $mesSeleccionado): int
    {
        if (!is_dir($directorioBase)) {
            return 0;
        }
        if ($mesSeleccionado === 0) {
            $total = 0;
            for ($mes = 1; $mes <= 12; $mes++) {
                $directorioMes = $directorioBase . DIRECTORY_SEPARATOR . Calendario::obtenerNombre($mes);
                $total += self::contarImagenesEnCarpeta($directorioMes);
            }
            return $total;
        }
        $directorioMes = $directorioBase . DIRECTORY_SEPARATOR . Calendario::obtenerNombre($mesSeleccionado);
        return self::contarImagenesEnCarpeta($directorioMes);
    }
}
?>
