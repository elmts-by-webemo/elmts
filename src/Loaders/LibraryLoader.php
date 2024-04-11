<?php

namespace Elmts\Core\Loaders;

use Elmts\Core\Validation\Validator;
use Elmts\Core\Services\HtmlTagGeneratorService;

/**
 * Abstrakcyjna klasa LibraryLoader
 *
 * Zapewnia ogólną strukturę oraz niezbędne narzędzia do ładowania bibliotek (np. CSS, JS).
 * Wykorzystuje walidator do sprawdzania poprawności konfiguracji oraz serwis do generowania
 * tagów HTML, umożliwiając dynamiczne i bezpieczne włączanie zasobów do aplikacji.
 *
 * @package Elmts\Core\Loaders
 * @version 1.0.0
 * @creation_date 2024-04-10
 * @modification_date 2024-04-10
 * @gpt_name simplyPHPDoc-Gen
 */
abstract class LibraryLoader {
    
    /**
     * Instancja walidatora używana do walidacji konfiguracji bibliotek.
     * @var Validator
     */
    protected $validator;
    
    /**
     * Instancja serwisu generatora tagów HTML, używana do tworzenia tagów dla ładowanych zasobów.
     * @var HtmlTagGeneratorService
     */
    protected $htmlTagGenerator;

    /**
     * Konstruktor klasy LibraryLoader.
     *
     * Inicjalizuje walidator i generator tagów HTML, które są wykorzystywane
     * do walidacji konfiguracji i generowania odpowiednich tagów HTML dla bibliotek.
     *
     * @param Validator $validator Instancja walidatora.
     * @param HtmlTagGeneratorService $htmlTagGenerator Instancja serwisu generatora tagów HTML.
     */
    public function __construct(Validator $validator, HtmlTagGeneratorService $htmlTagGenerator) {
        $this->validator = $validator;
        $this->htmlTagGenerator = $htmlTagGenerator;
    }

    /**
     * Zwraca wymagania dotyczące konfiguracji biblioteki.
     *
     * @return array Tablica zawierająca wymagane klucze konfiguracyjne i ich walidatory.
     */
    abstract protected function getRequirements(): array;
    
     /**
     * Zwraca mapowanie kluczy konfiguracji na atrybuty HTML.
     *
     * @return array Asocjacyjna tablica mapująca klucze konfiguracyjne na atrybuty HTML.
     */
    abstract protected function getAttributeMap(): array;

    /**
     * Ładuje zasoby na podstawie konfiguracji.
     *
     * Waliduje konfigurację, mapuje ją na atrybuty HTML i generuje odpowiedni tag HTML.
     *
     * @param array $config Opcjonalna asocjacyjna tablica konfiguracyjna.
     * @return string Wynikowy tag HTML do włączenia w aplikację.
     * @throws \Exception Gdy konfiguracja jest niepoprawna.
     */
    public function load(array $config=[]): string {
        // Walidacja konfiguracji
        $requirements = $this->getRequirements();
        $validationResult = $this->validator->validateArray($config, $requirements);
        if (!$validationResult->isValid()) {
            throw new \Exception("Configuration is invalid: " . implode(', ', $validationResult->getErrors()));
        }

        // Generowanie tagu HTML
        $attributes = $this->mapConfigToAttributes($config);
        return $this->htmlTagGenerator->createTag($this->getTagName(), $attributes);
    }

    /**
     * Mapuje konfigurację na atrybuty HTML na podstawie zdefiniowanej mapy atrybutów.
     *
     * @param array $config Asocjacyjna tablica konfiguracyjna.
     * @return array Asocjacyjna tablica atrybutów HTML.
     */
    protected function mapConfigToAttributes(array $config): array {
        $attributeMap = $this->getAttributeMap();
        $attributes = [];
        foreach ($attributeMap as $configKey => $htmlAttribute) {
            if (isset($config[$configKey])) {
                $attributes[$htmlAttribute] = $config[$configKey];
            }
        }
        return $attributes;
    }

    /**
     * Zwraca nazwę tagu HTML do wygenerowania.
     *
     * @return string Nazwa tagu HTML.
     */
    abstract protected function getTagName(): string;
}
