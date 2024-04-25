<?php
namespace Elmts\Core\Facades;

use Elmts\Core\Services\DiContainerService;
use Elmts\Core\Interfaces\ILogger;
use Elmts\Core\Exceptions\ElmtsException;

/**
 * Klasa fasady AppFacade służy jako pośrednik do wywoływania metod kontrolerów
 * zdefiniowanych w mapie kontrolerów.
 *
 * @package Elmts\Core\Facades
 * @version 1.0.0
 * - creation_date 2024-04-18
 * - modification_date 2024-04-18
 * - gpt_name simplyPHPDoc-Gen
 */
class AppFacade
{
    /**
     * Mapa przechowująca odniesienia do klas kontrolerów.
     *
     * @var array
     */
    private static $controllerMap=[
        'AppController'=>AppController::class,
    ];

    /**
     * Metoda służąca do wywoływania statycznych metod zarejestrowanych kontrolerów.
     * 
     * @param string $name Nazwa metody do wywołania.
     * @param array $arguments Argumenty przekazywane do metody.
     * @return mixed Wynik wywołanej metody kontrolera.
     * @throws ElmtsException Gdy metoda nie istnieje w kontrolerze.
     */
    public static function __callStatic($name, $arguments)
    {
        foreach(self::$controllerMap as $controller)
        {
            if (method_exists($controller, $name))
            {
                return call_user_func_array([$controller, $name], $arguments);
            }
        }
        throw new ElmtsException("The $name method does not exist in the ResourceController.");
    }

    /**
     * Ustawia logi w zależności od typu logowania.
     *
     * @param string|null $log Wiadomość logu.
     * @param string|null $type Typ logowania (np. 'info', 'error').
     * @param array|null $params Dodatkowe parametry dla logu.
     * @return void
     */
    public static function setLog(?string $log, ?string $type='info',?array $params=[])
    {
        $containerDi = DiContainerService::getInstance();
        $logger = $containerDi->get(ILogger::class);
        
        match ($type) {
            'debug' => $logger->debug($log, $params),
            'info' => $logger->info($log, $params),
            'notice' => $logger->notice($log, $params),
            'warning' => $logger->warning($log, $params),
            'error' => $logger->error($log, $params),
            'critical' => $logger->critical($log, $params),
            'alert' => $logger->alert($log, $params),
            'emergency' => $logger->emergency($log, $params),
            default => $logger->info($log, $params)
        };
    }
}