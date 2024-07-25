<?php

namespace App\Models;

use App\models\Trip_stop;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stop extends Model
{
    use HasFactory;
    protected $fillable = [
        'stop_name',
        'stop_location',

    ];

    protected $primaryKey = 'stop_id';
    public function trip_stop()
    {
        return $this->hasMany(Trip_stop::class);
    }
}
