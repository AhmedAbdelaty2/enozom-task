<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public function format(){
        return[
            'id'=>$this->id,
            'name'=>$this->summary,
            'starts-at'=>$this->start,
            'ends-at'=>$this->end,
        ];
    }

    protected $fillable=[
        'holiday_id',
        'summary',
        'start',
        'end',
        'country_id',
    ];

    public function country() {
        return $this->belongsTo(Country::class);
    }
}
