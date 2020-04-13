<?php

namespace App\Http\Controllers;

use App\Admin\Contracts\ModelOperationsInterface;

abstract class BaseOperationsController extends Controller
{
    /**
     * @var ModelOperationsInterface
     */
    private $modelOperations;

    /**
     * BaseOperationsController constructor.
     * @param ModelOperationsInterface $modelOperations
     */
    public function __construct(ModelOperationsInterface $modelOperations)
    {
        $this->modelOperations = $modelOperations;
    }


}
