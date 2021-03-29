<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Admdt;

class Admpr extends Model
{
    public $timestamps = false;
    protected $table = 'admpr';
    //protected $primaryKey = 'admin_id';

    public function admdts()
    {
        //return $this->hasMany(Admdt::class,'admdtmprn','admprmprn')->where('admdt.admdtmdtn', '=', 1);
        return $this->hasMany(Admdt::class,'admdtmprn','admprmprn')->take(10);
    }
}
