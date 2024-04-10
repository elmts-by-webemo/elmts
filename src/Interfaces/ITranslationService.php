<?php

namespace Elmts\Core\Interfaces;

/**
 * Interfejs definiujący metody ładowania i otrzymywania tłumaczeń.
 *
 * Zapewnia mechanizm dla ładowania zestawu tłumaczeń dla określonego języka
 * oraz pobierania indywidualnych tłumaczeń na podstawie klucza.
 *
 * @package Elmts\Core\Interfaces
 */
interface ITranslationService {
    /**
     * Ładuje tłumaczenia dla określonego języka.
     *
     * @param string $language Kod języka, dla którego mają zostać załadowane tłumaczenia.
     * @return void
     */
    public function load(string $language): void;

    /**
     * Pobiera tłumaczenie na podstawie podanego klucza.
     *
     * @param string $key Klucz, dla którego ma zostać zwrócone tłumaczenie.
     * @return string|null Tłumaczenie dla podanego klucza lub null, jeśli tłumaczenie nie zostało znalezione.
     */
    public function getTranslation(string $key): ?string;
}
