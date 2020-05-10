<?php

namespace App\Admin\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Interface EntitiesDataContractor
 * @package App\Admin\Contracts
 */
interface EntitiesDataContractor
{
    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param int $id
     * @return Model
     */
    public function show(int $id);
}
