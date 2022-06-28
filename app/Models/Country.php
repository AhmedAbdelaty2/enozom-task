<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'city_id',
        'city_name',
    ];

    public function holiday() {
        return $this->hasMany(Holiday::class);
    }
}
