<?php

namespace App\Admin\Services;

use App\Admin\Contracts\EntitiesOperationsContractor;
use App\Models\Content;
use App\Models\ContentMeta;

/**
 * Class ContentMetaOperationsService
 * @package App\Admin\Services
 */
class ContentMetaOperationsService implements EntitiesOperationsContractor
{
    /**
     * @param array $parameters
     * @return ContentMeta
     */
    public function store(array $parameters): ContentMeta
    {
        return ContentMeta::create($parameters);
    }

    /**
     * @param int $id
     * @param array $parameters
     * @return ContentMeta
     */
    public function update(int $id, array $parameters): ContentMeta
    {
        $meta = ContentMeta::findOrFail($id);

        $meta->update($parameters);

        return $meta;
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
