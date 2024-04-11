<?php

namespace Elmts\Core\Interfaces;

/**
 * Interfejs IHtmlTagGenerator definiuje standardowy kontrakt dla generatorów tagów HTML.
 *
 * @package Elmts\Core\Interfaces
 */
interface IHtmlTagGeneratorService {
    /**
     * Tworzy tag HTML na podstawie nazwy i atrybutów.
     *
     * @param string $tagName Nazwa tagu HTML.
     * @param array $attributes Asocjacyjna tablica atrybutów i ich wartości.
     * @return string Skonstruowany tag HTML.
     */
    public static function createTag(string $tagName, array $attributes = []): string;
}
