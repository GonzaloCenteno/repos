<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Tthpgp  extends Model
{
    public $timestamps = false;
    protected $table = 'tthpgp';
    //protected $primaryKey = 'admodmodn';
    protected $fillable = ['tthpgptdes','tthpgpcent','tthpgpcnta','tthpgpfpag','tthpgpsbas',
                            'tthpgpr5ta','tthpgpafam','tthpgpseps','tthpgpfpro','tthpgpfreg','tthpgphora','tthpgpusrn','tthpgpestd','tthpgpmrcb'];
}
