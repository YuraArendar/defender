<?php

use App\Admin\Services\ContentDataService;
use App\Admin\Services\ContentMetaDataService;
use App\Admin\Services\ContentMetaOperationsService;
use App\Admin\Services\ContentOperationsService;
use App\Admin\Services\StructureDataService;
use App\Admin\Services\StructureMetaDataService;
use App\Admin\Services\StructureMetaOperationsService;
use App\Admin\Services\StructureOperationsService;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\ContentMetaController;
use App\Http\Controllers\Admin\StructureController;
use App\Http\Controllers\Admin\StructureMetaController;
use App\Http\Requests\Admin\ContentRequest;
use App\Http\Requests\Admin\ContentStructureRequest;
use App\Http\Requests\Admin\MetaStructureRequest;
use App\Http\Requests\Admin\StructureRequest;

return [
    'controllers_contracts_operations_binding' => [
        StructureController::class => StructureOperationsService::class,
        StructureMetaController::class => StructureMetaOperationsService::class,
        ContentController::class => ContentOperationsService::class,
        ContentMetaController::class => ContentMetaOperationsService::class,
    ],
    'controllers_contracts_data_binding' => [
        StructureController::class => StructureDataService::class,
        StructureMetaController::class => StructureMetaDataService::class,
        ContentController::class => ContentDataService::class,
        ContentMetaController::class => ContentMetaDataService::class,
    ],
    'controllers_request_binding' => [
        'structures' => StructureRequest::class,
        'structures-meta' => MetaStructureRequest::class,
        'content' => ContentRequest::class,
        'content-meta' => ContentStructureRequest::class,
    ],
];
