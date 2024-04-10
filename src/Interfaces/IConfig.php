<?php

namespace Elmts\Core\Interfaces;

/**
 * Interfejs IConfig definiuje podstawowy kontrakt dla zarządzania konfiguracją w aplikacji.
 * Umożliwia ładowanie konfiguracji z różnych źródeł oraz pobieranie skonfigurowanych wartości.
 */
interface IConfig
{
    /**
     * Ładuje i scala konfiguracje z podanego źródła.
     * 
     * @param array $config Nowe konfiguracje do załadowania i scalenia z istniejącymi ustawieniami.
     * @throws \Elmts\Core\Exceptions\ElmtsException W przypadku błędów konfiguracji.
     * @return void
     */
    public function loadConfiguration(array $config): void;

    /**
     * Pobiera wartość konfiguracyjną na podstawie podanego klucza.
     * 
     * @param string $key Klucz żądanego ustawienia konfiguracyjnego.
     * @return mixed Zwraca wartość konfiguracyjną dla podanego klucza lub null, jeśli ustawienie nie istnieje.
     */
    public function getConfig(string $key);
}
