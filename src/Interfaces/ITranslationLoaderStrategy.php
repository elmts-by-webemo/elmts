<?php 
namespace Elmts\Core\Interfaces;

/**
 * Interfejs strategii ładowania tłumaczeń.
 * Definiuje metody potrzebne do ładowania danych tłumaczeń z różnych źródeł.
 *
 * @package Elmts\Core\Interfaces
 * @version 1.0
 * - creation_date 2024-04-25
 * - modification_date 2024-04-25
 * - gpt_name simplyPHPDoc-Gen
 */
interface ITranslationLoaderStrategy
{
    /**
     * Ładuje tłumaczenia z podanego pliku.
     * Metoda powinna zwracać tablicę tłumaczeń.
     *
     * @param string $filePath Ścieżka do pliku tłumaczeń.
     * @return array Tablica tłumaczeń.
     */
    public function load(string $filePath): array;
}