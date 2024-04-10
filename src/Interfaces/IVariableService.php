<?php
namespace Elmts\Core\Interfaces;

/**
 * Interfejs IVariableService definiuje podstawowy kontrakt dla serwisu zarządzającego zmiennymi.
 * 
 * Ten interfejs umożliwia implementację serwisu, który odpowiada za dostęp
 * do różnych zmiennych aplikacji, które mogą być przechowywane w plikach, bazie danych
 * lub innych źródłach.
 *
 * @package Elmts\Core\Interfaces
 */
interface IVariableService
{
    /**
     * Pobiera wartość zmiennej na podstawie podanego klucza.
     *
     * @param string $key Klucz identyfikujący zmienną, którą chcemy pobrać.
     * @return mixed Może zwrócić dowolny typ wartości zmiennej. Jeśli zmienna nie istnieje, zwracana jest wartość null.
     */
    public function get($key);
}