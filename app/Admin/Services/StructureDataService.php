<?php

namespace App\Admin\Services;

use App\Admin\Contracts\EntitiesDataContractor;
use App\Models\Structure;
use Illuminate\Support\Collection;

/**
 * Class StructureDataService
 * @package App\Admin\Services
 */
class StructureDataService implements EntitiesDataContractor
{
    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Structure::defaultOrder()->get()->toTree();
    }

    /**
     * @param int $id
     * @return Structure
     */
    public function show(int $id): Structure
    {
        return Structure::withTranslation()->findOrFail($id);
    }
}
