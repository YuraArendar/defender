<?php

namespace App\Admin\Services;

use App\Admin\Contracts\EntitiesDataContractor;
use App\Models\Structure;
use Illuminate\Support\Collection;

/**
 * Class StructureMetaDataService
 * @package App\Admin\Services
 */
class StructureMetaDataService implements EntitiesDataContractor
{
    public function show(int $id)
    {
        return Structure::findOrFail($id)->meta;
    }

    public function all(): Collection
    {
        return new Collection([]);
    }
}
