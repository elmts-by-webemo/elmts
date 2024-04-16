<?php
namespace Elmts\Core\Loaders;

use Pecee\SimpleRouter\ClassLoader\IClassLoader;
use Pecee\SimpleRouter\Exceptions\ClassNotFoundHttpException;
use Psr\Container\ContainerInterface;

/**
 * Loader klas do integracji PHP-DI z Pecee SimpleRouter.
 * 
 * Loader klas wykorzystuje kontener iniekcji zależności do dynamicznego
 * rozwiązywania i instancjonowania klas, metod klas oraz funkcji anonimowych (closures),
 * zapewniając elastyczny sposób zarządzania zależnościami w kontrolerach lub funkcjach
 * wywoływanych przez router.
 * 
 * @package Elmts\Core\Loaders
 */
class RouterClassLoader implements IClassLoader
{
    /**
     * Instancja kontenera DI.
     *
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Konstruktor dla klasy RouterClassLoader.
     * 
     * Przyjmuje kontener iniekcji zależności implementujący interfejs PSR-11 ContainerInterface.
     *
     * @param ContainerInterface $container Kontener iniekcji zależności.
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Ładuje klasę po jej nazwie.
     * 
     * Ta metoda próbuje rozwiązać i zwrócić instancję klasy
     * z kontenera DI. Jeśli klasa nie zostanie znaleziona w kontenerze,
     * rzucany jest wyjątek ClassNotFoundHttpException.
     *
     * @param string $class Pełna nazwa kwalifikowana klasy.
     * @return object Zwraca instancję rozwiązanej klasy.
     * @throws ClassNotFoundHttpException Jeśli klasa nie istnieje w kontenerze.
     */
    public function loadClass(string $class)
    {
        if (!$this->container->has($class)) {
            throw new ClassNotFoundHttpException($class, null, sprintf('Class "%s" does not exist', $class), 404, null);
        }
        return $this->container->get($class);
    }

    /**
     * Wywołuje metodę klasy z podanymi parametrami.
     * 
     * Ta metoda używa kontenera DI do rozwiązania instancji klasy, a następnie
     * wywołuje określoną metodę na tej instancji, przekazując podane parametry.
     *
     * @param object $class Instancja klasy lub nazwa klasy.
     * @param string $method Nazwa metody do wywołania.
     * @param array $parameters Parametry przekazywane do metody.
     * @return string Wynik wywołania metody.
     */
    public function loadClassMethod($class, string $method, array $parameters)
    {
        return (string)$this->container->call([$class, $method], $parameters);
    }

    /**
     * Wykonuje funkcję anonimową (closure) z podanymi parametrami.
     * 
     * Ta metoda bezpośrednio wywołuje podaną funkcję anonimową, przekazując podane parametry.
     * Uwaga: Rozwiązanie kontenera DI nie jest stosowane do funkcji anonimowych.
     *
     * @param callable $closure Funkcja anonimowa do wykonania.
     * @param array $parameters Parametry przekazywane do funkcji anonimowej.
     * @return string Wynik wykonania funkcji anonimowej.
     */
    public function loadClosure(callable $closure, array $parameters)
    {
        return (string)call_user_func_array($closure, $parameters);
    }
}
