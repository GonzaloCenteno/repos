<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Admdt extends Model
{
    public $timestamps = false;
    protected $table = 'admdt';
    //protected $primaryKey = 'admodmodn';
    protected $fillable = ['admdtmdtn'];
}
