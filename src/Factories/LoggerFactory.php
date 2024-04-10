<?php
namespace Elmts\Core\Factories;

use Elmts\Core\Interfaces\ILoggerFactory;
use Elmts\Core\Interfaces\ILogger;
use App\Config\MainConfig;
use App\Config\LoggerConfig;
use Elmts\Core\Adapters\MonologAdapter;
use Elmts\Core\Exceptions\ElmtsException;

/**
 * Klasa LoggerFactory służy do tworzenia instancji adapterów logowania.
 * Implementacja interfejsu ILoggerFactory definiuje metodę createLogger(),
 * która tworzy i zwraca instancję adaptera logowania opartego na Monologu.
 * 
 * Klasa wykorzystuje konfigurację aplikacji przekazaną przez MainConfig do 
 * stworzenia konfiguracji dla loggera, co umożliwia elastyczne zarządzanie 
 * ustawieniami logowania w różnych środowiskach.
 *
 * @package Elmts\Core\Factories
 */
class LoggerFactory implements ILoggerFactory
{
    /**
     * Instancja MainConfig używana do konfiguracji loggera.
     *
     * @var MainConfig
     */
    private $mainConfig;

    /**
     * Konstruktor klasy LoggerFactory przyjmujący MainConfig.
     *
     * @param MainConfig $mainConfig Instancja MainConfig zawierająca ustawienia konfiguracyjne aplikacji.
     */
    public function __construct(MainConfig $mainConfig)
    {
        $this->mainConfig = $mainConfig;
    }

    /**
     * Tworzy i zwraca instancję adaptera logowania.
     * 
     * Metoda korzysta z konfiguracji aplikacji dostarczonej przez MainConfig
     * do stworzenia i konfiguracji instancji LoggerConfig, która następnie 
     * jest używana do stworzenia i zwrócenia adaptera logowania opartego na Monologu.
     *
     * @return ILogger Instancja adaptera logowania.
     * @throws \RuntimeException Wyjątek rzucany w przypadku błędu podczas tworzenia adaptera logowania.
     */
    public function createLogger(): ILogger
    {
        try {
            return new MonologAdapter(new LoggerConfig($this->mainConfig));
        } catch (ElmtsException $exception) {
            throw new \RuntimeException('Error creating logger: ' . $exception->getMessage());
        }
    }
}
