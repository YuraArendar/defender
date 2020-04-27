<?php

namespace App\Admin\Services;

use App\Admin\Contracts\EntitiesOperationsContractor;
use App\Models\Structure;
use Illuminate\Support\Collection;

/**
 * Class StructuresService
 * @package App\Admin\Services
 */
class StructuresService implements EntitiesOperationsContractor
{
    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Structure::all()->toTree();
    }

    /**
     * @param array $parameters
     * @return Structure
     */
    public function store(array $parameters): Structure
    {
        return Structure::create($parameters);
    }

    /**
     * @param int $id
     * @param array $parameters
     * @return Structure
     */
    public function update(int $id, array $parameters): Structure
    {
        $structure = Structure::findOrFail($id);
        $structure->update($parameters);

        return $structure;
    }

    /**
     * @param int $id
     * @return Structure
     */
    public function show(int $id): Structure
    {
        return Structure::withTranslation()->findOrFail($id);
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function destroy(int $id): Collection
    {
        Structure::destroy($id);

        return $this->all();
    }
}
