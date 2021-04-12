<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Tthpgp  extends Model
{
    public $timestamps = false;
    protected $table = 'tthpgp';
    //protected $primaryKey = 'admodmodn';
    protected $fillable = ['tthpgptdes','tthpgpcent','tthpgpcnta','tthpgpcnti','tthpgpfpag','tthpgpsbas',
                            'tthpgpr5ta','tthpgpafam','tthpgpseps','tthpgpfpro','tthpgpfreg','tthpgphora','tthpgpusrn','tthpgpestd','tthpgpmrcb'];

    public function setTthpgpsbasAttribute($value)
    {
        $this->attributes['tthpgpsbas'] = Crypt::encryptString($value);
    }

    public function getTthpgpsbasAttribute($value)
    {
        return Crypt::decryptString($value);
    }
}
