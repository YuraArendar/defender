<?php

use App\Admin\Services\StructuresService;
use App\Http\Controllers\Admin\StructureController;
use App\Http\Requests\Admin\StructureRequest;

return [
    'controllers_contracts_binding' => [
        StructureController::class => StructuresService::class,
    ],
    'controllers_request_binding' => [
        'structures' => StructureRequest::class,
    ],
];
