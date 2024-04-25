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

            foreach ($keys as $k) {
                if (!isset($temp[$k])) {
                    $temp[$k] = [];
                }
                $temp = &$temp[$k];
            }

            $temp = $value;
        }

        return $result;
    }
}