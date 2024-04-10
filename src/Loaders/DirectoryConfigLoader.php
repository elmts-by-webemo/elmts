<?php

namespace Elmts\Core\Loaders;

use Elmts\Core\Interfaces\IDirectoryConfigLoader;
use Elmts\Core\Interface\IConfigLoaderStrategy;
use Elmts\Core\Exceptions\ElmtsException;


/**
 * Ładowacz konfiguracji z katalogu.
 *
 * Odpowiada za ładowanie konfiguracji z plików znajdujących się w określonym katalogu
 * i scalanie ich w jedną tablicę konfiguracyjną. Obsługuje różne formaty plików
 * poprzez zastosowanie strategii ładowania.
 *
 * @package Elmts\Core\Loaders
 */
class DirectoryConfigLoader implements IDirectoryConfigLoader {
    /**
     * Lista strategii ładowania konfiguracji.
     *
     * @var ConfigLoaderStrategy[]
     */
    private $loaderStrategies;

    /**
     * Konstruktor klasy DirectoryConfigLoader.
     *
     * @param IConfigLoaderStrategy[] $loaderStrategies Strategie do ładowania plików konfiguracyjnych.
     */
    public function __construct(array $loaderStrategies) {
        $this->loaderStrategies = $loaderStrategies;
    }

    /**
     * Ładuje konfiguracje z plików w określonym katalogu.
     *
     * @param string $directoryPath Ścieżka do katalogu z plikami konfiguracyjnymi.
     * @return array Złączona tablica konfiguracji.
     * @throws ElmtsException Gdy wystąpi problem z odczytem katalogu lub plików.
     */
    public function loadConfigurations(string $directoryPath): array {
        if (!is_dir($directoryPath)) {
            throw new ElmtsException("The specified path does not exist or is not a directory: {$directoryPath}");
        }

        $aggregatedConfig = [];

        foreach ($this->loaderStrategies as $extension => $strategy) {
            $configFiles = glob($directoryPath . '/*.' . $extension);
            
            foreach ($configFiles as $file) {
                try {
                    $config = $strategy->load($file);
                    $aggregatedConfig = array_merge($aggregatedConfig, $config);
                } catch (\Throwable $e) {
                    throw new ElmtsException("Error loading configuration from file {$file}: {$e->getMessage()}", 0, $e);
                }
            }
        }

        return $aggregatedConfig;
    }
}
