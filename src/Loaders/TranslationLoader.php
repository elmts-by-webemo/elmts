<?php

namespace Elmts\Core\Loaders;

use Elmts\Core\Interfaces\ITranslationLoader;
use Elmts\Core\Interfaces\ITranslationLoaderStrategy;
use Elmts\Core\Exceptions\ElmtsException;
use App\Config\MainConfig;
use Elmts\Core\Facades\HelperFacade;

/**
 * Loader tłumaczeń, odpowiedzialny za ładowanie tłumaczeń z plików.
 * Zarządza różnymi strategiami ładowania w zależności od typu pliku.
 *
 * @package Elmts\Core\Loaders
 * @version 1.1
 * - creation_date 2024-04-25
 * - modification_date 2024-04-25
 * - gpt_name simplyPHPDoc-Gen
 */
class TranslationLoader implements ITranslationLoader
{
    /**
     * Ścieżka do katalogu zawierającego pliki tłumaczeń.
     *
     * @var string
     */
    private $locationPath;

    /**
     * Lista strategii ładowania plików.
     *
     * @var TranslationLoaderStrategy[]
     */
    private $loaderStrategies;

    /**
     * Konstruktor klasy TranslationLoader.
     * Inicjalizuje ścieżkę do plików tłumaczeń i strategie ładowania.
     *
     * @param MainConfig $pathsConfig Konfiguracja ścieżek do plików.
     * @param array $loaderStrategies Strategie ładowania tłumaczeń.
     */
    public function __construct(MainConfig $pathsConfig, array $loaderStrategies)
    {
        $this->locationPath = $pathsConfig->getConfig('path_location');
        $this->loaderStrategies = $loaderStrategies;
    }

    /**
     * Ładuje tłumaczenia dla określonego języka z pliku.
     * Obsługuje wyjątki w przypadku nieznalezienia katalogu językowego.
     *
     * @param string $language Kod języka, dla którego mają zostać załadowane tłumaczenia.
     * @throws ElmtsException Jeśli plik tłumaczeń nie istnieje.
     * @return array Tablica tłumaczeń dla podanego języka.
     */
    public function load(string $language): array {
        $translations = [];
        $languageDirPath = $this->locationPath . "{$language}/";

        if (!is_dir($languageDirPath)) {
            throw new ElmtsException("Language directory not found: {$languageDirPath}");
        }

        foreach ($this->loaderStrategies as $extension => $strategy) {
            $files = glob($languageDirPath . '*.' . $extension);

            foreach ($files as $file) {
                $fileName = basename($file, '.' . $extension);
                $key = "__{$fileName}";
                $fileTranslations = $strategy->load($file);
                $fileTranslations = HelperFacade::transformFlatToAsoc($fileTranslations);
                $translations[$key] = $fileTranslations;
            }
        }

        return $translations;
    }
}