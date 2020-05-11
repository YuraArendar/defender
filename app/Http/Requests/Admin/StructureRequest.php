<?php

namespace App\Http\Requests\Admin;

use App\Admin\Contracts\EntityRequestOperationsContractor;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StructureRequest
 * @package App\Http\Requests\Admin
 */
class StructureRequest extends FormRequest implements EntityRequestOperationsContractor
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $id = $this->route()->parameter('structure');
        $aliasRule = self::ALIAS_RULE . ($id === null ? '' : ',id,:structure');

        return [
            'alias' => $aliasRule,
            'name' => 'required|max:255',
            'template' => 'required|max:12',
            'controller' => 'required|max:12',
            'locale' => 'required|size:2',
        ];
    }
}
