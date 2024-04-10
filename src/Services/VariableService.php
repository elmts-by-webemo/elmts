<?php

namespace Elmts\Core\Services;

use Elmts\Core\Interfaces\IVariableService;
use Elmts\Core\Interfaces\IConfig;
use Elmts\Core\Interfaces\ILanguageService;
use Elmts\Core\Exceptions\ElmtsException;

/**
 * Serwis VariableService odpowiedzialny za zarządzanie i dostęp do zmiennych konfiguracyjnych aplikacji.
 *
 * Umożliwia ładowanie konfiguracji zmiennych specyficznych dla wybranego języka. Klasa współpracuje z
 * serwisami ILanguageService oraz IPathsConfig, aby dynamicznie określić i załadować odpowiedni plik
 * konfiguracyjny zmiennych na podstawie bieżącego ustawienia języka.
 *
 * @package Elmts\Core\Services
 */
class VariableService implements IVariableService
{
     /**
     * Serwis zarządzający informacjami o bieżącym języku w aplikacji.
     *
     * @var ILanguageService
     */
    private $languageService;

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
     * @param ILanguageService $languageService Serwis do zarządzania językami, umożliwia określenie bieżącego języka aplikacji.
     * @param IPathsConfig $pathsConfig Serwis do zarządzania ścieżkami, wykorzystywany do ustalenia lokalizacji plików konfiguracyjnych.
     */
    public function __construct(ILanguageService $languageService, IConfig $pathsConfig)
    {
        $this->languageService = $languageService;
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
        $currentLanguage = $this->languageService->getCurrentLanguage();
        $baseLanguagePath = $this->pathsConfig->getConfig('location');
        $variablesPath = $baseLanguagePath . "{$currentLanguage}/variables.php";

        if (!file_exists($variablesPath)) {
            throw new ElmtsException("Variables file not found for language: {$currentLanguage}");
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
}