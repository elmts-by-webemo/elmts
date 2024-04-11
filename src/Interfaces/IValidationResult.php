<?php

namespace Elmts\Core\Interfaces;

/**
 * Interfejs IValidationResult definiuje kontrakt dla wyników walidacji.
 *
 * Zapewnia mechanizm do łatwego sprawdzenia, czy walidacja zakończyła się sukcesem,
 * oraz umożliwia dostęp do ewentualnych błędów walidacji. Implementacje tego interfejsu
 * umożliwiają gromadzenie informacji o wynikach procesu walidacji, w tym o wszelkich
 * naruszeniach zdefiniowanych reguł walidacji.
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
     */
    public function addError(string $error): void;
}