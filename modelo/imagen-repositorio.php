<?php
public function llamarImagenes () : array
        {
            return glob(
                $this->carpeta . '*.{jpg, jpeg, png}',
                GLOB_BRACE
            );
        }
?>