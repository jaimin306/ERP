<?php

namespace App\Http\Requests\Admin\User;

use App\Http\Requests\Request;

/**
 * Class UpdateUserRequest
 * @package App\Http\Requests\Backend\Access\User
 */
class UpdateUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return access()->allow('edit-countries');
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
            'email' => 'required|email',
            'first_name'                  => 'required',
            'last_name'                  => 'required'
        ];
    }
}
