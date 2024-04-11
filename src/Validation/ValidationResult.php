<?php

namespace Elmts\Core\Validation;

use Elmts\Core\Interfaces\IValidationResult;


/**
 * Klasa ValidationResult przechowuje wyniki procesu walidacji.
 *
 * Udostępnia metody do sprawdzania, czy walidacja zakończyła się sukcesem,
 * oraz do uzyskiwania dostępu do ewentualnych błędów walidacji.
 * Nie rzuca wyjątków bezpośrednio, ale może być używana do przechowywania
 * informacji o błędach wykrytych podczas procesu walidacji.
 *
 * @package Elmts\Core\Validation
 */

class ValidationResult implements IValidationResult {
    /**
     * @var bool Flaga wskazująca, czy walidacja zakończyła się sukcesem.
     */
    protected $isValid;

    /**
     * @var array Tablica zawierająca komunikaty o błędach walidacji.
     */
    protected $errors = [];

    /**
     * Inicjuje nową instancję klasy ValidationResult.
     *
     * @param bool $isValid Określa, czy walidacja zakończyła się sukcesem.
     * @param array $errors Opcjonalna tablica błędów wykrytych podczas walidacji.
     */
    public function __construct(bool $isValid, array $errors = []) {
        $this->isValid = $isValid;
        $this->errors = $errors;
    }

    /**
     * Sprawdza, czy walidacja zakończyła się sukcesem.
     *
     * @return bool True, jeśli walidacja zakończyła się sukcesem, w przeciwnym razie false.
     */
    public function isValid(): bool {
        return $this->isValid;
    }

    /**
     * Zwraca tablicę zawierającą błędy walidacji.
     *
     * @return array Tablica z komunikatami o błędach walidacji.
     */
    public function getErrors(): array {
        return $this->errors;
    }

    /**
     * Dodaje błąd do wyników walidacji.
     *
     * @param string $error Komunikat o błędzie do dodania.
     */
    public function addError(string $error): void {
        $this->errors[] = $error;
        $this->isValid = false;
    }
}