<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    const MALE = 'male';
    const FEMALE = 'female';
    const AGE_LESS_THAN_1 = '<1';
    const AGE_1_TO_2 = '1to2';
    const AGE_2_TO_5 = '2to5';
    const AGE_5_TO_10 = '5to10';
    const AGE_MORE_THAN_10 = '>10';
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rescuser_id',
        'name',
        'image',
        'type',
        'breed',
        'age',
        'gender',
        'description',
        'status'
    ];
}
