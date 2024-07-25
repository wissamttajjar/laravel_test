<?php

namespace App\Models;

use App\Models\year;
use App\Models\Dashboard_user;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class year_user extends Model
{
    use HasFactory;
    protected $fillable = [
        'duser_id',
        'year_id'
    ];

    protected $primaryKey = 'yuser_id';
    public function year()
    {
        return $this->belongsTo(year::class);
    }

    public function dash_user()
    {
        return $this->belongsTo(Dashboard_user::class);
    }
}
