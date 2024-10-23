<?php

namespace App\Helpers;

class StringHelper
{
    // Función recursiva para contar letras
    public static function contarLetras($string, $resultado = [])
    {
        // Si la cadena está vacía, retornamos el resultado
        if (empty($string)) {
            return $resultado;
        }

        // Tomamos el primer carácter de la cadena y lo convertimos en mayúscula
        $letra = strtoupper($string[0]);

        // Solo procesamos letras (ignoramos espacios y caracteres especiales)
        if (ctype_alpha($letra)) {
            // Incrementamos el contador de esa letra
            if (isset($resultado[$letra])) {
                $resultado[$letra]++;
            } else {
                $resultado[$letra] = 1;
            }
        }

        // Llamada recursiva con el resto de la cadena
        return self::contarLetras(substr($string, 1), $resultado);
    }
}
