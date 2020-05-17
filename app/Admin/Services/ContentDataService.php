<?php

namespace App\Admin\Services;

use App\Admin\Contracts\EntitiesDataContractor;
use App\Models\Content;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

/**
 * Class ContentDataService
 * @package App\Admin\Services
 */
class ContentDataService implements EntitiesDataContractor
{
    /**
     * @return Collection
     */
    public function all(): Collection
    {
        $request = request();

        $structureId = $request->get('structure_id');
        $orderBy = $request->get('orderBy');
        $way = $request->get('way');

        return Content::where('structure_id', $structureId)->orderBy($orderBy, $way)->get();
    }

    /**
     * @param int $id
     * @return Content
     */
    public function show(int $id): Content
    {
        return Content::withTranslation()->findOrFail($id);
    }

    /**
     * @param int $structureId
     * @return Paginator
     */
    public function pagination(int $structureId): Paginator
    {
        $request = request();

        $orderBy = $request->get('orderBy');
        $way = $request->get('way');
        $perPage = $request->get('perPage');

        return Content::where('structure_id', $structureId)->orderBy($orderBy, $way)->paginate($perPage);
    }

    /**
     * @param int $structureId
     * @return int
     */
    public function fistListId(int $structureId): int
    {
        $request = request();

        $orderBy = $request->get('orderBy');
        $way = $request->get('way');

        return Content::where('structure_id', $structureId)->orderBy($orderBy, $way)->firstOrFail()->id;
    }

    /**
     * @param int $structureId
     * @return int
     */
    public function lastListId(int $structureId): int
    {
        $request = request();

        $orderBy = $request->get('orderBy');
        $way = $request->get('way');

        if ($way === 'asc') {
            $way = 'desc';
        } else {
            $way = 'asc';
        }

        return Content::where('structure_id', $structureId)->orderBy($orderBy, $way)->firstOrFail()->id;
    }
}
