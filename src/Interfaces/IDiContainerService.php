<?php

namespace Elmts\Core\Interfaces;

use Psr\Container\ContainerInterface;

/**
 * Interfejs dla kontenera DI, zapewniający dostęp do instancji kontenera DI.
 *
 * @package App\Container\Interfaces
 */
interface IDiContainerService {
    /**
     * Zwraca instancję kontenera DI.
     *
     * @return ContainerInterface
     */
    public static function getInstance(): ContainerInterface;
}
