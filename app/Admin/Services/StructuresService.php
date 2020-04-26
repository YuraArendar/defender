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
     * @return Collection
     */
    public function store(array $parameters): Collection
    {
        Structure::create($parameters);

        return $this->all();
    }

    /**
     * @param int $id
     * @param array $parameters
     * @return Collection
     */
    public function update(int $id, array $parameters): Collection
    {
        $structure = Structure::findOrFail($id);
        $structure->update($parameters);

        return $this->all();
    }

    /**
     * @param int $id
     * @return Structure
     */
    public function show(int $id): Structure
    {
        return Structure::findOrFail($id)->withTranslation()->first();
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
