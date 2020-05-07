<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuitemUpdateRequest extends FormRequest
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
            'slug' => 'required|max:20|unique:menuitems,slug,' . $this->route('menuitem')->id,
            'name' => 'required|max:50',
            'is_enable' => 'required',
            'menu_id' => 'required',
        ];
    }
}
