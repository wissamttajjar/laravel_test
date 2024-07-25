<?php

namespace App\Models;

use App\Models\contract;
use App\Models\Semester;
use App\Models\year_user;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class year extends Model
{
    use HasFactory;
    protected $fillable = [
        'year_date',
        'start_date',
        'end_date'
    ];

    protected $primaryKey = 'year_id';
    public function year_user()
    {
        return $this->hasMany(year_user::class);
    }

    public function semester()
    {
        return $this->hasMany(Semester::class);
    }

    public function contract()
    {
        return $this->hasMany(contract::class);
    }
}
