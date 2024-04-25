<?php
namespace Elmts\Core\Helpers;

/**
 * Klasa pomocnicza debugera.
 *
 * @package Elmts\Core\Helpers
 * @version 1.0
 * - created 2024-04-25
 * - modified 2024-04-25
 */
class DumpHelper {
    
    /**
     * Wypisuje podane zmienne wewnątrz znaczników <pre> z jasnoszarym tłem.
     *
     * @param mixed $params Zmienne do wyświetlenia.
     */
    public static function dump($params) {
        echo '<code style="background-color: #f5f5f5; padding: 10px; border: 1px solid #ccc; border-radius: 5px;"><pre>DumpHelper:';
        var_dump($params);
        echo '</pre></code>';
    }

    /**
     * Wypisuje podane zmienne wewnątrz znaczników <pre> z jasnoszarym tłem. i następnie robi exit
     *
     * @param mixed $params Zmienne do wyświetlenia.
     */
    public static function dumpE($params) {
        echo '<code style="background-color: #f5f5f5; padding: 10px; border: 1px solid #ccc; border-radius: 5px;"><pre>DumpHelper:';
        var_dump($params);
        echo '</pre></code>';
        exit();
    }
}