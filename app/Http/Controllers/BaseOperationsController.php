<?php

namespace App\Http\Controllers;

use App\Admin\Contracts\EntitiesOperationsInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class BaseOperationsController
 * @package App\Http\Controllers
 */
abstract class BaseOperationsController extends Controller
{
    /**
     * @var EntitiesOperationsInterface
     */
    private $entitiesOperations;

    /**
     * BaseOperationsController constructor.
     * @param EntitiesOperationsInterface $entitiesOperations
     */
    public function __construct(EntitiesOperationsInterface $entitiesOperations)
    {

        $this->entitiesOperations = $entitiesOperations;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->entitiesOperations->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        return response()->json($this->entitiesOperations->store($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json($this->entitiesOperations->show($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        return response()->json($this->entitiesOperations->update($id, $request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        return response()->json($this->entitiesOperations->destroy($id));
    }
}
