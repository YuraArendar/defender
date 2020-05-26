<?php

namespace App\Admin\Services;

use App\Admin\Contracts\EntitiesDataContractor;
use App\Models\Content;
use Illuminate\Support\Collection;

/**
 * Class ContentMetaDataService
 * @package App\Admin\Services
 */
class ContentMetaDataService implements EntitiesDataContractor
{
    public function show(int $id)
    {
        return Content::findOrFail($id)->meta;
    }

    public function all(): Collection
    {
        return new Collection([]);
    }
}
