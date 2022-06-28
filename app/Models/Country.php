<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public function format(){
        return[
            'id'=>$this->country_id,
            'name'=>$this->country_name,
        ];
    }

    protected $fillable=[
        'id',
        'country_id',
        'country_name',
    ];

    public function holiday() {
        return $this->hasMany(Holiday::class);
    }
}
