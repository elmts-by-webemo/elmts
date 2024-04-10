<?php
namespace Elmts\Core\Services;

use Elmts\Core\Interfaces\ICookieService;
use Elmts\Core\Exceptions\ElmtsException;

/**
 * Serwis do obsługi ciasteczek (cookies) w aplikacji.
 *
 * Implementuje interfejs ICookieService, dostarczając podstawowe metody
 * do zarządzania ciasteczkami, takie jak pobieranie i ustawianie wartości ciasteczek.
 * Zawiera także metodę do usuwania ciasteczek.
 *
 * @package Elmts\Core\Services
 */
class CookieService implements ICookieService {
    /**
     * Pobiera wartość ciasteczka o podanej nazwie.
     *
     * @param string $name Nazwa ciasteczka, którego wartość jest pobierana.
     * @return string|null Wartość ciasteczka lub null, jeśli ciasteczko o danej nazwie nie istnieje.
     */
    public function get(string $name): ?string {
        return $_COOKIE[$name] ?? null;
    }

    /**
     * Ustawia ciasteczko o określonej nazwie, wartości i czasie wygaśnięcia.
     *
     * @param string $name Nazwa ciasteczka, które ma zostać ustawione.
     * @param string $value Wartość ciasteczka.
     * @param int $expiry Czas wygaśnięcia ciasteczka w sekundach od obecnej chwili.
     * @param string $path Ścieżka, dla której ciasteczko jest dostępne. Domyślnie '/'.
     * @param string $domain Domena, dla której ciasteczko jest dostępne.
     * @param bool $secure Określa, czy ciasteczko powinno być przesyłane tylko przez HTTPS.
     * @param bool $httpOnly Określa, czy ciasteczko powinno być dostępne tylko przez protokół HTTP.
     * @return bool Zwraca true, jeśli ustawienie ciasteczka się powiodło, false w przeciwnym przypadku.
     * @throws ElmtsException Jeśli ciasteczko nie może zostać ustawione.
     */
    public function set(string $name, string $value, int $expiry = 3600, string $path = '/', string $domain = '', bool $secure = false, bool $httpOnly = true): bool {
        $result = setcookie($name, $value, time() + $expiry, $path, $domain, $secure, $httpOnly);
        if (!$result) {
            throw new ElmtsException("Failed to set cookie: {$name}.");
        }
        return $result;
    }

    /**
     * Usuwa ciasteczko o podanej nazwie.
     *
     * @param string $name Nazwa ciasteczka, które ma zostać usunięte.
     */
    public function delete(string $name): void {
        setcookie($name, '', time() - 3600, "/");
    }
}