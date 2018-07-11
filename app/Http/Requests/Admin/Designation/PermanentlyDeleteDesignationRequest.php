<?php

namespace App\Http\Requests\Admin\State;

use App\Http\Requests\Request;

/**
 * Class PermanentlyDeleteUserRequest
 * @package App\Http\Requests\Backend\Access\User
 */
class PermanentlyDeleteStateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('permanently-delete-courses');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
