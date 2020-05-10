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
     * @param array $parameters
     * @return mixed
     */
    public function store(array $parameters);

    /**
     * @param int $id
     * @param array $parameters
     * @return mixed
     */
    public function update(int $id, array $parameters);

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id);
}
