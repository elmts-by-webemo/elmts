<?php

namespace Elmts\Core\Services;

use Elmts\Core\Interfaces\ITranslationService;
use Elmts\Core\Interfaces\ITranslationLoader;
use Elmts\Core\Exceptions\ElmtsException;

/**
 * Usługa singletonowa do obsługi tłumaczeń.
 * Ta klasa zarządza tłumaczeniami oraz zmiennymi związanymi z różnymi językami.
 * 
 * @package Elmts\Core\Services
 * @version 1.0.0
 * - created 2024-04-18
 * - modified 2024-04-18
 * - GPT simplyPHPDoc-Gen
 */
class TranslationService implements ITranslationService
{
    /**
     * Jedyna instancja klasy.
     * 
     * @var self|null
     */
    private static $instance = null;

    /**
     * Tablica przechowująca tłumaczenia.
     * 
     * @var array
     */
    private $translations = [];
    
    /**
     * Tablica przechowująca zmienne używane w tłumaczeniach.
     * 
     * @var array
     */
    private $variables = [];

    /**
     * Ładowarka do pobierania tłumaczeń.
     * 
     * @var ITranslationLoader
     */
    private $translationLoader;
    
    /**
     * Aktualny język dla tłumaczeń.
     * 
     * @var string
     */
    private $currentLanguage;

    /**
     * Konstruuje nową instancję usługi tłumaczeniowej.
     *
     * @param ITranslationLoader $translationLoader Ładowarka danych tłumaczeniowych.
     * @param string $language Początkowy język do ustawienia.
     */
    private function __construct(ITranslationLoader $translationLoader, $language='')
    {
        $this->translationLoader = $translationLoader;
        $this->setLanguage($language);
    }

    /**
     * Zapobiega klonowaniu instancji singletona.
     */
    private function __clone() {}

    /**
     * Zapobiega deserializacji instancji singletona.
     *
     * @throws ElmtsException Jeśli próba deserializacji zostanie podjęta.
     */
    public function __wakeup() {
        throw new ElmtsException("Cannot unserialize a singleton.");
    }

    /**
     * Zwraca jedyną instancję klasy.
     *
     * @param ITranslationLoader $translationLoader Ładowarka danych tłumaczeniowych.
     * @param string $language Początkowy język do ustawienia, domyślnie APP_LOCALE jeśli nie podano.
     * @return self Jedyna instancja klasy.
     */
    public static function getInstance(ITranslationLoader $translationLoader, $language=''): self
    {
        if($language==''){
            $language=envParam('APP_LOCALE');
        }

        if (self::$instance === null) {
            self::$instance = new self($translationLoader, $language);
        }
        return self::$instance;
    }

    /**
     * Ustawia język dla tłumaczeń.
     *
     * @param string $language Język do ustawienia.
     * @throws ElmtsException Jeśli wystąpi błąd podczas ładowania tłumaczeń.
     */
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

    /**
     * Pobiera tłumaczenie na podstawie klucza, z opcjonalną domyślną wartością.
     *
     * @param string $key Klucz tłumaczenia.
     * @param string $default Domyślna wartość, jeśli klucz nie zostanie znaleziony.
     * @return string Tłumaczenie lub wartość domyślna.
     */
    public function get(string $key, string $default = ''): string
    {
        return $this->translations[$key] ?? $default;
    }

    /**
     * Pobiera zmienną tłumaczenia na podstawie klucza, z opcjonalną domyślną wartością.
     *
     * @param string $key Klucz zmiennej.
     * @param mixed $default Domyślna wartość, jeśli klucz nie zostanie znaleziony.
     * @return mixed Wartość zmiennej lub wartość domyślna.
     */
    public function getVariable(string $key, $default = null)
    {
        return $this->variables[$key] ?? $default;
    }

    /**
     * Zamienia zmienne w tekście, korzystając z wyrażeń regularnych.
     *
     * Metoda wyszukuje w podanym tekście wszystkie wystąpienia szablonów zmiennych
     * w formacie {{nazwaZmiennej}} i zamienia je na odpowiednie wartości.
     * Jeśli zmienna nie istnieje, zostanie zastąpiona domyślną wartością, która
     * jest formatem szablonu tej zmiennej.
     *
     * @param string $text Tekst, w którym mają zostać zamienione zmienne.
     * @return string Tekst z zamienionymi zmiennymi.
     */
    protected function replaceVariables(string $text): string {
        return preg_replace_callback('/{{(\w+)}}/', function ($matches) {
            $variableName = $matches[1];
            return $this->getVariable($variableName, "{{{$variableName}}}");
        }, $text);
    }

    /**
     * Tłumaczy podany klucz na obecny język. Zwraca klucz, jeśli tłumaczenie nie zostanie znalezione.
     * Rzuca wyjątek, jeśli wystąpi problem z dostępem do tłumaczeń.
     *
     * @param string $key Klucz tłumaczenia do przetłumaczenia.
     * @throws ElmtsException Jeśli wystąpi problem z pobraniem tłumaczenia.
     * @return string Przetłumaczony tekst lub klucz, jeśli tłumaczenie nie zostanie znalezione.
     */
    public function translate(string $key): string
    {
        try {
            $translation = $this->translations[$key] ?? $key;
            return $this->replaceVariables($translation);
        } catch (ElmtsException $e) {
            throw $e;
        }
    }
}
