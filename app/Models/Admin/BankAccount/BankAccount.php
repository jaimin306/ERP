<?php

namespace App\Models\Admin\BankAccount;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    //
    protected $table = 'bank_account_details';
    protected $fillable = ['account_type_id', 'bank_name', 'account_no', 'account_holder', 'branch_name', 'micr_code', 'ifsc_code', 'bank_address'];
}
