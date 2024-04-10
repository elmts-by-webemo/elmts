<?php
namespace Elmts\Core\Handlers;

use Elmts\Core\Interfaces\ILoggerService;

class ErrorHandler implements IErrorHandler
{
    private ILoggerService $logger;

    public function __construct(ILoggerService $logger)
    {
        $this->logger = $logger;
    }

    public function registerErrorHandler(): void
    {
        set_error_handler([$this, 'handleError']);
    }

    public function registerExceptionHandler(): void
    {
        set_exception_handler([$this, 'handleException']);
    }

    public function registerShutdownFunction(): void
    {
        register_shutdown_function([$this, 'handleShutdown']);
    }

    public function handleError($errno, $errstr, $errfile, $errline): void
    {
        $this->logger->logError("Error ({$errno}): {$errstr} in {$errfile} on line {$errline}");
    }

    public function handleException($exception): void
    {
        $this->logger->logError("Uncaught Exception: " . $exception->getMessage());
    }

    public function handleShutdown(): void
    {
        $error = error_get_last();
        if ($error !== null) {
            $this->logger->logError("Fatal Error: {$error['message']} in {$error['file']} on line {$error['line']}");
        }
    }
}