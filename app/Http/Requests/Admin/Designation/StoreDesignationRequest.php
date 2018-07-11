<?php

namespace App\Http\Requests\Admin\Designation;

use App\Http\Requests\Request;

/**
 * Class StoreUserRequest
 * @package App\Http\Requests\Backend\Access\User
 */
class StoreDesignationRequest extends Request
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
            'designation_name'                  => 'required',
            'department_id'                  => 'required'
        ];
    }
}
