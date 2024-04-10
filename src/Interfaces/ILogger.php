<?php

namespace Elmts\Core\Interfaces;

/**
 * Interfejs ILogger definiujący metody do logowania różnych typów wiadomości.
 * 
 * Implementując ten interfejs, klasa może dostarczyć mechanizm logowania
 * dla błędów, ostrzeżeń oraz informacji.
 * 
 * @package Elmts\Core\Interfaces
 */
interface ILogger
{
    /**
     * Loguje wiadomość błędu.
     *
     * @param string $message Treść wiadomości błędu.
     * @throws ElmtsException Wyrzucany, gdy wystąpi błąd podczas logowania.
     * @return void
     */
    public function error(string $message): void;

    /**
     * Loguje wiadomość ostrzeżenia.
     *
     * @param string $message Treść wiadomości ostrzeżenia.
     * @throws ElmtsException Wyrzucany, gdy wystąpi błąd podczas logowania.
     * @return void
     */
    public function warning(string $message): void;

    /**
     * Loguje informacyjną wiadomość.
     *
     * @param string $message Treść informacyjnej wiadomości.
     * @throws ElmtsException Wyrzucany, gdy wystąpi błąd podczas logowania.
     * @return void
     */
    public function info(string $message): void;

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
