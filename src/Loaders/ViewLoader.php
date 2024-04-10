<?php

namespace Elmts\Core\Loaders;

use Elmts\Core\Interfaces\IViewLoader;
use Elmts\Core\Exceptions\ElmtsException;

/**
 * Loader widoków odpowiedzialny za ładowanie i dostarczanie zawartości plików widoków,
 * częściowych widoków i komponentów.
 *
 * Klasa ViewLoader umożliwia dynamiczne ładowanie zawartości z plików PHP lub HTML,
 * umożliwiając przekazywanie parametrów do widoków, co wspiera reużywalność i modularność kodu.
 *
 * @package Elmts\Core\Loaders
 */
class ViewLoader implements IViewLoader
{
    /**
     * Ładuje i zwraca zawartość widoku na podstawie podanej ścieżki.
     * Pozwala na przekazanie opcjonalnych parametrów, które mogą być użyte w widoku.
     *
     * @param string $path Ścieżka do pliku widoku.
     * @param array|null $params Opcjonalne parametry przekazywane do widoku.
     * @return string Zawartość załadowanego widoku.
     * * @throws ElmtsException Jeśli plik widoku nie zostanie znaleziony.
     */
    public function load(string $path, ?array $params = []): string
    {
        // if (!file_exists($path)) {
        //     throw new ElmtsException("View file not found: {$path}");
        // }

        if (!empty($params)) {
            extract($params);
        }

        if (file_exists($path)) {
            ob_start();
            include $path;
            $content = ob_get_clean();
        }else{
            $content="View file not found: {$path}";
        }
        return $content;
    }

    /**
     * Ładuje i zwraca zawartość częściowego widoku (partial) na podstawie podanej ścieżki.
     * Pozwala na przekazanie opcjonalnych parametrów, które mogą być użyte w częściowym widoku.
     *
     * @param string $filePath Ścieżka do pliku częściowego widoku.
     * @param array|null $params Opcjonalne parametry przekazywane do częściowego widoku.
     * @return string Zawartość załadowanego częściowego widoku.
     */
    public function loadPartial(string $filePath, ?array $params = []): string
    {
        return $this->load($filePath, $params);
    }

    /**
     * Ładuje i zwraca zawartość komponentu na podstawie podanej ścieżki.
     * Pozwala na przekazanie opcjonalnych parametrów, które mogą być użyte w komponencie.
     *
     * @param string $filePath Ścieżka do pliku komponentu.
     * @param array|null $params Opcjonalne parametry przekazywane do komponentu.
     * @return string Zawartość załadowanego komponentu.
     */
    public function loadComponent(string $filePath, ?array $params = []): string
    {
        return $this->load($filePath, $params);
    }
}
