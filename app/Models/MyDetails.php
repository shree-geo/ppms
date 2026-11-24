<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyDetails extends Model
{
    protected $fillable = ['id', 'first_name', 'last_name', 'address', 'phone', 'email', 'nationality'];
}
