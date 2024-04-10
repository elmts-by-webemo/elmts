<?php

namespace Elmts\Core\Interfaces;

// Upewnij się, że importujesz ContainerBuilder zamiast ContainerInterface
use DI\ContainerBuilder;

/**
 * Interfejs dla konfiguracji kontenera DI.
 */
interface IDiContainerConfig {
    /**
     * Konfiguruje kontener DI poprzez dodawanie zależności.
     *
     * Zmieniamy typ argumentu z ContainerInterface na ContainerBuilder,
     * aby był zgodny z tym, co faktycznie jest używane do konfiguracji kontenera.
     *
     * @param ContainerBuilder $builder Kontener DI do konfiguracji.
     */
    public function configure(ContainerBuilder $builder): void;
}
