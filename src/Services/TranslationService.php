<?php

namespace Elmts\Core\Services;

use Elmts\Core\Interfaces\ITranslationService;
use Elmts\Core\Interfaces\ITranslationLoader;
use Elmts\Core\Exceptions\ElmtsException;

class TranslationService implements ITranslationService
{
    private static $instance = null;
    private $translations = [];
    private $variables = [];

    private $translationLoader;
    private $currentLanguage;

    private function __construct(ITranslationLoader $translationLoader, $language = envParam('APP_LOCALE'))
    {
        $this->translationLoader = $translationLoader;
        $this->setLanguage($language);
    }

    public static function getInstance(ITranslationLoader $translationLoader, $language = envParam('APP_LOCALE')): TranslationService
    {
        if (self::$instance === null) {
            self::$instance = new self($translationLoader, $language);
        }
        return self::$instance;
    }

    public function setLanguage($language)
    {
        try {
            $this->translations = $this->translationLoader->load($language);
            $this->variables = $this->translationLoader->loadVariables($language);
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

    /**
     * Zwraca tłumaczenie dla podanego klucza.
     * 
     * Jeśli tłumaczenie dla klucza nie zostanie znalezione, zwraca sam klucz.
     * Rzuca ElmtsException w przypadku problemów z dostępem do tłumaczeń.
     *
     * @param string $key Klucz tłumaczenia do pobrania.
     * @throws ElmtsException W przypadku problemów z pobraniem tłumaczenia.
     * @return string Tłumaczenie dla klucza lub klucz, jeśli tłumaczenie nie zostanie znalezione.
     */
    public function translate(string $key): string
    {
        try {
            return $this->translations[$key] ?? $key;
        } catch (ElmtsException $e) {
            throw $e;
        }
    }
}
