<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Admpr;

class Admod extends Model
{
    public $timestamps = false;
    protected $table = 'admod';
    protected $primaryKey = 'admodmodn';

    public function admprs()
    {
        return $this->hasMany(Admpr::class,'admprmodn','admodmodn');
    }
}
