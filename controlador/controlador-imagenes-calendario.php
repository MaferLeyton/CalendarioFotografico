<?php

class ControlarImagenesCalendario
{
    public array $listaDeMeses;
    public int $mesId = 0;
    public string $imagenId = '';

    public function __construct(array $listaDeMeses)
    {
        $this->listaDeMeses = $listaDeMeses;    
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

function ContarFotosDebug(string $directorioBase, int $mesSeleccionado): int
{
    if (!is_dir($directorioBase)) {
        return 0;
    }

    if ($mesSeleccionado === 0) {
        $total = 0;
        for ($mes = 1; $mes <= 12; $mes++) {
            $directorioMes = $directorioBase . DIRECTORY_SEPARATOR . ObtenerNombreMesSeleccionado($mes);
            $total += ContarImagenesEnDirectorio($directorioMes);
        }
        return $total;
    }

    $directorioMes = $directorioBase . DIRECTORY_SEPARATOR . ObtenerNombreMesSeleccionado($mesSeleccionado);
    return ContarImagenesEnDirectorio($directorioMes);
}

function ContarImagenesEnDirectorio(string $directorio): int
{
    if (!is_dir($directorio)) {
        return 0;
    }

    $extensiones = ['jpg', 'jpeg', 'png', 'jfif'];
    $contador = 0;
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directorio, FilesystemIterator::SKIP_DOTS));

    foreach ($iterator as $archivo) {
        if (!$archivo->isFile()) {
            continue;
        }

        $extension = strtolower($archivo->getExtension());
        if (in_array($extension, $extensiones, true)) {
            $contador++;
        }
    }

    return $contador;
}
}
?>