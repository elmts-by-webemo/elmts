<?php

namespace Elmts\Core\Interfaces;

use Elmts\Core\Exceptions\ElmtsException;

/**
 * Interfejs dla loadera tłumaczeń, definiujący metodę do ładowania tłumaczeń z plików.
 *
 * @package Elmts\Core\Interfaces
 */
interface ITranslationLoader
{
    /**
     * Ładuje tłumaczenia dla określonego języka z pliku.
     *
     * Używa skonfigurowanej ścieżki do poszukiwania pliku tłumaczeń dla podanego języka.
     * Jeśli plik istnieje, tłumaczenia są zwracane jako tablica.
     * W przypadku nieznalezienia pliku, zgłaszany jest wyjątek ElmtsException.
     *
     * @param string $language Kod języka, dla którego mają zostać załadowane tłumaczenia.
     * @throws ElmtsException Jeśli plik tłumaczeń nie istnieje.
     * @return array Tablica tłumaczeń dla podanego języka.
     */
    public function load(string $language): array;

    /**
     * Ładuje zmienne dla określonego języka z pliku.
     *
     * Używa skonfigurowanej ścieżki do poszukiwania pliku zmiennych dla podanego języka.
     * Jeśli plik istnieje, zmienne są zwracane jako tablica.
     * W przypadku nieznalezienia pliku, zgłaszany jest wyjątek ElmtsException.
     *
     * @param string $language Kod języka, dla którego mają zostać załadowane tłumaczenia.
     * @throws ElmtsException Jeśli plik zmiennych nie istnieje.
     * @return array Tablica zmiennych dla podanego języka.
     */
    public function loadVariables(string $language): array;
}
