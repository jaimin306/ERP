<?php

namespace App\Http\Requests\Admin\User;

use App\Http\Requests\Request;

/**
 * Class StoreUserRequest
 * @package App\Http\Requests\Backend\Access\User
 */
class StoreUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return access()->allow('create-countries');
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
            'user_name'                  => 'required',
            'department_id'                  => 'required',
            'designation_id'                  => 'required',
            //'email'                  => 'required',
            'email' => 'required|email|unique:users',
            'password'                  => 'required',
            'first_name'                  => 'required',
            'last_name'                  => 'required'
        ];
    }
}
