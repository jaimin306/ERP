<?php

namespace App\Models\Admin\User;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //

    protected $fillable = ['user_name', 'department_id', 'designation_id', 'phone', 'website', 'first_name', 'last_name', 'email', 'password', 'last_ip', 'last_login'];
}
