<?php

namespace App\Http\Requests\Admin\Vendor;

use App\Http\Requests\Request;

/**
 * Class StoreUserRequest
 * @package App\Http\Requests\Backend\Access\User
 */
class StoreVendorRequest extends Request
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
            "vendor_type_id" => "required",
            "country_id" => "required",
            "state_id" => "required",
            "first_name" => "required",
            "last_name" => "required",
            'email' => 'required|email',
        ];
    }
}
