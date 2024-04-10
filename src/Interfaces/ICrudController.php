<?php

namespace Elmts\Core\Interfaces;

interface ICrudController
{
    /**
     * Wyświetl listę zasobów.
     */
    public function index();

    /**
     * Pokaż formularz do tworzenia nowego zasobu.
     */
    public function create();

    /**
     * Zapisz nowo utworzony zasób.
     *
     * @param array $data Dane do utworzenia zasobu.
     */
    public function store($data);

    /**
     * Wyświetl pojedynczy zasób.
     *
     * @param int $id Identyfikator zasobu.
     */
    public function show($id);

    /**
     * Pokaż formularz do edycji istniejącego zasobu.
     *
     * @param int $id Identyfikator zasobu.
     */
    public function edit($id);

    /**
     * Zaktualizuj istniejący zasób.
     *
     * @param array $data Dane do aktualizacji zasobu.
     * @param int $id Identyfikator zasobu.
     */
    public function update($data, $id);

    /**
     * Usuń istniejący zasób.
     *
     * @param int $id Identyfikator zasobu.
     */
    public function destroy($id);
}
