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
        $letra = mb_strtoupper(mb_substr($string, 0, 1));

        // Solo procesamos letras, incluyendo letras con tildes y la ñ
        if (preg_match('/^[A-ZÁÉÍÓÚÑ]$/u', $letra)) {
            // Incrementamos el contador de esa letra
            if (isset($resultado[$letra])) {
                $resultado[$letra]++;
            } else {
                $resultado[$letra] = 1;
            }
        }

        // Llamada recursiva con el resto de la cadena
        return self::contarLetras(mb_substr($string, 1), $resultado);
    }
}
