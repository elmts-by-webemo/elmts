<?php
namespace Elmts\Core\Interfaces;

use Elmts\Core\Exceptions\ElmtsException;

interface ILanguageController
{
    /**
     * Zmienia aktualny język aplikacji na nowy, podany przez użytkownika.
     * 
     * @param string $newLanguage Nowy kod języka, który ma zostać ustawiony.
     * @throws ElmtsException W przypadku, gdy podany język nie jest obsługiwany.
     * @return void
     */
    public function changeLanguage(string $newLanguage): void;

    /**
     * Zwraca kod aktualnie ustawionego języka.
     *
     * @return string Kod aktualnego języka.
     */
    public function getCurrentLanguage(): string;

    /**
     * Pobiera listę dostępnych języków.
     * 
     * @return array Tablica z kodami dostępnych języków.
     */
    public function getAvailableLanguages(): array;

    /**
     * Tłumaczy podany klucz na aktualnie ustawiony język.
     * 
     * @param string $key Klucz tłumaczenia do pobrania.
     * @throws ElmtsException W przypadku problemów z pobraniem tłumaczenia.
     * @return string Tłumaczenie dla klucza lub klucz, jeśli tłumaczenie nie zostanie znalezione.
     */
    public function translate(string $key): string;
}