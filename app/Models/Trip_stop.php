<?php

namespace App\Models;

use App\Models\stop;
use App\Models\trip;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trip_stop extends Model
{
    use HasFactory;
    protected $fillable = [

        'trip_id',
        'stop_id'
    ];

    protected $primaryKey = 'trip_stop_id';
    public function trip()
    {
        return $this->belongsTo(trip::class);
    }

    public function stop()
    {
        return $this->belongsTo(stop::class);
    }
}
