<?php

class ContadorImagenes
{
    private static array $extensiones = ['jpg', 'jpeg', 'png', 'jfif'];

    public function contarImagenesEnCarpeta(string $directorio): int
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

    public function contarImagenesPorMes(string $directorioBase, int $mesSeleccionado): int
    {
        if (!is_dir($directorioBase)) {
            return 0;
        }

        if ($mesSeleccionado === 0) {
            $total = 0;
            for ($mes = 1; $mes <= 12; $mes++) {
                $directorioMes = $directorioBase . DIRECTORY_SEPARATOR . Calendario::obtenerNombre($mes);
                $total += $this->contarImagenesEnCarpeta($directorioMes);
            }
            return $total;
        }

        $directorioMes = $directorioBase . DIRECTORY_SEPARATOR . Calendario::obtenerNombre($mesSeleccionado);
        return $this->contarImagenesEnCarpeta($directorioMes);
    }
}
?>