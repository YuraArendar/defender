<?php

namespace App\Admin\Services;

use App\Admin\Contracts\EntitiesOperationsContractor;
use App\Models\Structure;
use App\Models\StructureMeta;

/**
 * Class StructureMetaOperationsService
 * @package App\Admin\Services
 */
class StructureMetaOperationsService implements EntitiesOperationsContractor
{
    /**
     * @param array $parameters
     * @return StructureMeta
     */
    public function store(array $parameters): StructureMeta
    {
        return StructureMeta::create($parameters);
    }

    /**
     * @param int $id
     * @param array $parameters
     * @return StructureMeta
     */
    public function update(int $id, array $parameters): StructureMeta
    {
        $structure = Structure::findOrFail($id);

        $structure->meta->update($parameters);

        return $structure->meta;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        return true;
    }
}
