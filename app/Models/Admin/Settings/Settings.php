<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    //
    protected $table = "config";
    protected $fillable = ['company_name','company_phone','company_email', 'company_website', 'company_address', 'country_id', 'state_id', 'city', 'zip_code', 'email_host', 'email_username', 'email_password', 'date_format', 'time_format', 'company_logo', 'login_background'];
}
