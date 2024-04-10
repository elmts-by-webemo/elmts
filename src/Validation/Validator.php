<?php

namespace Elmts\Core\Validation;

use Elmts\Core\Interfaces\IValidator;
use Elmts\Core\Exceptions\ElmtsException;

/**
 * Klasa Validator służy do walidacji danych wejściowych na podstawie zdefiniowanych ograniczeń.
 *
 * @package Elmts\Core\Validation
 */
class Validator implements IValidator {
    /**
     * Waliduje podaną wartość na podstawie zestawu ograniczeń.
     *
     * @param mixed $value Wartość do walidacji.
     * @param array $constraints Ograniczenia użyte do walidacji wartości.
     *
     * @return ValidationResult Obiekt ValidationResult zawierający wyniki walidacji.
     *
     * @throws ElmtsException Gdy walidacja napotka na problem, uniemożliwiający jej wykonanie.
     */
    public function validate($value, array $constraints = []): ValidationResult {
        
        // Przykładowa implementacja. Tutaj powinna znaleźć się logika sprawdzająca wartość
        // na podstawie dostarczonych ograniczeń i tworząca odpowiedni ValidationResult.

        // Jeśli nie ma ograniczeń, uznajemy wartość za prawidłową.
        if (empty($constraints)) {
            return new ValidationResult(true);
        }

        // Tutaj należy dodać faktyczną logikę walidacji.
        $errors = [];
        foreach ($constraints as $constraint) {
            // Sprawdź wartość pod kątem ograniczenia.
            // Jeśli wartość jest nieprawidłowa, dodaj błąd do $errors.
        }

        $isValid = empty($errors);

        return new ValidationResult($isValid, $errors);
    }
}