<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseOperationsController;
use Illuminate\Contracts\Pagination\Paginator;
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

    /**
     * @param int $structureId
     * @return JsonResponse
     */
    public function pagination(int $structureId): JsonResponse
    {
        /** @var Paginator $pagination */
        $pagination = $this->entitiesData->pagination($structureId);

        return response()->json([
            'items' => $pagination->items(),
            'pagination' => [
                'currentPage' => $pagination->currentPage(),
                'firstItem' => $this->entitiesData->fistListId($structureId),
                'lastItem' => $this->entitiesData->lastListId($structureId),
                'perPage' => $pagination->perPage(),
                'total' => $pagination->total(),
            ],
        ]);
    }
}
