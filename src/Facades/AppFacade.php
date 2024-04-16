<?php
namespace Elmts\Core\Facades;

use Elmts\Core\Services\DiContainerService;
use Elmts\Core\Interfaces\ILogger;
use Elmts\Core\Exceptions\ElmtsException;

class AppFacade
{
    private static $controllerMap=[
        'AppController'=>AppController::class,
    ];

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

    public static function setLog(?string $log)
    {
        $containerDi = DiContainerService::getInstance();
        $logger = $containerDi->get(ILogger::class);
        $logger->info($log);
    }
}