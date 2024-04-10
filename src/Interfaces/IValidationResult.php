<?php

namespace Elmts\Core\Interfaces;

use Elmts\Core\Exceptions\ElmtsException;

/**
 * Interfejs IValidationResult definiuje kontrakt dla wyników walidacji.
 *
 * Określa metody, które muszą być dostępne w klasach wyników walidacji,
 * umożliwiając łatwe sprawdzenie, czy walidacja zakończyła się sukcesem,
 * oraz dostęp do ewentualnych błędów walidacji.
 *
 * Implementacje tego interfejsu mogą rzucać ElmtsException w przypadku
 * wystąpienia błędów wewnętrznych uniemożliwiających prawidłową walidację.
 *
 * @package Elmts\Core\Interfaces
 */
interface IValidationResult {
    /**
     * Sprawdza, czy walidacja zakończyła się sukcesem.
     *
     * @return bool True, jeśli walidacja zakończyła się sukcesem, w przeciwnym razie false.
     */
    public function isValid(): bool;

    /**
     * Zwraca tablicę zawierającą błędy walidacji.
     *
     * @return array Tablica z komunikatami o błędach walidacji.
     */
    public function getErrors(): array;

    /**
     * Dodaje błąd do wyników walidacji.
     *
     * @param string $error Komunikat o błędzie do dodania.
     * @throws ElmtsException Gdy nie można prawidłowo przetworzyć błędu.
     */
    public function addError(string $error): void;
}