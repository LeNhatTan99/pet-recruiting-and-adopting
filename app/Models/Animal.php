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
    const AVAILABLE  = 'available';
    const UNAVAILABLE  = 'unavailable';
    const PENDING = 'pending';
    const CANCEL  = 'cancel';
    const IN_PROGRESS = 'in progress';
    const NEED_DONATE = 'need donate';
    const BREED_NATIVE_DOG = 'Native Dog';
    const BREED_NON_NATIVE_DOG = 'Non-native Dog';
    const BREED_NATIVE_CAT = 'Native Cat';
    const BREED_NON_NATIVE_CAT = 'Non-native Cat';
    const TYPE_DOG = 'Dog';
    const TYPE_CAT = 'Cat';

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rescuer_id',
        'name',
        'image',
        'type',
        'breed',
        'age',
        'gender',
        'description',
        'status'
    ];

        /**
     * search status 
     * @return array
     */
    public static function getStatus() {
        return [
            self::AVAILABLE => 'available',
            self::UNAVAILABLE => 'unavailable',
            self::IN_PROGRESS => 'in progress',
            self::NEED_DONATE => 'need donate',
            self::CANCEL  => 'cancel',
            self::PENDING => 'pending',
        ];
    }
}
