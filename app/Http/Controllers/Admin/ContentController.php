<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseOperationsController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class ContentController
 * @package App\Http\Controllers\Admin
 */
class ContentController extends BaseOperationsController
{
    /**
     * @param Request $request
     * @param int $contentId
     * @return JsonResponse
     */
    public function active(Request $request, int $contentId): JsonResponse
    {
        return response()->json($this->entitiesOperations->setActive($contentId, $request->get('active')));
    }

    /**
     * @param int $contentId
     * @param int $structureId
     * @return JsonResponse
     */
    public function up(int $contentId, int $structureId): JsonResponse
    {
        return response()->json($this->entitiesOperations->up($contentId, $structureId));
    }

    /**
     * @param int $contentId
     * @param int $structureId
     * @return JsonResponse
     */
    public function down(int $contentId, int $structureId): JsonResponse
    {
        return response()->json($this->entitiesOperations->down($contentId, $structureId));
    }
}
