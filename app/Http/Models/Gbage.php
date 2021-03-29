<?php

namespace App\Http\Models;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\Model;

class Gbage extends Model
{
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

    public function scopeFilter(Builder $query, array $filters) {
        if ( ! request("page")) {
            session()->put("search", $filters['search'] ?? null);
            session()->put("trashed", $filters['trashed'] ?? null);
        }
        $query->when(session("search"), function ($query, $search) {
            $query->where('per_nombres', 'LIKE', '%'.$search.'%');
        })->when(session("trashed"), function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }
}
