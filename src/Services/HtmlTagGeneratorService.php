<?php

namespace Elmts\Core\Services;

use Elmts\Core\Interfaces\IHtmlTagGeneratorService;

/**
 * Klasa HtmlTagGeneratorService
 *
 * Oferuje funkcjonalność do generowania tagów HTML na podstawie podanej nazwy i zestawu atrybutów.
 * Umożliwia łatwe i bezpieczne tworzenie tagów HTML, z automatycznym kodowaniem atrybutów
 * celem zapobiegania atakom typu XSS.
 *
 * @package Elmts\Core\Services
 * @version 1.0.0
 * @creation_date 2024-04-10
 * @modification_date 2024-04-10
 * @gpt_name simplyPHPDoc-Gen
 */
class HtmlTagGeneratorService implements IHtmlTagGeneratorService
{
    /**
     * Tworzy tag HTML na podstawie nazwy i atrybutów.
     *
     * Metoda statyczna przyjmuje nazwę tagu oraz opcjonalnie asocjacyjną tablicę atrybutów,
     * gdzie klucze to nazwy atrybutów, a wartości to ich zawartość. Każda wartość atrybutu
     * jest kodowana za pomocą funkcji htmlspecialchars(), aby zapewnić bezpieczeństwo.
     * Zwraca gotowy do użycia tag HTML jako ciąg znaków.
     *
     * @param string $tagName Nazwa tagu HTML.
     * @param array $attributes Asocjacyjna tablica atrybutów i ich wartości.
     * @return string Skonstruowany tag HTML.
     */
    public static function createTag(string $tagName, array $attributes = []): string
    {
        $attributeStrings = array_map(function ($key, $value) {
            return sprintf('%s="%s"', $key, htmlspecialchars($value, ENT_QUOTES, 'UTF-8'));
        }, array_keys($attributes), $attributes);

        // Dla tagów, które wymagają zamknięcia (np. <script>), używamy innego formatu
        if (in_array($tagName, ['script', 'a', 'button'])) {
            return sprintf('<%s %s></%s>', $tagName, implode(' ', $attributeStrings), $tagName);
        } else { // Dla tagów samozamykających (np. <img>, <input>, <link>)
            return sprintf('<%s %s>', $tagName, implode(' ', $attributeStrings));
        }
    }
}