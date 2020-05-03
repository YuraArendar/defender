<?php

namespace App\Admin\Services;

use App\Admin\Contracts\EntitiesOperationsContractor;
use App\Models\Structure;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

/**
 * Class StructureService
 * @package App\Admin\Services
 */
class StructureService implements EntitiesOperationsContractor
{
    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Structure::defaultOrder()->get()->toTree();
    }

    /**
     * @param array $parameters
     * @return Structure
     */
    public function store(array $parameters): Structure
    {
        $structure = Structure::create($parameters);
        Structure::fixTree();

        return $structure;
    }

    /**
     * @param int $id
     * @param array $parameters
     * @return Structure
     */
    public function update(int $id, array $parameters): Structure
    {
        $structure = Structure::findOrFail($id);

        foreach ($parameters as $key => $value) {
            if (property_exists($structure, $key) && $structure->$key === $value) {
                unset($parameters[$key]);
            }
        }

        try {
            $structure->update($parameters);
        } catch (QueryException $exception) {
            if (strpos($exception->getMessage(), '1062 Duplicate entry') !== false) {
                abort(422, json_encode(['errors' => ['alias' => [trans('validation.unique', ['attribute' => 'alias'])]]]));
            }
        }

        Structure::fixTree();

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
        Structure::fixTree();

        return $this->all();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function up(int $id): bool
    {
        Structure::findOrFail($id)->up();
        Structure::fixTree();

        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function down(int $id): bool
    {
        Structure::findOrFail($id)->down();
        Structure::fixTree();

        return true;
    }
}
