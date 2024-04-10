<?php

namespace Elmts\Core\Interfaces;

/**
 * Interfejs definiujący strategię ładowania konfiguracji.
 *
 * Określa metody, które muszą być zaimplementowane przez klasy strategii
 * ładowania, umożliwiając obsługę różnych formatów plików konfiguracyjnych.
 */
interface IConfigLoaderStrategy {
    /**
     * Ładuje konfigurację z określonego pliku.
     *
     * @param string $filePath Ścieżka do pliku konfiguracyjnego, który ma zostać załadowany.
     * @return array Zawartość pliku konfiguracyjnego przetworzona do postaci tablicy.
     * @throws \Exception Gdy wystąpi problem z ładowaniem pliku lub jego przetwarzaniem.
     */
    public function load(string $filePath): array;

    /**
     * Zwraca listę obsługiwanych rozszerzeń plików.
     *
     * Ta metoda pozwala na określenie, które rozszerzenia plików są obsługiwane
     * przez daną strategię, co umożliwia elastyczne ładowanie różnych typów konfiguracji.
     *
     * @return array Tablica zawierająca obsługiwane rozszerzenia plików jako stringi.
     */
    public function supportedFileExtensions(): array;
}