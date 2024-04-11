<?php

namespace Elmts\Core\Strategy;

use Elmts\Core\Loaders\LibraryLoader;

/**
 * Klasa CssLibraryLoaderStrategy
 *
 * Specjalizuje klasę LibraryLoader do ładowania arkuszy stylów CSS.
 * Definiuje wymagania konfiguracyjne, mapowanie atrybutów i generowanie tagu <link>
 * niezbędne do załączenia arkuszy CSS do aplikacji.
 *
 * @package Elmts\Core\Strategy
 * @version 1.0.0
 * @creation_date 2024-04-10
 * @modification_date 2024-04-10
 * @gpt_name simplyPHPDoc-Gen
 */
class CssLibraryLoaderStrategy extends LibraryLoader {
    /**
     * Określa wymagane elementy konfiguracji dla ładowania CSS.
     *
     * @return array Tablica zawierająca klucze konfiguracji wymagane dla ładowania CSS.
     */
    protected function getRequirements(): array {
        return ['src' => true];
    }

    /**
     * Mapuje konfigurację na atrybuty HTML dla tagu <link>.
     *
     * Definiuje sposób przekształcania kluczy konfiguracji na atrybuty tagu <link>,
     * włączając domyślną wartość dla atrybutu 'rel'.
     *
     * @return array Asocjacyjna tablica mapująca klucze konfiguracji na atrybuty HTML.
     */
    protected function getAttributeMap(): array {
        return [
            'src' => 'href',
            'rel' => 'rel',
            'integrity' => 'integrity',
            'crossorigin' => 'crossorigin',
            'referrerpolicy'=>'referrerpolicy',
        ];
    }

    /**
     * Zwraca nazwę tagu HTML używanego do ładowania CSS.
     *
     * @return string Stała wartość 'link' wskazująca na tag używany do ładowania arkuszy CSS.
     */
    protected function getTagName(): string {
        return 'link';
    }
}