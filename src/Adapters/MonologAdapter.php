<?php

namespace Elmts\Core\Adapters;

use Elmts\Core\Interfaces\ILogger;
use App\Config\LoggerConfig;
use Monolog\Level;
use Monolog\Logger as MonologLogger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
// 
use Elmts\Core\Exceptions\ElmtsException;

/**
 * Klasa MonologAdapter jest adapterem dla biblioteki Monolog, implementującym interfejs ILogger.
 * 
 * Dzięki temu adapterowi, możemy korzystać z funkcji logowania dostarczanych przez Monolog
 * zgodnie z wymaganiami interfejsu ILogger. Konfiguracja loggera jest pobierana z LoggerConfig.
 * 
 * @package Elmts\Core\Adapters
 */
class MonologAdapter implements ILogger
{
    private MonologLogger $logger;

    /**
     * Konstruktor klasy MonologAdapter.
     *
     * @param LoggerConfig $config Konfiguracja dla loggera.
     * @throws ElmtsException Wyrzucany, gdy wystąpi błąd podczas konfiguracji loggera.
     */
    public function __construct(LoggerConfig $config)
    {
        try {
            $name = $config->getLoggerName();
            $logPath = $config->getLoggerPath();
            $currentLogDate=date('Y-m-d');
            $logFile = $logPath."/{$currentLogDate}.log";

            $this->logger = new MonologLogger($name);
            $this->logger->pushHandler(new StreamHandler($logFile));
        } catch (\Exception $e) {
            throw new ElmtsException('Error occurred while configuring logger: ' . $e->getMessage());
        }
    }
    /**
     * Loguje wiadomość błędu.
     *
     * @param string $message Treść wiadomości błędu.
     * @return void
     */
    public function error(string $message): void
    {
        $this->logger->error($message);
    }

    /**
     * Loguje wiadomość ostrzeżenia.
     *
     * @param string $message Treść wiadomości ostrzeżenia.
     * @return void
     */
    public function warning(string $message): void
    {
        $this->logger->warning($message);
    }

    /**
     * Loguje informacyjną wiadomość.
     *
     * @param string $message Treść informacyjnej wiadomości.
     * @return void
     */
    public function info(string $message): void
    {
        $this->logger->info($message);
    }

    /**
     * Ustawia nazwę loggera.
     *
     * @param string $name Nazwa loggera.
     * @return void
     */
    public function setName(string $name): void
    {
        $this->logger->setName($name);
    }

    /**
     * Ustawia miejsce zapisu logów.
     *
     * @param string $path Ścieżka do miejsca zapisu logów.
     * @return void
     */
    public function setLogPath(string $path): void
    {
        $this->logger->popHandler();
        $this->logger->pushHandler(new StreamHandler($path));
    }
}