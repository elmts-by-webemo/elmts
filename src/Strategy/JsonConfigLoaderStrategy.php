<?php

namespace Elmts\Core\Strategy;

use Elmts\Core\Interfaces\IConfigLoaderStrategy;
use Elmts\Core\Exceptions\ElmtsException;

/**
 * Strategia ładowania konfiguracji z plików JSON.
 *
 * Odpowiada za wczytanie i przekształcenie zawartości plików konfiguracyjnych JSON
 * do tablicy PHP.
 *
 * @package Elmts\Core\Strategy
 */
class JsonConfigLoaderStrategy implements IConfigLoaderStrategy {
    /**
     * Ładuje konfigurację z określonego pliku JSON.
     *
     * Próbuje odczytać plik JSON i przekształcić jego zawartość na tablicę PHP.
     * Jeśli plik nie istnieje lub nie można go odczytać, zwraca pustą tablicę.
     * W przypadku błędów związanych z dekodowaniem JSON, rzuca wyjątek ElmtsException.
     *
     * @param string $filePath Ścieżka do pliku konfiguracyjnego JSON.
     * @return array Zawartość pliku konfiguracyjnego jako tablica.
     * @throws ElmtsException Gdy wystąpi błąd dekodowania JSON.
     */
    public function load(string $filePath): array {
        if (!is_file($filePath)) {
            return [];
        }

        $content = file_get_contents($filePath);
        $config = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new ElmtsException("Error decoding JSON from file {$filePath}: " . json_last_error_msg());
        }

        return $config ?: [];
    }

    /**
     * Zwraca listę obsługiwanych rozszerzeń plików.
     *
     * Dla tej strategii obsługiwane jest wyłącznie rozszerzenie 'json'.
     *
     * @return array Lista zawierająca pojedynczy element: 'json'.
     */
    public function supportedFileExtensions(): array {
        return ['json'];
    }
}
