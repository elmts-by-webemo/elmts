<?php

namespace Elmts\Core\Interfaces;

/**
 * Interfejs IErrorHandler definiujący metody do rejestracji obsługi błędów w aplikacji.
 * 
 * Implementując ten interfejs, klasa może dostarczyć mechanizm obsługi błędów, wyjątków
 * oraz funkcji zamykania aplikacji.
 * 
 * @package Elmts\Core\Interfaces
 */
interface IErrorHandler
{
    /**
     * Rejestruje obsługę błędów aplikacji.
     *
     * @return void
     */
    public function registerErrorHandler(): void;

    /**
     * Rejestruje obsługę wyjątków aplikacji.
     *
     * @return void
     */
    public function registerExceptionHandler(): void;

    /**
     * Rejestruje funkcję zamykania aplikacji.
     *
     * @return void
     */
    public function registerShutdownFunction(): void;
}
