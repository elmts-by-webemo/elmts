<?php

namespace Elmts\Core\Strategy;

use Elmts\Core\Interfaces\IConfigLoaderStrategy;
use Elmts\Core\Exceptions\ElmtsException;

/**
 * Strategia ładowania konfiguracji z plików PHP.
 *
 * Odpowiada za wczytanie i przekształcenie zawartości plików konfiguracyjnych PHP
 * do tablicy PHP. Pliki konfiguracyjne PHP muszą zwracać tablicę.
 *
 * @package Elmts\Core\Strategy
 */
class PhpConfigLoaderStrategy implements IConfigLoaderStrategy {
    /**
     * Ładuje konfigurację z określonego pliku PHP.
     *
     * Próbuje odczytać plik PHP i przekształcić jego zawartość na tablicę PHP.
     * Jeśli plik nie istnieje, zwraca pustą tablicę. W przypadku błędów 
     * związanych z includowaniem pliku, rzuca wyjątek ElmtsException.
     *
     * @param string $filePath Ścieżka do pliku konfiguracyjnego PHP.
     * @return array Zawartość pliku konfiguracyjnego jako tablica.
     * @throws ElmtsException Gdy plik nie istnieje lub nie można go odczytać.
     */
    public function load(string $filePath): array {
        if (!is_file($filePath)) {
            throw new ElmtsException("The configuration file does not exist: {$filePath}");
        }

        // Próbujemy includować plik i przechwytujemy błędy.
        try {
            $config = include $filePath;
        } catch (\Throwable $e) {
            throw new ElmtsException("Error loading configuration file {$filePath}: " . $e->getMessage(), 0, $e);
        }

        if (!is_array($config)) {
            throw new ElmtsException("The configuration file {$filePath} does not return an array.");
        }

        return $config;
    }

    /**
     * Zwraca listę obsługiwanych rozszerzeń plików.
     *
     * Dla tej strategii obsługiwane jest wyłącznie rozszerzenie 'php'.
     *
     * @return array Lista zawierająca pojedynczy element: 'php'.
     */
    public function supportedFileExtensions(): array {
        return ['php'];
    }
}
