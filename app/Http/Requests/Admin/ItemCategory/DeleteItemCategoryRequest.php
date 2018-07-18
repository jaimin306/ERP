<?php


namespace App\Http\Requests\Adnin\ItemCategory;

use App\Http\Requests\Request;

/**
 * Class PermanentlyDeleteUserRequest
 * @package App\Http\Requests\Backend\Access\User
 */
class DeleteItemCategoryRequest extends Request
{
    //echo "string";die;
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
            //
        ];
    }
}
