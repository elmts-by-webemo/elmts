<?php

namespace Elmts\Core\Interfaces;

/**
 * Interfejs dla kontrolera widoku, określający metody do reagowania na akcje użytkownika i prezentowania odpowiednich widoków lub komponentów.
 *
 * @package Elmts\Core\Interfaces
 */
interface IViewController
{
    /**
     * Obsługuje żądanie i prezentuje odpowiedni widok.
     *
     * @param string $viewName Nazwa widoku do załadowania.
     * @param array $data Dane do przekazania do widoku.
     */
    public function showView(string $viewName, array $data = []): void;

    /**
     * Obsługuje żądanie i prezentuje odpowiedni komponent.
     *
     * @param string $componentName Nazwa komponentu do załadowania.
     * @param array $data Dane do przekazania do komponentu.
     */
    public function showComponent(string $componentName, array $data = []): void;

    /**
     * Wyświetla częściowy widok (partial) na podstawie podanej ścieżki i opcjonalnych parametrów.
     * Ta metoda może być używana do renderowania mniejszych fragmentów strony, takich jak nagłówki,
     * stopki, komponenty nawigacyjne itp.
     *
     * @param string $filePath Ścieżka do pliku częściowego widoku.
     * @param array|null $params Opcjonalne parametry do przekazania do częściowego widoku.
     */
    public function showPartial(string $filePath, ?array $params = []): void;
}
