<?php

class ControladorDeImagen
{
    private static array $extensiones = ['jpg', 'jpeg', 'png', 'jfif'];

    // Llama imágenes de una carpeta
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

    // Ordenar imágenes por fecha de creación (asume array de objetos con propiedad fechaDeCreacion tipo DateTime)
    public function ordenarPorFechaDeCreacion(array $imagenes): array
    {
        usort($imagenes, function ($a, $b) {
            $fechaA = $a->fechaDeCreacion instanceof DateTime ? $a->fechaDeCreacion->getTimestamp() : strtotime($a->fechaDeCreacion ?? '');
            $fechaB = $b->fechaDeCreacion instanceof DateTime ? $b->fechaDeCreacion->getTimestamp() : strtotime($b->fechaDeCreacion ?? '');
            return $fechaA <=> $fechaB;
        });
        return $imagenes;
    }

    // Agrupar imágenes por día
    public function agruparImagenesPorDia(array $imagenes): array
    {
        $agrupadas = [];
        foreach ($imagenes as $imagen) {
            if (!isset($imagen->fechaDeCreacion)) {
                continue;
            }
            $fecha = $imagen->fechaDeCreacion instanceof DateTime
                ? $imagen->fechaDeCreacion->format('Y-m-d')
                : date('Y-m-d', strtotime($imagen->fechaDeCreacion));
            $agrupadas[$fecha][] = $imagen;
        }
        return $agrupadas;
    }

    // Seleccionar una imagen por día (la más antigua)
    public function seleccionarImagenPorDia(array $imagenes): array
    {
        $seleccionadas = [];
        foreach ($imagenes as $imagen) {
            if (!isset($imagen->fechaDeCreacion)) {
                continue;
            }
            $fecha = $imagen->fechaDeCreacion instanceof DateTime
                ? $imagen->fechaDeCreacion->format('Y-m-d')
                : date('Y-m-d', strtotime($imagen->fechaDeCreacion));
            if (!isset($seleccionadas[$fecha]) || $imagen->fechaDeCreacion < $seleccionadas[$fecha]->fechaDeCreacion) {
                $seleccionadas[$fecha] = $imagen;
            }
        }
        return array_values($seleccionadas);
    }

    // Agrupar imágenes por mes
    public function agruparImagenesPorMes(array $imagenes): array
    {
        $agrupadas = [];
        foreach ($imagenes as $imagen) {
            if (!isset($imagen->fechaDeCreacion)) {
                continue;
            }
            $mes = $imagen->fechaDeCreacion instanceof DateTime
                ? $imagen->fechaDeCreacion->format('Y-m')
                : date('Y-m', strtotime($imagen->fechaDeCreacion));
            $agrupadas[$mes][] = $imagen;
        }
        return $agrupadas;
    }

    // Agrupar imágenes por año
    public function agruparImagenesPorAno(array $imagenes): array
    {
        $agrupadas = [];
        foreach ($imagenes as $imagen) {
            if (!isset($imagen->fechaDeCreacion)) {
                continue;
            }
            $ano = $imagen->fechaDeCreacion instanceof DateTime
                ? $imagen->fechaDeCreacion->format('Y')
                : date('Y', strtotime($imagen->fechaDeCreacion));
            $agrupadas[$ano][] = $imagen;
        }
        return $agrupadas;
    }

    // Contar imágenes en carpeta
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

    // Contar imágenes por mes
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

    // Organizar imágenes por mes: mueve imágenes a subcarpetas según su mes de creación
    public static function organizarFotosPorMes(string $directorioBase): int
    {
        if (!is_dir($directorioBase)) {
            return 0;
        }
        $moved = 0;
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($directorioBase, FilesystemIterator::SKIP_DOTS)
        );
        foreach ($iterator as $archivo) {
            if (!$archivo->isFile()) {
                continue;
            }
            $extension = strtolower($archivo->getExtension());
            if (!in_array($extension, self::$extensiones, true)) {
                continue;
            }
            $fecha = new DateTime('@' . $archivo->getMTime());
            $mes = $fecha->format('m');
            $ano = $fecha->format('Y');
            $nombreMes = $fecha->format('F'); // Ej: January, February...
            $destinoDir = $directorioBase . DIRECTORY_SEPARATOR . $ano . '-' . $nombreMes;
            if (!is_dir($destinoDir)) {
                mkdir($destinoDir, 0777, true);
            }
            $destino = $destinoDir . DIRECTORY_SEPARATOR . $archivo->getFilename();
            if (rename($archivo->getPathname(), $destino)) {
                $moved++;
            }
        }
        return $moved;
    }
}
