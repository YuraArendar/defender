<?php

namespace App\Http\Requests\Admin;

use App\Admin\Contracts\EntityRequestOperationsContractor;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ContentRequest
 * @package App\Http\Requests\Admin
 */
class ContentRequest extends FormRequest implements EntityRequestOperationsContractor
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
        $id = $this->route()->parameter('content');
        $aliasRule = self::ALIAS_RULE . ($id === null ? '' : ',id,:content');

        return [
            'alias' => $aliasRule,
            'name' => 'required|max:255',
            'template' => 'required|max:12',
            'locale' => 'required|size:2',
            'structure_id' => 'required|integer|min:1',
        ];
    }
}
