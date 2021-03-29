<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Tthbon extends Model
{
    public $timestamps = false;
    protected $table = 'tthbon';

    protected $fillable = ['tthboncage','tthbonitem','tthbonmont','tthbonestd','tthbonmrcb','tthbonfpro',
                            'tthbonfreg','tthbonhora','tthbonusrn'];
}
