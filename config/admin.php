<?php

use App\Admin\Services\StructuresService;
use App\Http\Controllers\Admin\StructureController;

return [
    'controllers_contracts_binding' => [
        StructureController::class => StructuresService::class,
    ]
];
