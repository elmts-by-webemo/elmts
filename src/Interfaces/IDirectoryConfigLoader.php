<?php

namespace Elmts\Core\Interfaces;

use Elmts\Core\Exceptions\ElmtsException;

/**
 * Interfejs dla ładowacza konfiguracji z katalogu.
 *
 * @package Elmts\Core\Interfaces
 */
interface IDirectoryConfigLoader {
    /**
     * Pobiera i scala konfiguracje z plików w określonym katalogu.
     *
     * @param string $directoryPath Ścieżka do katalogu z plikami konfiguracyjnymi.
     * @return array Złączona tablica konfiguracji.
     * @throws \InvalidArgumentException Jeśli podana ścieżka nie istnieje lub nie jest katalogiem.
     * @throws \ElmtsException Jeśli wystąpią inne błędy podczas ładowania konfiguracji.
     */
    public function loadConfigurations(string $directoryPath): array;
}