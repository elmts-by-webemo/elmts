<?php

namespace Elmts\Core\Interfaces;

/**
 * Interfejs ILogger definiujący metody do logowania różnych typów wiadomości.
 * 
 * Implementując ten interfejs, klasa może dostarczyć mechanizm logowania
 * dla błędów, ostrzeżeń oraz informacji.
 * 
 * @package Elmts\Core\Interfaces
 * @version 1.0
 * - creationDate 2024-04-18
 * - modificationDate 2024-04-18
 * - gptName simplyPHPDoc-Gen
 */
interface ILogger
{
    /**
     * Loguje wiadomość błędu.
     *
     * @param string $message Treść wiadomości błędu.
     * @param array|null $params Dodatkowe parametry dla wiadomości błędu.
     * @throws ElmtsException Wyrzucany, gdy wystąpi błąd podczas logowania.
     * @return void
     */
    public function error(string $message, ?array $params): void;

    /**
     * Loguje wiadomość ostrzeżenia.
     *
     * @param string $message Treść wiadomości ostrzeżenia.
     * @param array|null $params Dodatkowe parametry dla wiadomości ostrzeżenia.
     * @throws ElmtsException Wyrzucany, gdy wystąpi błąd podczas logowania.
     * @return void
     */
    public function warning(string $message, ?array $params): void;

    /**
     * Loguje informacyjną wiadomość.
     *
     * @param string $message Treść informacyjnej wiadomości.
     * @param array|null $params Dodatkowe parametry dla informacyjnej wiadomości.
     * @throws ElmtsException Wyrzucany, gdy wystąpi błąd podczas logowania.
     * @return void
     */
    public function info(string $message, ?array $params): void;

    /**
     * Loguje wiadomość debugującą.
     *
     * @param string $message Treść wiadomości debugującej.
     * @param array|null $params Dodatkowe parametry dla wiadomości debugującej.
     * @return void
     */
    public function debug(string $message, ?array $params): void;

    /**
     * Loguje wiadomość o typie "notice".
     *
     * @param string $message Treść wiadomości typu notice.
     * @param array|null $params Dodatkowe parametry dla wiadomości typu notice.
     * @return void
     */
    public function notice(string $message, ?array $params): void;
    
    /**
     * Loguje krytyczną wiadomość.
     *
     * @param string $message Treść krytycznej wiadomości.
     * @param array|null $params Dodatkowe parametry dla krytycznej wiadomości.
     * @return void
     */
    public function critical(string $message, ?array $params): void;
    
     /**
     * Loguje alarmującą wiadomość.
     *
     * @param string $message Treść alarmującej wiadomości.
     * @param array|null $params Dodatkowe parametry dla alarmującej wiadomości.
     * @return void
     */   
    public function alert(string $message, ?array $params): void;
    
    /**
     * Loguje wiadomość o sytuacji awaryjnej.
     *
     * @param string $message Treść wiadomości o sytuacji awaryjnej.
     * @param array|null $params Dodatkowe parametry dla wiadomości o sytuacji awaryjnej.
     * @return void
     */  
    public function emergency(string $message, ?array $params): void;

    /**
     * Ustawia nazwę loggera.
     *
     * @param string $name Nazwa loggera.
     * @return void
     */
    public function setName(string $name): void;

    /**
     * Ustawia miejsce zapisu logów.
     *
     * @param string $path Ścieżka do miejsca zapisu logów.
     * @return void
     */
    public function setLogPath(string $path): void;
}
