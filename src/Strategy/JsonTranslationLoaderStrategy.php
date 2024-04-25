<?php
namespace Elmts\Core\Strategy;

use Elmts\Core\Interfaces\ITranslationLoaderStrategy;

/**
 * Obsługuje ładowanie danych tłumaczeń z plików JSON.
 *
 * @package Elmts\Core\Strategy
 * @version 1.0
 * - creation_date 2024-04-25
 * - modification_date 2024-04-25
 * - gpt_name simplyPHPDoc-Gen
 */
class JsonTranslationLoaderStrategy implements ITranslationLoaderStrategy
{
    /**
     * Ładuje dane tłumaczenia z pliku JSON.
     *
     * @param string $filePath Ścieżka do pliku JSON zawierającego dane tłumaczenia.
     * @return array Tablica asocjacyjna reprezentująca dane tłumaczenia.
     */
    public function load(string $filePath): array
    {
        $data = file_get_contents($filePath);
        return json_decode($data, true);
    }
}