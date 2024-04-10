<?php

namespace Elmts\Core\Interfaces;

/**
 * Interfejs serwisu zarządzającego językami w aplikacji.
 *
 * Definiuje kontrakt dla serwisów odpowiedzialnych za dostarczanie informacji
 * o dostępnych językach oraz sprawdzanie, czy konkretny język jest obsługiwany.
 *
 * @package Elmts\Core\Interfaces
 */
interface ILanguageService
{
    /**
     * Pobiera listę dostępnych języków.
     *
     * Metoda powinna zwrócić tablicę kodów dostępnych języków obsługiwanych przez aplikację.
     *
     * @return array Lista kodów dostępnych języków.
     */
    public function getAvailableLanguages(): array;

    /**
     * Sprawdza, czy dany język jest obsługiwany przez aplikację.
     *
     * @param string $language Kod języka, którego obsługę chcemy sprawdzić.
     * @return bool True, jeśli język jest obsługiwany, false w przeciwnym razie.
     */
    public function isLanguageSupported(string $language): bool;
}