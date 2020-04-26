<?php

namespace App\Http\Requests\Admin;

use App\Admin\Contracts\EntityRequestOperationsContractor;
use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'alias' => self::ALIAS_RULE,
            'name' => 'required|max:255',
            'template' => 'required|max:12',
            'controller' => 'required|max:12',
            'parent_id' => 'sometimes|integer',
            'id' => 'sometimes|integer',
            'locale' => 'required|size:2',
        ];
    }
}
