<?php
namespace Elmts\Core\Facades;

use Elmts\Core\Helpers\ArrayHelper;
use Elmts\Core\Exceptions\ElmtsException;

/**
 * Klasa fasady HelperFacade służy jako pośrednik do wywoływania statycznych metod
 * pomocniczych zarejestrowanych w mapie pomocników.
 *
 * @package Elmts\Core\Facades
 * @version 1.0.1
 * - creation_date 2024-04-18
 * - modification_date 2024-04-25
 * - gpt_name simplyPHPDoc-Gen
 */
class HelperFacade
{
    /**
     * Mapa przechowująca odniesienia do klas pomocniczych.
     *
     * @var array
     */
    private static $helperMap = [
        'ArrayHelper' => ArrayHelper::class,
    ];

    /**
     * Metoda służąca do wywoływania statycznych metod zarejestrowanych pomocników.
     * 
     * @param string $name Nazwa metody do wywołania.
     * @param array $arguments Argumenty przekazywane do metody.
     * @return mixed Wynik wywołanej metody pomocnika.
     * @throws ElmtsException Gdy metoda nie istnieje w pomocniku.
     */
    public static function __callStatic($name, $arguments)
    {
        foreach (self::$helperMap as $helper) {
            if (method_exists($helper, $name)) {
                return call_user_func_array([$helper, $name], $arguments);
            }
        }
        throw new ElmtsException("The $name method does not exist in the registered helpers.");
    }
}
?>
