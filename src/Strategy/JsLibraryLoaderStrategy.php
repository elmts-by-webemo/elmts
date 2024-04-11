<?php

namespace Elmts\Core\Strategy;

use Elmts\Core\Loaders\LibraryLoader;

/**
 * Klasa JsLibraryLoaderStrategy
 *
 * Specjalizuje klasę LibraryLoader do ładowania skryptów JavaScript.
 * Definiuje wymagania konfiguracyjne, mapowanie atrybutów i generowanie tagu <script>
 * niezbędne do załączenia skryptów JS do aplikacji.
 *
 * @package Elmts\Core\Strategy
 * @version 1.0.0
 * @creation_date 2024-04-10
 * @modification_date 2024-04-10
 * @gpt_name simplyPHPDoc-Gen
 */
class JsLibraryLoaderStrategy extends LibraryLoader
{
    
    /**
     * Określa wymagane elementy konfiguracji dla ładowania JavaScript.
     *
     * @return array Tablica zawierająca klucze konfiguracji wymagane dla ładowania JS.
     */
    protected function getRequirements(): array {
        return ['src' => true];
    }

    /**
     * Mapuje konfigurację na atrybuty HTML dla tagu <script>.
     *
     * Definiuje sposób przekształcania kluczy konfiguracji na atrybuty tagu <script>,
     * umożliwiając łatwe dodawanie atrybutów 'async', 'defer', a także ustawienie
     * domyślnej wartości dla 'type'.
     *
     * @return array Asocjacyjna tablica mapująca klucze konfiguracji na atrybuty HTML.
     */
    protected function getAttributeMap(): array {
        return [
            'src' => 'src',
            'async' => 'async', 
            'integrity' => 'integrity',
            'type' => 'type',
            'crossorigin'=>'crossorigin',
            'referrerpolicy'=>'referrerpolicy'
        ];
    }

    /**
     * Zwraca nazwę tagu HTML używanego do ładowania skryptów JavaScript.
     *
     * @return string Stała wartość 'script' wskazująca na tag używany do ładowania skryptów JS.
     */
    protected function getTagName(): string {
        return 'script';
    }
}