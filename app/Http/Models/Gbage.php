<?php

namespace App\Http\Models;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\GlobalFunction;

class Gbage extends Model
{
    use GlobalFunction;

    public $timestamps = false;
    protected $table = 'gbage';
    //protected $primaryKey = 'admodmodn';
    //protected $fillable = ['admdtmdtn'];

    public function getGbagetdidAttribute($value)
    {
        switch ($value) {
          case 1: return 'DNI';break;
          default: return 'RUC';
        }
    }

    public function getGbagenombAttribute($value)
    {
        return $this->LimpiarStrings($value);
    }

}
