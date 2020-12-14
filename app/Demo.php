<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demo extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'company', 'phone'];
}
