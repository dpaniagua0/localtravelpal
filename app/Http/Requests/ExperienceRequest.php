<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ExperienceRequest extends Request
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
            'title' => 'required|min:3',
            'location' => 'required',
            'description' => 'required|min:30',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'owner_id' => 'required',
            'min_capacity' => 'required|integer',
            'max_capacity' => 'required|integer'
        ];
    }
}
