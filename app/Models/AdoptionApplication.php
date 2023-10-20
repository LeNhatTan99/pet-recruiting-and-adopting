<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdoptionApplication extends Model
{
    use HasFactory;

    const PENDING = 'pending';
    const REJECT = 'reject';
    const ACCEPT = 'accept';
        /**
     * @var string
     */
    protected $table = 'adoption_applications';

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'animal_id',
        'user_id',
        'application_date',
        'status',
        'reason',
    ];
            /**
     * search status 
     * @return array
     */
    public static function getStatus() {
        return [
            self::REJECT => 'reject',
            self::ACCEPT => 'accept',
            self::PENDING => 'pending',
        ];
    }
}
