<?php

namespace App\Admin\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Interface EntitiesOperationsContractor
 * @package App\Admin\Contracts
 */
interface EntitiesOperationsContractor
{
    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param array $parameters
     * @return Collection
     */
    public function store(array $parameters): Collection;

    /**
     * @param int $id
     * @param array $parameters
     * @return Collection
     */
    public function update(int $id, array $parameters): Collection;

    /**
     * @param int $id
     * @return Model
     */
    public function show(int $id);

    /**
     * @param int $id
     * @return Collection
     */
    public function destroy(int $id): Collection;
}
