<?php

namespace App\Admin\Services;

use App\Admin\Contracts\EntitiesDataContractor;
use App\Models\Content;
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
        return Content::all();
    }

    /**
     * @param int $id
     * @return Content
     */
    public function show(int $id): Content
    {
        return Content::withTranslation()->findOrFail($id);
    }
}
