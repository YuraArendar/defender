<?php

namespace App\Admin\Services;

use App\Admin\Contracts\EntitiesOperationsContractor;
use App\Models\Content;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;

/**
 * Class ContentOperationsService
 * @package App\Admin\Services
 */
class ContentOperationsService implements EntitiesOperationsContractor
{
    /**
     * @param array $parameters
     * @return Content
     */
    public function store(array $parameters): Content
    {
        $position = Content::where('structure_id', $parameters['structure_id'])->max('position');
        $parameters['position'] = ++$position;
        return Content::create($parameters);
    }

    /**
     * @param int $id
     * @param array $parameters
     * @return Content
     */
    public function update(int $id, array $parameters): Content
    {
        $content = Content::findOrFail($id);

        foreach ($parameters as $key => $value) {
            if (property_exists($content, $key) && $content->$key === $value) {
                unset($parameters[$key]);
            }
        }

        try {
            $content->update($parameters);
        } catch (QueryException $exception) {
            if (strpos($exception->getMessage(), '1062 Duplicate entry') !== false) {
                abort(422, json_encode(['errors' => ['alias' => [trans('validation.unique', ['attribute' => 'alias'])]]]));
            }
        }

        return $content;
    }

    /**
     * @param int $id
     * @return int|mixed
     */
    public function destroy(int $id)
    {
        return Content::destroy($id);
    }

    /**
     * @param int $id
     * @param bool $active
     * @return bool
     */
    public function setActive(int $id, bool $active): bool
    {
        $content = Content::findOrFail($id);

        $content->active = $active;

        return $content->save();
    }

    /**
     * @param int $contentId
     * @param int $structureId
     * @return Collection
     */
    public function up(int $contentId, int $structureId): Collection
    {
        $item = Content::findOrFail($contentId);
        $topItem = Content::where('structure_id', $structureId)
            ->where('position', '>', $item->position)
            ->orderBy('position')
            ->firstOrFail();

        $item->position++;
        $topItem->position--;
        $item->save();
        $topItem->save();
        return Content::where('structure_id', $structureId)->orderByDesc('position')->get();
    }

    /**
     * @param int $contentId
     * @param int $structureId
     * @return Collection
     */
    public function down(int $contentId, int $structureId): Collection
    {
        $item = Content::findOrFail($contentId);
        $bottomItem = Content::where('structure_id', $structureId)
            ->where('position', '<', $item->position)
            ->orderByDesc('position')
            ->firstOrFail();

        $item->position--;
        $bottomItem->position++;
        $item->save();
        $bottomItem->save();
        return Content::where('structure_id', $structureId)->orderByDesc('position')->get();
    }
}
