<?php

namespace App\Http\Requests\Admin;

use App\Admin\Contracts\EntityRequestOperationsContractor;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ContentStructureRequest
 * @package App\Http\Requests\Admin
 */
class ContentStructureRequest extends FormRequest implements EntityRequestOperationsContractor
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
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'locale' => 'required|size:2',
            'content_id' => 'required|integer',
        ];
    }
}
