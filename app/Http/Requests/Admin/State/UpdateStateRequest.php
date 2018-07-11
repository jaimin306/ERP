<?php

namespace App\Http\Requests\Admin\State;

use App\Http\Requests\Request;

/**
 * Class UpdateUserRequest
 * @package App\Http\Requests\Backend\Access\User
 */
class UpdateStateRequest extends Request
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
            'name'  => 'required',
            'country_id'  => 'required',
        ];
    }
}
