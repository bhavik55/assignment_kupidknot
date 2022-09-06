<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'userid',
        'dob',
        'gender',
        'income',
        'occupation',
        'family',
        'manglik',
        'p_income',
        'p_occupation',
        'p_family',
        'p_manglik',
    ];
}
