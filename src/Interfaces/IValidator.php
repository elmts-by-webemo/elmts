<?php

namespace Elmts\Core\Interfaces;

use Elmts\Core\Validation\ValidationResult;
use Elmts\Core\Exceptions\ElmtsException;

/**
 * Interfejs IValidator definiuje standardowy kontrakt dla walidatorów,
 * zapewniając mechanizm do walidacji różnych wartości z użyciem zestawu zasad
 * lub ograniczeń. Każda implementacja tego interfejsu powinna być w stanie
 * przetworzyć daną wartość i ocenić jej zgodność z podanymi ograniczeniami,
 * zwracając rezultat walidacji.
 *
 * @package Elmts\Core\Interfaces
 */
interface IValidator {
    /**
     * Waliduje podaną wartość z użyciem zestawu ograniczeń.
     *
     * @param mixed $value Wartość do walidacji.
     * @param array $constraints Ograniczenia użyte do walidacji wartości.
     * 
     * @return ValidationResult Obiekt ValidationResult zawierający wyniki walidacji,
     *                          w tym informacje o wszelkich naruszeniach zasad.
     * 
     * @throws ElmtsException Może być rzucony, gdy walidator napotka na błąd,
     *                        który uniemożliwia wykonanie walidacji.
     */
    public function validate($value, array $constraints = []): ValidationResult;

    /**
     * Waliduje tablicę asocjacyjną na podstawie zdefiniowanych wymagań.
     *
     * @param array $data Tablica do walidacji.
     * @param array $requirements Wymagania, gdzie klucz to nazwa klucza w $data,
     *                            a wartość określa, czy wartość może być pusta.
     * 
     * @return ValidationResult Zwraca obiekt ValidationResult z wynikami walidacji,
     *                          w tym informacje o wszelkich naruszeniach zasad.
     * 
     * @throws ElmtsException Może być rzucony, gdy walidator napotka na błąd,
     *                        który uniemożliwia wykonanie walidacji.
     */
    public function validateArray(array $data, array $requirements): ValidationResult;
}
