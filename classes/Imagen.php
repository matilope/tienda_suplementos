<?php

class Imagen
{

  /**
   * Devuelve el nombre del archivo junto a su extensión o tira una excepción
   * @return string
   */
  public function subirImagen($directorio, $archivo): string
  {
    if (!empty($archivo['tmp_name'])) {
      $nombreArchivo = explode(".", $archivo['name']);
      $extension = array_pop($nombreArchivo);
      $extension = $extension === "jpg" ? "jpeg" : $extension;
      $filename = uniqid(array_pop($nombreArchivo), true) . ".$extension";
      if (!function_exists("imagecreatefrom$extension")) {
        throw new Exception("La extensión es inválida, sólo se aceptan jpeg, jpg, png, gif, webp, avif, bmp, xbm");
      }
      $img_og = "imagecreatefrom$extension"($archivo['tmp_name']);
      $ancho_og = imagesx($img_og);
      $alto_og = imagesy($img_og);
      $alto_auto = floor($alto_og * (376 / $ancho_og));
      $gdImage = imagecreatetruecolor(376, $alto_auto);
      $transparent = imagecolorallocatealpha($gdImage, 0, 0, 0, 127);
      imagefill($gdImage, 0, 0, $transparent);
      imagesavealpha($gdImage, true);
      imagecopyresized($gdImage, $img_og, 0, 0, 0, 0, 376, $alto_auto, $ancho_og, $alto_og);
      $fileUpload = "image$extension"($gdImage, "$directorio/$filename");
      if (!$fileUpload) {
        throw new Exception("Ha ocurrido un error al subir la imagen");
      } else {
        return $filename;
      }
    }
  }

  /**
   * Si se elimina la imagen devuelve true, en caso de que no tira una excepción, pero si no existe el archivo devuelve false
   * @return bool
   */
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
