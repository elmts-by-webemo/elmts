<?php

namespace Elmts\Core\Interfaces;

use Elmts\Core\Interfaces\ILogger;
use Elmts\Core\Exceptions\ElmtsException;

/**
 * Interfejs ILoggerFactory definiujący metodę do tworzenia instancji adapterów logowania.
 * 
 * Implementując ten interfejs, fabryka może dostarczyć różne implementacje adapterów logowania.
 * 
 * @package Elmts\Core\Interfaces
 */
interface ILoggerFactory
{
    /**
     * Tworzy instancję adaptera logowania.
     *
     * @return ILogger Instancja adaptera logowania.
     * @throws \RuntimeException Wyrzucany, gdy wystąpi błąd podczas tworzenia adaptera logowania.
     */
    public function createLogger(): ILogger;
}