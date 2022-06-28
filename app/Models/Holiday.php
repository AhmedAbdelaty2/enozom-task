<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable=[
        'id',
        'summary',
        'start',
        'end',
        'country_id',
    ];

    public function country() {
        return $this->belongsTo(Country::class);
    }
}
