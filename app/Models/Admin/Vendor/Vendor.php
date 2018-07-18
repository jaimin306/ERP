<?php

namespace App\Models\Admin\Vendor;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    //
    protected $fillable = ['first_name', 'last_name', 'country_id', 'state_id', 'city', 'zipcode', 'email', 'contact_number', 'additional_contact_number', 'vendor_code', 'vendor_type_id', 'address_line1', 'address_line2', 'fax_no', 'discount_days', 'discount_percentage', 'term_days', 'tax_id_no', 'taxable_amount', 'consumer_user_tax', 'balance_owed', 'date_opened', 'account_status', 'bank_account_id' ];
}
