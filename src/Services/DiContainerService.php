<?php

namespace Elmts\Core\Services;

use App\Config\DiContainerConfig;
use Elmts\Core\Interfaces\IDiContainerService;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Elmts\Core\Exceptions\ElmtsException;

/**
 * Serwis kontenera DI zapewniający globalny dostęp do skonfigurowanego kontenera DI,
 * używając biblioteki PHP-DI. Implementuje wzorzec Singleton, aby zapewnić jedną instancję
 * kontenera DI w całej aplikacji.
 *
 * @package Elmts\Core\Services
 */
class DiContainerService implements IDiContainerService {
    /**
     * Jedyna instancja kontenera DI.
     *
     * @var ContainerInterface|null
     */
    private static $instance = null;

    /**
     * Zwraca globalną instancję kontenera DI.
     *
     * @return ContainerInterface Instancja kontenera DI.
     * @throws ElmtsException W przypadku problemów z inicjalizacją kontenera.
     */
    public static function getInstance(): ContainerInterface {
        if (self::$instance === null) {
            $builder = new ContainerBuilder();
            $diContainerConfig = new DiContainerConfig();
            
            $diContainerConfig->configure($builder);
            
            try {
                self::$instance = $builder->build();
            } catch (\Exception $e) {
                throw new ElmtsException("Failed to initialize DI container: " . $e->getMessage());
            }
        }

        return self::$instance;
    }

    /**
     * Prywatny konstruktor zapobiega tworzeniu nowych instancji z zewnątrz klasy.
     */
    private function __construct() {}

    /**
     * Blokuje klonowanie instancji klasy.
     */
    private function __clone() {}

    /**
     * Blokuje deserializację instancji klasy.
     */
    public function __wakeup() {
        throw new ElmtsException("Cannot unserialize a singleton.");
    }
}