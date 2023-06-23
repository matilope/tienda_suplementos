<?php

class Utilidades
{

    /**
     * Saca acentos
     * @param string $texto
     * @return string saca los acentos de un texto y además pasa el texto a minuscula
     */
    public static function sacarAcentos($texto): string
    {
        $textoMinuscula = strtolower($texto);
        $acentos = array('á', 'é', 'í', 'ó', 'ú');
        $sinAcentos = array('a', 'e', 'i', 'o', 'u');
        return str_replace($acentos, $sinAcentos, $textoMinuscula);
    }
}
