<?php

namespace Elmts\Core\Interfaces;

use Elmts\Core\Exceptions\ElmtsException;

/**
 * Interfejs dla loadera tłumaczeń, definiujący metodę do ładowania tłumaczeń z plików przy użyciu różnych strategii.
 * Określa wymagania dla implementacji loadera, które obejmują obsługę różnych formatów plików.
 *
 * @package Elmts\Core\Interfaces
 * @version 1.1
 * - creation_date 2024-04-25
 * - modification_date 2024-04-25
 * - gpt_name simplyPHPDoc-Gen
 */
interface ITranslationLoader
{
    /**
     * Ładuje tłumaczenia dla określonego języka z plików zgodnie z konfiguracją strategii.
     * Każda strategia odpowiada za ładowanie plików w określonym formacie i zbieranie tłumaczeń w skonsolidowaną tablicę.
     *
     * @param string $language Kod języka, dla którego mają zostać załadowane tłumaczenia.
     * @return array Skonsolidowana tablica tłumaczeń dla podanego języka, zorganizowana po kluczach plików.
     * @throws ElmtsException Jeśli wystąpi problem z ładowaniem plików, na przykład plik nie istnieje.
     */
    public function load(string $language): array;
}
