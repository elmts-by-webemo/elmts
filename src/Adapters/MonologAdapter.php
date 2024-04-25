<?php

namespace Elmts\Core\Adapters;

use Elmts\Core\Interfaces\ILogger;
use App\Config\LoggerConfig;
use Monolog\Level;
use Monolog\Logger as MonologLogger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
 
use Elmts\Core\Exceptions\ElmtsException;

/**
 * Klasa MonologAdapter jest adapterem dla biblioteki Monolog, implementującym interfejs ILogger.
 * 
 * Dzięki temu adapterowi, możemy korzystać z funkcji logowania dostarczanych przez Monolog
 * zgodnie z wymaganiami interfejsu ILogger. Konfiguracja loggera jest pobierana z LoggerConfig.
 * 
 * @package Elmts\Core\Adapters
 * @version 1.1
 * - creationDate 2024-04-18
 * - modificationDate 2024-04-18
 * - gptName simplyPHPDoc-Gen
 */
class MonologAdapter implements ILogger
{
    /**
     * @var MonologLogger Instancja MonologLogger używana do logowania.
     */
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
            $debugLevel = $config->getDebugLevel();            
            $currentLogDate=date('Y-m-d');
            $logFile = $logPath."/{$currentLogDate}.log";

            $this->logger = new MonologLogger($name);
            $this->logger->pushHandler(new StreamHandler($logFile, MonologLogger::$debugLevel));
        } catch (\Exception $e) {
            throw new ElmtsException('Error occurred while configuring logger: ' . $e->getMessage());
        }
    }

    /**
     * Loguje wiadomość błędu.
     *
     * @param string $message Treść wiadomości błędu.
     * @param array|null $params Opcjonalne parametry dołączone do logowania.
     * @return void
     */
    public function error(string $message, ?array $params=[]): void
    {
        $this->logger->error($message, $params);
    }

    /**
     * Loguje wiadomość ostrzeżenia.
     *
     * @param string $message Treść wiadomości ostrzeżenia.
     * @param array|null $params Opcjonalne parametry dołączone do logowania.
     * @return void
     */
    public function warning(string $message, ?array $params=[]): void
    {
        $this->logger->warning($message, $params);
    }

    /**
     * Loguje informacyjną wiadomość.
     *
     * @param string $message Treść informacyjnej wiadomości.
     * @param array|null $params Opcjonalne parametry dołączone do logowania.
     * @return void
     */
    public function info(string $message, ?array $params=[]): void
    {
        $this->logger->info($message, $params);
    }

    /**
     * Loguje wiadomość debugującą.
     *
     * @param string $message Treść wiadomości debugującej.
     * @param array|null $params Opcjonalne parametry dołączone do logowania.
     * @return void
     */
    public function debug(string $message, ?array $params=[]): void
    {
        $this->logger->debug($message, $params);
    }

    /**
     * Loguje wiadomość o typie "notice".
     *
     * @param string $message Treść wiadomości typu notice.
     * @param array|null $params Opcjonalne parametry dołączone do logowania.
     * @return void
     */
    public function notice(string $message, ?array $params=[]): void
    {
        $this->logger->notice($message, $params);
    }

    /**
     * Loguje krytyczną wiadomość.
     *
     * @param string $message Treść krytycznej wiadomości.
     * @param array|null $params Opcjonalne parametry dołączone do logowania.
     * @return void
     */
    public function critical(string $message, ?array $params=[]): void
    {
        $this->logger->critical($message, $params);
    }

    /**
     * Loguje alarmującą wiadomość.
     *
     * @param string $message Treść alarmującej wiadomości.
     * @param array|null $params Opcjonalne parametry dołączone do logowania.
     * @return void
     */
    public function alert(string $message, ?array $params=[]): void
    {
        $this->logger->alert($message, $params);
    }

    /**
     * Loguje wiadomość o sytuacji awaryjnej.
     *
     * @param string $message Treść wiadomości o sytuacji awaryjnej.
     * @param array|null $params Opcjonalne parametry dołączone do logowania.
     * @return void
     */
    public function emergency(string $message, ?array $params=[]): void
    {
        $this->logger->emergency($message, $params);
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