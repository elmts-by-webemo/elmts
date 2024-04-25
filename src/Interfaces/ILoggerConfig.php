<?php

namespace Elmts\Core\Interfaces;

use Elmts\Core\Exceptions\ElmtsException;

/**
 * Interfejs ILoggerConfig definiuje wymagane metody konfiguracyjne, które muszą być dostarczone
 * przez klasę konfiguracyjną loggera.
 */
interface ILoggerConfig
{
    /**
     * Pobiera nazwę loggera z konfiguracji.
     *
     * @return string Nazwa loggera.
     * @throws ElmtsException Jeśli konfiguracja nie zawiera nazwy loggera.
     */
    public function getLoggerName(): string;

    /**
     * Pobiera ścieżkę do plików logów z konfiguracji.
     *
     * @return string Ścieżka do plików logów.
     * @throws ElmtsException Jeśli konfiguracja nie zawiera ścieżki do logów.
     */
    public function getLoggerPath(): string;

    /**
     * Pobiera poziom debugowania z konfiguracji.
     *
     * @return string Poziom debugowania.
     * @throws ElmtsException Jeśli konfiguracja nie zawiera poziomu debugowania.
     */
    public function getDebugLevel(): string;

    /**
     * Pobiera flagę debugowania z konfiguracji.
     *
     * @return bool Flaga debugowania.
     * @throws ElmtsException Jeśli konfiguracja nie zawiera flagi debugowania.
     */
    public function getDebug(): bool;
}
