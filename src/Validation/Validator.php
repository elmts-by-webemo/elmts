<?php

namespace Elmts\Core\Validation;

use Elmts\Core\Interfaces\IValidator;

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

    /**
     * Waliduje tablicę asocjacyjną na podstawie zdefiniowanych wymagań.
     *
     * @param array $data Tablica do walidacji.
     * @param array $requirements Wymagania, gdzie klucz to nazwa klucza w $data,
     *                            a wartość określa, czy wartość może być pusta.
     *
     * @return ValidationResult Zwraca obiekt ValidationResult z wynikami walidacji,
     *                          w tym informacje o wszelkich naruszeniach zasad.
     */
    public function validateArray(array $data, array $requirements): ValidationResult {
        $errors = [];

        foreach ($requirements as $key => $valueMustNotBeEmpty) {
            if (!array_key_exists($key, $data)) {
                $errors[] = "The required key '{$key}' is missing from the data.";
                continue;
            }

            if ($valueMustNotBeEmpty && empty($data[$key])) {
                $errors[] = "The key '{$key}' cannot be empty.";
            }
        }

        $isValid = empty($errors);
        return new ValidationResult($isValid, $errors);
    }
}