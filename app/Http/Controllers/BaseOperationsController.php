<?php

namespace App\Http\Controllers;

use App\Admin\Contracts\EntitiesDataContractor;
use App\Admin\Contracts\EntitiesOperationsContractor;
use App\Admin\Contracts\EntityRequestOperationsContractor;
use Illuminate\Http\JsonResponse;

/**
 * Class BaseOperationsController
 * @package App\Http\Controllers
 */
abstract class BaseOperationsController extends Controller
{
    /**
     * @var EntitiesOperationsContractor
     */
    protected $entitiesOperations;

    /**
     * @var EntitiesDataContractor
     */
    protected $entitiesData;

    /**
     * BaseOperationsController constructor.
     * @param EntitiesOperationsContractor $entitiesOperations
     * @param EntitiesDataContractor $entitiesData
     */
    public function __construct(EntitiesOperationsContractor $entitiesOperations, EntitiesDataContractor $entitiesData)
    {

        $this->entitiesOperations = $entitiesOperations;
        $this->entitiesData = $entitiesData;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->entitiesData->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EntityRequestOperationsContractor $request
     * @return JsonResponse
     */
    public function store(EntityRequestOperationsContractor $request): JsonResponse
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
        return response()->json($this->entitiesData->show($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EntityRequestOperationsContractor $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(EntityRequestOperationsContractor $request, int $id): JsonResponse
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
