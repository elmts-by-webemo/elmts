<?php

namespace Elmts\Core\Interfaces;

use Elmts\Core\Exceptions\ElmtsException;

/**
 * Interfejs loadera widoków, definiujący metody do ładowania głównych widoków, częściowych widoków (partials) i komponentów.
 *
 * @package Elmts\Core\Interfaces
 */
interface IViewLoader
{
    /**
     * Ładuje główny widok na podstawie podanej ścieżki i opcjonalnych parametrów
     * i zwraca jego zawartość jako ciąg znaków.
     *
     * @param string $path Ścieżka do pliku widoku.
     * @param array|null $params Opcjonalne parametry przekazywane do widoku.
     * @return string Zawartość załadowanego widoku.
     * @throws ElmtsException W przypadku problemu z ładowaniem widoku.
     */
    public function load(string $path, ?array $params = []): string;

    /**
     * Ładuje częściowy widok (partial) na podstawie podanej ścieżki i opcjonalnych parametrów
     * i zwraca jego zawartość jako ciąg znaków.
     *
     * @param string $filePath Ścieżka do pliku częściowego widoku.
     * @param array|null $params Opcjonalne parametry przekazywane do częściowego widoku.
     * @return string Zawartość załadowanego częściowego widoku.
     * @throws ElmtsException W przypadku problemu z ładowaniem częściowego widoku.
     */
    public function loadPartial(string $filePath, ?array $params = []): string;

    /**
     * Ładuje komponent na podstawie podanej ścieżki i opcjonalnych parametrów
     * i zwraca jego zawartość jako ciąg znaków.
     *
     * @param string $filePath Ścieżka do pliku komponentu.
     * @param array|null $params Opcjonalne parametry przekazywane do komponentu.
     * @return string Zawartość załadowanego komponentu.
     * @throws ElmtsException W przypadku problemu z ładowaniem komponentu.
     */
    public function loadComponent(string $filePath, ?array $params = []): string;
}