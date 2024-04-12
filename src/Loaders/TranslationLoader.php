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
     * Ścieżka do katalogu zawierającego pliki tłumaczeń i zmiennych
     *
     * @var string
     */
    private $locationPath;

    /**
     * Konstruktor klasy TranslationLoader.
     * Inicjalizuje ścieżkę do plików tłumaczeń, wykorzystując konfigurację ścieżek.
     */
    public function __construct(MainConfig $pathsConfig)
    {
        $this->locationPath = $pathsConfig->getConfig('path_location');
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
        $locationFullPath = $this->locationPath . "{$language}/translations.php";
        if (file_exists($locationFullPath)) {
            return require $locationFullPath;
        } else {
            throw new ElmtsException("Translation file not found: {$locationFullPath}");
        }
    }

    public function loadVariables(string $language): array
    {
        $locationFullPath = $this->locationPath . "{$language}/variables.php";
        if (file_exists($locationFullPath)) {
            return require $locationFullPath;
        } else {
            throw new ElmtsException("Variables file not found: {$locationFullPath}");
        }
    }
}