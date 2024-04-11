<?php

namespace Elmts\Core\Controllers;

use Elmts\Core\Interfaces\ICookieService;
use Elmts\Core\Interfaces\ILanguageController;
use Elmts\Core\Interfaces\ITranslationService;
use Elmts\Core\Interfaces\ILanguageService;
use Elmts\Core\Exceptions\ElmtsException;

/**
 * Kontroler zarządzający lokalizacją i tłumaczeniami w aplikacji.
 *
 * Kluczowe funkcjonalności:
 * - Wykrywanie preferowanego języka użytkownika.
 * - Ustawianie bieżącego języka aplikacji.
 * - Pobieranie tłumaczeń dla określonych kluczy.
 * 
 * Wykorzystuje CookieService do przechowywania preferowanego języka w ciasteczkach oraz
 * TranslationLoaderService do ładowania i dostępu do tłumaczeń.
 *
 * @package Elmts\Core\Controllers
 */
class LanguageController implements ILanguageController
{
    /**
     * Aktualnie wybrany język w aplikacji.
     *
     * @var string
     */
    private string $currentLanguage;

    private ITranslationService $translationService; 

    /**
     * Serwis do zarządzania ciasteczkami.
     *
     * @var ICookieService
     */
    private ICookieService $cookieService;

    /**
     * Serwis zarządzający dostępnymi językami w aplikacji.
     *
     * Umożliwia pobieranie listy dostępnych języków oraz sprawdzanie,
     * czy dany język jest obsługiwany przez aplikację. Jest wykorzystywany
     * do wykrywania i weryfikacji preferowanego języka użytkownika.
     *
     * @var ILanguageService
     */
    private ILanguageService $languageService;

    /**
     * Inicjalizuje kontroler lokalizacji.
     *
     * Ustawia serwisy odpowiedzialne za zarządzanie tłumaczeniami, ciasteczkami i językami.
     * Automatycznie wykrywa i ustawia preferowany język użytkownika na podstawie dostępnych danych.
     *
     * @param TranslationsLoader $translationsLoader Serwis do ładowania tłumaczeń.
     * @param ICookieService $cookieService Serwis do zarządzania ciasteczkami.
     * @param ILanguageService $languageService Serwis zarządzający dostępnymi językami.
     */
    public function __construct(ITranslationService $translationService, ICookieService $cookieService, ILanguageService $languageService)
    {
        $this->translationService = $translationService;
        $this->cookieService = $cookieService;
        $this->languageService = $languageService;

        $this->setCurrentLanguage($this->detectLanguage());
    }

    /**
     * Wykrywa preferowany język użytkownika.
     * 
     * Sprawdza parametr `lang` w URL, wartość ciasteczka `language` oraz domyślny język zdefiniowany
     * w zmiennej środowiskowej `LOCATION_DEFAULT`. Następnie używa metody getAvailableLanguages() z serwisu
     * zarządzania językami, aby sprawdzić, czy wykryty język jest wśród dostępnych języków.
     * W przypadku, gdy język nie jest obsługiwany, metoda rzuca wyjątek ElmtsException.
     *
     * @return string Kod preferowanego języka.
     * @throws ElmtsException Jeśli wykryty język nie jest obsługiwany.
     */
    private function detectLanguage(): string
    {
        $language = $_GET['lang'] ?? $this->cookieService->get('language') ?? envParam('APP_LOCALE');

        if (!$this->languageService->isLanguageSupported($language)) {
            throw new ElmtsException("Unsupported language: {$language}");
        }

        return $language;
    }

    /**
     * Ustawia aktualny język aplikacji i ładuje odpowiednie tłumaczenia.
     * 
     * Zapisuje wybrany język w ciasteczku i używa TranslationLoader do załadowania tłumaczeń.
     * Rzuca ElmtsException w przypadku niepowodzenia.
     *
     * @param string $language Kod języka do ustawienia.
     * @throws ElmtsException W przypadku problemów z ustawieniem języka lub ładowaniem tłumaczeń.
     * @return void
     */
    private function setCurrentLanguage(string $language): void
    {
        $this->currentLanguage = $language;
        try {
            $this->cookieService->set('language', $language, time() + 3600);
            $this->translationService->load($language);
        } catch (ElmtsException $e) {
            throw $e;
        }
    }

    /**
     * Zwraca kod aktualnie ustawionego języka.
     *
     * @return string Kod aktualnego języka.
     */
    public function getCurrentLanguage(): string
    {
        return $this->currentLanguage;
    }

    /**
     * Zmienia aktualny język aplikacji na nowy, podany przez użytkownika.
     * 
     * Ta metoda sprawdza, czy nowy język jest obsługiwany (zawarty w dostępnych językach).
     * Jeśli tak, ustawia ten język jako aktualny i ładuje dla niego tłumaczenia.
     * W przeciwnym razie rzuca wyjątek ElmtsException.
     *
     * @param string $newLanguage Nowy kod języka, który ma zostać ustawiony.
     * @throws ElmtsException W przypadku, gdy podany język nie jest obsługiwany.
     * @return void
     */
    public function changeLanguage(string $newLanguage): void
    {
        if (in_array($newLanguage, $this->getAvailableLanguages())) {
            $this->setCurrentLanguage($newLanguage);
        } else {
            throw new ElmtsException("Unsupported language: {$newLanguage}");
        }
    }

    /**
     * Pobiera listę dostępnych języków zdefiniowanych w zmiennej środowiskowej.
     * 
     * Ta metoda zwraca tablicę dostępnych kodów języków, które aplikacja może obsłużyć,
     * bazując na konfiguracji zdefiniowanej w zmiennej środowiskowej `LOCATION_TRANSLATIONS`.
     *
     * @return array Tablica z kodami dostępnych języków.
     */
    public function getAvailableLanguages(): array
    {
        return explode('|', $_ENV['LOCATION_TRANSLATIONS']);
    }

    /**
     * Zwraca tłumaczenie dla podanego klucza.
     * 
     * Jeśli tłumaczenie dla klucza nie zostanie znalezione, zwraca sam klucz.
     * Rzuca ElmtsException w przypadku problemów z dostępem do tłumaczeń.
     *
     * @param string $key Klucz tłumaczenia do pobrania.
     * @throws ElmtsException W przypadku problemów z pobraniem tłumaczenia.
     * @return string Tłumaczenie dla klucza lub klucz, jeśli tłumaczenie nie zostanie znalezione.
     */
    public function translate(string $key): string
    {
        try {
            return $this->translationService->getTranslation($key) ?? $key;
        } catch (ElmtsException $e) {
            throw $e;
        }
    }
}