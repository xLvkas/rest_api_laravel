<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $table = 'students';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'gender'
    ];
}
