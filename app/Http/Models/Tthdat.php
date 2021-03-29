<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Tthpgp;
use App\Http\Models\Tthbon;

class Tthdat  extends Model
{
    public $timestamps = false;
    protected $table = 'tthdat';
    //protected $primaryKey = 'admodmodn';
    protected $fillable = ['tthdatcage', 'tthdattcol', 'tthdattper', 'tthdattcon','tthdatgere', 'tthdatdepa', 'tthdattare', 'tthdatgrup',
    'tthdatnive', 'tthdatcate',  'tthdatosbs', 'tthdatncar','tthdatspen', 'tthdatcusp', 'tthdatestd', 'tthdatmrcb','tthdatfpro', 'tthdatfreg', 'tthdathora', 'tthdatusrn'];

    public function pago()
    {
        return $this->hasOne(Tthpgp::class,'tthpgpcage','tthdatcage');
    }

    public function bonos()
    {
        return $this->hasMany(Tthbon::class,'tthboncage','tthdatcage');
    }
}
