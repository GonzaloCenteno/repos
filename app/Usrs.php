<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usrs extends Model
{
    public $timestamps = false;
    protected $table = 'informix.accpo';
    //protected $primaryKey = 'admin_id';

    protected $fillable = ['accpoccic','accponact'];
}
