<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User;

class UserRequest extends Request
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
        $user = User::find($this);
        switch($this->method())
        {
            case 'POST':
            {
                return [
                    'name' => 'required',
                    'users.*.email' => 'required|email|unique:users',
                    'password' => 'required|min:6',
                    'confirm_password' => 'required|same:password|min:6',
                    'role_list' => 'required'
                ];
            }
            case 'PATCH':
            {
                return [
                    'name' => 'required',
                    'users.*.email' => 'required|email|unique:users',
                  //  'password' => 'required|min:6',
                    //'confirm_password' => 'required|same:password|min:6'
                ];
            }

            default:break;
        }
    }
}
