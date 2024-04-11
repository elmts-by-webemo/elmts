<?php

namespace Elmts\Core\Services;

use Elmts\Core\Interfaces\IVariableService;
use Elmts\Core\Interfaces\IConfig;
use Elmts\Core\Interfaces\ILanguageController;
use Elmts\Core\Exceptions\ElmtsException;

/**
 * Serwis VariableService odpowiedzialny za zarządzanie i dostęp do zmiennych konfiguracyjnych aplikacji.
 *
 * Umożliwia ładowanie konfiguracji zmiennych specyficznych dla wybranego języka. Klasa współpracuje z
 * kontrolerem ILanguageController oraz serwisem IPathsConfig, aby dynamicznie określić i załadować odpowiedni plik
 * konfiguracyjny zmiennych na podstawie bieżącego ustawienia języka.
 *
 * @package Elmts\Core\Services
 */
class VariableService implements IVariableService
{
     /**
     * Kontroler zarządzający informacjami o bieżącym języku w aplikacji.
     *
     * @var ILanguageController
     */
    private $languageController;

    /**
     * Serwis zarządzający konfiguracją ścieżek w aplikacji, używany do uzyskania
     * ścieżki dostępu do plików konfiguracyjnych zmiennych.
     *
     * @var IConfig
     */
    private $pathsConfig;

    /**
     * Tablica przechowująca załadowane zmienne konfiguracyjne. Zawartość tablicy
     * zależy od pliku konfiguracyjnego specyficznego dla wybranego języka.
     *
     * @var array
     */
    private $variables = [];

    /**
     * Konstruktor klasy VariableService.
     *
     * @param ILanguageController $languageController Kontroler do zarządzania językami, umożliwia określenie bieżącego języka aplikacji.
     * @param IPathsConfig $pathsConfig Serwis do zarządzania ścieżkami, wykorzystywany do ustalenia lokalizacji plików konfiguracyjnych.
     */
    public function __construct(ILanguageController $languageController, IConfig $pathsConfig)
    {
        $this->languageController = $languageController;
        $this->pathsConfig = $pathsConfig;
        $this->loadVariables();
    }

    /**
     * Ładuje zmienne konfiguracyjne na podstawie bieżącego języka.
     *
     * Zmienne są ładowane z pliku znajdującego się w lokalizacji określonej przez bieżący język.
     * Wywołuje wyjątek ElmtsException, jeśli plik zmiennych nie zostanie znaleziony.
     *
     * @throws ElmtsException Jeśli plik zmiennych dla bieżącego języka nie zostanie znaleziony.
     */
    protected function loadVariables()
    {
        $currentLanguage = $this->languageController->getCurrentLanguage();
        $baseLanguagePath = $this->pathsConfig->getConfig('path_location');
        $variablesPath = $baseLanguagePath . "{$currentLanguage}/variables.php";

        if (!file_exists($variablesPath)) {
            throw new ElmtsException("Variables file (".$variablesPath.") not found for language: ".$currentLanguage);
        }

        $this->variables = include $variablesPath;
    }

    /**
     * Zwraca wartość zmiennej konfiguracyjnej na podstawie podanego klucza.
     *
     * @param string $key Klucz identyfikujący zmienną konfiguracyjną do pobrania.
     * @return mixed Wartość zmiennej konfiguracyjnej.
     * @throws ElmtsException Jeśli zmienna o podanym kluczu nie istnieje.
     */
    public function get($key)
    {
        if (!array_key_exists($key, $this->variables)) {
            throw new ElmtsException("The variable with key '{$key}' does not exist.");
        }

        return $this->variables[$key];
    }

    /**
     * Zamienia zastępcze zmienne w ciągu znaków na ich odpowiadające wartości.
     *
     * @param string $inputString Ciąg znaków zawierający zastępcze zmienne do zastąpienia.
     * @return string Zmodyfikowany ciąg znaków z zastąpionymi zmiennymi.
     */
    public function replacePlaceholders(string $inputString): string 
    {
        preg_match_all('/{{(.*?)}}/', $inputString, $matches);

        if (empty($matches[0])) {
            return $inputString;
        }

        $placeholders = $matches[0];

        foreach ($placeholders as $placeholder) {
            $key = trim($placeholder, '{}');
            $value = $this->get($key);
            $inputString = str_replace($placeholder, $value, $inputString);
        }

        return $inputString;
    }
}