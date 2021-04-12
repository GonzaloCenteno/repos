<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Tthbon extends Model
{
    public $timestamps = false;
    protected $table = 'tthbon';

    protected $fillable = ['tthboncage','tthbonitem','tthbonmont','tthbonestd','tthbonmrcb','tthbonfpro',
                            'tthbonfreg','tthbonhora','tthbonusrn'];

    public function setTthbonmontAttribute($value)
    {
        $this->attributes['tthbonmont'] = Crypt::encryptString($value);
    }

    public function getTthbonmontAttribute($value)
    {
        return Crypt::decryptString($value);
    }
}
