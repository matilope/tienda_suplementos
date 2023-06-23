<?php

class Imagen
{
    public function subirImagen($directorio, $archivo): string
    {
        if (!empty($archivo['tmp_name'])) {
            $nombreArchivo = explode(".", $archivo['name']);
            $index = count($nombreArchivo);
            $extension = $nombreArchivo[$index - 1];
            $filename = uniqid($nombreArchivo[$index - 2], true) . ".$extension";
            $fileUpload = move_uploaded_file($archivo['tmp_name'], "$directorio/$filename");
            if (!$fileUpload) {
                throw new Exception("Ha ocurrido un error al subir la imagen");
            } else {
                return $filename;
            }
        }
    }

    public function borrarImagen($directorioArchivo): bool
    {
        if (file_exists(($directorioArchivo))) {
            $fileDelete = unlink($directorioArchivo);
            if (!$fileDelete) {
                throw new Exception("Ha ocurrido un error al borrar la imagen");
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
}