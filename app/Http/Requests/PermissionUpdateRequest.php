<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'slug' => 'required|max:20|unique:permissions,slug,' . $this->route('permission')->id,
            'name' => 'required|max:50',
            'model' => 'required',
            'action' => 'required',
            'by_group' => 'required',
        ];
    }
}
