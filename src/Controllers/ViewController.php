<?php

namespace Elmts\Core\Controllers;

use Elmts\Core\Interfaces\IViewController;
use Elmts\Core\Interfaces\IViewLoader;
use Elmts\Core\Interfaces\ILoggerFactory;
use Elmts\Core\Interfaces\ILogger;
use Elmts\Core\Exceptions\ElmtsException;

/**
 * Kontroler odpowiadający za zarządzanie procesem renderowania widoków w aplikacji.
 * Obejmuje to wyświetlanie widoków, widoków częściowych, komponentów i zasobów,
 * delegując konkretne zadania do loadera widoków, zgodnie z zasadami SOLID.
 *
 * @package Elmts\Core\Controllers
 */
class ViewController implements IViewController
{
    /**
     * Loader widoków używany do ładowania i renderowania widoków oraz komponentów.
     *
     * @var IViewLoader
     */
    private $viewLoader;

     /**
     * Instancja loggera używana do logowania w kontrolerze.
     *
     * @var ILogger
     */
    private $logger;

    /**
     * Konstruktor klasy ViewController.
     *
     * Inicjalizuje loader widoków oraz loggera.
     *
     * @param IViewLoader $viewLoader Loader widoków używany do ładowania widoków i komponentów.
     * @param ILoggerFactory $loggerFactory Fabryka używana do tworzenia instancji loggera.
     */
    public function __construct(IViewLoader $viewLoader, ILoggerFactory $loggerFactory)
    {
        $this->viewLoader = $viewLoader;
        $this->logger = $loggerFactory->createLogger();
    }

     /**
     * Ładuje i wyświetla główny widok na podstawie podanej ścieżki i opcjonalnych parametrów.
     *
     * @param string $path Ścieżka do pliku widoku.
     * @param array|null $params Opcjonalne parametry przekazywane do widoku.
     * @throws ElmtsException W przypadku problemów z ładowaniem widoku.
     */
    public function showView(string $path, ?array $params = []): void
    {
        try {
            echo $this->viewLoader->load($path, $params);
        } catch (\Exception $e) {
            throw new ElmtsException("Problem with loading the view: $path", 0, $e);
        }
    }

    /**
     * Ładuje i wyświetla komponent na podstawie podanej ścieżki i opcjonalnych parametrów.
     *
     * @param string $filePath Ścieżka do pliku komponentu.
     * @param array|null $params Opcjonalne parametry przekazywane do komponentu.
     * @throws ElmtsException W przypadku problemów z ładowaniem komponentu.
     */
    public function showComponent(string $filePath, ?array $params = []): void
    {
        try {
            echo $this->viewLoader->loadComponent($filePath, $params);
        } catch (\Exception $e) {
            throw new ElmtsException("Problem with loading the component: $filePath", 0, $e);
        }
    }

    /**
     * Ładuje i wyświetla widok częściowy (partial) na podstawie podanej ścieżki i opcjonalnych parametrów.
     * Używane do renderowania mniejszych części strony, takich jak nagłówki, stopki itp.
     *
     * @param string $filePath Ścieżka do pliku widoku częściowego.
     * @param array|null $params Opcjonalne parametry przekazywane do widoku częściowego.
     * @throws ElmtsException W przypadku problemów z ładowaniem widoku częściowego.
     */
    public function showPartial(string $filePath, ?array $params = []): void
    {
        try {
            echo $this->viewLoader->loadPartial($filePath, $params);
        } catch (\Exception $e) {
            throw new ElmtsException("Problem with loading the partial view: $filePath", 0, $e);
        }
    }
}