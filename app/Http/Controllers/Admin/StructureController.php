<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseOperationsController;
use Illuminate\Http\JsonResponse;

/**
 * Class StructureController
 * @package App\Http\Controllers\Admin
 */
class StructureController extends BaseOperationsController
{
    /**
     * @param int $structure
     * @return JsonResponse
     */
    public function up(int $structure): JsonResponse
    {
        return response()->json($this->entitiesOperations->up($structure));
    }

    /**
     * @param int $structure
     * @return JsonResponse
     */
    public function down(int $structure): JsonResponse
    {
        return response()->json($this->entitiesOperations->down($structure));
    }
}
