<?php

namespace Elmts\Core\Interfaces

/**
 * Interfejs strategii migracji.
 *
 * Zapewnia metody niezbędne do generowania treści migracji na podstawie
 * podanej nazwy tabeli.
 *
 * @package Elmts\Core\Interfaces
 */
interface IMigrationStrategy
{
    /**
     * Generuje treść migracji dla określonej tabeli.
     *
     * @param string $tableName Nazwa tabeli, dla której ma zostać wygenerowana migracja.
     * @return string Treść migracji.
     */
    public function generateMigrationContent($tableName): string;
}
