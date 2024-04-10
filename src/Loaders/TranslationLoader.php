<?php

namespace Elmts\Core\Loaders;

use Elmts\Core\Interfaces\ITranslationLoader;
use Elmts\Core\Exceptions\ElmtsException;
use App\Config\MainConfig;

/**
 * Loader tłumaczeń, odpowiedzialny za ładowanie tłumaczeń z plików.
 *
 * @package Elmts\Core\Loaders
 */
class TranslationLoader implements ITranslationLoader
{
    /**
     * Ścieżka do katalogu zawierającego pliki tłumaczeń.
     *
     * @var string
     */
    private $translationsPath;

    /**
     * Konstruktor klasy TranslationLoader.
     * Inicjalizuje ścieżkę do plików tłumaczeń, wykorzystując konfigurację ścieżek.
     */
    public function __construct(MainConfig $pathsConfig)
    {
        $this->translationsPath = $pathsConfig->getConfig('path_location');
    }

    /**
     * Ładuje tłumaczenia dla określonego języka z pliku.
     *
     * Używa skonfigurowanej ścieżki do poszukiwania pliku tłumaczeń dla podanego języka.
     * Jeśli plik istnieje, tłumaczenia są zwracane jako tablica.
     * W przypadku nieznalezienia pliku, zgłaszany jest wyjątek ElmtsException.
     *
     * @param string $language Kod języka, dla którego mają zostać załadowane tłumaczenia.
     * @throws ElmtsException Jeśli plik tłumaczeń nie istnieje.
     * @return array Tablica tłumaczeń dla podanego języka.
     */
    public function load(string $language): array
    {
        $translationsFullPath = $this->translationsPath . "{$language}/translations.php";
        if (file_exists($translationsFullPath)) {
            return require $translationsFullPath;
        } else {
            throw new ElmtsException("Translation file not found: {$translationsFullPath}");
        }
    }
}