<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Role;

class RoleRequest extends Request
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
        $role = Role::find($this->roles);
        switch($this->method())
        {
            case 'POST':
            {
                return [
                    'name' => 'required|min:3',
                    'display_name' => 'required|min:3|unique:roles,name',
                ];
            }
            case 'PATCH':
            {
                return [
                    'name' => 'required|min:3',
                    'display_name' => 'required|min:3|unique:roles,name,'.$role->id,
                ];
            }
            default:break;
        }
    }
}
