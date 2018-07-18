<?php

namespace App\Http\Requests\Admin\ItemType;

use App\Http\Requests\Request;

/**
 * Class PermanentlyDeleteUserRequest
 * @package App\Http\Requests\Backend\Access\User
 */
class PermanentlyDeleteItemTypeRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return access()->allow('permanently-delete-courses');
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
            //
        ];
    }
}
