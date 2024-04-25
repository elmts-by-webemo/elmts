<?php
namespace Elmts\Core\Strategy;

use Elmts\Core\Interfaces\ITranslationLoaderStrategy;

/**
 * Obsługuje ładowanie danych tłumaczeń z plików PHP.
 * Zakłada, że plik zwraca tablicę tłumaczeń.
 *
 * @package Elmts\Core\Strategy
 * @version 1.0
 * -creation_date 2024-04-25
 * - modification_date 2024-04-25
 * - gpt_name simplyPHPDoc-Gen
 */
class PhpTranslationLoaderStrategy implements ITranslationLoaderStrategy
{
    /**
     * Ładuje dane tłumaczenia z pliku PHP.
     * Zakłada, że plik zwraca tablicę tłumaczeń.
     *
     * @param string $filePath Ścieżka do pliku PHP zawierającego dane tłumaczenia.
     * @return array Tablica tłumaczeń.
     * @throws \Exception Jeśli plik nie istnieje.
     */
    public function load(string $filePath): array
    {
        if (!file_exists($filePath)) {
            throw new \Exception("File not found: {$filePath}");
        }
        return require $filePath;
    }
}