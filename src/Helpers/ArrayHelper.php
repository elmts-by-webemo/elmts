<?php
namespace Elmts\Core\Helpers;

/**
 * Klasa pomocnicza do operacji na tablicach.
 *
 * @package Elmts\Core\Helpers
 * @version 1.0
 * - created 2024-04-25
 * - modified 2024-04-25
 */
class ArrayHelper {
    /**
     * Transformuje jednowymiarową tablicę z kluczami rozdzielonymi kropkami w zagnieżdżoną tablicę asocjacyjną.
     *
     * @param array $flatArray Jednowymiarowa tablica do transformacji.
     * @return array Zagnieżdżona tablica asocjacyjna.
     */
    public static function transformFlatToAssoc(array $flatArray): array {
        $result = [];

        foreach ($flatArray as $key => $value) {
            $keys = explode('.', $key);
            $temp = &$result;

            // Iteruj przez wszystkie segmenty klucza
            for ($i = 0; $i < count($keys); $i++) {
                $k = $keys[$i];
                
                // Jeżeli jesteśmy przy ostatnim segmencie, ustaw wartość
                if ($i === count($keys) - 1) {
                    $temp[$k] = $value;
                } else {
                    // Sprawdź, czy dalszy segment jest już tablicą, jeśli nie, zainicjuj go
                    if (!isset($temp[$k]) || !is_array($temp[$k])) {
                        $temp[$k] = [];
                    }
                    // Przesuń referencję temp do dalszego segmentu
                    $temp = &$temp[$k];
                }
            }
        }

        return $result;
    }
}