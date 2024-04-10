<?php
namespace Elmts\Core\Services;

use Elmts\Core\Interfaces\ILanguageService;

/**
 * Serwis zarządzania językami w aplikacji.
 *
 * Umożliwia ładowanie dostępnych języków i sprawdzanie, czy dany język jest obsługiwany.
 *
 * @package Elmts\Core\Services
 */
class LanguageService implements ILanguageService
{
    /**
     * Lista dostępnych języków.
     *
     * @var array
     */
    protected $availableLanguages;

    /**
     * Konstruktor klasy LanguageService.
     *
     * Ładuje listę dostępnych języków z konfiguracji środowiskowej lub ustawia domyślny język 'pl'.
     */
    public function __construct()
    {
        $this->availableLanguages = $this->loadAvailableLanguages();
    }

    /**
     * Zwraca listę dostępnych języków.
     *
     * @return array Lista dostępnych języków.
     */
    public function getAvailableLanguages(): array
    {
        return $this->availableLanguages;
    }

    /**
     * Sprawdza, czy dany język jest obsługiwany przez aplikację.
     *
     * @param string $language Kod języka do sprawdzenia.
     * @return bool True, jeśli język jest obsługiwany, false w przeciwnym razie.
     */
    public function isLanguageSupported(string $language): bool
    {
        return in_array($language, $this->availableLanguages);
    }

    /**
     * Ładuje listę dostępnych języków z konfiguracji środowiskowej.
     *
     * Jeśli konfiguracja środowiskowa 'APP_LOCALE_TRANSLATIONS' nie jest ustawiona, zwraca domyślnie ['pl'].
     *
     * @return array Lista kodów dostępnych języków.
     */
    protected function loadAvailableLanguages(): array
    {
        return !empty(envParam('APP_LOCALE_TRANSLATIONS')) ? explode('|', envParam('APP_LOCALE_TRANSLATIONS')) : ['pl'];
    }
}