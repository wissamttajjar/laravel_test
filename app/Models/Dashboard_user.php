<?php

namespace App\Models;

use App\Models\year_user;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dashboard_user extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_name',
        'email',
        'password',
        'phone_number',
        'role'
    ];
    protected $primaryKey = 'duser_id';
    public function year_user()
    {
        return $this->hasMany(year_user::class);
    }
}
