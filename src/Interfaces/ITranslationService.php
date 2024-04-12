<?php

namespace Elmts\Core\Interfaces;

/**
 * Interfejs ITranslation
 * 
 * Zapewnia interfejs dla usług tłumaczeniowych, umożliwiając pobieranie przetłumaczonych
 * ciągów znaków i zmiennych.
 * 
 * @package Elmts\Core\Interfaces
 * @version 1.0.0
 * @creation_date 2024-04-11
 * @modification_date 2024-04-11
 * @GPT_name simplyPHPDoc-Gen
 */
interface ITranslationService
{
    /**
     * Pobiera przetłumaczony ciąg znaków za pomocą jego klucza. Zwraca wartość domyślną, jeśli klucz nie zostanie znaleziony.
     *
     * @param string $key Klucz ciągu tłumaczenia do pobrania.
     * @param string $default Opcjonalnie. Wartość domyślna, która ma zostać zwrócona, jeśli tłumaczenie nie zostanie znalezione. Domyślnie jest to pusty ciąg.
     * @return string Przetłumaczony ciąg znaków lub wartość domyślna, jeśli nie zostanie znaleziony.
     */
    public function get(string $key, string $default = ''): string;

    /**
     * Pobiera przetłumaczoną zmienną za pomocą jej klucza. Zwraca wartość domyślną, jeśli klucz nie zostanie znaleziony.
     *
     * @param string $key Klucz zmiennej tłumaczenia do pobrania.
     * @param mixed $default Opcjonalnie. Wartość domyślna, która ma zostać zwrócona, jeśli tłumaczenie nie zostanie znalezione. Domyślnie jest to null.
     * @return mixed Przetłumaczona zmienna lub wartość domyślna, jeśli nie zostanie znaleziona.
     */
    public function getVariable(string $key, $default = null);

     /**
     * Tłumaczy podany klucz na aktualnie ustawiony język.
     * 
     * @param string $key Klucz tłumaczenia do pobrania.
     * @throws ElmtsException W przypadku problemów z pobraniem tłumaczenia.
     * @return string Tłumaczenie dla klucza lub klucz, jeśli tłumaczenie nie zostanie znalezione.
     */
    public function translate(string $key): string;
}
