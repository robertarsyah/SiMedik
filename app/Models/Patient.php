<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'nik',
        'name',
        'gender',
        'birth_date',
        'address',
        'phone'
    ];
}
