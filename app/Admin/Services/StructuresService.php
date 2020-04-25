<?php

namespace App\Admin\Services;

use App\Admin\Contracts\EntitiesOperationsInterface;
use App\Models\Structure;
use Illuminate\Support\Collection;

/**
 * Class StructuresService
 * @package App\Admin\Services
 */
class StructuresService implements EntitiesOperationsInterface
{
    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Structure::all();
    }

    /**
     * @param array $parameters
     * @return Structure
     */
    public function store(array $parameters): Structure
    {
        $parameters[$parameters['locale']]['content'] = $parameters['content'];
        $parameters[$parameters['locale']]['name'] = $parameters['name'];
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

        $structure->translate($parameters['locale'])->name = $parameters['name'];
        $structure->translate($parameters['locale'])->content = $parameters['content'];

        return $structure;
    }

    /**
     * @param int $id
     * @return Structure
     */
    public function show(int $id): Structure
    {
        return Structure::findOrFail($id)->withTranslation();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        return (bool)Structure::destroy($id);
    }
}
