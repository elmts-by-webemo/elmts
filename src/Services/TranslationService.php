<?php

namespace Elmts\Core\Services;

use Elmts\Core\Interfaces\ITranslationService;
use Elmts\Core\Interfaces\ITranslationLoader;
use Elmts\Core\Interfaces\IVariableService;
use Elmts\Core\Exceptions\ElmtsException;

/**
 * Serwis odpowiedzialny za ładowanie i zarządzanie tłumaczeniami.
 *
 * Implementuje interfejs ITranslationService, zapewniając funkcjonalność
 * do ładowania tłumaczeń z plików i pobierania indywidualnych tłumaczeń
 * na podstawie klucza. Korzysta z klasy TranslationLoader do ładowania tłumaczeń.
 * W przypadku problemów z ładowaniem pliku tłumaczeń, zostanie zgłoszony wyjątek ElmtsException.
 * 
 * @package Elmts\Core\Service
 */
class TranslationService implements ITranslationService {
    /**
     * Loader tłumaczeń.
     *
     * @var ITranslationLoader
     */
    private $translationLoader;

    /**
     * Serwis zarządzający zmiennymi konfiguracyjnymi.
     *
     * @var IVariableService
     */
    private $variableService;
    
    /**
     * Tablica zawierająca załadowane tłumaczenia.
     *
     * @var array
     */
    private array $translations = [];

    /**
     * Konstruktor klasy TranslationService.
     * Inicjalizuje obiekt loadera tłumaczeń.
     *
     * @param ITranslationLoader $translationLoader Obiekt loadera tłumaczeń.
     */
    public function __construct(ITranslationLoader $translationLoader,
        IVariableService $variableService) {
        $this->translationLoader = $translationLoader;
        $this->variableService = $variableService;
    }

    /**
     * Ładuje tłumaczenia dla określonego języka.
     *
     * @param string $language Kod języka, dla którego mają zostać załadowane tłumaczenia.
     * @throws ElmtsException Jeśli plik tłumaczeń nie istnieje.
     * @return void
     */
    public function load(string $language): void {
        $this->translations = $this->translationLoader->load($language);
    }

    /**
     * Zwraca tłumaczenie dla podanego klucza.
     *
     * @param string $key Klucz tłumaczenia, którego wartość ma zostać zwrócona.
     * @return string|null Tłumaczenie dla podanego klucza lub null, jeśli tłumaczenie nie zostało znalezione.
     */
    public function getTranslation(string $key): ?string {
        $translation = $this->translations[$key] ?? null;
        if ($translation !== null) {
            $translation = $this->variableService->replacePlaceholders($translation);
        }
        return $translation;
    }
}