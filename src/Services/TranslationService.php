<?php

namespace Elmts\Core\Services;

use Elmts\Core\Interfaces\ITranslationService;
use Elmts\Core\Interfaces\ILocationLoader;
use Elmts\Core\Exceptions\ElmtsException;

class TranslationService implements ITranslationService
{
    private static $instance = null;
    private $translations = [];
    private $variables = [];

    private $locationLoader;
    private $currentLanguage;

    private function __construct(ILocationLoader $locationLoader, $language = APP_LOCALE)
    {
        $this->locationLoader = $locationLoader;
        $this->setLanguage($language);
    }

    public static function getInstance(ILocationLoader $locationLoader, $language = APP_LOCALE): TranslationService
    {
        if (self::$instance === null) {
            self::$instance = new self($locationLoader, $language);
        }
        return self::$instance;
    }

    public function setLanguage($language)
    {
        try {
            $this->translations = $this->locationLoader->load($language);
            $this->variables = $this->locationLoader->loadVariables($language);
            $this->currentLanguage = $language;
        } catch (ElmtsException $e) {
            throw new ElmtsException("Could not load translations or variables for language: $language", 0, $e);
        }
    }

    public function get(string $key, string $default = ''): string
    {
        return $this->translations[$key] ?? $default;
    }

    public function getVariable(string $key, $default = null)
    {
        return $this->variables[$key] ?? $default;
    }
}
