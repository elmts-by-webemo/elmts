<?php

namespace Elmts\Core\Interfaces;

/**
 * Interfejs definiujący podstawowe operacje na ciasteczkach (cookies).
 *
 * Pozwala na ustawianie, pobieranie oraz usuwanie ciasteczek w aplikacji,
 * zapewniając abstrakcję nad bezpośrednim dostępem do globalnej tablicy $_COOKIE
 * i funkcji setcookie().
 *
 * @package Elmts\Core\Interfaces
 */
interface ICookieService
{
    /**
     * Ustawia ciasteczko o określonej nazwie, wartości i czasie życia.
     *
     * @param string $name Nazwa ciasteczka.
     * @param string $value Wartość ciasteczka.
     * @param int $expiry Czas życia ciasteczka w sekundach od teraz. Domyślnie 3600 sekund (1 godzina).
     * @param string $path Ścieżka, dla której ciasteczko jest dostępne. Domyślnie '/'.
     * @param string $domain Domena, dla której ciasteczko jest dostępne.
     * @param bool $secure Określa, czy ciasteczko powinno być przesyłane tylko przez HTTPS.
     * @param bool $httpOnly Określa, czy ciasteczko powinno być dostępne tylko przez protokół HTTP,
     *                       co czyni je niedostępnym dla skryptów klienta.
     * @return bool Zwraca true, jeśli ustawienie ciasteczka się powiodło, false w przeciwnym przypadku.
     */
    public function set(string $name, string $value, int $expiry = 3600, string $path = '/', string $domain = '', bool $secure = false, bool $httpOnly = true): bool;

    /**
     * Pobiera wartość ciasteczka o określonej nazwie.
     *
     * @param string $name Nazwa ciasteczka do pobrania.
     * @return string|null Wartość ciasteczka, jeśli istnieje, w przeciwnym razie null.
     */
    public function get(string $name): ?string;

    /**
     * Usuwa ciasteczko o określonej nazwie.
     *
     * @param string $name Nazwa ciasteczka do usunięcia.
     * @return void
     */
    public function delete(string $name): void;
}